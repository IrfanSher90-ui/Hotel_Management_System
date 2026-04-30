
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php 
    include '../includes/header.php';
    echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href='dashboard.php' class='btn btn-discover btn-lg text-black'>Back</a>";

     ?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Check-In / Check-Out</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="p-4 shadow-lg animate__animated animate__fadeIn" style="border: 2px dashed #6c757d; border-radius: 15px; animation: borderGlow 2s infinite alternate;">
        <form>
          <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" class="form-control" placeholder="Enter customer name">
          </div>
          <div class="mb-3">
            <label>Room Number</label>
            <input type="text" class="form-control" placeholder="Enter room number">
          </div>
          <div class="mb-3">
            <label>Check-In Date</label>
            <input type="date" class="form-control">
          </div>
          <div class="mb-3">
            <label>Check-Out Date</label>
            <input type="date" class="form-control">
          </div>
          <div class="d-grid gap-2 d-md-block text-center">
            <button class="btn btn-outline-success me-2">Check In</button>
            <button class="btn btn-outline-danger">Check Out</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include '../includes/footer.php'; ?>

</body>
</html>