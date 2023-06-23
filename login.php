<!DOCTYPE HTML>
<?php
include "header.html";
?>

<body>
    <div class="wrapper">
        <h1>Gothenburg Trail Riders</h1>
        <h2>Log in:</h2>

        <form class="content" action="loginscript.php" method="POST">

            <label>Username:</label>
            <input type="name" name="anvandarnamn" placeholder="Användarnamn">

            <label>Password:</label>
            <input type="password" name="losenord" placeholder="Lösenord">

            <button type="submit">Log in</button>

            <a href="logout.php">Log out!</a>
        </form>
    </div>

</body>

</html>