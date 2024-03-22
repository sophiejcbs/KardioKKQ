<!-- Description: Receive Data from login.php and fix_login.php, identifies errors and saves in session state variables -->
<!-- Author: Sophie Nadine Jacobs -->
<!-- Date: 28/6/2023 -->
<!-- Validated: OK 28/6/2023 -->
<?php 
    session_start(); //start session
    if(!isset($_SESSION["errors_login"])) { //check if session var exists
        $_SESSION["errors_login"] = array(); //create and set session var
    }
    $_SESSION["validUser"] = false;
    $errors_login = $_SESSION["errors_login"];
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

        if(isset($_POST["username"])) {
            $username = $_POST["username"];
        }
        else {
            //Redirect to login page and destroy session data, if process not triggered by a form submit.
            header("location: login.php");
            session_destroy();
        }

        if(isset($_POST["userPwd"])) {
            $userPwd = $_POST["userPwd"];
        }

        $username = sanitise_input($username);
        $userPwd = sanitise_input($userPwd);

        $errors_login = array();

        if($username == "") {
            $errors_login["username"] = "You must enter a username.";
        }
        if($userPwd == "") {
            $errors_login["userPwd"] = "You must enter a password.";
        }

        $validUser = false;

        if($username != "" && $userPwd != "") {
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
                        if($username == $row["username"] && $userPwd == $row["userPwd"]) {
                            $validUser = true;
                            break;
                        }
                    }
                }
            }
        }

        if($validUser != true) {
            $errors_login["noMatch"] = "No matching login credentials.";
        }

        if(count($errors_login) == 0) {
            $_SESSION["validUser"] = $validUser;
            header("location: manager.php");
        }
        else {
            $_SESSION["validUser"] = $validUser;
            $_SESSION["errors_login"] = $errors_login; 
            $_SESSION["username"] = $username;
            $_SESSION["userPwd"] = $userPwd;

            header("location: fix_login.php");
        }
    //close db connection
    mysqli_close($conn);
    }
    
?>