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

// Read Operation
$sql = "SELECT * FROM data1";
$result = $conn->query($sql);

// Delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $idToDelete = $_POST["id"];

    $sql = "DELETE FROM data1 WHERE id=$idToDelete";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $idToUpdate = $_POST["id"];
    $newClientCode = $_POST["updateClientCode"];
    $newMemo = $_POST["updateMemo"];
    $newAddress = $_POST["updateAddress"];
    $newCity = $_POST["updateCity"];
    $newDate = $_POST["updateDate"];
    $newAmount = $_POST["updateAmount"];



    

    // Add more fields as needed

    $sql = "UPDATE data1 SET clientcode='$newClientCode', memo='$newMemo', address='$newAddress' , city='$newCity' , date='$newDate', amount='$newAmount' WHERE id=$idToUpdate";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>READ DATA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<CENTER>
<h1>WELCOME TO HISTORY OF BILL</h1>
</CENTER>

<br>
<br>
    <!-- Modal for Update -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for updating data -->
                    <form id="updateForm" action="update_record.php" method="POST">
                        <input type="hidden" id="updateRecordId" name="updateRecordId">
                        <div class="mb-3">
                            <label for="updateClientCode" class="form-label">Client Code:</label>
                            <input type="text" class="form-control" id="updateClientCode" name="updateClientCode">
                        </div>
                        <div class="mb-3">
                            <label for="updateMemo" class="form-label">Memo:</label>
                            <input type="text" class="form-control" id="updateMemo" 
                            name="updateMemo">
                        </div>

                        

                        <div class="mb-3">
                            <label for="updateAddress" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="updateAddress" name="updateAddress">
                        </div>

                        <div class="mb-3">
                            <label for="updateCity" class="form-label">City:</label>
                            <input type="text" class="form-control" id="updateCity" 
                            name="updateCity">
                        </div>

                        <div class="mb-3">
                            <label for="updateDate" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="updateDate" 
                            name="updateDate">
                        </div>

                        <div class="mb-3">
                            <label for="select" class="form-label">Select:</label>
                             <select class="form-select" name="abc" required style="width: 83%;" id="updateSelect">
                        <option value="" disabled selected value="None">NONE</option>
                        <option value="GST COMPOSITION FEE">GST COMPOSITION FEE</option>
                        <option value="GST INCOME TAX RETURN FEE">GST INCOME TAX RETURN FEE</option>
                        <option value="GST REGULAR FEE">GST REGULAR FEE</option>
                        <option value="GST & INCOME TAX & TDS RETURN FEE">GST & INCOME TAX & TDS RETURN FEE</option>
                        <option value="GST & INCOME TAX FEE">GST & INCOME TAX FEE</option>

                    </select>
                        </div>

                        <div class="mb-3">
                            <label for="updateAmount" class="form-label">Amount:</label>
                            <input type="text" class="form-control" id="updateAmount" name="updateAmount">
                        </div>


                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>CLIENT CODE</th>
            <th>MEMO</th>
            <th>ADDRESS</th>
            <th>CITY</th>
            <th>DATE</th>
            <th>SELECT</th>
            <th>AMOUNT</th>
            <th>DELETE</th>
            <th>UPDATE</th>
        </tr>
        </thead>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr data-id={$row['id']}>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['clientcode']}</td>";
            echo "<td>{$row['memo']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['city']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['abc']}</td>";
            echo "<td>{$row['amount']}</td>";
            echo "<td><button class='btn btn-danger' onclick='deleteRecord({$row['id']})'>DELETE</button></td>";
            echo "<td>    <button class='btn btn-primary' type='button' onclick='openUpdateModal(" . $row['id'] . ")'>UPDATE</button></td>";
            echo "</tr>";
        }
        ?>
    </table>


    

    <script>




    function openUpdateModal(recordId) {
        $.ajax({
            type: "POST",
            url: "fetch_record.php",
            data: { id: recordId },
            success: function(response) {
                // Keys: id,clientcode,memo,address,city,date,abc,amount
                // Keys: 38,111111111,33333333,qqq,1111,2024,GST COMPOSI,1111111
                var recordDetails = JSON.parse(response);
                // alert(`Keys: ${Object.keys(recordDetails)}`)
                // alert(`Keys: ${Object.values(recordDetails)}`)
                populateUpdateForm(recordDetails);
                $('#updateModal').modal('show');
            }
        });
    }

    function deleteRecord(recordId) {
        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                type: "POST",
                url: "billread.php",
                data: { id: recordId, delete: true },
                success: function(response) {
                    location.reload();
                }
            });
        }
    }

    function populateUpdateForm(recordDetails) {
        $('#updateRecordId').val(recordDetails.id);
        $('#updateClientCode').val(recordDetails.clientcode);
        $('#updateMemo').val(recordDetails.memo);
        $('#updateAddress').val(recordDetails.address);
        $('#updateCity').val(recordDetails.city);
        $('#updateDate').val(recordDetails.date);
        $('#updateSelect').val(recordDetails.abc).change();

        $('#updateAmount').val(recordDetails.amount);
        // Add more lines to populate other form fields as needed
    }

    $(document).ready(function() {
        $('#updateForm').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serializeArray();

            $.ajax({
                type: "POST",
                url: "update_record.php",
                data: formData,
                success: function(response) {
                    $('#updateModal').modal('hide');
                    location.reload();
                }
            });
        });
    });

</script>

</body>
</html>
