<?php
include '../includes/db_connect.php'; 


function flash($msg, $type = 'info') {
    $_SESSION['flash'] = ['msg'=>$msg,'type'=>$type];
}
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $delId = intval($_POST['booking_id'] ?? 0);
    if ($delId) {
        $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
        $stmt->bind_param("i", $delId);
        if ($stmt->execute()) {
            flash("Booking #{$delId} deleted.", 'success');
        } else {
            flash("Delete failed: " . $stmt->error, 'error');
        }
        $stmt->close();
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
}


if (isset($_GET['export']) && $_GET['export'] === 'csv') {
  
    $export_csv = true;
} else {
    $export_csv = false;
}


$search = trim($_GET['search'] ?? '');
$room_type = trim($_GET['room_type'] ?? '');
$status = trim($_GET['status'] ?? '');
$date_from = trim($_GET['date_from'] ?? '');
$date_to = trim($_GET['date_to'] ?? '');
$page = max(1, intval($_GET['page'] ?? 1));
$per_page = intval($_GET['per_page'] ?? 12);
$offset = ($page - 1) * $per_page;

$where = "WHERE 1=1";
$params = [];
$types = "";


if ($search !== '') {
    $s = "%{$search}%";
    $where .= " AND (CAST(id AS CHAR) LIKE ? OR guest_name LIKE ? OR email LIKE ? OR phone LIKE ?)";
    $params = array_merge($params, [$s,$s,$s,$s]);
    $types .= "ssss";
}

if ($room_type !== '') {
    $where .= " AND room_type = ?";
    $params[] = $room_type; $types .= "s";
}

if ($status !== '') {
    $where .= " AND status = ?";
    $params[] = $status; $types .= "s";
}

if ($date_from !== '') {
    $where .= " AND check_in >= ?";
    $params[] = $date_from; $types .= "s";
}
if ($date_to !== '') {
    $where .= " AND check_out <= ?";
    $params[] = $date_to; $types .= "s";
}


$totalRes = $conn->query("SELECT COUNT(*) AS cnt FROM bookings");
$totalRow = $totalRes->fetch_assoc(); $totalBookings = $totalRow['cnt'] + 0;

$statusRes = $conn->query("SELECT status, COUNT(*) AS cnt FROM bookings GROUP BY status");
$statusCounts = ['confirmed'=>0,'pending'=>0,'cancelled'=>0];
while ($r = $statusRes->fetch_assoc()) {
    $k = strtolower($r['status']);
    $statusCounts[$k] = $r['cnt'] + 0;
}


$countSql = "SELECT COUNT(*) AS cnt FROM bookings $where";
$countStmt = $conn->prepare($countSql);
if ($types) {
    
    $countStmt->bind_param($types, ...$params);
}
$countStmt->execute();
$countStmt->bind_result($filteredCount);
$countStmt->fetch();
$countStmt->close();


$dataSql = "SELECT id, guest_name, email, phone, room_type,Number_of_rooms,guests, check_in, check_out, status, special_requests, created_at,price FROM bookings $where ORDER BY created_at DESC";
if (!$export_csv) {
    $dataSql .= " LIMIT ? OFFSET ?";
}


$stmt = $conn->prepare($dataSql);
if ($types) {
   
    $bindParams = $params;
    if (!$export_csv) {
        $bindParams[] = $per_page;
        $bindParams[] = $offset;
        $stmt->bind_param($types."ii", ...$bindParams);
    } else {
        $stmt->bind_param($types, ...$bindParams);
    }
} else {
    if (!$export_csv) {
        $stmt->bind_param("ii", $per_page, $offset);
    }
}
$stmt->execute();
$result = $stmt->get_result();


if ($export_csv) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=bookings_export.csv');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID','Guest Name','Email','Phone','Room Type','Number_of_rooms','Guests','Check-in','Check-out','Status','Created At','Special Requests','price']);
    while ($row = $result->fetch_assoc()) {
        fputcsv($out, [
            $row['id'],$row['guest_name'],$row['email'],$row['phone'],$row['room_type'],$row['Number_of_rooms'],$row['guests'],
            $row['check_in'],$row['check_out'],$row['status'],$row['created_at'],$row['special_requests'],$row['price']
        ]);
    }
    fclose($out);
    exit;
}


$totalPages = max(1, ceil($filteredCount / $per_page));
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Manage Bookings — Dashboard</title>
  <style>
    :root{
      --bg:#0f172a; 
      --card:#0f1724; 
      --muted:#9aa3bd; 
      --accent:#7c3aed; 
      --accent2:#06b6d4;
      --ok:#22c55e; 
      --warn:#f59e0b; 
      --bad:#ef4444;
    }
    *{
      box-sizing:border-box;
      font-family:Inter,system-ui,Arial;
    }
    body
    {
      margin:0;
     /* background:linear-gradient(180deg,#071028 0%, #0b1220 100%); */
     color:#e6eef8;
     padding:20px;
     background:
      radial-gradient(1200px 800px at 10% -10%, #0b1220  0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
      
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



    .wrap{
      max-width:1200px;
      margin:0 auto;
    }
    header{
      display:flex;
      align-items:center;
      gap:12px;
      justify-content:space-between;
      margin-bottom:18px;
    }
    .brand{
      display:flex;
      align-items:center;
      gap:10px;
    }
    .logo{
      background:linear-gradient(135deg,var(--accent),var(--accent2));
      padding:10px;
      border-radius:8px;
      font-weight:800;
    }
    .title{
      font-size:18px;
      font-weight:700;
    }
    .searchbar{
      display:flex;
      gap:8px;
      align-items:center;
    }
    input[type="text"], 
    select, input[type="date"]{
      background:transparent;
      border:1px solid rgba(255,255,255,0.06);
      padding:8px 10px;
      border-radius:8px;
      color:var(--muted);
    }
    button{
      background:linear-gradient(90deg,var(--accent),var(--accent2));
      border:0;
      color:#041022;
      padding:8px 12px;
      border-radius:8px;
      cursor:pointer;
      font-weight:700;
    }
    .cards{
      display:grid;
      grid-template-columns:repeat(4,1fr);
      gap:12px;
      margin-bottom:14px;
    }
    .card{
      background:linear-gradient(180deg, rgba(255,255,255,0.02), transparent);
      padding:14px;
      border-radius:12px;
      border:1px solid rgba(255,255,255,0.03);
    }
    .card h3{
      margin:0;
      font-size:13px;
      color:var(--muted);
    }
    .card .big{
      font-weight:800;
      font-size:20px;
      margin-top:6px;
    }
    /* filters & table */
    .filters{
      display:flex;
      flex-wrap:wrap;
      gap:8px;
      align-items:center;
      margin-bottom:12px;
    }
    .table-wrap{
      overflow:auto;
      background:transparent;
      border-radius:10px;
      padding:8px;
    }
    table{
      width:100%;
      border-collapse:collapse;
      color:var(--muted);
      min-width:900px;
    }
    th,td{
      padding:10px;
      border-bottom:1px solid rgba(255,255,255,0.03);
      text-align:left;
    }
    th{
      font-size:13px;
      color:#aab7c9;
      font-weight:600;
    }
    tr:hover td{
      background:linear-gradient(90deg, rgba(255,255,255,0.01), transparent);
    }
    .badge{
      padding:6px 8px;
      border-radius:8px;
      font-weight:700;
      font-size:12px;
    }
    .badge.confirm{
      background:rgba(34,197,94,0.12);
      color:var(--ok);border:1px solid rgba(34,197,94,0.08);
    }
    .badge.pending{
      background:rgba(245,158,11,0.08);
      color:var(--warn);
      border:1px solid rgba(245,158,11,0.06);
    }
    .badge.cancel{
      background:rgba(239,68,68,0.06);
      color:var(--bad);
      border:1px solid rgba(239,68,68,0.06);
    }
    .actions button{
      margin-right:6px;
      padding:6px 8px;
      border-radius:8px;
      border:0;
      cursor:pointer;
    }
    .btn-view{
      background:rgba(255,255,255,0.03);
      color:var(--muted);
    }
    .btn-edit{
      background:rgba(124,58,237,0.12);
      color:var(--accent);
    }
    .btn-delete{
      background:rgba(239,68,68,0.12);
      color:var(--bad);
    }
    /* modal */
    .modal-back{
      position:fixed;
      inset:0;
      background:
      radial-gradient(1200px 800px at 10% -10%, #0b1220  0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
      display:none;
      align-items:center;
      justify-content:center;
      z-index:50;
    }
    .modal{
      /* background:var(--card); */
      padding:18px;
      border-radius:12px;
      max-width:720px;
      width:100%;
      border:1px solid rgba(255,255,255,0.03);
       
    }
    .modal h4{
      margin:0 0 10px;
    }
      .modal-back div{
      background:linear-gradient(180deg, rgba(255,255,255,0.02), transparent);
      padding:14px;
      border-radius:12px;
      border:1px solid rgba(255,255,255,0.03);
   }
    
    /* pagination */
    .pagination{
      display:flex;
      gap:8px;
      align-items:center;
      justify-content:flex-end;
      margin-top:12px;
    }
    .page-btn{
      padding:6px 10px;
      border-radius:8px;
      background:transparent;
      border:1px solid rgba(255,255,255,0.03);
      color:var(--muted);
      cursor:pointer;
    }
    /* responsive */
    @media (max-width:960px){
        .cards{
          grid-template-columns:repeat(2,1fr);
        }
        table{
          min-width:700px;
        }
    }
    @media (max-width:720px){
        .cards{
          grid-template-columns:1fr;
        }
        table{
          min-width:600px;
        }
    }
  </style>
</head>
<body>
<div class="wrap">
  <header>
    <div class="brand">
      <div class="logo">HMS</div>
      <div>
        <div class="title">Manage Bookings</div>
        <div style="font-size:13px;color:var(--muted)">Admin Dashboard</div>
      </div>
    </div>

    <div class="searchbar">
      <form method="get" style="display:flex;gap:8px;align-items:center">
        <input type="text" name="search" placeholder="Search by name/email/id/phone" value="<?=htmlspecialchars($search)?>">
        <select name="room_type">
          <option value="">All Rooms</option>
          <option <?=($room_type=='Single')?'selected':''?>>Single</option>
          <option <?=($room_type=='Double')?'selected':''?>>Double</option>
          <option <?=($room_type=='Suite')?'selected':''?>>Suite</option>
          <option <?=($room_type=='Family')?'selected':''?>>Family</option>
        </select>
        <select name="status">
          <option value="">All Status</option>
          <option value="confirmed" <?=($status=='confirmed')?'selected':''?>>Confirmed</option>
          <option value="pending" <?=($status=='pending')?'selected':''?>>Pending</option>
          <option value="cancelled" <?=($status=='cancelled')?'selected':''?>>Cancelled</option>
        </select>
        <input type="date" name="date_from" value="<?=htmlspecialchars($date_from)?>">
        <input type="date" name="date_to" value="<?=htmlspecialchars($date_to)?>">
        <button type="submit">Apply</button>
        <a href="?export=csv&<?=htmlspecialchars(http_build_query($_GET))?>" style="text-decoration:none"><button type="button" style="background:transparent;border:1px solid rgba(255,255,255,0.04);color:var(--muted)">Export CSV</button></a>
        <a href="http://localhost/hotal_management_testing/Manage_bookings/manage_bookings.php"><button type="button" style="background:linear-gradient(90deg,var(--accent),var(--accent2));border:1px solid rgba(255,255,255,0.04); color:#041022;">Clear</button></a></a>
      </form>
    </div>
  </header>

  <!-- stat cards -->
  <div class="cards">
    <div class="card">
      <h3>Total Bookings</h3>
      <div class="big"><?= $totalBookings ?></div>
    </div>
    <div class="card">
      <h3>Confirmed</h3>
      <div class="big"><?= $statusCounts['confirmed'] ?></div>
    </div>
    <div class="card">
      <h3>Pending</h3>
      <div class="big"><?= $statusCounts['pending'] ?></div>
    </div>
    <div class="card">
      <h3>Cancelled</h3>
      <div class="big"><?= $statusCounts['cancelled'] ?></div>
    </div>
  </div>

  <!-- table -->
  <div class="card">
    <div class="filters" style="justify-content:space-between">
      <div style="color:var(--muted)">Showing <?= $filteredCount ?> results</div>
      <div style="display:flex;gap:10px;align-items:center">
        <label style="font-size:13px;color:var(--muted)">Per page</label>
        <form method="get" id="perpageForm" style="display:inline">
          <?php
            // preserve other query params
            foreach ($_GET as $k=>$v) if ($k!=='per_page') echo '<input type="hidden" name="'.htmlspecialchars($k).'" value="'.htmlspecialchars($v).'">';
          ?>
          <select name="per_page" onchange="document.getElementById('perpageForm').submit()">
            <option value="8" <?=($per_page==8)?'selected':''?>>8</option>
            <option value="12" <?=($per_page==12)?'selected':''?>>12</option>
            <option value="24" <?=($per_page==24)?'selected':''?>>24</option>
          </select>
        </form>
      </div>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Guest</th>
            <th>Room</th>
            <th>Number of rooms</th>
            <th>Guests</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
            <th>Created</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td>
                <div style="font-weight:700;color:#eaf0ff"><?= htmlspecialchars($row['guest_name']) ?></div>
                <div style="font-size:13px;color:var(--muted)"><?= htmlspecialchars($row['email']) ?><br/><?= htmlspecialchars($row['phone']) ?></div>
              </td>
              <td><?= htmlspecialchars($row['room_type']) ?></td>
              <td><?= htmlspecialchars($row['Number_of_rooms']) ?></td>
              <td><?= htmlspecialchars($row['guests']) ?></td>
              <td><?= htmlspecialchars($row['check_in']) ?></td>
              <td><?= htmlspecialchars($row['check_out']) ?></td>
              <td>
                <?php if ($row['status']=='confirmed'): ?>
                  <span class="badge confirm">Confirmed</span>
                <?php elseif ($row['status']=='pending'): ?>
                  <span class="badge pending">Pending</span>
                <?php else: ?>
                  <span class="badge cancel">Cancelled</span>
                <?php endif; ?>
              </td>
              <td style="font-size:13px;color:var(--muted)"><?= htmlspecialchars($row['created_at']) ?></td>
               <td><?= htmlspecialchars($row['price']) ?></td>
              <td class="actions">
                <button class="btn-view" onclick='viewBooking(<?=json_encode($row, JSON_HEX_APOS|JSON_HEX_QUOT)?>)'>View</button>
                <a href="editbooking.php?id=<?= $row['id'] ?>"><button class="btn-edit">Edit</button></a>
                <form method="post" style="display:inline" onsubmit="return confirm('Delete booking #<?= $row['id'] ?> ?')">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                  <button type="submit" class="btn-delete">Delete</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <!-- pagination -->
    <div class="pagination" style="margin-top:12px">
      <div class="small" style="margin-right:auto;color:var(--muted)">Page <?= $page ?> of <?= $totalPages ?></div>
      <?php if ($page>1): ?>
        <a href="?<?= http_build_query(array_merge($_GET,['page'=>$page-1])) ?>"><button class="page-btn">Prev</button></a>
      <?php endif; ?>
      <?php if ($page<$totalPages): ?>
        <a href="?<?= http_build_query(array_merge($_GET,['page'=>$page+1])) ?>"><button class="page-btn">Next</button></a>
      <?php endif; ?>
    </div>
  </div>

  <?php $stmt->close(); $conn->close(); ?>

  <!-- modal -->
  <div id="modalBack" class="modal-back">
    <div class="modal" id="modal">
      <button style="float:right;background:transparent;border:0;color:var(--muted);font-size:18px" onclick="closeModal()">✕</button>
      <h4>Booking Details</h4>
      <div id="modalContent" style="margin-top:8px;color:var(--muted)"></div>
    </div>
  </div>

  <?php if ($flash): ?>
    <script> alert(<?= json_encode($flash['msg']) ?>); </script>
  <?php endif; ?>

</div>

<script>
  // View booking in modal
  function viewBooking(data){
    const content = document.getElementById('modalContent');
    document.querySelector('body').style.overflow = 'hidden';
    document.getElementById('modalBack').style.display = 'flex';
    content.innerHTML = `
      <div><strong>ID${data.id} — <br><strong>Guest Name:</strong> ${escapeHtml(data.guest_name)}</strong></div>
      <div style="margin-top:8px"><strong>Room:</strong> ${escapeHtml(data.room_type)} — <br><strong>Guests:</strong> ${data.guests}</div>
      <div style="margin-top:6px"><strong>Email:</strong> ${escapeHtml(data.email)} &nbsp; <br><strong>Phone:</strong> ${escapeHtml(data.phone)}</div>
      <div style="margin-top:6px"><strong>Check-in:</strong> ${data.check_in} &nbsp; <br><strong>Check-out:</strong> ${data.check_out}</div>
      <div style="margin-top:8px"><strong>Status:</strong> ${escapeHtml(data.status)}</div>
      <div style="margin-top:8px"><strong>Special Requests:</strong><br/>${escapeHtml(data.special_requests || '—')}</div>
      <div style="margin-top:8px;color:var(--muted)"><small>Created: ${data.created_at}</small></div>
      <div style="margin-top:12px"><a href="editbooking.php?id=${data.id}"><button style="padding:8px 10px;border-radius:8px;background:linear-gradient(90deg,#7c3aed,#06b6d4);border:0;color:#041227">Edit</button></a></div>
    `;
  }
  function closeModal(){ document.getElementById('modalBack').style.display = 'none';
  document.querySelector('body').style.overflow = 'auto';

   }
  
  function escapeHtml(s){ 
  if(!s) return ''; 
  return String(s).replace(/[&<>"']/g, function(m){
    return { 
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;'
    }[m];
  }); 
}


  // Theme toggle & save in localStorage
  (function(){
    const key = 'hms_theme';
    const t = localStorage.getItem(key) || 'dark';
    if (t === 'light') document.body.style.background = '#f5f7fa';
    // For simplicity we only used dark theme css. You can expand to full light mode.
  })();
</script>
</body>
</html>




<?php

//    include '../includes/db_connect.php'; 

// $id=$_GET['id'];

// $query = "delete from student where  std_id=$id";

// $run=mysqli_query($con,$query);
// if($run){
//     echo "<script>alert('Data has been deleted')
//     window.location.href='viewdata.php';
//     </script>";
// }
?>















































































