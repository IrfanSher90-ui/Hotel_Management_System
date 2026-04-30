<?php
include '../includes/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

  *{box-sizing:border-box}
  html,body{height:90vh}
  body{
    margin:0;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    background:
    radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
    radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
    radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
    radial-gradient(1000px 700px at 5% 10%, #0b7285 0%, transparent 55%),
    var(--bg);
    color: var(--text);
    overflow-x:hidden;
    transition: background .3s ease,color .3s ease;
    display: flex;
    justify-content:center;
  
  }


   .boards{
    grid-template-columns: 1.2fr .8fr;
    gap:12px;
    margin:50px;
   
  }
  @media (max-width:480px){ 
    .boards{
      flex-direction: column;
      align-items: flex-start;
      gap: 8px;
    }
   }

  .panel{
    background: var(--card);
    border:1px solid rgba(255,255,255,.08);
    border-radius:16px;
    padding:14px; 
    box-shadow: var(--shadow);
  }
  .panel h3{margin:0 0 10px 0; font-size:16px}
  .table{
    width:100%; 
    border-collapse: collapse; 
    font-size:14px;
  }
  .table th,.table td{
  
    color:#fff;
    background-color:transparent;
    border-bottom:1px dashed #fff;
    padding:10px; text-align:left;
  }
  
    </style>
</head>
<body>
  <section class="boards">
        <div class="panel">
          <h3>All Rooms</h3>
          <table class="table" role="table">
            <thead>
              <tr>
               <th>ID</th>
             <th>Room No</th>
             <th>Room Image</th>
             <th>Price (PKR)</th>
             <th>Room Type</th>
            <th>Guests</th>
             <th>Description</th>
             <th>Created_At</th>
              <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
          $query = "select * from rooms";
        $run = mysqli_query($conn,$query);
        $row = mysqli_num_rows($run);
        if($row > 0)  { 
           while ($data=mysqli_fetch_array($run))
           { echo 
            " <tr>
              <td>$data[0]</td>
              <td>$data[1]</td>
              <td>$data[2]</td>
              <td>$data[3]</td>
              <td>$data[4]</td>
              <td>$data[5]</td>
              <td>$data[6]</td>
              <td>$data[7]</td>
           
             <td>
             <button class='btn btn-sm btn-warning'>Edit</button>
             <button class='btn btn-sm btn-danger'>Delete</button>
             </td>
           </tr>";
           }
          }
        ?>
            </tbody>
          </table>
        </div>
      </section>

</body>
</html>