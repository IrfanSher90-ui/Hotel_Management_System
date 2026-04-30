<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Rooms</title>
  <style>

      :root{
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
  .light{
    --bg: #f8fafc;
    --surface: #ffffffcc;
    --card: #ffffff;
    --text: #0f172a;
    --muted: #64748b;
    --shadow: 0 10px 30px rgba(2,8,23,.08);
    --ring: 0 0 0 2px #7c3aed33;
  }
   
  
    body {
      background: #0d0d0d;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
    }
    .main{
       width: 650px;
      height: 590px;
      background: #111;
      border-radius: 20px;
      border:3px solid #222;
      display: flex;
      justify-content:center;
      align-items:center;
     transition: border 0.4s ease-in-out, transform 0.4s ease-in-out;
    }

    .main:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 15px #0ea5b767;
    }


    .card {
      width: 600px;
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
     height: 300px;
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
    left:250px;

   }
   
  .divider{     
    position: absolute;
      top: 250px;  
      left: -50%;
      width: 200%;
      height: 20px;
      background: linear-gradient(90deg,#00c853,#2905f7ff);
      filter: blur(80px);
      z-index: -3; 
     }

   form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 40px;
    }

    label {
      font-size: 14px;
      color: var(--muted);
      margin-bottom: 4px;
      text-align: left;
    }

    input, select {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #333;
      background: transparent;
      color: #fff;
      box-sizing: border-box;
       
    }
   select {
      appearance: none;        
      -moz-appearance: none;  
      -webkit-appearance: none; 
      background: #111 url("data:image/svg+xml;utf8,<svg fill='%23ffffff' height='20' width='20' xmlns='http://www.w3.org/2000/svg'><polygon points='0,0 20,0 10,10'/></svg>") no-repeat right 10px center;
      background-size: 12px;
      width: 185px;
     }
     select option:hover {
       background: #06b6d4; 
      color: #111;
     }


    input[type="file"] {
      padding: 5px;
     }
 

     .file-label {
      display: inline-block;
      background: transparent;
      color: white;
      padding: 5px 16px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .file-label:hover {
      transform: scale(1.05);
    }

    .file-name {
      margin-top: 12px;
      font-size: 14px;
      color: #333;
    }
   button{
      margin-top:-15px;
      margin-left:13vw;
      background: transparent;
      color: white;
      padding: 10px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
       width: 185px;
   }


     @media (min-width: 600px) {
      .form-row {
        display: flex;
        gap: 15px;
      }
      .form-row > div {
        flex: 1;
      }
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
      left:500px;
      top:420px;
    }
    .box img{
      width: 60px;
      height: 60px;
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
         <form action="" method="POST" enctype="multipart/form-data">
        <div>
          <label for="room">Room Name</label>
          <input type="text" name="title" placeholder="Enter room Name">
        </div>

        <div>
          <label for="image" class="file-label">Room Image
          <input type="file" name="image_url"></label>
        </div>

        <div class="form-row">
          <div>
            <label for="price">Price (PKR)</label>
            <input type="text" name="price" placeholder="Enter price">
          </div>
          <div>
            <label for="room_type">Room Type</label>
            <select name="room" name="room_type">
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Suite">Suite</option>
                <option value="Family">Family</option>
          </select>
          </div>
        </div>

        <div class="form-row">
          <div>
            <label for="guests">Guests</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="guests" placeholder="No. of guests">
          </div>
          <div>
            <label for="description">Description</label>
            <input type="text" name="description" placeholder="Short description">
          </div>
        </div>

        <div>
        </div>
        <button type="submit" value="submit" name="submit">submit</button>
        <br>
        <br>
           <?php
    if(isset($_POST['submit']))
    {
       include '../includes/db_connect.php';  
        $room_name = $_POST['title'];
        //image upload
        $image = $_FILES['image_url']['name'];
        $tmp_name = $_FILES['image_url']['tmp_name'];
        move_uploaded_file($tmp_name, "../uploads/" . $image);
        $price = $_POST['price'];
        $room_type = $_POST['room_type'];
        $guests = $_POST['guests'];
        $decoration = $_POST['description'];

        $query = "INSERT INTO rooms(title,image_url,price,room_type,guests,description)
        VALUES('$room_name','$image','$price','$room_name','$guests','$decoration')";
        $run = mysqli_query($conn, $query);
        if($run){
            echo "<script>alert('Room Added Successfully!')</script>";
        }
        else{
            echo "Not run Error: " . mysqli_error($conn);
}
        
    }

       ?>
  </form>
    </div>
    
    <div class="info">
      <p class="EM">EMP-51247</p>
      <p>January 15, 2023</p>
      <p>12 Corporate Plaza</p>
      <p>Springfield Office</p>
    </div>
    <div class="box">
      <img src="../uploads/blackchip.png" alt="">
    </div>
  </div>
  </div>
     
</body>
</html>


            