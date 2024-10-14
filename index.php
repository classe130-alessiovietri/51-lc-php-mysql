<?php

define("DB_SERVERNAME", "localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD", "root");
define("DB_NAME", "classe130_university");
// define("DB_PORT", "3306" oppure "8889");

// Connect
// $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
// $conn = new mysqli("localhost", "root", "root", "classe130_university");

// var_dump($conn);

// Check connection
if ($conn && $conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
}
else {
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
        // $sql = "SELECT * FROM departments WHERE id = ".$_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM departments WHERE id = ?");
        $stmt->bind_param("i", $depId);
        $depId = $_GET['id'];
    }
    else {
        $stmt = $conn->prepare("SELECT * FROM departments");
    }

    $stmt->execute();
     
    $result = $stmt->get_result();
    
    // var_dump($result);
    
    if ($result && $result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            // echo "<ul>".
            //         "<li>".
            //             "id: ".$row['id'].
            //         "</li>".
            //         "<li>".
            //             "name: ".$row['name'].
            //         "</li>".
            //     "</ul>";
    
            echo "<ul>";
            foreach ($row as $key => $value) {
                echo "<li>";
                echo $key.': '.$value;
                echo "</li>";
            }
            echo "</ul>";
        }
    }
    elseif ($result) {
        echo "0 results";
    }
    else {
        echo "query error";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>51 LC PHP MySql</title>
    </head>
    <body>

        <form action="">
            <input type="number" name="id" placeholder="Inserisci l'ID...">
            <button>
                Filtra
            </button>
        </form>
        
    </body>
</html>