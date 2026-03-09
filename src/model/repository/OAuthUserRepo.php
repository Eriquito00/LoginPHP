<?php

namespace App\Model\Repository;

use App\Model\Entities\OAuthUser;
use App\Model\Entities\User;

interface OAuthUserRepo {
    /**
     * Funcion que obtiene un usuario en base a un proveedor y un ID de proveedor
     *
     * @param OAuthUser $oauthUser
     * @return void
     */
    public function findOAuthAccount(OAuthUser $oauthUser);

    /**
     * Funcion que inserta la informacion OAuth de un usuario en base a su User ID
     *
     * @param User $user
     * @param OAuthUser $oauthUser
     * @return void
     */
    public function createOAuthAccount(User $user, OAuthUser $oauthUser);

    /**
     * Funcion que actualiza el access_token cuando se vuelve a hacer un login
     *
     * @param OAuthUser $oauthUser
     * @return void
     */
    public function updateOAuthToken(OAuthUser $oauthUser);
}
?>