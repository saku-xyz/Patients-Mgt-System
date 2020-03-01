<?php include('config.php'); ?>
<?php include('user.php'); ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<?php
require('conn.php');
$id = $_GET['id'];

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $mysqli->query("UPDATE `patient` SET `patient_name` = '$name', `nic` = '$nic', `address` = '$address', `telephone` = '$telephone', `age` = '$age', `gender`= '$gender' WHERE `patient_id`=$id");
    header("location:patient.php");
}

$result = $mysqli->query("SELECT * FROM `patient` WHERE `patient_id`='$id'");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <form method="post" action="editpatient.php" role="form">
        <div class="modal-body">
            <div class="form-group">
                <label for="id">Patient ID</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $row['patient_id']; ?>" readonly="true" />

            </div>
            <div class="form-group">
                <label for="name">patient Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['patient_name']; ?>" />
            </div>
            <div class="form-group">
                <label for="phone">NIC</label>
                <input type="text" class="form-control" id="email" name="nic" value="<?php echo $row['nic']; ?>" />
            </div>
            <div class="form-group">
                <label for="phone">Address</label>
                <input type="text" class="form-control" id="email" name="address" value="<?php echo $row['address']; ?>" />
            </div>
            <div class="form-group">
                <label for="phone">Telephone No</label>
                <input type="text" class="form-control" id="email" name="telephone" value="<?php echo $row['telephone']; ?>" />
            </div>
            <div class="form-group">
                <label for="phone">Age</label>
                <input type="text" class="form-control" id="email" name="age" value="<?php echo $row['age']; ?>" />
            </div>
            <div class="form-group">
                <label>Select Gender</label>
                <select name="gender" class="form-control">
                    <option value="<?php echo $row['gender']; ?>" hidden><?php echo $row['gender']; ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="submit" value="Update" />&nbsp;
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
</body>

</html>