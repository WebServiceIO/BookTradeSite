<?php
require_once('included_classes.php');

// TODO convert to boolean on returns and have web page take care of that
class MySqlTools
{
    private  $db_connection;

    function __construct()
    {
        $this->db_connection = DataBaseLoader::connect();
    }

    public function insertSession($session_info)
    {

        var_dump($session_info);
        try {
            $statement = $this->db_connection->prepare("INSERT INTO sessions (user_id, fingerprint, time_stamp) VALUES(:user_id, :fingerp, :time_stamp )");

            if (isset($session_info['user_id']) && isset($session_info['finger_print']) && isset($session_info['time_stamp']))
            {
                echo 'debug!!!!!!!!!1';
                $statement->bindValue(':user_id', $session_info['user_id'], PDO::PARAM_INT);
                $statement->bindValue(':fingerp', $session_info['finger_print'], PDO::PARAM_STR);
                $statement->bindValue(':time_stamp', $session_info['time_stamp'], PDO::PARAM_STR);
                $result = $statement->execute();

                echo 'RESULT: ' . $result;
                return $result;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error, please report to admin error code 542" . $e;
            return false;
        }
        // some reason, the array values were not there and it cant continue
        //return false;
    }

    public function deleteSession($user_id)
    {
        try {
                $statement = $this->db_connection->prepare("DELETE FROM sessions WHERE user_id = '$user_id'");
                $result = $statement->execute();
                return $result;

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

    public function getUserIdFromEmail($email)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT user_id FROM users WHERE email = '$email'");
            $statement->execute();
            return $statement->fetch()['user_id'];
        }catch(PDOException $e){
            echo "Error, please report to admin error code 134";
        }
    }


    public function getFingerprintInfoFromId($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT fingerprint FROM sessions WHERE user_id = '$user_id'");
            $statement->execute();
            return $statement->fetch()['fingerprint'];
        }catch(PDOException $e){
            echo "Error, please report to admin error code 134";
        }
    }

    public function verifyPassword($email, $password){
        try {
            
            $statement = $this->db_connection->prepare("SELECT password FROM users WHERE email = '$email'");
            $statement->execute();
            $hashed_pass = $statement->fetch();
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
