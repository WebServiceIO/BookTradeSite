<?php
    $host;
    $user;
    $password;
    $database;
    $key = $_GET['confirmKey'];
    //Query the temporary database for the key.
    //If it is found, add all the information to a solid database
    $myQuery = mysqli_connect($host,$user,$password,$database);
    if(mysqli_connect_errno()){
        echo "The connection to the database has failed.";
        exit();
    }
    else{
        $statement = "SELECT name, email, username, password FROM pending_activation_db WHERE confirmation_code = $key";
        $result = $myQuery->query($statement);
        //Check temp database
        if(($result->num_rows) > 0){
            //connect to the user database and add this new user
            $addToDatabase = mysqli_connect($host, $user, $password, user_db);
            if(mysqli_connect_errno()){
                echo "Error could not connect to user database";
                exit();
            }
            else{
                $fetchedResults = $result->fetch_row();
                $statement = "INSERT INTO user_db(name, email, username, password) 
                              VALUES($fetchedResults['name'], $fetchedResults['email'], $fetchedResults['username'], $fetchedResults['password'])";
                $
            }
        }
        $query->close();
    }

?>