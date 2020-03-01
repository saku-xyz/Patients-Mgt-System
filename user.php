<?php
$user_id = $_SESSION["user_id"];
$user_qry = "SELECT * FROM users where user_id = $user_id";
$usr_result = mysqli_query($db,$user_qry);
$row = mysqli_fetch_assoc($usr_result);
?>