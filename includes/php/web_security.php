<?php


class Security
{
    static function hash_password($password)
    {
        $options = array(
            'cost' => 15
        );

        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

        return $hashed_password;
    }
}

