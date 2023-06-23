<?php 
// logout
include_once "header.html";
session_start();

if (isset($_SESSION["anvandarnamn"])) {
    session_destroy();
    echo "<p class='content wrapper'> You have been logged out, thanks for your visit! </p>";
}

else {
    echo "<div class='main'><br />" .
          "<p class='content wrapper'>You can not log out because you are not logged in </p>";
}
exit();
