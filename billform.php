<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert Operation
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
//     $clientcode = $_POST["clientcode"];
//     $memo = $_POST["memo"];
//     $address = $_POST["address"];
//     $city = $_POST["city"];
//     $date = $_POST["date"];
//     $select = $_POST["select"];
//     $amount = $_POST["amount"];

//     $sql = "INSERT INTO data1 (clientcode, memo, address , city , date , select , amount) VALUES ('$clientcode', '$memo', '$address' , '$city' , '$date','$select','$amount')";

//     if ($conn->query($sql) === TRUE) {
//         echo "Record inserted successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }

    // Insert Operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // ... (your existing code)
    $clientcode = $_POST["clientcode"];
    $memo = $_POST["memo"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $date = $_POST["date"];
    $abc = $_POST["abc"];
    $amount = $_POST["amount"];

    $sql = "INSERT INTO data1 (clientcode,memo,address,city,date,amount,abc) VALUES ('$clientcode','$memo','$address','$city','$date','$amount','$abc')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
        header("Location: /fomr/crud/bill/billtable.php?clientcode=$clientcode& memo=$memo& address=$address&city=$city&date=$date&amount=$amount&abc=$abc");

        // echo "<script>window.location.href=google.com"
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form data</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .main {
        display: flex;
        justify-content: start;
        width: 100%;
    }

   

    .form-control {
        border: solid 2px black !important;
        
    }

    .form-select {
        border: solid 2px black !important;
    }
</style>

<body>

    <div class="container">

        <h1 class="text-center"> BILL SYSTEM</h1>

        <div id="demoo"></div>
        <form method="post" class="was-validated">

            <div class="d-flex justify-content-evenly">
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">CLIENT CODE : </label>
                    <input type="number" class="form-control" name="clientcode" placeholder="Enter username"
                        name="uname" required style="width: 120%;">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">MEMO NO : </label>
                    <input type="number" class="form-control" name="memo" placeholder="Enter username" name="uname"
                        required style="width: 120%;">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>

            <div class="d-flex justify-content-evenly">
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">COMPANY NAME AND ADDRESS : </label>
                    <textarea class="form-control" name="address"  cols="9" rows="6.5" required
                        style="width: 120%;"></textarea>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>


                <div>
                    <div class="mb-3 mt-3">
                        <label for="uname" class="form-label">CITY :</label>
                        <input type="text" class="form-control" name="city" placeholder="Enter username" name="uname"
                            required style="width: 120%;">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>


                    <div class="mb-3 mt-3">
                        <label for="uname" class="form-label">Date:</label>
                        <input type="date" class="form-control"  name="date" name="uname" required
                            style="width: 120%;" value=""
                            min="1997-01-01" max="2090-12-31">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>


            </div>

            <div class="d-flex justify-content-evenly">
                <div style="margin-left: 100px;">
                    <label  for="uname" class="form-label"> CHARGES FOR : </label>
                    <select class="form-select" name="abc" required style="width: 83%;" id="select">
                        <option value="">NONE</option>
                        <option value="GST COMPOSITION FEE">GST COMPOSITION FEE</option>
                        <option value="GST INCOME TAX RETURN FEE">GST INCOME TAX RETURN FEE</option>
                        <option value="GST REGULAR FEE">GST REGULAR FEE</option>
                        <option value="GST & INCOME TAX & TDS RETURN FEE">GST & INCOME TAX & TDS RETURN FEE</option>
                        <option value="GST & INCOME TAX FEE">GST & INCOME TAX FEE</option>

                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div style="margin-right: 100px;">
                    <label for="uname" class="form-label">AMOUNT </label>
                    <input type="number" class="form-control" name="amount" placeholder="Enter username" name="uname"
                        required style="width: 120%;">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>
            <br>
            <br>
            <center>
                <button class="btn btn-primary"  type="submit" name="submit" onclick="tabledata()">SUBMIT</button>
            </center>
        </form>
    </div>
<script>
    function tabledata() {

    }
</script>
</body>

</html>