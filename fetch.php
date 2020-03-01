<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "hospital_mgt");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM patient
  WHERE patient_id LIKE '%".$search."%'
  OR patient_name LIKE '%".$search."%' 
  OR nic LIKE '%".$search."%' 
  OR telephone LIKE '%".$search."%' 
 ";
}
else
{
 $query = "
  SELECT * FROM patient ORDER BY patient_id
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
 <div id="member" class="col-lg-12">
 <table class="table table-striped table-hover">
 <thead>
 <tr>
     <th>Patient ID</th>
     <th>Patient Name</th>
     <th>NIC</th>
     <th>Address</th>
     <th>Telephone No</th>
     <th>Age</th>
     <th>Gender</th>
     <th>Action</th>
 </tr>
</thead>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["patient_id"].'</td>
    <td>'.$row["patient_name"].'</td>
    <td>'.$row["nic"].'</td>
    <td>'.$row["address"].'</td>
    <td>'.$row["telephone"].'</td>
    <td>'.$row["age"].'</td>
    <td>'.$row["gender"].'</td>
    <td><a class="btn btn-sm btn-primary" style="color:#fff" 
    data-toggle="modal"
    data-target="#exampleModal"
    data-whatever="' . $row['patient_id'] . ' ">
    <i
    class="material-icons" data-toggle="tooltip"
    title="Edit">&#xE254;</i>
 </a>

 <a onClick="slotDelete(' . $row['patient_id'] . ')" style="color:#fff" class="btn btn-sm btn-Danger">
     <i
    class="material-icons" data-toggle="tooltip"
    title="Delete">&#xE872;
    </i>
 </a></td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo '<h5 style="color:red"> Sorry, Patients Not Found! </h5>';
}

?>