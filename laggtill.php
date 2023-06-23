<!DOCTYPE HTML>
<?php
include "header.html";

session_start();

//is there no session: $_SESSION['anvandartillgang'] send user to log in page. 
if (!isset($_SESSION['anvandartillgang'])) {
    header("Location:login.php");
}

//when user is logged in they can add event. 
else if ($_SESSION['anvandartillgang'] === 'Admin1' || $_SESSION['anvandartillgang'] === 'Admin2') {
    echo "<p class='content wrapper'>Welcome you are logged in as: " . $_SESSION['anvandarnamn'] . "</p>";
}
//
else {
    header("Location:login.php");
    echo "<p class='content wrapper'>Please log in to access this page.</p>";
}
?>

<body>
    <div class="wrapper">
        <h1>Add event:</h1>


        <form class="content" action="laggtillscript.php" method="POST">

            <label>Event name:</label>
            <input type="name" name="namn" placeholder="Event namn:">

            <label>Palce:</label>
            <input type="name" name="plats" placeholder="Plats">

            <label>Date:</label>
            <input type="date" name="datum" placeholder="Datum">

            <label>Time:</label>
            <input type="time" name="tid" placeholder="Tid">

            <label>Price:</label>
            <input type="number" name="pris" placeholder="Pris">

            <button type="submit">Add event</button>
        </form>
    </div>

</body>

</html>