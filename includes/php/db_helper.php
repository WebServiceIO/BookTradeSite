<?php
require_once('included_classes.php');

// TODO convert to boolean on returns and have web page take care of that
class db_helper
{
    private  $db_connection;

    function __construct()
    {
        $this->db_connection = db_loader::connect();
    }

    public function insertSession($session_info)
    {
        try {
           
            $statement = $this->db_connection->prepare("INSERT INTO sessions ('user_id', 'fingerprint', 'time_stamp') VALUES(:user_id, :fingerp, :time_stamp )");
            if (isset($session_info['USER_ID']) && isset($session_info['FINGER_PRINT']) && isset($session_info['TIME_STAMP']))
            {
                $statement->bindValue(':user_id', $session_info['USER_ID'], PDO::PARAM_INT);
                $statement->bindValue(':fingerp', $session_info['FINGER_PRINT'], PDO::PARAM_STR);
                $statement->bindValue(':time_stamp', $session_info['TIME_STAMP'], PDO::PARAM_STR);
                $result = $statement->execute();
                return $result;
            }
        } catch (PDOException $e) {
            echo "Error, please report to admin error code 542";
        }
        // some reason, the array values were not there and it cant continue
        return false;
    }


    public function checkEmail($email){
        try {
         
            $statement = $this->db_connection->prepare("SELECT * FROM users WHERE email = '$email'");
            $result = $statement->execute();
            return $result;
        }catch(PDOException $e){
            echo "Error, please report to admin error code 542";
        }
    }

    public function getUserIdFromEmail($login)
    {
        try {
         
            $statement = $this->db_connection->prepare("SELECT user_id FROM users WHERE email = '$login'");
            $result = $statement->execute();




            return $result;
        }catch(PDOException $e){
            echo "Error, please report to admin error code 134";
        }
    }

    public function verifyPassword($email, $password){
        try {
            
            $statement = $this->db_connection->prepare("SELECT password FROM users WHERE email = '$email'");
            $statement->execute();
           // $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $hashed_pass = $statement->fetch();

           // echo($hashed_pass['password']);

            return password_verify($password,$hashed_pass['password']);
        }catch(PDOException $e){
            echo "Error, please report to admin error code 131";
        }
    }


    public function getFName($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT fname FROM users WHERE user_id = '$user_id'");
            $statement->execute();
            return $statement->fetch()['fname'];
        }catch(PDOException $e){
            echo "Error, please report to admin error code 131";
        }
    }
}
