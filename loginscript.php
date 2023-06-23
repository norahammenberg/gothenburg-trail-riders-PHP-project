<?php
//kconect to the database
require_once("connecttodb.php");
//Start a session
session_start();
//variables with the username and password provided by the user:
$anvandarnamn = validate($_POST["anvandarnamn"]);
$losenord = validate($_POST["losenord"]);
//function that checks data provided by the user:
function validate($data)
{
    //delete unnecessary signs
    $data = trim($data);
    //delete backslash
    $data = stripslashes($data);

    $data = htmlspecialchars($data);
    return $data;
}

//varable for hash password
$hashlosenord = hash("sha256", $losenord);

//checking usernamne and password is provided and if they are not null:
if (isset($_POST["anvandarnamn"]) && isset($_POST["losenord"])) {
    //if empty
    if (empty($anvandarnamn)) {
        header("Location: login.php?error=Please provide username.");
        exit();
    }

    //if empty
    else if (empty($losenord)) {
        header("Location: login.php?error=Please prvide password.");
        exit();
    }

    //sql query to DB
    else {
        //preparing and bind a sql query to avoid sql injections 
        $sql = "SELECT * FROM gbgstiglogin WHERE anvandarnamn=-? AND losenord =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $anvandarnamn, $hashlosenord);
        //execute sql query:
        $stmt->execute();
        //Fetching mysql result.
        $result = $stmt->get_result();
    }

    //Chech if data excist in the DB inbyggd PHP funktion som här används för att kollar om data finns i databasen 
    if (mysqli_num_rows($result) === 1) {
        //fetch data from DB and save in a arrey
        $row = mysqli_fetch_assoc($result);

        //if log in is correct
        if ($row['anvandarnamn'] === $anvandarnamn && $row['losenord'] === $hashlosenord && $row['anvandartillgang'] === 'Admin1') {

            //session variables declared
            $_SESSION['anvandarnamn'] = $row['anvandarnamn'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['anvandartillgang'] = $row['anvandartillgang'];
            $_SESSION['losenord'] = $row['losenord'];

            header("Location: laggtill.php");
            exit();
        }

        //if correct log in
        else if ($row['anvandarnamn'] === $anvandarnamn && $row['losenord'] === $hashlosenord && $row['anvandartillgang'] === 'Admin2') {

            //session variables declared
            $_SESSION['anvandarnamn'] = $row['anvandarnamn'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['anvandartillgang'] = $row['anvandartillgang'];

            header("Location: tabort.php");
            exit();
        } else {
            header("Location: login.php?error=Fel användarnamn eller lösenord...");
            exit();
        }
    } else {
        header("Location: login.php?error=Fel användarnamn eller lösenord...");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
//close db connection. 
$stmt->close();
$conn->close();
