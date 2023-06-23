<!DOCTYPE HTML>
<?php
include "header.html";
//star a session
session_start();

//if no session please login
if (!isset($_SESSION['anvandartillgang'])) {
    header("Location:login.php");
}

//if user have logged in with correct user.
else if ($_SESSION['anvandartillgang'] === 'Admin2') {
    echo "<p class='content wrapper'>Welcome you are logged in as: " . $_SESSION['anvandarnamn'] . "</p>";
} else {
    echo "<p class='content wrapper'> Please log in </p>";
    header("Location:login.php");
}

?>

<body>
    <div class="wrapper">
        <h1>Delete event:</h2>

            <form class="content" action="tabortscript.php" method="POST">

                <label>Event name:</label>
                <input type="name" name="id" placeholder="Event ID:">

                <button type="submit">Delete</button>
            </form>
    </div>

</body>

</html>