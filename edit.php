<?php
$showAlert = false;
$showAlertCreation = false;
$showError = false;
$login = true;
include 'partials/_dbconnect.php';
$sno = $_GET['sno'];
if (($_SERVER["REQUEST_METHOD"] != "POST")&&$sno!=0) {
   
    $Sql = "SELECT * FROM `hotel_data` WHERE `Sno.`=$sno";
    $result = mysqli_query($conn, $Sql);
    $row = mysqli_fetch_assoc($result);
    $visitor_name = $row['Visitor_name'];
    $contact_number = $row['Contact_number'];
    $email_id =  $row['Email_id'];
    $room_no =  $row['Room_no'];
    $category = $row['category'];
    $no_of_beds = $row['no_of_beds'];
    $arrival_date =  $row['Arrival_date'];
    $departure_date = $row['Departure_date'];
    $advance_payment = $row['advance_payment'];
    $rent =  $row['Rent'];
} 
else if(($_SERVER["REQUEST_METHOD"] == "POST")){
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $visitor_name = $_POST["visitor_name"];
        $contact_number = $_POST["contact_number"];
        $email_id =  $_POST["email_id"];
        $arrival_date =  $_POST["arrival_date"];
        $departure_date =  $_POST["departure_date"];
        $advance_payment = $_POST['advance_payment'];
        $rent =  $_POST["rent"];
        $room_no =  $_POST["room_no"];
        $category = $_POST['category'];
        $no_of_beds = $_POST['no_of_beds'];
        if($sno==0){
            $room_no =  $_GET['rn'];
$category = $_GET['category'];
$no_of_beds = $_GET['beds'];
        }
        // $check = $_POST["checkbox"];
        // if(isset($_POST['checkbox'])){
        //     $check = "booked";
        // }

        if(isset($_POST['uncheckbox'])){
            $check = "vacant"; 
            $existSql = "SELECT * FROM `room` WHERE `room_no` = '$room_no'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    // $row = mysqli_fetch_assoc($result);
    if($numExistRows>0){
        // $exists = true;
        // $showError = " Sorry, desired room is already booked!!";
    }
    else{
            $sql = "INSERT INTO `room` (`room_no`, `category`, `no_of_beds`, `price`, `Status`) VALUES ('$room_no','$category','$no_of_beds','$rent','$check')";
            $result = mysqli_query($conn, $sql);
    }
        }
        else{
            $existSql = "SELECT * FROM `hotel_data` WHERE room_no = '$room_no'";
            $result = mysqli_query($conn, $existSql);
            $row = mysqli_fetch_assoc($result);
            if(($sno==0)||($row['Room_status'] == "booked")){
                $check = "booked";
            }
            else{
                $check = "vacant"; 
            }
           
        }
        if($sno!=0){
        $sql = "UPDATE `hotel_data` SET `Visitor_name`='$visitor_name',`Contact_number`='$contact_number',`Email_id`='$email_id',`category`='$category',`no_of_beds`='$no_of_beds',`Arrival_date`='$arrival_date',`Departure_date`='$departure_date',`Rent`='$rent',`Room_status`='$check' WHERE `Sno.`=$sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
              if($sno!=0){header("location: welcome.php");}
        } 
        else {
            $showError = "Sorry, you failed to update record!! ";
        }
    }
    else{
        $existSql = "SELECT * FROM `hotel_data` WHERE room_no = '$room_no'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if(($numExistRows>0)&&($row['Room_status'] == "booked")){
        // $exists = true;
        $showError = " Sorry, desired room is already booked!!";
    }
    else{
  
    $sql = "INSERT INTO `hotel_data` (`Visitor_name`, `Contact_number`, `Email_id`, `Room_no`, `category`, `no_of_beds`,`Arrival_date`, `Departure_date`, `advance_payment`, `Rent`, `Room_status`) VALUES ('$visitor_name', '$contact_number', '$email_id','$room_no','$category','$no_of_beds','$arrival_date','$departure_date','$advance_payment','$rent','$check')";
    $result = mysqli_query($conn, $sql);
   
    $room_delete = "DELETE FROM `room` WHERE `room_no`=$room_no";
    $room_deleted = mysqli_query($conn,$room_delete);

    if ($result) {
      $showAlertCreation = true;
    }
   else {
    $showError = "Visitor Already Exists";}
  }
    }
        }
    
else{
$room_no =  $_GET['rn'];
$category = $_GET['category'];
$no_of_beds = $_GET['beds'];
$rent = $_GET['rent'];
$arrival_date = date("Y-m-d");
$advance_payment = 0;
$check= "checked";
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
        <strong>Success!</strong> Your room has been updated successfully!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if ($showAlertCreation) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your room has been booked successfully!!
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
    <a href="/hotel-management/welcome.php"><button class="btn btn-dark btn-sm mb-2">Back</button></a>
    <form method="post">

            
              <?php if($sno!=0){ ?>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="visitor_name">Visitor name</label>
                    <input type="text" class="form-control" value=<?php echo $visitor_name; ?> id="visitor_name" name="visitor_name" aria-describedby="emailHelp">

                </div>
                <div class="form-group col-md-6">
                    <label for="contact_number">Contact number</label>
                    <input type="text" class="form-control" value=<?php echo $contact_number; ?> id="contact_number" name="contact_number">
                </div>
                <div class="form-group col-md-12">
                    <label for="email_id">Email id</label>
                    <input type="email" class="form-control" value=<?php echo $email_id; ?> id="email_id" name="email_id">
                    <small id="emailHelp" class="form-text text-muted">Make sure to type the email in abc@gmail.com format</small>
                </div>
                <div class="form-group col-md-4">
                    <label for="room_no">Room no</label>
                    <input type="text" class="form-control" value=<?php echo $room_no; ?> id="room_no" name="room_no">

                  </div>
                  <div class="form-group col-md-4">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" value="<?php echo $category; ?>">
      </div> 
     
                <div class="form-group col-md-4">
        <label for="no_of_beds">No. of beds</label>
        <input type="text" class="form-control" id="no_of_beds" name="no_of_beds" value="<?php echo $no_of_beds; ?>">
        <small id="emailHelp" class="form-text text-muted">No. of beds available in the room</small>
      </div>
      <div class="form-group col-md-6">
                    <label for="arrival_date">Arrival date</label>
                    <input type="date" class="form-control" value=<?php echo $arrival_date; ?> id="arrival_date" name="arrival_date">
                    <small id="emailHelp" class="form-text text-muted">Make sure to type the date in suggested format</small>
                </div>                    
                <div class="form-group col-md-6">
                    <label for="departure_date">Departure date</label>
                    <input type="date" class="form-control" value=<?php echo $departure_date; ?> id="departure_date" name="departure_date">
                    <small id="emailHelp" class="form-text text-muted">Make sure to type the date in suggested format</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="advance_payment">Advance payment</label>
                    <input type="text" class="form-control" value=<?php echo $advance_payment; ?> id="advance_payment" name="advance_payment">

                </div>
             
                <div class="form-group col-md-6">
                    <label for="rent">Rent</label>
                    <input type="text" class="form-control" value=<?php echo $rent; ?> id="rent" name="rent">

                </div>
      <?php } ?>
      <?php if($sno==0){ ?>
        <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="visitor_name">Visitor name</label>
                    <input type="text" class="form-control" id="visitor_name" name="visitor_name" aria-describedby="emailHelp">

                </div>
                <div class="form-group col-md-6">
                    <label for="contact_number">Contact number</label>
                    <input type="text" class="form-control"  id="contact_number" name="contact_number">
                </div>
                <div class="form-group col-md-12">
                    <label for="email_id">Email id</label>
                    <input type="email" class="form-control" id="email_id" name="email_id">
                    <small id="emailHelp" class="form-text text-muted">Make sure to type the email in abc@gmail.com format</small>
                </div>
        <div class="form-group col-md-4">
                    <label for="room_no">Room no</label>
                    <input type="text" class="form-control" value=<?php echo $room_no; ?> id="room_no" name="room_no" readonly>

                  </div>
                  <div class="form-group col-md-4">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" value="<?php echo $category; ?>" readonly>
      </div> 
     
                <div class="form-group col-md-4">
        <label for="no_of_beds">No. of beds</label>
        <input type="text" class="form-control" id="no_of_beds" name="no_of_beds" value="<?php echo $no_of_beds; ?>" readonly>
        <small id="emailHelp" class="form-text text-muted">No. of beds available in the room</small>
      </div>
      <div class="form-group col-md-6">
                    <label for="arrival_date">Arrival date</label>
                    <input type="date" class="form-control" value=<?php echo $arrival_date; ?> id="arrival_date" name="arrival_date">
                    <small id="emailHelp" class="form-text text-muted">Make sure to type the date in suggested format</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="departure_date">Departure date</label>
                    <input type="date" class="form-control"  id="departure_date" name="departure_date">
                    <small id="emailHelp" class="form-text text-muted">Make sure to type the date in suggested format</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="advance_payment">Advance payment</label>
                    <input type="text" class="form-control" id="advance_payment" name="advance_payment">

                </div>
             
                <div class="form-group col-md-6">
                    <label for="rent">Rent</label>
                    <input type="text" class="form-control" value=<?php echo $rent; ?> id="rent" name="rent">

                </div>
        <?php  } ?>
                
            </div>
    <?php if($sno!=0){ ?><div class="form-check">
    <input type="checkbox" class="form-check-input" id="uncheckbox"  value="vacant" name="uncheckbox">
    <label class="form-check-label" for="exampleCheck1">I am checking out</label>
  </div>
            <div class="text-right"><button type="submit" class="btn btn-dark ">Edit details</button> <?php } ?>
            <?php if($sno==0){ ?>
            <div class="text-right"><button type="submit" class="btn btn-dark ">Check in</button> <?php } ?>   
    </div>
    </div></form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>