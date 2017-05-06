<?php
namespace Felis;

/**
 * Manage users in our system.
 */
class Users extends Table {

    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }
    /**
     * Test for a valid login.
     * @param $email User email
     * @param $password Password credential
     * @returns User object if successful, null otherwise.
     */
    public function login($email, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=? and password=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email, $password));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));
    }

    /**
     * Get a user based on the id
     * @param $id ID of the user
     * @returns User object if successful, null otherwise.
     */
    public function get($id) {

        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));
    }

    /**
     * Modify a user record based on the contents of a User object
     * @param User $user User object for object with modified data
     * @return true if successful, false if failed or user does not exist
     */
    public function update(User $user) {

        if(!$this->get($user->getId())){
            return false;
        }
        $sql =<<<SQL
UPDATE $this->tableName
set email=?,name=?,phone=?,address=?,notes=?,role=?
where id=?
SQL;

        try {
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $ret = $statement->execute(array($user->getEmail(), $user->getName(), $user->getPhone(),$user->getAddress(),$user->getNotes(), $user->getRole(),$user->getId() ));
            return $ret;
        } catch(\PDOException $e) {
            // do something when the exception occurs...
            return false;
        }

    }

    public function getClients(){
        $sql = <<<SQL
select name, id from $this->tableName
where role='C'
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();
        if($statement->rowCount() === 0) {
            return null;
        }
        $users = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $usersArray = array();
        foreach($users as $user){
            array_push($usersArray,$user);
        }
        return $usersArray;




    }


}