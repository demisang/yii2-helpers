<?php
/**
 * @copyright Copyright (c) 2018 Ivan Orlov
 * @license   https://github.com/demisang/yii2-helpers/blob/master/LICENSE
 * @link      https://github.com/demisang/yii2-helpers#readme
 * @author    Ivan Orlov <gnasimed@gmail.com>
 */

namespace demi\helpers;

use yii\base\BaseObject;
use Yii;

/**
 * Хелпер для работы с паролями
 *
 * @see     http://ru2.php.net/manual/ru/book.password.php
 *
 * @deprecated Since Yii 2.0.6 used this hash strategy by default
 */
class Password extends BaseObject
{
    /**
     * Returns the hash of the password
     *
     * @param string $password Original password
     * @param int $algo        Encryption algorithm
     * @param array $options   Additional options for encryption, for example:
     *                         ```
     *                         [
     *                         'salt' => 'my salt here',
     *                         'cost' => 12 // the default cost is 10
     *                         ];
     *                         ```
     *
     * @return bool|string Hash of the password
     */
    public static function getHash($password, $algo = null, $options = [])
    {
        if (version_compare(PHP_VERSION, "5.5.0", ">=")) {
            if ($algo === null) {
                $algo = PASSWORD_DEFAULT;
            }

            return password_hash($password, $algo, $options);
        } else {
            return Yii::$app->security->generatePasswordHash($password);
        }
    }

    /**
     * Verifies that the password is matches the hash
     *
     * @param string $password Specified password for verification
     * @param string $hash     Correct password hash
     *
     * @return bool TRUE if the password is correct, otherwise FALSE
     */
    public static function verify($password, $hash)
    {
        if (version_compare(PHP_VERSION, "5.5.0", ">=")) {
            return password_verify($password, $hash);
        } else {
            return Yii::$app->security->validatePassword($password, $hash);
        }
    }

    /**
     * Checks whether need to re-hash this password
     *
     * @param string $hash   Hash of the password
     * @param int $algo      Encryption algorithm
     * @param array $options Encryption options, see [[getHash]]
     *
     * @return boolean Returns TRUE, if the password must be re-hashed, otherwise FALSE
     *                 Do not forget after re-hashing update it in the database
     */
    public static function needsRehash($hash, $algo = null, $options = [])
    {
        if (version_compare(PHP_VERSION, "5.5.0", ">=")) {
            if ($algo === null) {
                $algo = PASSWORD_DEFAULT;
            }

            return password_needs_rehash($hash, $algo, $options);
        } else {
            return false;
        }
    }
}
