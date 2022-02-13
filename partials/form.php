<?php
$showAlert = false;
$showError = false;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $visitor_name = $_POST["visitor_name"];
    $contact_number = $_POST["contact_number"];
    $email_id =  $_POST["email_id"];
    $room_no =  $_POST["room_no"];
    $arrival_date =  $_POST["arrival_date"];
    $departure_date =  $_POST["departure_date"];
    $rent =  $_POST["rent"];
    $existSql = "SELECT * FROM `hotel_data` WHERE room_no = '$room_no'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = " Sorry, desired room is already booked!!";
    }
    else{
  
    $sql = "INSERT INTO `hotel_data` (`Visitor_name`, `Contact_number`, `Email_id`, `Room_no`, `Arrival_date`, `Departure_date`, `Rent`) VALUES ('$visitor_name', '$contact_number', '$email_id', '$room_no', '$arrival_date', '$departure_date', '$rent')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $showAlert = true;
    }
   else {
    $showError = "Visitor Already Exists";}
  }
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
  <?php require '_nav1.php' ?>
  <?php
  if ($showAlert) {
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
  <a href="/LOGINSYSTEM/welcome.php"><button class="btn btn-dark btn-sm mb-2">Back</button></a>
  <form action="/LOGINSYSTEM/partials/form.php" method="post" class="">
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="visitor_name">Visitor name</label>
        <input type="text" class="form-control" id="visitor_name" name="visitor_name" aria-describedby="emailHelp">

      </div>
      <div class="form-group col-md-6">
        <label for="contact_number">Contact number</label>
        <input type="text" class="form-control" id="contact_number" name="contact_number">
      </div>
      <div class="form-group col-md-12">
        <label for="email_id">Email id</label>
        <input type="email" class="form-control" id="email_id" name="email_id">
        <small id="emailHelp" class="form-text text-muted">Make sure to type the email in abc@gmail.com format</small>
      </div>
      <div class="form-group col-md-6">
        <label for="room_no">Room no</label>
        <input type="text" class="form-control" id="room_no" name="room_no">
        
      </div>
      <div class="form-group col-md-6">
        <label for="arrival_date">Arrival date</label>
        <input type="date" class="form-control" id="arrival_date" name="arrival_date">
        <small id="emailHelp" class="form-text text-muted">Make sure to type the date in suggested format</small>
      </div>
      <div class="form-group col-md-6">
        <label for="departure_date">Departure date</label>
        <input type="date" class="form-control" id="departure_date" name="departure_date">
        <small id="emailHelp" class="form-text text-muted">Make sure to type the date in suggested format</small>
      </div>
      <div class="form-group col-md-6">
        <label for="rent">Rent</label>
        <input type="text" class="form-control" id="rent" name="rent">
        
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