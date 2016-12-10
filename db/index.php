<html>
<body>
<?php

include $_SERVER['DOCUMENT_ROOT']."/private/Config.php";

// Create connection
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    // The connection failed. What do you want to do?
    // You could contact yourself (email?), log the error, show a nice page, etc.
    // You do not want to reveal sensitive information

    // Let's try this:
    echo "Désolé, la connexion BDD ne fonctionne pas.";

    // Something you should not do on a public site, but this example will show you
    // anyways, is print out MySQL error related information -- you might log this
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

    // You might want to show them something nice, but we will simply exit
    exit;
}

if (isset($_POST["message"])) {
    $p_mess=$_POST['message'];
    $date = date("y-m-d");
    $query = "INSERT INTO message(message,dateCreation) VALUES ('$p_mess', '$date')";
    $mysqli->query($query);
    $mysqli->commit();
}

if (isset($_GET["clean"])) {
    $cleanID = $_GET["clean"];
    $date = date("y-m-d");
    $query = "UPDATE message SET deleted = now() WHERE id=$cleanID";
    $mysqli->query($query);
    $mysqli->commit();
}

$query = "SELECT * from message WHERE deleted is null ORDER BY id";
$result = $mysqli->query($query);
?>

<div class='col-md-12'>
    <br/>
</div>

<div class='col-md-12'>
    <div class='col-md-6'>
        <form action ="index.php" method="post">

            <input type="text" name="message" placeholder="Message">
            <input type="submit" class='btn btn-sm btn-info' value="Envoyer message" >

        </form>
    </div>
    <div class='col-md-6'>
        <form action ="index.php" method="post">
            <input type="submit" class='btn btn-sm btn-info' value="Afficher nouveaux message">
        </form>
    </div>
</div>



<div class='col-md-12'>
    <br/>
</div>

<div class="col-md-12 bg-info menu-titre">
    <form action ="index.php" method="post">

        <?php
        echo "<table>";
        for ($row_no = $result->num_rows - 1; $row_no >= 0; $row_no--) {
            $result->data_seek($row_no);
            $row = $result->fetch_assoc();
            $messPrecedent = $row['message'];
            $messID = $row['id'];
            echo "<tr>";
            echo "<td><a href='index.php?clean=$messID'>X</a></td>";
            echo "<td class='col-md-11'><a href='$messPrecedent'>$messPrecedent</a></td>";
            echo "</tr>";
        }
        echo "</table>\n";
        ?>
    </form>
</div>
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<!--
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
-->
</body>
</html>	