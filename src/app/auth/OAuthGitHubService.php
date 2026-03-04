<?php
namespace App\App\Auth;

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

    public function getUserData(string $accessToken): array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_ENV["GITHUB_USER_API"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Accept: application/vnd.github.v3+json',
            'User-Agent: ' . $_ENV["GITHUB_USERAGENT"]
        ]);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($statusCode !== 200) {
            return ['error' => 'Failed to fetch user data'];
        }

        return json_decode($response, true);
    }
}
?>