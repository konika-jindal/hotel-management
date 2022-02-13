<?php
$showAlert = false;
$showAlertCreation = false;
$showError = false;
$login = true;
include 'partials/_dbconnect.php';
$sno = $_GET['sn'];
if (($_SERVER["REQUEST_METHOD"] != "POST")&&$sno!=0) {
   
    $Sql = "SELECT * FROM `room` WHERE `sno`=$sno";
    $result = mysqli_query($conn, $Sql);
    $row = mysqli_fetch_assoc($result);
    $room_no = $row['room_no'];
    $category = $row['category'];
    $no_of_beds =  $row['no_of_beds'];
    $price =  $row['price'];
    $Status =  $row['Status'];
} 
else if(($_SERVER["REQUEST_METHOD"] == "POST")){
    $room_no = $_POST['room_no'];
    $category = $_POST['category'];
    $no_of_beds =  $_POST['no_of_beds'];
    if($sno!=0)
    {
    $price =  $_POST['price'];
    $Status =  $_POST['Status'];
    }
    else{
        if($_POST['category']=="Deluxe"){
            $price= 4500;
        }
        else if($_POST['category']=="Single"){
            $price= 1000;
        }
        else if($_POST['category']=="Double"){
            $price= 2000;
        }
        else if($_POST['category']=="King"){
            $price= 2500;
        }
        else{
            $price= 2500;
        }
        $Status = "vacant";
    }
        if($sno!=0){
        $sql = "UPDATE `room` SET `room_no`=$room_no,`category`=$category,`no_of_beds`=$no_of_beds,`price`=$price,`Status`=$Status WHERE `Sno.`=$sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
              if($sno!=0){header("location: room.php");}
        } 
        else {
            $showError = "Sorry, you failed to update record!! ";
        }
    }
    else{
        $existSql = "SELECT * FROM `room` WHERE room_no = '$room_no'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if(($numExistRows>0)){
        // $exists = true;
        $showError = " Sorry, desired room is already existing!!";
    }
    else{
  
    $sql = "INSERT INTO `room`(`room_no`, `category`, `no_of_beds`, `price`, `Status`) VALUES ('$room_no','$category','$no_of_beds','$price','$Status')";
    $result = mysqli_query($conn, $sql);
   
    // $room_delete = "DELETE FROM `room` WHERE `room_no`=$room_no";
    // $room_deleted = mysqli_query($conn,$room_delete);

    if ($result) {
      $showAlertCreation = true;
    }
   else {
    $showError = "Visitor Already Exists";}
  }
    }
        }
    
else{
    $room_no = "room_no";
    $category = "category";
    $no_of_beds =  " 0";
    // $price =  0;
    // $Status =  "Status";
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
  <?php
  if ($showAlert) {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your room has been booked successfully!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
  }
  if ($showAlertCreation) {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> room has been added successfully!!
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
  <div class="container my-4 col-sm-8">
  <a href="/LOGINSYSTEM/room.php"><button class="btn btn-dark btn-sm mb-2">Back</button></a>
  <form method="post" class="">
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="room_no">Room no</label>
        <input type="text" class="form-control" id="room_no" name="room_no" value="<?php echo $room_no; ?>" aria-describedby="emailHelp">

      </div>
      <?php if($sno!=0){ ?>
      <div class="form-group col-md-6">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" value="<?php echo $category; ?>">
      </div> 
      <div class="form-group col-md-6">
        <label for="price">Price</label>
        <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
        
      </div>
      <div class="form-group col-md-6">
        <label for="Status">Status</label>
        <input type="text" class="form-control" id="Status" name="Status" value="<?php echo $Status; ?>">
      </div>
      <?php } ?>
      <?php if($sno==0){ ?> 
      <div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" id="category" name="category">
      <option>Deluxe(4500)</option>
      <option>Single(1000)</option>
      <option>Double(2000)</option>
      <option>Queen(2500)</option>
      <option>King(2500)</option>
    </select>
  </div> <?php } ?>
      <div class="form-group col-md-12">
        <label for="no_of_beds">No. of beds</label>
        <input type="text" class="form-control" id="no_of_beds" name="no_of_beds" value="<?php echo $no_of_beds; ?>">
        <small id="emailHelp" class="form-text text-muted">No. of beds available in the room</small>
      </div>
    </div>
      <div class="text-right"><button type="submit" class="btn btn-dark ">Submit</button></div>
    </form>
  </div> 
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>