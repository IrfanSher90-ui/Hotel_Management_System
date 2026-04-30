<?php
session_start();

include '../includes/db_connect.php';  

if (isset($_SESSION['user']['id'])){ 

$query = "SELECT * FROM bookings WHERE user_id='".$_SESSION['user']['id']."' ORDER BY `bookings`.`id` DESC limit 1";
$result = mysqli_query($conn, $query);

$querys = "SELECT * FROM bookings WHERE user_id='".$_SESSION['user']['id']."'";
$results = mysqli_query($conn, $querys);

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bookings</title>
  <style>
    :root {
      --bg-light: #f9f9f9;
      --bg-dark: #1e1e2f;
      --text-light: #1e1e2f;
      --text-dark: #f9f9f9;
      --card-light: #ffffff;
      --card-dark: #2a2a40;
      --primary: #4f46e5;
      --secondary: #06b6d4;
       --bg: #0f172a;         
    --surface: #111827ee;     
    --card: #0b1222;          
    --text: #e5e7eb;         
    --muted: #9ca3af;      
    --brand1: #7c3aed;        
    --brand2: #06b6d4;        
    --ok: #22c55e;
    --warn: #f59e0b;
    --bad: #ef4444;
    --shadow: 0 10px 30px rgba(0,0,0,.35);
    --glass: blur(8px) saturate(120%);
    --ring: 0 0 0 2px #7c3aed55;
    }

    body {
      margin: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: var(--bg-light);
      color: var(--text-light);
      transition: all 0.3s ease;
    }
    
    section{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    body.dark {
     
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

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
      border-radius:18px;
      overflow:hidden;
      border:1px solid rgba(255,255,255,.08);
      box-shadow: var(--shadow);
      color: white;
    }
    button{
      background: linear-gradient(135deg, #1e293b88, #0ea5b767);
      padding: 1rem 2rem;
      color: white;
      border:1px solid rgba(255,255,255,.08);
      box-shadow: var(--shadow);
      border-radius:10px;
    }

    .toggle-btn {
     display:inline-flex; align-items:center; gap:8px; cursor:pointer;
    padding:8px 12px; border-radius:12px;
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
    }
  
    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 1rem;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 1.5rem;
      display: none;
    }

    .container.active{
      display: block;
    }

    .card {
      background: transparent;
      border-radius: 16px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      padding: 1.5rem;
      transition: all 0.3s ease;
      display: inline-block;
    }

    body.dark .card {
      background:transparent;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h3 {
      margin: 0;
      font-size: 1.2rem;
      color: var(--primary);
    }

    .details {
      margin: 1rem 0;
      font-size: 0.9rem;
      line-height: 1.6;
    }

    .status {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 10px;
      font-size: 0.8rem;
      font-weight: bold;
    }
    .confirmed { background: #22c55e; color: white; }
    .pending { background: #facc15; color: black; }
    .canceled { background: #ef4444; color: white; }

    .actions {
      display: flex;
      justify-content: space-between;
      gap: 10px;
    }

    .btn {
      flex: 1;
      padding: 0.6rem;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn.cancel { background: #ef4444; color: white; }
    .btn.invoice { background: var(--primary); color: white; }
    .btn:hover { opacity: 0.8; }
  </style>
</head>
<body>
  <header>
    <h2>My Bookings</h2>
    <center><button onclick="switchForm('lastBooking')">LastBooking</button>&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="switchForm('allBookings')">AllBookings</button></center>
    <button class="toggle-btn" onclick="toggleMode()">Theme</button>
  </header>
  <section>
    <div class="container active" id="lastBooking">
      <h2>Last Booking</h2>
      <?php while ($row = mysqli_fetch_assoc($result)){ ?>
      <div class="card">
        <div class="details">
        <h3><?php echo ($row['room_type']);  ?></h3>
       
        <p><strong><h2>Name : <?php echo ($row['guest_name']);  ?></h2></strong></p>
        <p><strong><h2>Number of Rooms : <?php echo ($row['Number_of_rooms']);  ?></h2></strong></p>
        <p><strong><?php echo ($row['email']);   ?></p>
        <p><strong><?php echo ($row['guests']);   ?></p>
        <p><strong><?php echo ($row['check_in']);   ?></p>
        <p><strong><?php echo ($row['check_out']);   ?></p>
         <p><strong><strong><?php echo ($row['price']);?></strong></p>
         <p><strong><?php echo ($row['status']);   ?></p>
        <p><strong><?php echo ($row['created_at']);   ?></p>
        <p><strong><?php echo ($row['price']);?></strong></p>
      </div>
      <div class="actions">
        <button class="btn cancel">Cancel</button>
        <button class="btn invoice">Download Invoice</button>
      </div>
    </div>
    <?php }?>
  </div>
  <div class="container" id="allBookings">
    <h2>All Bookings</h2>
    <?php while ($rows = mysqli_fetch_assoc($results)){ ?>
      <div class="card">
        <div class="details">
        <h3><?php echo ($rows['room_type']);  ?></h3>
       
        <p><strong><h2>Name : <?php echo ($rows['guest_name']);  ?></h2></strong></p>
        <p><strong><?php echo ($rows['email']);   ?></p>
        <p><strong><?php echo ($rows['guests']);   ?></p>
        <p><strong><?php echo ($rows['check_in']);   ?></p>
        <p><strong><?php echo ($rows['check_out']);   ?></p>
         <p><strong><strong><?php echo ($rows['price']);?></strong></p>
         <p><strong><?php echo ($rows['status']);   ?></p>
        <p><strong><?php echo ($rows['created_at']);   ?></p>
        <p><strong><?php echo ($rows['price']);?></strong></p>
      </div>
      <div class="actions">
        <button class="btn cancel">Cancel</button>
        <button class="btn invoice">Download Invoice</button>
      </div>
    </div>
    <?php }?>
  </div>
</section>

  <script>
    function switchForm(formId) {
      document.querySelectorAll(".container").forEach(form => form.classList.remove("active"));
      document.getElementById(formId).classList.add("active");
    }
    function toggleMode() {
      document.body.classList.toggle("dark");
      const btn = document.querySelector(".toggle-btn");
      if(document.body.classList.contains("dark")) {
        btn.textContent = "Theme";
      } else {
        btn.textContent = "Theme";
      }
    }
  </script>



<?php
}else{
  echo "<script>window.location.href='../loginsign.php'</script>";
}
?>
</body>
</html>
