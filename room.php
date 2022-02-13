<?php
session_start();
$Sno= 0;
$count=0;
$showAlert = false;
$showError = false;
$login = true;
include 'partials/_dbconnect.php';
$sql_room_vacant = "SELECT * FROM `room` ORDER BY room_no ASC";
$resu_room_vacant = mysqli_query($conn, $sql_room_vacant);
$Sql_room_booked = "SELECT * FROM `hotel_data` WHERE `Room_status`='booked' ORDER BY room_no ASC";
$resu_room_booked = mysqli_query($conn, $Sql_room_booked);
// $Sql = "SELECT * FROM `room`";
// $resu = mysqli_query($conn, $Sql);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // include '_dbconnect.php';
  $room_no =  $_POST["room_no"];
  $existSql = "SELECT * FROM `room` WHERE room_no = '$room_no'";
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if($numExistRows > 0){
      // $exists = true;
      $showError = " Sorry, desired room is already existing!!";
  }
  else{

  $sql = "INSERT INTO `room` (`room_no`) VALUES ('$room_no')";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $showAlert = true;
  }
 
 else {
  $showError = "Failed to add";}
}
}
$sql = "SELECT * FROM `room` ORDER BY room_no ASC";
$resu = mysqli_query($conn, $sql);
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
  <?php if ($showAlert) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your room has been updated successfully!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> ' . $showError . '
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
      </div> ';
    }
    ?>
        
    <div class="row">
      <div class="col-sm-2"><a href="/LOGINSYSTEM/welcome.php"><button class="btn btn-dark btn-sm mx-4 mt-2">Back</button></a></div>
    <div class="col-sm-8"></div>
    <div class="col-sm-2"><a href="room_form.php?sn=0"><button class="btn btn-dark btn-sm mx-4 mt-2">Add new room</button></a></div>
</div>
  <?php 
        while($row = mysqli_fetch_assoc($resu_room_vacant))
        { 
          ?>
<div class="card border-success d-inline-block col-sm-1 p-1 mt-4 mr-0 ml-3">
    <div class="card-body p-0 border-success">
      <h5 class="card-title text-success text-center"><?php echo $row['room_no']?></h5>
      <h5 class="card-title text-dark text-center"><?php echo $row['category']?></h5>
      <h5 class="card-title text-success text-center"><?php echo $row['no_of_beds']." "."beds"?></h5>
      <h5 class="card-title text-dark text-center"><?php echo $row['price']?></h5>
      <a href="delete_room.php?sn=<?php echo $row['sno'];?>" class="text-danger text-center ml-3" style="font-size: small;">Delete</a> <a href="room_form.php?sn=<?php echo $row['sno'];?>" class="text-dark text-center ml-1" style="font-size: small;">Edit</a>
    </div>
  </div>

<?php } ?>
<br>
<?php 
        while($row = mysqli_fetch_assoc($resu_room_booked))
        { 
          ?>
 <div class="card border-danger d-inline-block col-sm-1 p-1 mt-4 mr-0 ml-3">
    <div class="card-body p-0 border-success">
      <h5 class="card-title text-danger text-center"><?php echo $row['Room_no']?></h5>
      <h5 class="card-title text-dark text-center"><?php echo $row['category']?></h5>
      <h5 class="card-title text-danger text-center"><?php echo $row['no_of_beds']." "."beds"?></h5>
      <h5 class="card-title text-dark text-center"><?php echo $row['Rent']?></h5>
      <a href="delete.php?sn=<?php echo $row['Sno.'];?>" class="text-danger text-center ml-4" style="font-size: small;">Delete</a>
    </div>
  </div>

<?php } ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>