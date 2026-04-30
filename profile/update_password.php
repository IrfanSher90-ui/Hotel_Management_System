<?php
session_start();

include '../includes/db_connect.php';  

if (isset($_SESSION['user']['id'])){ 

$query = "SELECT * FROM users WHERE id='".$_SESSION['user']['id']."'";
$result = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Card</title>
  <style>

      :root{
    --bg: #0f172a;           /* slate-900 */
    --surface: #111827ee;    /* near-black glass */
    --card: #0b1222;         /* deep slate */
    --text: #e5e7eb;         /* gray-200 */
    --muted: #9ca3af;        /* gray-400 */
    --brand1: #7c3aed;       /* violet-600 */
    --brand2: #06b6d4;       /* cyan-500 */
    --ok: #22c55e;
    --warn: #f59e0b;
    --bad: #ef4444;
    --shadow: 0 10px 30px rgba(0,0,0,.35);
    --glass: blur(8px) saturate(120%);
    --ring: 0 0 0 2px #7c3aed55;
  }
  .light{
    --bg: #f8fafc;
    --surface: #ffffffcc;
    --card: #ffffff;
    --text: #0f172a;
    --muted: #64748b;
    --shadow: 0 10px 30px rgba(2,8,23,.08);
    --ring: 0 0 0 2px #7c3aed33;
  }
    ::-webkit-scrollbar {
   overflow:hidden;
  }
  
  
  body {
    background: #0d0d0d;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: Arial, sans-serif;
    overflow:hidden;
    }
    .main{
       width: 420px;
      height: 590px;
      background: #111;
      border-radius: 20px;
      /* box-shadow: 0 0 25px rgba(0,0,0,0.5); */
      border:3px solid #222;
      display: flex;
      justify-content:center;
      align-items:center;
     transition: border 0.4s ease-in-out, transform 0.4s ease-in-out;
    }

    .main:hover {
      /* border-color: var(--highlight); */
      transform: translateY(-5px);
      box-shadow: 0 0 15px #0ea5b767;
    }


    .card {
      width: 380px;
      height: 500px;
      background: #111;
      border-radius: 20px;
      box-shadow: 0 0 25px rgba(0,0,0,0.5);
      border:3px solid #222;
      text-align: center;
      position: relative;
      overflow: hidden;
      color: #fff;
    }
   .line{
     width: 100%;
     height: 120px;
     background-color:#111111;
     border-bottom:3px solid #222;
     position: absolute;
     top:-40px;
     z-index: -1;
   }
   .smallline{
    width: 70px;
    height: 6px;
    background-color:#222;
    border-radius:10px;
    position:absolute;
    left:160px;
    top:20px;
   }
   
  .divider{     
    position: absolute;
      top: 150px;  
      left: -50%;
      width: 200%;
      height: 20px;
      background: linear-gradient(90deg,#00c853,#2905f7ff);
      filter: blur(80px);
      z-index: -3; 
     }
    .profile {
      position: relative;
      margin-top: 60px;
      z-index: 2;
    }

    .profile img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      border: 4px solid #222;
      margin-top:30px;
    }

    h2 {
      margin-top: 15px;
      font-size: 20px;
      font-weight: bold;
    }

    p {
      font-size: 14px;
      color: #aaa;
      margin: 5px 0 20px;
    }

    .info {
      position: absolute;
      bottom: -10px;
      font-size: 12px;
      color: #bbb;
      text-align:left;
      padding:10px 30px;
    }
    .info .EM{
      color:white;
    }
    .box{
      position: absolute;
      left:300px;
      top:420px;
    }
    .box img{
      width: 60px;
      height: 60px;
    }
    .btn{
    display:inline-flex; 
    align-items:center; 
    margin-bottom:12px;
    color:#fff;
    gap:10px; 
    cursor:pointer;
    padding:8px 25px; 
    border-radius:8px;
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
    background-color:transparent;
    }
    .btn a{
      text-decoration:none;
      list-style:none;
      color:#fff;
    }

  </style>
</head>
<body>
  <div class="main">

  <div class="card">
    <div class="profile">
      <div class="line">
        <div class="smallline"></div>
      </div>
      <div class="divider"></div>
         <?php while ($row = mysqli_fetch_assoc($result)){ ?>
        <img src="../<?php echo ($row['image']); ?>" alt="Profile Image">
        <h2>Name : <?php echo ($row['name']); ?></h2>
        <p><strong>Email :</strong> <?php echo ($row['email']); }?></p>
    </div>
    <div class="info">
      <p class="EM">EMP-51247</p>
      <p>January 15, 2023</p>
      <p>Profile Page</p>
      <button class="btn"><a href="./logout.php">Logout</a></button>

    </div>
    <div class="box">
      <img src="../uploads/blackchip.png" alt="">
    </div>
  </div>

  <?php
}else{
  echo "<script>window.location.href='../loginsign.php'</script>";
}
?>
  </div>
</body>
</html>
