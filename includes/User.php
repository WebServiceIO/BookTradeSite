<?php

// https://github.com/seanhweb/PHP-Secure-Session-Database-Login/blob/master/inc/class.user.inc.php
class User
{
    protected $db_connection;

    public function __construct()
    {
        $this->db_connection = db_loader::connect();
    }


    // create user into DB
//    public function create($username, $password, $fname, $lname, $email)
//    {
//        if($this->checkUser($username, $email))
//        {
//            // TODO research more, it may redirect to that [age
//            // sends a raw http header
//            // in this case, header field is location and value is root of the web page
//            // https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
//            //https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
//            // http://stackoverflow.com/questions/24039340/why-is-the-http-location-header-only-set-for-post-requests-201-created-respons
//            // it will redirect you to this page!
//            header('Location: '. site_root . '?error');
//            exit("User name already taken");
//        }
//        else
//        {
//            $hashed_password = DBSecurity::hash_password($password);
//
//            // TODO WHAT IS ROLE
//            //$insert = $this->db_connection->prepare("INSERT INTO `users` (`uid`,`username`,`password`, `role`) VALUES ('', :username, :password, '1')");
//            $insert = $this->db_connection->prepare("INSERT INTO users (username, password, email, fname, lname) VALUES (:username, :hashed_password, :email, :fname, :lname)");
//
//            // PDO::PARAM_STR (integer) : Represents the SQL CHAR, VARCHAR, or other string data type.
//            $insert->bindValue(':username', $username, PDO::PARAM_STR);
//            $insert->bindValue(':hashed_password', $hashed_password, PDO::PARAM_STR);
//            $insert->bindValue(':email', $email, PDO::PARAM_STR);
//            $insert->bindValue(':fname', $fname, PDO::PARAM_STR);
//            $insert->bindValue(':lname', $lname, PDO::PARAM_STR);
//
//            $insert->execute();
//
//            header('Location: '. loggedin);
//
////            if($session->isLoggedIn() == false) {
////                $this->login($username, $password);
////            }
//
//        }
//    }
//

    //  https://www.sitepoint.com/password-hashing-in-php/


    public function login($username, $password)
    {
        $sth = $this->db_connection->prepare("SELECT password from users WHERE username = :username LIMIT 1");
        $sth->bindParam(':username',$username);
        $sth->execute();
        // PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names returned in your result set
        $user = $sth->fetch(PDO::FETCH_OBJ);

//        foreach($this->dbh->query("SELECT uid FROM users WHERE username = '$username'") as $row) {
//            $user_id = $row['uid'];
//        }
        if ( crypt($password, $user->password) === $user->password) {
//            $session = new session();
//            $session->begin_database_session($username,$user_id);
            //password matches, process in session
        }
        else {
            header('Location: '.site_root.'?error');
        }
    }

    function checkUser($username, $email)
    {
        // TODO check if email exist MORE THAN one time, count function
        $user_count =  $this->db_connection->query("SELECT username FROM users WHERE username = '$username'")->rowCount();
        $email_count =  $this->db_connection->query("SELECT email FROM users WHERE email = '$email'")->rowCount();

        if($user_count >= 1 || $email_count>= 1) {
            return true;
        }
        else {
            return false;
        }
    }

}