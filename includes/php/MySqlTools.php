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
        try {
            $statement = $this->db_connection->prepare("INSERT INTO sessions (user_id, fingerprint, time_stamp) VALUES(:user_id, :fingerp, :time_stamp )");

            if (isset($session_info['user_id']) && isset($session_info['finger_print']) && isset($session_info['time_stamp']))
            {

                $statement->bindValue(':user_id', $session_info['user_id'], PDO::PARAM_INT);
                $statement->bindValue(':fingerp', $session_info['finger_print'], PDO::PARAM_STR);
                $statement->bindValue(':time_stamp', $session_info['time_stamp'], PDO::PARAM_STR);
                $result = $statement->execute();

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


    function getTableColumns($table, $id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT * FROM '$table' where user_id = '$id'");
            $statement->execute();
            //$result = $statement->fetch();

            $result = $statement->fetchAll(PDO::FETCH_CLASS);

            var_dump($result);


            return $result;

        } catch (PDOException $e) {
            echo "Error, please report to admin error code 542";
        }

        return null;
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
            return $statement->fetch();
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


    public function getUserNameFromID($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT username FROM users WHERE user_id = '$user_id'");
            $statement->execute();
            return $statement->fetch()['username'];
        }catch(PDOException $e){
            echo "Error, please report to admin error code 134";
        }
    }

    public function getAllUserPost($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT username FROM users WHERE user_id = '$user_id'");
            $statement->execute();
            return $statement->fetch()['username'];
        }catch(PDOException $e){
            echo "Error, please report to admin error code 134";
        }
    }

    public static function load_by_id ($id) {
        $stmt = $pdo->prepare('SELECT id, name FROM users WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->fetchObject(__CLASS__);
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

            echo '<br>';
            var_dump (password_get_info($hashed_pass['password']));
            echo strlen($hashed_pass['password']);
            echo '<br>';
            echo substr($hashed_pass['password'], 0, 60);
            echo '<br>';

            return password_verify($password, substr($hashed_pass['password'], 0, 60));
        }catch(PDOException $e){
            echo "Error, please report to admin error code 131";
        }
    }

//    public function verifyPassword($email, $password){
//        try {
//            echo $email . $password;
//            $statement = $this->db_connection->prepare("SELECT password FROM users WHERE email = '$email'");
//            $statement->execute();
//            $hashed_pass = $statement->fetch();
//            var_dump( $hashed_pass);
//            echo $password;
//            return password_verify($password,$hashed_pass['password']);
//        }catch(PDOException $e){
//            echo "Error, please report to admin error code 131";
//        }
//    }


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

    function registerUser($username, $password, $fname, $lname, $email)
    {
        $hashed_password = Security::hash_password($password);

        echo '<br>';
        echo 'HASHED PASS: ' . $hashed_password;
        echo '<br>';
        echo strlen($hashed_password);
        echo '<br>';
        // TODO will need to be updated for sessions later
        $insert = $this->db_connection->prepare("INSERT INTO users (username, password, email, fname, lname) VALUES (:username, :hashed_password, :email, :fname, :lname)");
        // PDO::PARAM_STR (integer) : Represents the SQL CHAR, VARCHAR, or other string data type.
        $insert->bindValue(':username', $username, PDO::PARAM_STR);
        $insert->bindValue(':hashed_password', $hashed_password, PDO::PARAM_STR);
        $insert->bindValue(':email', $email, PDO::PARAM_STR);
        $insert->bindValue(':fname', $fname, PDO::PARAM_STR);
        $insert->bindValue(':lname', $lname, PDO::PARAM_STR);
        // execute query
        $insert->execute();
        return true;


    }


    // TODO convert to PDO later
    function checkUsername($username)
    {
        $user_count = $this->db_connection->query("SELECT username FROM users WHERE username = '$username'")->rowCount();
        if($user_count >= 1)
            return true;
        else
            return false;
    }


}
