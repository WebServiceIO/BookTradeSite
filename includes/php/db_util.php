<?php

require_once('config/included_classes.php');
require_once('db_tables/post.php');
require_once('web_security.php');

class DBUtilities
{
    private  $db_connection;

    function __construct()
    {
        $this->db_connection = DataBaseLoader::connect();
       // $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function addPost($user_id, $isbn, $title, $author, $edition, $class, $price, $comments, $item_condition)
    {
        try
        {
            $this->db_connection->beginTransaction();
            $isbn_id = null;

            // isbn = exist already in db
            // TODO convert the two following functions into one
            if($this->checkForIsbn($isbn)) {
                $isbn_id = $this->getIsbnIdFromIsbn($isbn);
            }
            // isbn != exist in db
            else
            {
                $isbn_table_statement = $this->db_connection->prepare("INSERT INTO isbns (isbn) VALUES(:isbn)");
                $isbn_table_statement->bindParam(':isbn', $isbn, PDO::PARAM_INT);
                $isbn_table_statement->execute();
                $isbn_id = $this->db_connection->lastInsertId();
            }

            $post_table_statement = $this->db_connection->prepare("INSERT INTO posts (user_id, title, author, edition, class, price, comments, item_condition) VALUES (:user_id, :title, :author, :edition, :class, :price, :comments, :item_condition)");
            $post_table_statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $post_table_statement->bindParam(':title', $title, PDO::PARAM_STR);
            $post_table_statement->bindParam(':author', $author, PDO::PARAM_STR);
            $post_table_statement->bindParam(':edition', $edition, PDO::PARAM_STR);
            $post_table_statement->bindParam(':class', $class, PDO::PARAM_STR);
            $post_table_statement->bindParam(':price', $price, PDO::PARAM_INT);
            $post_table_statement->bindParam(':comments', $comments, PDO::PARAM_STR);
            $post_table_statement->bindParam(':item_condition', $item_condition, PDO::PARAM_STR);
            $post_table_statement->execute();

            $last_post_entry = $this->db_connection->lastInsertId();

            $junction_table_statement = $this->db_connection->prepare("INSERT INTO posts_isbns (isbn_id, post_id) VALUES (:isbn_id, :post_id)");
            $junction_table_statement->bindParam(':isbn_id', $isbn_id, PDO::PARAM_INT);
            $junction_table_statement->bindParam(':post_id', $last_post_entry, PDO::PARAM_INT);
            $junction_table_statement->execute();

            $this->db_connection->commit();

            return array('post_id' => $last_post_entry, 'condition' => true);
        }
        catch (Exception $e)
        {
            $this->db_connection->rollBack();
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

    public function getIsbnFromIsbnID($isbn_id)
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

    public function getUserNameFromID($user_id)
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

    public function getEmailFromUserId($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT email FROM users WHERE user_id = :user_id");
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch()['email'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getContactInfo($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT contact_info FROM users WHERE user_id = :user_id");
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch()['contact_info'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getContactFromID($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT contact_info FROM users WHERE user_id = :user_id");
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch()['contact_info'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getIsbnFromPostID($post_id)
    {
        try {
            $this->db_connection->beginTransaction();

            $statement = $this->db_connection->prepare("SELECT isbn_id FROM posts_isbns WHERE post_id = :post_id");
            $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $statement->execute();

            $isbn_id = $statement->fetch()['isbn_id'];


            $statement = $this->db_connection->prepare("SELECT isbn FROM isbns WHERE isbn_id = :isbn_id");
            $statement->bindParam(':isbn_id', $isbn_id, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch()['isbn'];

        } catch (PDOException $e) {
            $this->db_connection->rollBack();
        }
    }

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

    public function checkValidUser($user_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT valid_bit FROM users WHERE user_id = :user_id");
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch()['valid_bit'];
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    function registerUser($username, $password, $fname, $lname, $email, $contact_info)
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

        if($check != null)
        {
            if ($check->fetchColumn())
                return false;
            else
            {
                try {
                    $statement = $this->db_connection->prepare("INSERT INTO users (username, password, email, fname, lname, contact_info, valid_bit) VALUES (:username, :hashed_password, :email, :fname, :lname, :contact_info, '0')");
                    $hashed_password = Security::hash_password($password);
                    $statement->bindValue(':username', $username, PDO::PARAM_STR);
                    $statement->bindValue(':hashed_password', $hashed_password, PDO::PARAM_STR);
                    $statement->bindValue(':email', $email, PDO::PARAM_STR);
                    $statement->bindValue(':fname', $fname, PDO::PARAM_STR);
                    $statement->bindValue(':lname', $lname, PDO::PARAM_STR);
                    $statement->bindValue(':contact_info', $contact_info, PDO::PARAM_STR);
                    // execute query
                    $statement->execute();

//                    $id = $this->db_connection->prepare("SELECT user_id FROM users WHERE username = '$username'");
//                    $id->execute();
//                    $result = $id->fetch(PDO::FETCH_ASSOC);

//                   $link = sendEmail($email,$result['user_id']);
//
//                    $this->addUserVerification($result['user_id'], $link);

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
            $statement->execute();
            return $statement->fetchColumn();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function changeUsername($username, $user_id)
    {
        try {
            $statement = $this->db_connection->prepare("UPDATE users SET username = :new_username WHERE user_id = :user_id");
            $statement->bindValue(':new_username', $username, PDO::PARAM_STR);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            return $statement->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    function changeUserPassword($password, $user_id)
    {
        try {
            $statement = $this->db_connection->prepare("UPDATE users SET password = :new_hashed_password WHERE user_id = :user_id");
            $hashed_password = Security::hash_password($password);
            $statement->bindValue(':new_hashed_password', $hashed_password, PDO::PARAM_STR);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            return $statement->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }



    function changeContactInfo($contact_info, $user_id)
    {
        try {
            $statement = $this->db_connection->prepare("UPDATE users SET contact_info = :new_contact_info WHERE user_id = :user_id");
            $statement->bindValue(':new_contact_info', $contact_info, PDO::PARAM_STR);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            return $statement->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function getIsbnIdFromIsbn($isbn)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT isbn_id FROM isbns WHERe isbn = :isbn");
            $statement->bindValue(':isbn', $isbn, PDO::PARAM_STR);
            $statement->execute();
            return  $statement->fetch()['isbn_id'];
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function getIsbnIdCountFromIsbn($isbn)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT isbn_id FROM isbns WHERe isbn = :isbn");
            $statement->bindValue(':isbn', $isbn, PDO::PARAM_STR);
            $statement->execute();
            return  $statement->fetchColumn();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    function getAllPostIdFromIsbnId($isbn_id)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT post_id FROM posts_isbns WHERE isbn_id = :isbn_id");
            $statement->bindValue(':isbn_id', $isbn_id, PDO::PARAM_INT);
            $statement->execute();
            return  $statement->fetchALL(PDO::FETCH_COLUMN, 0);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    function checkForIsbn($isbn)
    {
        try {
            $statement = $this->db_connection->prepare("SELECT * FROM isbns WHERE isbn = :isbn");
            $statement->bindValue(':isbn', $isbn, PDO::PARAM_STR);
            $statement->execute();
            return  $statement->fetchColumn();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function insertSession($session_info)
    {
        try {
            $statement = $this->db_connection->prepare("REPLACE INTO sessions (user_id, fingerprint, time_stamp) VALUES(:user_id, :fingerp, :time_stamp)");

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
            echo $e->getMessage();
            return false;
        }
    }

    function addUserVerification($user_id, $verification_link)
    {
        try {
            $statement = $this->db_connection->prepare("INSERT INTO unverified_users(user_id, verification_link) VALUES(:user_id, :veri_link)");
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $statement->bindValue(':veri_link', $verification_link, PDO::PARAM_STR);
            return $statement->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    function activateAccount($link)
    {
        try {
            $this->db_connection->beginTransaction();


            $statement = $this->db_connection->prepare("SELECT user_id FROM unverified_users WHERE verification_link = :link");
            $statement->bindValue(':link', $link, PDO::PARAM_STR);
            $result = $statement->execute();

            $user_id = $statement->fetch();
            $user_id = $user_id['user_id'];


            $statement = $this->db_connection->prepare("UPDATE users SET valid_bit = 1 WHERE user_id = :user_id");
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $result = $statement->execute();


            $statement = $this->db_connection->prepare("DELETE FROM unverified_users WHERE user_id = :user_id");
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $result = $statement->execute();

            $this->db_connection->commit();


        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->db_connection->rollBack();
            return false;
        }
    }

}
