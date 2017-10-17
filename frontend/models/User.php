<?php

namespace frontend\models;

use OAuth2\Storage\UserCredentialsInterface;
use common\models\User as CommonUser;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends CommonUser implements UserCredentialsInterface
{
    /**
     * @param mixed $token
     * @param null $type
     * @return \yii\web\IdentityInterface|static
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //TODO 实现根据token解析用户的方法
        return User::findIdentity(1);
    }

    /**
     * Grant access tokens for basic user credentials.
     *
     * Check the supplied username and password for validity.
     *
     * You can also use the $client_id param to do any checks required based
     * on a client, if you need that.
     *
     * Required for OAuth2::GRANT_TYPE_USER_CREDENTIALS.
     *
     * @param $username
     * Username to be check with.
     * @param $password
     * Password to be check with.
     *
     * @return
     * TRUE if the username and password are valid, and FALSE if it isn't.
     * Moreover, if the username and password are valid, and you want to
     *
     * @see http://tools.ietf.org/html/rfc6749#section-4.3
     *
     * @ingroup oauth2_section_4
     */
    public function checkUserCredentials($username, $password)
    {
        // TODO: Implement checkUserCredentials() method.
        return true;
    }

    /**
     * @return
     * ARRAY the associated "user_id" and optional "scope" values
     * This function MUST return FALSE if the requested user does not exist or is
     * invalid. "scope" is a space-separated list of restricted scopes.
     * @code
     * return array(
     *     "user_id"  => USER_ID,    // REQUIRED user_id to be stored with the authorization code or access token
     *     "scope"    => SCOPE       // OPTIONAL space-separated list of restricted scopes
     * );
     * @endcode
     */
    public function getUserDetails($username)
    {
        // TODO: Implement getUserDetails() method.
        return [
            "user_id" => 1,    // REQUIRED user_id to be stored with the authorization code or access token
            "scope" => 'scope'       // OPTIONAL space-separated list of restricted scopes
        ];
    }
}