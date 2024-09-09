<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct($username = null, $email = null, $password = null)
    {
        $this->username = htmlspecialchars($username);
        $this->email = htmlspecialchars($email);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public static function all()
    {
        return R::findAll('users');
    }

    public static function find($id)
    {
        return R::load('users', $id);
    }

    public function save()
    {
        $user = R::dispense('users');
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $this->password;
        
        try {
            R::store($user);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function updatePassword($id, $newPassword)
    {
        $user = R::load('users', $id);

        if ($user->id) {
            $user->password = password_hash($newPassword, PASSWORD_DEFAULT);
            try {
                R::store($user);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }
}