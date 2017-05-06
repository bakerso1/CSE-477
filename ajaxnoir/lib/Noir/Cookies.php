<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/28/2017
 * Time: 7:55 PM
 */

namespace Noir;


class Cookies extends Table
{

    public function __construct(Site $site) {
        parent::__construct($site, "cookie");
    }
    /**
     * Create a new cookie token
     * @param $user User to create token for
     * @return New 32 character random string
     */
    public function create($user) {
        $sql = <<<SQL
INSERT INTO $this->tableName (user, salt, hash)
VALUES (?, ?, ?)
SQL;
        $statement = $this->pdo()->prepare($sql);
        $token = $this->randomSalt(32);
        $password = $this->randomSalt(32);
        $hash = hash("sha256", $token.$password);
        $statement->execute(array($user, $token, $hash));
        return $token;
    }
    public static function randomSalt($len = 16) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        return $str;
    }
    /**
     * Validate a cookie token
     * @param $user User ID
     * @param $token Token
     * @return null|string If successful, return the actual
     *   hash as stored in the database.
     */
    public function validate($user, $token) {
        $sql = <<<SQL
SELECT * FROM $this->tableName
WHERE user=? and salt=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($user, $token));
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        if($statement->rowCount() == 0){
            return null;
        }
        return $row['hash'];
    }
    /**
     * Delete a hash from the database
     * @param $hash Hash to delete
     * @return bool True if successful
     */
    public function delete($hash) {
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE hash=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($hash));
        return true;
    }

}