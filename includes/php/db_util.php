<?php

require_once('config/included_classes.php');
require_once('db_tables/post.php');

class DBUtilities
{
    private  $db_connection;

    function __construct()
    {
        $this->db_connection = DataBaseLoader::connect();
        $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }




    function addPost($user_id, $isbn, $title, $author, $edition, $class, $price, $contact, $comments, $item_condition)
    {
        try
        {
            $this->db_connection->beginTransaction();

            $isbn_table_statement = $this->db_connection->prepare("INSERT INTO isbns (isbn) VALUES(:isbn)");
            $isbn_table_statement->bindParam(':isbn', $isbn, PDO::PARAM_INT);
            $isbn_table_statement->execute();

            $last_isbn_entry = $this->db_connection->lastInsertId();

            $post_table_statement = $this->db_connection->prepare("INSERT INTO posts (user_id, title, author, edition, class, price, contact, comments, item_condition) VALUES (:user_id, :title, :author, :edition, :class, :price, :contact, :comments, :item_condition)");
            $post_table_statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $post_table_statement->bindParam(':title', $title, PDO::PARAM_STR);
            $post_table_statement->bindParam(':author', $author, PDO::PARAM_STR);
            $post_table_statement->bindParam(':edition', $edition, PDO::PARAM_STR);
            $post_table_statement->bindParam(':class', $class, PDO::PARAM_STR);
            $post_table_statement->bindParam(':price', $price, PDO::PARAM_INT);
            $post_table_statement->bindParam(':contact', $contact, PDO::PARAM_STR);
            $post_table_statement->bindParam(':comments', $comments, PDO::PARAM_STR);
            $post_table_statement->bindParam(':item_condition', $item_condition, PDO::PARAM_STR);
            $post_table_statement->execute();

            $last_post_entry = $this->db_connection->lastInsertId();

            $junction_table_statement = $this->db_connection->prepare("INSERT INTO posts_isbns (isbn_id, post_id) VALUES (:isbn_id, :post_id)");
            $junction_table_statement->bindParam(':isbn_id', $last_isbn_entry, PDO::PARAM_INT);
            $junction_table_statement->bindParam(':post_id', $last_post_entry, PDO::PARAM_INT);
            $junction_table_statement->execute();

            $this->db_connection->commit();

            // TODO null/false check on lastinsertid?
            return array('post_id' => $this->db_connection->lastInsertId(), 'condition' => true);
        }
        catch (Exception $e)
        {
            $this->db_connection->rollBack();
            echo  $e->getMessage();
            //return false;
            return array('post_id' => null, 'condition' => false);
        }

    }

    public function deleteSession($user_id)
    {
        try {
                $statement = $this->db_connection->prepare("DELETE FROM sessions WHERE user_id = :user_id");
                $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $result = $statement->execute();
                return $result;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function checkEmail($email){
        try {
            $statement = $this->db_connection->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUserIdFromEmail($email)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT user_id FROM users WHERE email = :email");
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch()['user_id'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getUserNameFromID($isbn_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT isbn FROM isbns WHERE isbn_id = :isbn_id");
            $statement->bindParam(':isbn_id', $isbn_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch()['isbn_id'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUserIsbnFromIsbnID($isbn_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT username FROM users WHERE user_id = :user_id");
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch()['username'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


//    public function getAllUserPost($user_id)
//    {
//        try {
//            $statement = $this->db_connection->prepare("SELECT * FROM post WHERE user_id = :user_id");
//            $statement->bindParam(':user_id', $user_id);
//            $statement->execute();
//            return $statement->fetchAll(PDO::FETCH_CLASS, 'UserPost');
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//    }


    /**
     * @param $post_id
     * @return UserPost
     */
    public function getUserPost($post_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT * FROM posts WHERE post_id = :post_id");
            $statement->bindParam(':post_id', $post_id);
            $statement->execute();
            return $statement->fetchObject('UserPost');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getFingerprintInfoFromId($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT fingerprint FROM sessions WHERE user_id = :user_id");
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch()['fingerprint'];
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function verifyPassword($email, $password){
        try {

            $statement = $this->db_connection->prepare("SELECT password FROM users WHERE email = :email");
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->execute();
            $hashed_pass = $statement->fetch();
            return password_verify($password, substr($hashed_pass['password'], 0, 60));
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getFName($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT fname FROM users WHERE user_id = :user_id");
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch()['fname'];
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function registerUser($username, $password, $fname, $lname, $email)
    {
        $check = null;
        try {
        $check = $this->db_connection->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $check->bindParam(':username', $username);
        $check->bindParam(':email', $email);
        $check->execute();

        }catch(PDOException $e){
            echo $e->getMessage();
        }

        if($check != null) {
            if ($check->rowCount() > 0)
                return false;
            else {
                try {
                    $insert = $this->db_connection->prepare("INSERT INTO users (username, password, email, fname, lname) VALUES (:username, :hashed_password, :email, :fname, :lname)");
                    $hashed_password = Security::hash_password($password);
                    $insert->bindValue(':username', $username, PDO::PARAM_STR);
                    $insert->bindValue(':hashed_password', $hashed_password, PDO::PARAM_STR);
                    $insert->bindValue(':email', $email, PDO::PARAM_STR);
                    $insert->bindValue(':fname', $fname, PDO::PARAM_STR);
                    $insert->bindValue(':lname', $lname, PDO::PARAM_STR);
                    // execute query
                    $insert->execute();
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
            return true;
        }
        else{
            return false;
        }
    }

    function checkUsername($username)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT username FROM users WHERE username = :username");
            $statement->bindValue(':username', $username, PDO::PARAM_STR);

            if ($statement->rowCount() >= 1)
                return true;
            else
                return false;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
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
            echo "Error, please report to admin error code 548" . $e;
            return false;
        }
    }
}

