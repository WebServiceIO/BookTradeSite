<?php
require_once('config/included_classes.php');
// TODO convert to boolean on returns and have web page take care of that
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
            return true;
        }
        catch (Exception $e)
        {
            $this->db_connection->rollBack();
            echo  $e->getMessage();
            return false;
        }

    }

    public function deleteSession($user_id)
    {
        try {
                $statement = $this->db_connection->prepare("DELETE FROM sessions WHERE user_id = '$user_id'");
                $result = $statement->execute();
                return $result;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }


    public function checkEmail($email){
        try {
            $statement = $this->db_connection->prepare("SELECT * FROM users WHERE email = '$email'");
            $result = $statement->execute();
            return $statement->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getUserIdFromEmail($email)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT user_id FROM users WHERE email = '$email'");
            $statement->execute();
            return $statement->fetch()['user_id'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }


    public function getUserNameFromID($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT username FROM users WHERE user_id = '$user_id'");
            $statement->execute();
            return $statement->fetch()['username'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getAllUserPost($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT username FROM users WHERE user_id = '$user_id'");
            $statement->execute();
            return $statement->fetch()['username'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function load_by_id ($id)
    {
        try {
            $statement =  $this->db_connection->prepare('SELECT id, name FROM users WHERE id=?');
            $statement->execute([$id]);
            return $statement->fetchObject(__CLASS__);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getFingerprintInfoFromId($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT fingerprint FROM sessions WHERE user_id = '$user_id'");
            $statement->execute();
            return $statement->fetch()['fingerprint'];
        }catch(PDOException $e){
            echo $e->getMessage();
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
            echo $e->getMessage();
        }
    }

    public function getFName($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT fname FROM users WHERE user_id = '$user_id'");
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
            $user_count = $this->db_connection->query("SELECT username FROM users WHERE username = :username");
            $user_count->bindValue(':username', $username, PDO::PARAM_STR);
            if ($user_count->rowCount() >= 1)
                return true;
            else
                return false;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }


}

