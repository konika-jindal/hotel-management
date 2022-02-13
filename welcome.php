<?php
session_start();
$Sno= 0;
$showAlert = false;
$showError = false;
$login = true;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
}
else{
  include 'partials/_dbconnect.php';
  $sql_room_vacant = "SELECT * FROM `room` ORDER BY room_no ASC";
$resu_room_vacant = mysqli_query($conn, $sql_room_vacant);
$Sql_room_booked = "SELECT * FROM `hotel_data` WHERE `Room_status`='booked' ORDER BY room_no ASC";
$resu_room_booked = mysqli_query($conn, $Sql_room_booked);
$Sql = "SELECT * FROM `hotel_data` ORDER BY Room_status";
$resu = mysqli_query($conn, $Sql);
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Welcome - <?php $_SESSION['username'] ?></title>
</head>

<body>
  <?php require 'partials/_nav1.php' ?>
  <!-- <div class="row"> -->
    <h5 class="ml-2 mt-2">Vacant rooms</h5>
    <!-- <div class="col-sm-10"></div> -->
  <!-- </div> -->
  <?php 
        while($row = mysqli_fetch_assoc($resu_room_vacant))
        { 
          ?>
<div class="card border-success d-inline-block col-sm-1 p-1 mt-2 mr-0 ml-3">
<a href="edit.php?sno=0&rn=<?php echo $row['room_no'];?>&rent=<?php echo $row['price'];?>&beds=<?php echo $row['no_of_beds'];?>&category=<?php echo $row['category'];?>"><div class="card-body p-0 border-success">
      <h5 class="card-title text-success text-center"><?php echo $row['room_no']?></h5>
      <h5 class="card-title text-success text-center"><?php echo $row['category']?></h5>
    </div>
    </a>
  </div>
  
<?php } ?>
<h5 class="ml-2 mt-2 mb-0">Booked rooms</h5>
<!-- <br> -->
<?php 
        while($row = mysqli_fetch_assoc($resu_room_booked))
        { 
          ?>
 <div class="card border-danger d-inline-block col-sm-1 p-1 mt-4 mr-0 ml-3 mb-2">
    <div class="card-body p-0 border-success">
      <h5 class="card-title text-danger text-center"><?php echo $row['Room_no']?></h5>
      <h5 class="card-title text-danger text-center"><?php echo $row['category']?></h5>
    </div>
  </div>

<?php } ?>
<h4 class="my-4">Bookings</h4>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Sno.</th>
          <th scope="col">Visitor name</th>
          <th scope="col">Contact number</th>
          <th scope="col">Email id</th>
          <th scope="col">Room no</th>
          <th scope="col">Arrival date</th>
          <th scope="col">Departure date</th>
          <th scope="col">Rent</th>
          <th scope="col">Status</th>
          <th scope="col" class="text-center">Operations</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        while($row = mysqli_fetch_assoc($resu))
        {  $Sno= $Sno+1;
          ?>
        <tr>
          <!-- <th scope="row">1</th> -->
          <td><?php echo "$Sno"; ?></td>
          <td><?php echo $row['Visitor_name']; ?></td>
          <td><?php echo $row['Contact_number']; ?></td>
          <td><?php echo $row['Email_id']; ?></td>
          <td><?php echo $row['Room_no']; ?></td>
          <td><?php echo $row['Arrival_date']; ?></td>
          <td><?php echo $row['Departure_date']; ?></td>
          <td><?php echo $row['Rent']; ?></td>
          <td><?php echo $row['Room_status']; ?>
    <!-- <label class="form-check-label" for="exampleCheck1">Check me out</label> -->
  </div></td>
          <td>
            <!-- <a href="edit.php?sn=<?php echo $row['Sno.'];?>&nm=<?php echo $row['Visitor_name'];?>&cn=<?php echo $row['Contact_number'];?>&eid=<?php echo $row['Email_id'];?>&rn=<?php echo $row['Room_no'];?>&ad=<?php echo $row['Arrival_date'];?>&dd=<?php echo $row['Departure_date'];?>&rent=<?php echo $row['Rent'];?>"><button class="btn btn-dark float-right ml-1">Edit</button></a> -->
            <a href="edit.php?sno=<?php echo $row['Sno.'];?>"><button class="btn btn-dark float-right ml-1">Edit</button></a>
            <a href="delete.php?sn=<?php echo $row['Sno.'];?>"><button class="btn btn-dark float-right">Delete</button></a></td> 
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>