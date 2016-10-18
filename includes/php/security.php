<?php


class DBSecurity
{
    // https://jonsuh.com/blog/securely-hash-passwords-with-php/
    // https://github.com/seanhweb/PHP-Secure-Session-Database-Login/blob/master/inc/class.user.inc.php
    static function hash_password($password)
    {
        // http://php.net/manual/en/function.crypt.php
        // create a random cost
        $cost = 15;
        // salt
        // http://searchsecurity.techtarget.com/definition/salt
        // http://stackoverflow.com/questions/20893790/using-mcrypt-create-iv-to-create-salt
        // base64_encode makes the text URL safe
        // however, mcrypt_create_iv add + which in http post will turn into spaces, so we change them
        // stackoverflow.com/questions/5757870/sending-an-mcrypt-encrypted-string-via-a-url-parameter-decoded-text-is-mangled
        // TODO need to test with diff sizes, or does cost have to be same each passowrd?
        // TODO read
        // http://stackoverflow.com/questions/3135524/comparing-passwords-with-crypt-in-php
        // https://en.wikipedia.org/wiki/Bcrypt
        $salt = strtr(base64_encode(mcrypt_create_iv(rand(16, 32), MCRYPT_DEV_URANDOM)), '+', '.');
        // read intro
        // https://en.wikipedia.org/wiki/Bcrypt
        $salt = sprintf("$2a$%02d$", $cost) . $salt;
      /*
      *  The above function checks whether the Blowfish cipher is available through
      *  the CRYPT_BLOWFISH constant. If so, then we generate a random salt. The requirement
      *  is that the salt starts with “$2a$” (or “$2y$” see this notice on php.net) to
      * indicate the algorithm is Blowfish, followed by a two digit number from 4 to 31.
      * This number is a cost parameter that makes brute force attacks take longer. Then we
      * append an alphanumeric string containing 22 characters as the main portion of our salt.
      *  The alphanumeric string can also include ‘.’ and ‘/’.
      */
        $options = array(
//            'cost' => rand(0, 1000),
//            'salt' => mcrypt_create_iv($salt, MCRYPT_DEV_URANDOM),
            'cost' => $cost,
            'salt' => $salt
        );
        /*
         *  crypt()
         *  The salt parameter is optional. However, crypt() creates a weak password without the salt.
         *  PHP 5.6 or later raise an E_NOTICE error without it. Make sure to specify a strong enough salt for better security.
         *  password_hash() uses a strong hash, generates a strong salt, and applies proper rounds automatically.
         * password_hash() is a simple crypt() wrapper and compatible with existing password hashes. Use of password_hash() is encouraged.
         */
        // PASSWORD_BCRYPT = crypt_blowfish
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options)."\n";

        //**************************other info on blow fish salt: look at top comment http://stackoverflow.com/questions/3135524/comparing-passwords-with-crypt-in-php **************************

        return $hashed_password;
    }
}

