<?php

session_start();
if (!isset($_SESSION['user']['id'])){
  echo "<script>location.href='../loginsign.php'</script>";
}

include '../includes/db_connect.php';

$errors = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $guest_name = trim($_POST['guest_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $room_type = trim($_POST['room_type'] ?? '');
    $Number_of_rooms = trim($_POST['Number_of_rooms'] ?? '');
    $guests = intval($_POST['guests'] ?? 1);
    $check_in = $_POST['check_in'] ?? '';
    $check_out = $_POST['check_out'] ?? '';
    $special = trim($_POST['special_requests'] ?? '');
    $price = trim($_POST['price'] ?? '');
   

    if ($guest_name === '') $errors[] = "Enter guest name.";
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Enter a valid email.";
    if ($phone === '') $errors[] = "Enter phone number.";
    if ($room_type === '') $errors[] = "Select room type.";
    if ($Number_of_rooms === '') $errors[] = "Room Numbers.";
    if ($guests < 1) $errors[] = "Guests must be at least 1.";
    if (!$check_in) $errors[] = "Select check-in date.";
    if (!$check_out) $errors[] = "Select check-out date.";
    if ($check_in && $check_out && strtotime($check_out) <= strtotime($check_in)) $errors[] = "Check-out must be after check-in.";
    if (!$price) $errors[] = "Select price";
  
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO bookings (user_id,guest_name,email,phone,room_type,Number_of_rooms,guests,check_in,check_out,special_requests,price) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        if (!$stmt) {
            $errors[] = "Prepare failed: " . $conn->error;
        } else {
            $stmt->bind_param("sssissiissi", $_SESSION['user']['id'] ,$guest_name, $email, $phone, $room_type,$Number_of_rooms,$guests, $check_in, $check_out, $special,$price);
            if ($stmt->execute()) {
                $success = "Booking successful! Your booking ID: " . $stmt->insert_id;
           
                unset($_POST);
            } else {
                $errors[] = "Insert failed: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Room Booking</title>
  <style>
    :root{
      --bg:#0f172a; 
      --card:#0b1222; 
      --accent:#60a5fa; 
      --muted:#94a3b8; 
      --white:#fff;
      --shadow: 0 12px 30px rgba(2,6,23,0.45);
    }
    body{
        font-family:Inter,system-ui,Arial;
        margin:0;
        color:#0b1222;
        padding:28px;
        display:grid;
        place-items:center;
        min-height:100vh;
        background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
    color: var(--text);
    }

    
::-webkit-scrollbar {
  width: 5px;
  transition:1.5s;
}
::-webkit-scrollbar-track {
  background:transparent;
  transition:1.5s;
}
::-webkit-scrollbar-thumb {
  background:#06b6d4;
  border-radius: 8px;
  transition:1.5s;
}
::-webkit-scrollbar-thumb:hover {
  background:  #0f172a;

}
    .container{
        width:100%;
        max-width:920px;
        background:var(--card);
        color:var(--white);
        border-radius:14px;
        padding:20px;
        box-shadow:var(--shadow);
        overflow:hidden;
    }
    h2{
        margin:0 0 12px;
        font-size:20px;
    }
    .grid{
        display:grid;
        grid-template-columns:1fr 320px;
        gap:18px;
    }
    @media (max-width:900px){
        .grid{
            grid-template-columns:1fr;
        }
    }
    form{
        display:grid;
        gap:12px;
    }
    .row{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:12px;
    }
    label{
        font-size:13px;
        color:var(--muted);
        display:block;
        margin-bottom:6px;
    }

    input[type="text"], 
    input[type="email"],
    input[type="number"],  
    input[type="date"], 
    input[type="tel"], 
    select, textarea{
      width:100%;
      padding:10px;
      border-radius:8px;
      border:1px solid rgba(255,255,255,0.06);
      background:transparent;
      color:var(--white);
    }
   select {
     appearance: none;         
    -moz-appearance: none;   
    -webkit-appearance: none; 
     background: #010e29ff url("data:image/svg+xml;utf8,<svg fill='%23ffffff' height='20' width='20' xmlns='http://www.w3.org/2000/svg'><polygon points='0,0 20,0 10,10'/></svg>") no-repeat right 10px center;
     background-size: 12px;
    }
    textarea{
        min-height:100px;
        resize:vertical;
    }

      .total-box {
      margin-top: 20px;
      padding: 10px;
      border-radius: 10px;
      background:transparent;
      border:1px solid rgba(255,255,255,0.06);
      font-size: 18px;
      color:var(--white);
      font-weight: bold;
      text-align: center;
    }
    .btn{
        background:var(--accent);
        color:#06203a;
        padding:10px 14px;
        border-radius:10px;
        border:0;
        font-weight:700;
        cursor:pointer;
    }
    .btn.ghost{
        background:transparent;
        border:1px solid rgba(255,255,255,0.06);
        color:var(--white);
    }
    .card{
        background:linear-gradient(180deg, rgba(255,255,255,0.02), transparent);
        padding:12px;
        border-radius:12px;
        border:1px solid rgba(255,255,255,0.04);
    }
    .muted{
        color:var(--muted);
        font-size:13px;
    }
    .messages{
        margin-bottom:8px;
    }
    .error{
        background:#ffdddd;
        color:#7a1e1e;
        padding:8px;
        border-radius:8px;
        margin-bottom:8px;
    }
    .success{
        background:#ddffea;
        color:#0b6a3a;
        padding:8px;
        border-radius:8px;
        margin-bottom:8px;
    }
    .actions{
        display:flex;
        gap:10px;
        justify-content:flex-end;
    }
    .small{
        font-size:13px;
        color:var(--muted);
    }
  </style>
</head>
<body>
  <div class="container">
    <a onclick="history.back()" class="btn btn-discover btn-lg text-black">Back</a>
    <div class="grid">
      <div>
        <br>
        <h2>Book a Room</h2>
        <p class="small">Fill the form below to reserve a room. We'll confirm availability and send you an email.</p>

        <div class="messages">
          <?php if (!empty($errors)): ?>
            <?php foreach($errors as $e): ?>
              <div class="error"><?=htmlspecialchars($e)?></div>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if ($success): ?>
            <div class="success"><?=htmlspecialchars($success)?></div>
          <?php endif; ?>
        </div>

        <form id="bookingForm" method="post" action="">
          <label for="guest_name">Full Name</label>
          <input type="text" id="guest_name" name="guest_name" value="<?=htmlspecialchars($_POST['guest_name'] ?? '')?>" required>

          <div class="row">
            <div>
              <label for="email">Email</label>
              <input type="email" id="email" name="email" value="<?=htmlspecialchars($_POST['email'] ?? '')?>" required>
            </div>
            <div>
              <label for="phone">Phone</label>
              <input type="tel" id="phone" name="phone" value="<?=htmlspecialchars($_POST['phone'] ?? '')?>" required>
            </div>
          </div>

          <div class="row">
            <div>
              <label for="room_type">Room Type</label>
              <select id="room_type" class="roomtype" name="room_type" required onchange="updatePrice()">
                <option value="" >Select Room Type</option>
                <option value="Single" data-price="8000" <?= (($_POST['room_type'] ?? '')=='Single')?'selected':''?>>Single</option>
                <option value="Double" data-price="15000"<?= (($_POST['room_type'] ?? '')=='Double')?'selected':''?>>Double</option>
                <option value="Suite"  data-price="20000"<?= (($_POST['room_type'] ?? '')=='Suite')?'selected':''?>>Suite</option>
                <option value="Family" data-price="25000"<?= (($_POST['room_type'] ?? '')=='Family')?'selected':''?>>Family</option>
              </select>
            </div>
            <div>
             <label for="rooms">Number of Rooms</label>
             <input type="number" id="rooms" name="Number_of_rooms" value="1" min="1" onchange="calculateTotal()">
          </div>
              <div>
                <label for="price">Price Per Room</label>
               <input type="text" name="price" id="price" value="<?=htmlspecialchars($_POST['price'] ?? '')?>" placeholder="Price" readonly>
            </div>
            
          


            <div>
              <label for="guests">Guests</label>
              <input type="number" id="guests" name="guests" value="1" min="1" onchange="calculateTotal()">
            </div>
 
          </div>
          <div class="row">
            <div>
              <label for="check_in">Check-in</label>
              <input type="date" id="check_in" name="check_in" value="<?=htmlspecialchars($_POST['check_in'] ?? '')?>" onchange="calculateTotal()" required>
            </div>
            <div>
              <label for="check_out">Check-out</label>
              <input type="date" id="check_out" name="check_out" value="<?=htmlspecialchars($_POST['check_out'] ?? '')?>" onchange="calculateTotal()" required>
            </div>
          </div>

          <label for="special_requests">Special Requests (optional)</label>
          <textarea id="special_requests" name="special_requests"><?=htmlspecialchars($_POST['special_requests'] ?? '')?></textarea>
           
           <div class="total-box" id="total">Total: PKR 0</div>
          <div class="actions" style="margin-top:6px;">
            <button type="button" class="btn ghost" onclick="clearForm()">Clear</button>
            <button type="submit" class="btn">Book Now</button>
            
          </div>
          
        </form>
      </div>

      <aside>
        <div class="card">
          <h3 style="margin-top:0">Booking Summary</h3>
          <div class="muted">Fill the form to see a quick summary here.</div>
          <div id="summary" style="margin-top:12px">
            <div class="small">No selection yet</div>
          </div>
        </div>

        <div class="card" style="margin-top:12px">
          <h4 style="margin:0">Need Help?</h4>
          <p class="small">Call us: +92 300 0000000<br>Email: PeradiseHotel@gmail.com</p>
        </div>
      </aside>
    </div>
  </div>

<script>

function updatePrice() {
  const roomSelect = document.getElementById("room_type");
  const priceInput = document.getElementById("price");
  const selected = roomSelect.options[roomSelect.selectedIndex];
  const basePrice = parseInt(selected.getAttribute("data-price")) || 0;
  priceInput.value = basePrice; 
  calculateTotal();
}

function calculateTotal() {
  const basePrice = parseInt(document.getElementById("price").value) || 0;
  const rooms = parseInt(document.getElementById("rooms").value) || 1;

  const checkIn = new Date(document.getElementById("check_in").value);
  const checkOut = new Date(document.getElementById("check_out").value);

  let days = 1;
  if (checkIn && checkOut && checkOut > checkIn) {
    const diff = checkOut - checkIn;
    days = diff / (1000 * 60 * 60 * 24);
  }

  const total = basePrice * rooms * days;
  document.getElementById("total").innerText = "Total: PKR " + total.toLocaleString();
}

  // small client-side UX validations & summary
  const form = document.getElementById('bookingForm');
  const summary = document.getElementById('summary');

  function updateSummary() {
    const name = document.getElementById('guest_name').value || '—';
    const room = document.getElementById('room_type').value || '—';
    const guests = document.getElementById('guests').value || '—';
    const inDate = document.getElementById('check_in').value || '—';
    const outDate = document.getElementById('check_out').value || '—';
    const price = document.getElementById('price').value || '—';
   
    summary.innerHTML = `
      <div class="small"><strong>${name}</strong></div>
      <div class="small">Room: ${room}</div>
      <div class="small">Guests: ${guests}</div>
      <div class="small">From: ${inDate}</div>
      <div class="small">To: ${outDate}</div>
      <div class="small">Price: ₹${price}</div>
    `;
  }

  document.querySelectorAll('#bookingForm input, #bookingForm select, #bookingForm textarea').forEach(el=>{
    el.addEventListener('input', updateSummary);
  });

  function clearForm() {
    form.reset();
     updatePrice();
    updateSummary();
  }

  // basic check to ensure check-out > check-in (client-side)
  form.addEventListener('submit', function(e){
    const inDate = document.getElementById('check_in').value;
    const outDate = document.getElementById('check_out').value;
    if (inDate && outDate && new Date(outDate) <= new Date(inDate)) {
      e.preventDefault();
      alert('Check-out date must be after check-in date.');
    }
  });

  // init summary
  updatePrice();
  updateSummary();
</script>
</body>
</html>
