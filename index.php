<!DOCTYPE HTML>
<?php
include "header.html";
?>

<body>
    <div class="wrapper">
        <h2 class="secondheader">Event calander</h2>
        <table class="table">
            <tr>
                <td class="content tableheader">Event</td>
                <td class="content tableheader">Event ID</td>
                <td class="content tableheader">Palce</td>
                <td class="content tableheader">Date</td>
                <td class="content tableheader">Time</td>
                <td class="content tableheader">Price</td>
            </tr>
    </div>


    <?php
    //include connetion to the database
    include "connecttodb.php";
    session_start();

    //if user not logged in, show only upcoming events
    if (!isset($_SESSION['anvandartillgang'])) {

        $sql = "SELECT * FROM goteborgsstigcyklisterevent WHERE datum >= CURDATE() ORDER BY datum";
        $result = $conn->query($sql);
        //Checking for errors:
        if (!$result) {
            trigger_error('Invalid query: ' . $conn->error);
        }

        //Display result.
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<td class='content'>" . $row["namn"] . "</td><td class='content'>" . $row["plats"] . "</td><td class='content'>" . $row["datum"] . "</td><td class='content'>" . $row["tid"] . "</td><td class='content'>" . $row["pris"] . "</td></tr>";
            }
        } else {
            echo "0 results";
        }
    }

    //if user is logged in show all events
    else if ($_SESSION['anvandartillgang'] === 'Admin1' || $_SESSION['anvandartillgang'] === 'Admin2') {
        //with sql fetching data from the database and order by date 
        $sql = "SELECT * FROM goteborgsstigcyklisterevent ORDER BY datum";
        $result = $conn->query($sql);
        echo "<p class='wrapper'>Welcome you are logged in as: " . $_SESSION['anvandarnamn'] . "</p>";

        //checking for errors:
        if (!$result) {
            trigger_error('Invalid query: ' . $conn->error);
        }

        //Display data from the database
        if ($result->num_rows > 0) {
            //skriv ut data i varje rad
            while ($row = $result->fetch_assoc()) {
                echo "<td class='content'>" . $row["namn"] . "</td><td class='content'>" . $row["id"] . "</td><td class='content'>" . $row["plats"] . "</td><td class='content'>" . $row["datum"] . "</td><td class='content'>" . $row["tid"] . "</td><td class='content'>" . $row["pris"] . "</td></tr>";
            }
        } else {
            echo "0 results";
        }
    }
    //Close the database connection
    $conn->close();
    ?>
</body>

</html>