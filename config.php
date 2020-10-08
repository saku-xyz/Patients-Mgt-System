<?php
session_start();
$db=mysqli_connect('localhost','root','','hospital_mgt');
$errors= array();

if (isset($_POST['login']))
{
    $username= ($_POST['username']);
    $pass1= ($_POST['password']);
    
if(empty($username))
{
	array_push($errors, "Username is required");
}

if(empty($pass1))
{
	array_push($errors, "Password is required");
}
if (count($errors)==0){
	$password1= md5($pass1);//encript password before comparing with that from data base
	$query="SELECT * FROM users WHERE user_name='$username' AND password='$pass1'";
	$result = mysqli_query($db, $query);

	if(mysqli_num_rows($result)==1){
		$row = mysqli_fetch_assoc($result);
		$user_id = $row['user_id'];
		$username = $row['name'];
		$_SESSION["user_id"] = $user_id;

		header("Location: home.php");		    
		}else{
            // array_push($errors,"wrong username/password");
            echo '<script type="text/javascript">
            window.onload = function () { alert("Username or password incorrect..!!"); }
            </script>';
		}   
}
}

// insert details to patient table
if (isset($_POST['addpatient']))
{
$patient_name= ($_POST['p_name']);
$nic= ($_POST['nic']);
$address= ($_POST['address']);
$telephone= ($_POST['tele']);
$age= ($_POST['age']);
$gender= ($_POST['gender']);

//fields empty
if(empty($patient_name))
{
array_push($errors,"Please enter patient name!");
}
if(empty($nic))
{
array_push($errors,"Please enter NIC Number!");
}

//no errors
if(count($errors) == 0)
{
$sql="INSERT INTO patient (patient_name,nic,address,telephone,age,gender,time,date) VALUES ('$patient_name','$nic','$address','$telephone','$age','$gender','".date("H:i:s")."','".date("Y-m-d")."')";
mysqli_query($db, $sql);

header('location:patient.php');
}
}

//Delete Websites
if (isset($_GET['patient_delete']))
{
$patient_id = ($_GET['patient_id']);
$patient_delete_qry="DELETE FROM patient WHERE patient_id = $patient_id;";
mysqli_query($db, $patient_delete_qry);

header("Location: patient.php");
}

//logout
if(isset($_GET['logout'])){
session_destroy();
header('location:index.php');
}
?>
