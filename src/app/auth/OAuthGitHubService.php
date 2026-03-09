<?php
namespace App\App\Auth;

use App\Model\Entities\OAuthUser;
use Exception;

class OAuthGitHubService {
    private string $clientId;
    private string $clientSecret;
    private string $callbackUrl;

    public function __construct() {
        $this->clientId = $_ENV['GITHUB_CLIENT_ID'];
        $this->clientSecret = $_ENV['GITHUB_CLIENT_SECRET'];
        $this->callbackUrl = $_ENV['GITHUB_CALLBACK_URL'];
    }

    public function generateAuthorizationUrl(): array {
        session_start();

        // Generar CSFR
        $state = bin2hex(random_bytes(32));
        $_SESSION['oauth_state'] = $state;

        // Parametros para GitHub
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->callbackUrl,
            'scope' => 'user:email',
            'state' => $state,
        ];

        $authUrl = $_ENV["GITHUB_AUTHORIZE"] . http_build_query($params);

        return [
            'success' => true,
            'url' => $authUrl
        ];
    }

    public function changeCodeForToken(string $code): array {
        $params = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code,
        ];

        $url = $_ENV["GITHUB_ACCESS_TOKEN"];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
        curl_setopt($ch, CURLOPT_USERAGENT, $_ENV["GITHUB_USERAGENT"]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function getUserData(string $accessToken) {
        $userInfo = $this->getGithubUserInfo($_ENV["GITHUB_USER_API"], $_ENV["GITHUB_USERAGENT"], $accessToken);
        $userResponse = json_decode($userInfo["data"], true);
        $userStatus = $userInfo["status"];

        $emailsInfo = $this->getGithubUserInfo($_ENV["GITHUB_USER_EMAILS_API"], $_ENV["GITHUB_USERAGENT"], $accessToken);
        $emailsResponse = json_decode($emailsInfo["data"], true);
        $emailsStatus = $emailsInfo["status"];

        $email = null;
        foreach($emailsResponse as $e) {
            if ($e["primary"] === true) $email = $e["email"];
        }

        if ($userStatus !== 200) throw new Exception("Failed to fetch user data");
        if ($emailsStatus !== 200) throw new Exception("Failed to fetch emails");

        return new OAuthUser($userResponse["id"], "github", $userResponse["login"], $email, $accessToken);;
    }

    private function getGithubUserInfo(string $url, string $user_agent, string $accessToken): array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Accept: application/vnd.github.v3+json',
            'User-Agent: ' . $user_agent
        ]);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ["status" => $statusCode, "data" => $response];
    }
}
?>