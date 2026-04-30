<?php
// delete_booking.php
include '../includes/db_connect.php'; 

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid ID");

$conn->query("DELETE FROM bookings WHERE id=$id");
echo "Booking deleted! <a href='manage_bookings.php'>Back</a>";
