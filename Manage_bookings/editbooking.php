<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
<?php

include '../includes/db_connect.php'; 

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid ID");


$res = $conn->query("SELECT * FROM bookings WHERE id=$id");
$booking = $res->fetch_assoc();
if (!$booking) die("Booking not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guest = $_POST['guest_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE bookings SET guest_name=?, email=?, phone=?, status=? WHERE id=?");
    $stmt->bind_param("ssssi", $guest, $email, $phone, $status, $id);
    $stmt->execute();
    echo "Booking updated! <a href='manage_bookings.php'>Back</a>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Edit Booking ID<?= $booking['id'] ?></h2>
    <form method="post">
    Name: <input type="text" name="guest_name" value="<?= htmlspecialchars($booking['guest_name']) ?>"><br>
    Email: <input type="text" name="email" value="<?= htmlspecialchars($booking['email']) ?>"><br>
    Phone: <input type="text" name="phone" value="<?= htmlspecialchars($booking['phone']) ?>"><br>
    Status: 
    <select name="status">
    <option <?= $booking['status']=='pending'?'selected':'' ?>>pending</option>
    <option <?= $booking['status']=='confirmed'?'selected':'' ?>>confirmed</option>
    <option <?= $booking['status']=='cancelled'?'selected':'' ?>>cancelled</option>
   </select><br>
    <button type="submit">Save</button>
</form>
</body>
</html>

