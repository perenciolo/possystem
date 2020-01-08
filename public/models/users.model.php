<?php

require_once "connection.php";

class UsersModel
{

    /**
     * ============
     *  SHOW USERS
     * ============
     */
    public static function mdlShowUsers($table, $item, $value)
    {

        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Add new User to DB.
     *
     * @param string $table
     * @param array $data
     * @return boolean
     */
    public static function mdlAddUser(string $table, array $data): bool
    {
        $stmt = Connection::connect()
            ->prepare(
                "INSERT INTO {$table}(name, user, password, profile, photo) VALUES (:name, :user, :password, :profile, :photo)"
            );

        $stmt->bindParam(":name", $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(":user", $data['user'], PDO::PARAM_STR);
        $stmt->bindParam(":password", $data['password'], PDO::PARAM_STR);
        $stmt->bindParam(":profile", $data['profile'], PDO::PARAM_STR);
        $stmt->bindParam(":photo", $data['photo'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $stmt = null;
            return true;
        }

        $stmt = null;
        return false;
    }
}
