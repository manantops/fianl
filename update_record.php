<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idToUpdate = $_POST["updateRecordId"];
    $newClientCode = $_POST["updateClientCode"];
    $newMemo = $_POST["updateMemo"];
    $newCity = $_POST["updateCity"];
    $newAmount = $_POST["updateAmount"];
    $newAddress = $_POST["updateAddress"];
    $newDate = $_POST["updateDate"];
    




    $sql = "UPDATE data1 SET clientcode='$newClientCode', memo='$newMemo', City='$newCity', amount='$newAmount' , address='$newAddress', date = '$newDate' WHERE id=$idToUpdate";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
