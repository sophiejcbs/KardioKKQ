<!-- Description: Receive Data from manager_registration.php and fix_registration.php, identifies errors and saves in session state variables -->
<!-- Author: Sophie Nadine Jacobs -->
<!-- Date: 28/6/2023 -->
<!-- Validated: OK 28/6/2023 -->
<?php 
    session_start(); //start session
    if(!isset($_SESSION["errors_registration"])) { //check if session var exists
        $_SESSION["errors_registration"] = array(); //create and set session var
    }
?>
<?php
    function sanitise_input($data) {
        $data = trim($data); //remove leading/trailing space <script src="scripts/menu.js"></script>
        $data = stripslashes($data); //remove backslash in front of quote
        $data = htmlspecialchars($data); //convert html control char like < to HTML code &lt;
        return $data;
    }
?>
<?php
    require_once("settings.php"); //connection info

    $conn = @mysqli_connect($host,
            $user,
            $pwd,
            $sql_db
    );

    if(!$conn) {
        //display err msg
        echo "<p>Database connection failure</p>"; //not in production script
    }
    else {
        $sql_table = "managers";

        $fields = "user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(40) NOT NULL,
        userPwd VARCHAR(100) NOT NULL";
        $sqlString = "CREATE TABLE IF NOT EXISTS $sql_table ($fields);"; 

        $result = @mysqli_query($conn, $sqlString);

    if(!$result) { //check if table was created
        echo "<p class=\"wrong\">Unable to create Table $sql_table.". mysqli_error($conn) . ":". mysqli_error($conn) ." </p>"; //Would not show in a production script
    }
    else {
        if(isset($_POST["username"])) {
            $username = $_POST["username"];
        }
        else {
            //Redirect to Registration page and destroy session data, if process not triggered by a form submit.
            header("location: manager_registration.php");
            session_destroy();
        }

        if(isset($_POST["userPwd"])) {
            $userPwd = $_POST["userPwd"];
        }

        $username = sanitise_input($username);
        $userPwd = sanitise_input($userPwd);

        $errors_registration = array();

        if($username == "") {
            $errors_registration["username"] = "You must enter a username.";
        }
        else { //unique username validation
            $sqlString = "show tables like '$sql_table'";
            $result = @mysqli_query($conn, $sqlString);

            if(mysqli_num_rows($result) != 0) {
                $query = "select * from $sql_table";
    
                //execute query
                $result = mysqli_query($conn, $query);
    
                if(!$result) {
                    echo "<p>Something is wrong with ",	$query, "</p>";
                }
                else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($username == $row["username"]) {
                            $errors_registration["username"] = "Your username is not unique.";
                            break;
                        }
                    }
                }
            }
        }

        //password rule
        if($userPwd == "") {
            $errors_registration["userPwd"] = "You must enter a password.";
        }
        //min length of 8 characters
        else if (strlen($userPwd) < 8) {
            $errors_registration["userPwd"] = "Your password must be at least 8 characters long.";
        }

        //min length of 100 characters
        else if (strlen($userPwd) > 100) {
            $errors_registration["userPwd"] = "Your password can only be 100 characters long.";
        }

        //must contain uppercase and lowercase letters
        else if (!preg_match('/[a-z]/', $userPwd) || !preg_match('/[A-Z]/', $userPwd)) {
            $errors_registration["userPwd"] = "Your password must contain uppercase and lowercase characters.";
        }

        //at least 1 numeric digit
        else if (!preg_match('/[0-9]/', $userPwd)) {
            $errors_registration["userPwd"] = "Your password must contain at least 1 numeric digit.";
        }

        //at least 1 special character
        else if (!preg_match('/[!@#$%^&*()]/', $userPwd)) {
            $errors_registration["userPwd"] = "Your password must contain at least 1 special character.";
        }

        if(count($errors_registration) == 0) {
            $query = "INSERT INTO $sql_table (username, userPwd) VALUES('$username', '$userPwd')";

            $result = mysqli_query($conn, $query);
            if(!$result) {
                //not shown in production script
                echo "<p class = \"wrong\">Something is wrong with ", $query, "</p>";
            }
            else {
                $_SESSION["username"] = $username;
                $_SESSION["userPwd"] = $userPwd;
                header("location: login.php");
            }
        }
        else {
            $_SESSION["errors_registration"] = $errors_registration; 
            $_SESSION["username"] = $username;
            $_SESSION["userPwd"] = $userPwd;

            header("location: fix_registration.php");
        }
     }
    
    //close db connection
    mysqli_close($conn);
    }
    
?>