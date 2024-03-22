<!-- Description: Clear the session so that a user cannot access manager.php anymore -->
<!-- Author: Sophie Nadine Jacobs -->
<!-- Date: 28/6/2023 -->
<!-- Validated: OK 28/6/2023 -->
<?php
    session_start();                //start the session
    session_unset();                //unset all session variables
    session_destroy();              //destroy all session variables
    header("location: manager_home.php");
?>