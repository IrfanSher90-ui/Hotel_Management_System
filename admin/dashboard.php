<?php
session_start();
include '../includes/db_connect.php';
if ($_SESSION['user']['role'] == 'admin'){
}
else {
  echo "<script>location.href='../loginsign.php'</script>";
}


$ip = $_SERVER['REMOTE_ADDR'];
$conn->query("INSERT INTO visitors (ip_address) VALUES ('$ip')");
$totalVisitors = $conn->query("SELECT COUNT(*) as c FROM visitors")->fetch_assoc()['c'];


$loggedUsers = $conn->query("SELECT COUNT(*) as c FROM users WHERE id")->fetch_assoc()['c'];


$totalPayments = $conn->query("SELECT COUNT(*) as c FROM payment WHERE save_card='yes'")->fetch_assoc()['c'];


$totalbookings = $conn->query("SELECT COUNT(*) as c FROM bookings WHERE status='confirmed'")->fetch_assoc()['c'];


$pendingbookings = $conn->query("SELECT COUNT(*) as c FROM bookings WHERE status='pending'")->fetch_assoc()['c'];


$totalRes = $conn->query("SELECT COUNT(*) AS cnt FROM bookings");
$totalRow = $totalRes->fetch_assoc(); $allBookings = $totalRow['cnt'] + 0;

$statusRes = $conn->query("SELECT status, COUNT(*) AS cnt FROM bookings GROUP BY status");
$statusCounts = ['confirmed'=>0,'pending'=>0,'cancelled'=>0];
while ($r = $statusRes->fetch_assoc()) {
    $k = strtolower($r['status']);
    $statusCounts[$k] = $r['cnt'] + 0;
}



$query = "SELECT * FROM users WHERE id='".$_SESSION['user']['id']."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Nosifer&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

  <style>
:root {
  --bg: #0f172a;
  --text: #fff;
  --card: #1a1a1a7c;
  --heading: #66fcf1;
  --border: #66fcf1;
  --muted: #9ca3af;        
    --brand1: #7c3aed;      
    --brand2: #06b6d4;      
    --ok: #22c55e;
    --warn: #f59e0b;
    --bad: #ef4444;
    --shadow: 0 10px 30px rgba(0,0,0,.35);
    --glass: blur(8px) saturate(120%);
    --ring: 0 0 0 2px #7c3aed55;
    --surface: #111827ee;    
}
.light{
  --bg: #ffffff;
  --text: #000000;
  --card: #fafafa7c;
  --heading: #66fcf1;
  --border: #66fcf1;
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
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Segoe UI', sans-serif;
  background-color: var(--bg);
  color: var(--text);
  display: flex;
  min-height: 100vh;
  overflow-x: hidden;
  background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
}
.div{
  width: 100%;
  position: fixed;
  top: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-radius: 12px ;
  background: transparent;
  border:1px solid rgba(255,255,255,.08);
  box-shadow: var(--shadow); 
  backdrop-filter: blur(4px);
  z-index: 999px!important;
}

.sidebar {
  width: 290px;
   background: transparent;
    border:1px solid rgba(255,255,255,.08);
    box-shadow: var(--shadow); 
  backdrop-filter: blur(4px);
  height: 80vh;
  position: fixed;
  left: 10px;
  top: 109.5px;
  transition: transform 0.3s ease;
  z-index: 100;
  border-radius: 15px;
  padding: 15px;
  overflow-x: hidden;
  overflow-y: auto;
}

.sidebar.hidden {
  transform: translateX(-100%);
  left: 0px;
}

.sidebar h2 {
  color: var(--heading);
  text-align: center;
  margin-bottom: 30px;
}

.sidebar ul {
  list-style: none;
  width: 100%;
  padding: 5px 0px;
}

.sidebar ul li {
  cursor: pointer;
  transition: 0.2s;
  list-style: none;
  margin: 10px 0px;
  padding: 5px 0px;
  border-radius:10px;
}

.sidebar ul li a {
  text-decoration: none;
  cursor: pointer;
  padding: 10px;
  border-radius: 4px;
  margin: 0px 0;
  color: var(--text);
  transition: 0.2s;
  font-size: 14px;
}

.sidebar ul li:hover {
  width: 100%;
    background: linear-gradient(135deg, #4338ca33, #06b6d433);
    border-color: #7c3aed44;
    box-shadow: var(--ring);
    }

.dropdown {
  position: relative;
  width: 100%;
}

.dropdown-btn {
  display: block;
  cursor: pointer;
  color: var(--text);
  border-radius: 8px;
  text-decoration: none;
}



.dropdown-content {
  display: none;
  flex-direction: column;
  margin-left: 20px; 
  position: absolute;
  border-radius: 6px;
  overflow: hidden;
  background: linear-gradient(135deg, #4338ca73, #06b6d473);
  border-color: #7c3aed44;
  box-shadow: var(--ring);
}

.dropdown-content a {
  padding: 10px 20px;
  color: var(--text);
  text-decoration: none;
  font-size: 14px;
  transition: 0.3s;
}



.dropdown:hover .dropdown-content {
  margin-left:-0px;
  display: flex;
   width: 100%;
   background: linear-gradient(135deg, #0ea5b7cc,#312e81cc);
    box-shadow: var(--shadow);
   border-bottom:2px solid rgba(255,255,255,.08);
}

.brand{
  width: 260px;
    display:flex;
    align-items:center; 
    gap:10px;
    margin-top: 10px;
    padding:8px 10px;
    border-radius:10px;
    background: linear-gradient(135deg, #312e81cc, #0ea5b7cc);
    box-shadow: var(--shadow);
  }
  .brand strong{
    letter-spacing:.4px
  }

   .divider{
    width: 240px;
   height:10px; background:transparent; border-top: 3px dotted rgba(255,255,255,.08); margin:8px 0;
   margin-left: 15px;
  }

  .mini{
    margin-top:auto; display:grid; grid-template-columns:1fr 1fr; gap:10px;
    padding: 10px 10px;
  }
  .mini .kpi{
    background: rgba(255,255,255,.06); border-radius:12px; padding:10px;
    border:1px solid rgba(255,255,255,.08); text-align:center;
  }
  .mini .kpi h4{margin:2px 0 0 0; font-size:18px}


.toggle-sidebar {
background: var(--surface);
    border:1px solid rgba(255,255,255,.08);
    box-shadow: var(--shadow);
    color: #0ea5b7cc;
  padding: 6px 12px;
  cursor: pointer;
  z-index: 110;
  border-radius: 10px;
  margin-left: 10px;
  font-weight: bold;
}



.main {
  margin-top: 85px;
  margin-left: 240px;
  width: calc(100% - 220px);
  
  transition: all 0.3s ease;
}

.main.full {
  margin-left: 0;
  width: 98.5%;
}

header {
   background: transparent;
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 10px;
  width: 97%;
}

header h1 {
  color: var(--heading);
  font-size: 1.8rem;
}

.header-actions {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 10px;
  width: 100%;
}
 .search{
    position: relative; flex:1; min-width: 160px;
  }
  .search input{
    width:100%; border:none; outline:none;
    background: rgba(255,255,255,.06);
    color: var(--text);
    padding:12px 42px 12px 42px;
    border-radius:12px;
  }
  .search svg{position:absolute; left:12px; top:50%; transform:translateY(-50%); opacity:.7}

  .hero{
    background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
    border-radius:18px;
    padding:18px;
    margin-top: 30px;
    margin-left: 80px;
    margin-right: 30px;
    overflow:hidden;
    border:1px solid rgba(255,255,255,.08);
    box-shadow: var(--shadow);
  }
  .hero h1{
    margin:0 0 6px 0; 
    font-size:30px;
    font-weight:500;
  }

   /* .hero h1 span.drip-text{
    font-family: "Nosifer", sans-serif;
    color: var(--brand2);
    font-size: clamp(10px, 2vw, 30px);
    line-height: 1.05;
    letter-spacing: 2px;
    margin: 0;
    position: relative;
    text-shadow:
      0 1px 0 #0008,
      0 2px 0 #0007,
      0 3px 0 #0006,
      0 6px 12px rgba(0,0,0,.55),
      0 0 18px color-mix(in oklab, var(--ink) 70%, white 30%);
    -webkit-text-stroke: 1px rgba(0,0,0,.35);
    filter: drop-shadow(0 10px 22px rgba(0,0,0,.45));
  }

  
  .hero h1 span.drip-text::after{
    content:"";
    position:absolute; left:0; right:0; bottom:-8px; height:22px;
    background:
      radial-gradient(10px 12px at 10% 0, var(--ink) 60%, transparent 61%),
      radial-gradient(8px 10px at 28% 0,  var(--ink) 60%, transparent 61%),
      radial-gradient(12px 14px at 46% 0, var(--ink) 60%, transparent 61%),
      radial-gradient(9px 11px  at 65% 0, var(--ink) 60%, transparent 61%),
      radial-gradient(11px 13px at 82% 0, var(--ink) 60%, transparent 61%);
    filter: drop-shadow(0 3px 6px rgba(0,0,0,.5));
    animation: drip 2.8s ease-in-out infinite;
    pointer-events:none;
  }

 
  .hero h1 span.drip-text::before{
    content:"";
    position:absolute; left:0; right:0; bottom:-26px; height:28px;
    background:
      linear-gradient(var(--ink), transparent) 12% 0 / 6px 100% no-repeat,
      linear-gradient(var(--ink), transparent) 48% 0 / 5px 100% no-repeat,
      linear-gradient(var(--ink), transparent) 78% 0 / 7px 100% no-repeat;
    opacity:.9;
    filter: drop-shadow(0 4px 8px rgba(0,0,0,.5));
    animation: dripLong 3.6s ease-in-out infinite;
  }

  @keyframes drip{
    0%,100% { transform: translateY(0) }
    40%     { transform: translateY(2px) }
    60%     { transform: translateY(4px) }
  }
  @keyframes dripLong{
    0%,100% { transform: translateY(0)  }
    50%     { transform: translateY(3px) }
  }
  .hero p{margin:0; color: var(--muted)} */

.dashboard-section {
  padding: 30px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin-left: 50px;
}

.card {
  background-color: transparent;
  backdrop-filter: blur(4px);
  
  padding: 10px;
  border-radius: 10px;
  overflow:hidden;
  border:1px solid rgba(255,255,255,.08);
   box-shadow: var(--shadow);
  opacity: 0;
  transform: translateY(50px);
}

.card .h3 {
  font-size: 20px;
  color: var(--heading);
  margin-bottom: 10px;
}

.card p {
  color: var(--text);
  font-size: 14px;
}


.profile-modal {
  position: fixed;
  top: 75px;
  right: 10px;
  transform: translate(-0%, -0%) scale(0);
   background: linear-gradient(135deg, #1e293b88, #0ea5b767);
  border-radius:18px;
  color: var(--text);
  padding: 25px;
  z-index: 999;
  transition: transform 0.3s ease;
  text-align: center;
  overflow:hidden;
  border:1px solid rgba(255,255,255,.08);
  box-shadow: var(--shadow);
  
}
.profile-modal::before{
  content: "";
  border-bottom: 20px solid rgba(255,255,255,.08);
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  position: absolute;
  top: -20px;
  right: 30px;
}
.profile-modal.active {
  transform: translate(-0%, -0%) scale(1);
}

.profile-modal button {
  margin-top: 15px;
  padding: 6px 10px;
  color: var(--text);
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

  .modal-header{
    display:flex; align-items:center; gap:12px; padding:14px; border-bottom:1px solid rgba(255,255,255,.08);
  }

.modal-body{padding:10px}
  .link-list a{
    display:flex; align-items:center; gap:10px;
    text-decoration:none; color:inherit; padding:10px 12px; border-radius:12px;
    border:1px solid transparent;
  }
  .link-list a:hover{background: rgba(255,255,255,.06); border-color: rgba(255,255,255,.12)}

  
@media (max-width: 1149px) {
  .div{
    width: 100%;
    position: fixed;
    top: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: transparent;
    backdrop-filter: blur(4px);
    z-index: 999px!important;
  }
  .header-actions input {
    width: 70%;
  }
  .lo{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .sidebar {
    transform: translateX(-100%);
    position: fixed;
    width: 250px;
    z-index: 100;
    border-radius: none;
    left: -20px;
  }
  
  .sidebar.show {
    transform: translateX(0);
  }
  .profile-modal {
    right: 0px;
  }
  .profile-modal::before {
    content: "";
    right: 19px;
  }
  .main {
    margin-left: 0;
    margin-top: 115px;
    width: 100%;
  }

  .main.full {
    margin-left: 0;
    width: 100%;
  }
  .main header h1{
    font-size: 6vw;
   
  }
  .header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
}

@media (max-width: 766px) {
  .div{
    z-index: 99;
  }
  .sidebar {
    transform: translateX(-100%);
    position: fixed;
    width: 220px;
    z-index: 100;
    width: 100%;
    border-radius: none;
    left: -20px;
  }
  
  .sidebar.show {
    transform: translateX(0);
  }
  .profile-modal {
    right: 0px;
    top: 160px;
    width: 100%;
  }
  .profile-modal::before {
    content: "";
    right: 29px;
  }
  .main {
    margin-left: 0;
    width: 100%;
  }

  .main.full {
    margin-left: 0;
    width: 100%;
  }
 .main header h1{
    font-size: 6vw;
  }
  .header-actions input{
    width: 100%;
  }
  

  .toggle span{
    display: none;
  }
 
}
canvas{
      max-width: 500px;
      max-height: 250px;
      background-color: transparent;
      backdrop-filter: blur(4px);
      padding: 20px;
      border-radius: 12px;
      margin-left: 50px;
      border:1px solid rgba(255,255,255,.08);
      box-shadow: var(--shadow);
    }
    .lo{
      gap: 10px;
      
    }
    .toggle{
    display:inline-flex; align-items:center; gap:8px; cursor:pointer;
    padding:8px 12px; border-radius:12px;
    background: transparent;
    overflow:hidden;
    border:1px solid rgba(255,255,255,.08);
    box-shadow: var(--shadow);
    float: left;

  }
      .icon-btn{
    position:relative; border:none; background:var(--card);
    padding:9px; border-radius:18px; cursor:pointer; color:var(--text);
  }
  .badge{
    position:absolute; top:-4px; right:-4px;
    background: linear-gradient(135deg, #ef4444, #f97316);
    color:#66fcf1; border-radius:999px; padding:2px 6px; font-size:11px;
    box-shadow: var(--shadow);
  }

  
  .avatar{
    width:40px; height:40px; border-radius:999px; overflow:hidden;
    border:2px solid #66fcf1; cursor:pointer;float: right;/*margin-top: 5px;*/
    color: #838383;
  }



    table {
      width: 94%;
      border-collapse: collapse;
       backdrop-filter: blur(4px);
      padding: 20px;
      margin-left: 50px;
      border-radius: 30px;
      overflow:hidden;
      border:4px solid rgba(255,255,255,.08);
      box-shadow: var(--shadow);
      background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
      border-radius:18px;
    }
    th, td {
      padding: 1rem;
      border-bottom: 1px dotted #ddd;
      text-align: left;
    }
    .status{
    display:inline-flex; align-items:center; gap:6px;
    padding:4px 8px; border-radius:999px; font-size:12px;
    border:1px solid rgba(255,255,255,.12);
    background: rgba(255,255,255,.04);
  }
  .dot{width:8px; height:8px; border-radius:999px; background:var(--muted)}
  .ok .dot{background:var(--ok)}
  .warn .dot{background:var(--warn)}
  .bad .dot{background:var(--bad)}

    body.dark th, body.dark td { border-color: #334155; }



 .card1 {
      width: 610px;
      height: 250px;
       margin-top: -250px;
       margin-left: 600px;
      padding: 20px;
      text-align: center;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s;
      border: 2px dotted rgba(255,255,255,.08);
      backdrop-filter: var(--glass);
    }
   

    .card1 h3 {
      margin-bottom: 10px;
      text-align: left;
      font-size: 18px;
      color: var(--brand2);
    }
   
   
    .box {
      width: 100%;
      height: 200px;
      border-collapse: collapse;
      margin-top: -20px;
      margin-left: 20px;
      background-color: transparent;
    }
     .box ul ,li{
      list-style: none;
      text-decoration: none;
       background-color: transparent;
      padding: 10px;
      text-align: left;
      border-bottom: 1px dotted rgba(255,255,255,.08);
    }

    @media ( max-width: 480px) {
  header {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }
  .dashboard-section {
    grid-template-columns: 1fr;
    margin-left: 0;
    padding: 15px;
  }
  .main{
    grid-template-columns: 1fr;
    margin-left:-10px;
    padding: 15px;
  }
  .hero{
     grid-template-columns: 1fr;
    margin-left:15px;
    padding: 15px;
  }
  table {
    font-size: 12px;
    display: block;
    overflow-x: auto;
     grid-template-columns: 1fr;
    margin-left:-10px;
    padding: 15px;
  }
  canvas{
      grid-template-columns: 1fr;
    margin-left:-10px;
    padding: 15px;
  }
  .card1 {
    width: auto;
     grid-template-columns: 1fr;
    margin-left:-10px;
    padding: 15px;
    margin-top: 30px;
  }
   .box{
    width: auto;
     grid-template-columns: 1fr;
    margin-left:-10px;
    padding: 15px;
   }
}







  </style>
</head>
<body>
 
    <div class="div">
      <button class="toggle-sidebar" id="toggleSidebar">☰</button>
     
      <header>
        <div class="header-actions">
          <div class="search" role="search">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/></svg>
        <input placeholder="Search bookings, rooms, guests..." aria-label="Search"/>
          </div>

          <div class="lo">
            <label class="toggle" id="themeToggle" role="button" aria-pressed="false" tabindex="0">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 3v2m0 14v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M3 12h2m14 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
              <span>Theme</span>
            </label>
            &nbsp;&nbsp;
            <img src="../<?php echo ($row['image']); ?>" alt="Profile" class="avatar" id="profileBtn"/>
          </div>
        </div>
      </header>
    </div>

 
  <div class="sidebar" id="sidebar">
         <div class="brand">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M3 10l9-7 9 7v9a2 2 0 0 1-2 2h-4v-7H9v7H5a2 2 0 0 1-2-2v-9z" stroke="#fff" stroke-width="2" stroke-linejoin="round"/></svg>
        <strong>Admin-Dash</strong>
        <button aria-label="Close menu" title="Close" style="margin-left:auto; background:transparent; border:none; color:#fff; opacity:.7; cursor:pointer" id="toggleSidebar">
          <!-- <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M6 18L18 6" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg> -->
        </button>
      </div>
    <ul>
       <li><a href="../index.php"><i class="fas fa-home me-2"></i>&nbsp;&nbsp;&nbsp; Website</a></li>
       <li><a href="add_room.php"><i class="fas fa-plus-square me-2"></i>&nbsp;&nbsp;&nbsp; Add Room</a></li>
       <li class="dropdown">
          <a href="#" class="dropdown-btn"><i class="fas fa-cogs me-2"></i>&nbsp;&nbsp;Manage Bookings ▾</a>
          <div class="dropdown-content">
            <a href="../manage_bookings/bookings.php">Bookings</a>
            <a href="../manage_bookings/manage_bookings.php">Manage Bookings</a>
               <a href="../customer/room.php">View Rooms</a>
            <a href="../manage_bookings/booking_status.php">Booking Status</a>
            <a href="../customer/payment.php">Payments</a>
          </div>
        </li>
       <li><a href="room_list.php"><i class="fas fa-plus-square me-2"></i>&nbsp;&nbsp;&nbsp; Room List</a></li>
       <li><a href="../services/notification.php"><i class="fas fa-plus-square me-2"></i>&nbsp;&nbsp;&nbsp; Notifications</a></li>
       <li><a href="staff.php"><i class="fas fa-users me-2"></i>&nbsp;&nbsp;&nbsp;Manage Staff</a></li>
       <li><a href="../customer/mybooking.php"><i class="fas fa-calendar-check me-2"></i>&nbsp;&nbsp;&nbsp; My Bookings</a></li>
       <li class="dropdown">
          <a class="dropdown-btn" href="../staff/dashboard.php"><i class="fas fa-users me-2"></i>&nbsp;&nbsp;&nbsp; Services ▾</a>
          <div class="dropdown-content">
            <a href="../services/service.php">Our Services</a>
            <a href="../services/resturant.php">Our Resturant</a>
            <a href="../staff/repot.php">Reports</a>
          </div>
        </li>
       <li><a href="../customer/room.php"><i class="fas fa-bed me-2"></i>&nbsp;&nbsp;&nbsp;All Rooms</a></li>
       <li><a href="../Manage_bookings/booking_status.php"><i class="fas fa-calendar-check me-2"></i>&nbsp;&nbsp;&nbsp; Booking Status</a></li>
       <li><a href="settings.php"><i class="fas fa-cogs me-2"></i>&nbsp;&nbsp;&nbsp; Settings</a></li>
       <li><a href="logout.php"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M10 17l5-5-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 12h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>&nbsp;&nbsp;&nbsp; Logout</a></li>
    </ul>
       <div class="divider"></div>

        <div class="mini">
        <div class="kpi">
          <small>Occupied</small>
          <h4>78%</h4>
        </div>
        <div class="kpi">
          <small>Revenue</small>
          <h4>$12.4k</h4>
        </div>
      </div>
  </div>


  
  <div class="main" id="mainContent">
    <section class="hero">
      <h1>Welcome back, <span class="drip-text"><?php echo ($row['name']); ?></span> 👋</h1>
      <p>Here’s a quick overview of today’s activity across bookings, services, and housekeeping.</p>
    </section>
    <section class="dashboard-section">
      <div class="card">
        <p class="h3">Total Users</p>
        <p>1,245 active users</p>
      </div>
      <div class="card">
        <p class="h3">Revenue</p>
        <p>$12,340.50</p>
      </div>
       <div class="card">
        <p class="h3">Total Visitors</p>
        <h2><?= $totalVisitors ?></h2>
        </div>

         <div class="card">
          <p class="h3">Active Logins</p>
          <h2><?= $loggedUsers ?></h2>
          </div>

          <div class="card">
         <p class="h3">Successful Payments</p>
         <h2><?= $totalPayments ?></h2>
         </div>

          <div class="card">
         <p class="h3">Conformid Bookings</p>
         <h2><?= $totalbookings ?></h2>
         </div>

         <div class="card">
         <p class="h3">Pending Bookings</p>
          <h2><?= $pendingbookings ?></h2>
         </div>

         <div class="card">
         <p class="h3">Total Bookings</p>
         <h2><?= $allBookings ?></h2>
         </div>
         
        
      
    </section>
    <section style="margin-left: 30px;">  

        <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recent Bookings</h3>
        <br>
        <table>
          <thead>
              <tr><th>Guest</th><th>Room</th><th>Check-in</th><th>Nights</th><th>Status</th></tr>
            </thead>
            <tbody>
              <tr><td>Sarah Lee</td><td>406 • Deluxe</td><td>Aug 17</td><td>3</td><td><span class="status ok"><span class="dot"></span>Confirmed</span></td></tr>
              <tr><td>Jamal Khan</td><td>212 • Standard</td><td>Aug 17</td><td>1</td><td><span class="status warn"><span class="dot"></span>Pending</span></td></tr>
              <tr><td>Emily Clark</td><td>801 • Suite</td><td>Aug 18</td><td>2</td><td><span class="status ok"><span class="dot"></span>Confirmed</span></td></tr>
              <tr><td>Akira shah</td><td>119 • Standard</td><td>Aug 19</td><td>4</td><td><span class="status bad"><span class="dot"></span>Failed</span></td></tr>
            </tbody>
        </table>
        <br>
       
      <canvas id="salesChart"></canvas>


       <div class="card1">
      <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Popular Pages</h3>
        <div class="box">
        <ul>
        <li><strong>Page</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Views</li>
        <li>Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <?= $totalVisitors ?></li>
        <li>Bookings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;980</li>
        <li>Hotels&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;765</li>
        <li>Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 432</li>
        </ul>
    </div>
    </div>
    </section>
  </div>


  <!-- Profile Modal -->
  <div class="profile-modal" id="profileModal">
    <div class="modal-header">
        <img src="../<?php echo ($row['image']); ?>" alt="" class="avatar" style="width:46px;height:46px"/>
        <div>
          <strong id="modalTitle"><?php echo ($row['name']); ?></strong><br/>
          <small class="muted">Irfan Sher • Admin</small>
        </div>
     <div class="modal-body">
        <nav class="link-list">
          <a href="../profile/update_password.php"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 6h16M7 12h10M7 18h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Profile</a>
          <a href="../admin/settings.php"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" stroke="currentColor" stroke-width="2"/></svg>Settings</a>
          <a href="logout.php"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M10 17l5-5-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 12h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Logout</a>
        </nav>
      </div>
        <button aria-label="Close modal" onclick="document.getElementById('profileModal').classList.remove('active')"  style="margin-left:auto; background:transparent; border:none; color:inherit; cursor:pointer">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M6 18L18 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
    <!-- <button onclick="document.getElementById('profileModal').classList.remove('active')">Close</button> -->
  </div>


  <!-- GSAP + Script -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const body = document.body;
  const themeToggle = document.getElementById('themeToggle');
  const prefersLight = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches;
  const savedTheme = localStorage.getItem('hms-theme');
  if (savedTheme === 'light' || (!savedTheme && prefersLight)) body.classList.add('light');

  function flipTheme(){
    body.classList.toggle('light');
    localStorage.setItem('hms-theme', body.classList.contains('light') ? 'light' : 'dark');
    themeToggle.setAttribute('aria-pressed', body.classList.contains('light') ? 'true' : 'false');
  }
  themeToggle.addEventListener('click', flipTheme);
  themeToggle.addEventListener('keydown', e => { if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); flipTheme(); } });
    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray(".card").forEach(card => {
      gsap.to(card, {
        scrollTrigger: {
          trigger: card,
          start: "top 80%",
        },
        opacity: 1,
        y: 0,
        duration: 1,
        ease: "power2.out"
      });
    });

    // Sidebar toggle logic
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    // toggleBtn.addEventListener('click', () => {
    //   sidebar.classList.toggle('hidden');
    //   mainContent.classList.toggle('full');
    // });

    // Profile Modal logic
    const profileBtn = document.getElementById('profileBtn');
    const profileModal = document.getElementById('profileModal');

    profileBtn.addEventListener('click', () => {
      profileModal.classList.add('active');
    });
    toggleBtn.addEventListener('click', () => {
  sidebar.classList.toggle('hidden');
  sidebar.classList.toggle('show'); // 👈 For mobile
  mainContent.classList.toggle('full');
});


const ctx = document.getElementById('salesChart').getContext('2d');

    const salesChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'Monthly Sales (PKR)',
          data: [20000, 35000, 25000, 40000, 30000, 45000],
          backgroundColor: '#66fcf1',
          borderRadius: 10
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            labels: {
              color: '#838383' // legend text color
            }
          },
          title: {
            display: true,
            text: 'Hotel Sales (Jan to Jun)',
            color: '#838383',
            font: {
              size: 20
            }
          }
        },
        animation: {
          duration: 2000,
          easing: 'easeInOutQuart'
        },
        scales: {
          x: {
            ticks: {
              color: '#838383' // x-axis label color
            },
            grid: {
              color: '#838383'
            }
          },
          y: {
            beginAtZero: true,
            ticks: {
              color: '#838383', // y-axis label color
              callback: function(value) {
                return 'Rs. ' + value;
              }
            },
            grid: {
              color: '#838383'
            }
          }
        }
      }
    });
  

  </script>

</body>
</html>