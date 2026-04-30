<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Settings</title>
  <link href="https://fonts.googleapis.com/css2?family=Nosifer&display=swap" rel="stylesheet">
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
    --texts: #0f172a;
    --muted: #64748b;
    --shadow: 0 10px 30px rgba(2,8,23,.08);
    --ring: 0 0 0 2px #7c3aed33;
  }

  *{box-sizing:border-box}
  html,body{height:100%}
  body{
    margin:0;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
    color: var(--text);
    overflow-x:hidden;
    transition: background .3s ease,color .3s ease;
  }

.settings-container {
  display: flex;
  min-height: 100vh;
  color:var(--texts);
}

.settings-sidebar {
  width: 250px;
  height: calc(100dvh - 44px);
  padding: 20px;
  background: var(--surface);
  border:1px solid rgba(255,255,255,.08);
  border-left:2px dotted #0b7285;
  border-bottom:2px dotted #0b7285;
  border-top-right-radius:10px;
  border-bottom-right-radius:10px;
  box-shadow: var(--shadow);
  overflow:hidden;
  transform-origin: left center;
  animation: dropIn .45s ease both;
  color:var(--texts);
  }
  @keyframes dropIn{
    from{opacity:0; transform: translateY(-4px) scale(.98)}
    to{opacity:1; transform: translateY(0) scale(1)}
  }

.settings-sidebar h2 {
  text-align: center;
  margin-bottom: 20px;
  background: linear-gradient(135deg, #312e81cc, #0ea5b7cc);
  box-shadow: var(--shadow);
  padding:8px 10px; border-radius:12px;
}

.settings-sidebar ul {
  list-style: none;
  padding: 0;
}

.tab-btn {
  padding: 12px;
  margin: 5px 0;
  cursor: pointer; 
  background: transparent;
  border-bottom:1px dotted #0ea5b7cc;
  border-radius: 5px;
  transition: 0.3s;
}

.tab-btn:hover,
.tab-btn.active {
  background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
  border-color: #7c3aed44;
  box-shadow: var(--ring);
  color: white;
}

.settings-content {
  flex: 1;
  padding: 30px;
  background: transparent;
  
}

.tab-content {
  display: none;
  animation: fadeIn 0.3s ease;
}

.tab-content.active {
  display: block;
  
}

    
  
.tab-content h3{
   background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
   height:100px;
   padding-top:30px;
   border-radius:18px;
    padding:18px;
    overflow:hidden;
    border:1px solid rgba(255,255,255,.08);
    box-shadow: var(--shadow);
}
.tab-content h3.drip-text{
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

 
  .tab-content h3.drip-text::after{
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

 
  .tab-content h3.drip-text::before{
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


label {
  display: block;
  margin: 15px 0 5px;
  font-weight: 600;
}

input, select, textarea {
  width: 100%;
  padding: 10px;
  border: 2px dotted transparent;
  border-image: linear-gradient(135deg, #312e81cc, #0ea5b7cc) round 1%;
  background:transparent;
  border-radius: 20px;
  color:#fff;
}
select {
      appearance: none;        
      -moz-appearance: none;  
      -webkit-appearance: none; 
      background: #0F172A url("data:image/svg+xml;utf8,<svg fill='%23ffffff' height='20' width='20' xmlns='http://www.w3.org/2000/svg'><polygon points='0,0 20,0 10,10'/></svg>") no-repeat right 10px center;
      background-size: 12px;
      
     }
     select option:hover {
       background: #06b6d4; 
      color: #0F172A;
     }

img{
  width: 110px;
  padding: 10px;
  border: 2px dotted transparent;
  border-image: linear-gradient(135deg, #312e81cc, #0ea5b7cc) round 1%;
  background:transparent;
  border-radius: 15px;
  color:#fff;
}
button {
  margin-top: 20px;
  padding: 10px 20px;
  background: linear-gradient(135deg, #312e81cc, #0ea5b7cc);
  box-shadow: var(--shadow);
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background: linear-gradient(135deg, #0ea5b7cc , #312e81cc);
}
.right-actions{
    margin-left:auto; display:flex; align-items:center; gap:10px;
  }

 
  .toggle{
    display:inline-flex; align-items:center; gap:8px; cursor:pointer;
    padding:8px 12px; border-radius:12px;
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
  }

button.danger {
  background:transparent;
  border:1px solid  #e74c3c;
  margin-right: 10px;
  transition:.5s;
}

button.danger:hover {
   background:transparent;
  border:1px solid  #e74c3c;
  transform:scale(1.1);
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
  .settings-container {
    flex-direction: column;
  }
  .settings-sidebar {
    width: 100%;
  }
}

  </style>
</head>
<body>

<div class="settings-container">
  <div class="settings-sidebar">
    <h2>Settings</h2>
    <ul>
      <li class="tab-btn active"  onclick="showTab('profile')">Profile</li>
      <li class="tab-btn" onclick="showTab('preferences')">Preferences</li>
      <li class="tab-btn" onclick="showTab('security')">Security</li>
      <li class="tab-btn" onclick="showTab('hotel')">Hotel Info</li>
      <li class="tab-btn" onclick="showTab('danger')">Danger Zone</li>
      <li>
        <div class="right-actions">
        <label class="toggle" id="themeToggle" role="button" aria-pressed="false" tabindex="0">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 3v2m0 14v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M3 12h2m14 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          <span>Theme</span>
        </label>
            </div>
      </li>
    </ul>
  </div> 
  <?php
include '../includes/db_connect.php'; 
      $query="select * from users where id='1'";
       $run=mysqli_query($conn,$query); 
      $row=mysqli_num_rows($run); 
      if($row>0){  
            while($data=mysqli_fetch_array($run)){
           ?>
   <div class="settings-content">
     <div class="tab-content active" id="profile">
       <h3 class="" style="font-size:30px;">Profile Settings</h3>
       <form action="" method="post" enctype="multipart/form-data">
       <label>Full Name</label><input type="text" name="name" placeholder="<?=$data[1]?>">
       <label>Email</label><input type="text" name="email" placeholder="<?=$data[2]?>">
       <label>Profile Picture</label>
       <img src="../uploads/<?=$data[4]?>" alt="">
       <input name="photo" type="file">
       <button value="submit" name="submit">Save Profile</button>
       </form>
     </div>
<?php
}
}
 
  if (isset($_POST['submit'])) {
    $name =   $_POST['name'];
    $email =  $_POST['email'];
    
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $photo_name = $_FILES['image']['name'];
    $photo_tmp = $_FILES['image']['tmp_name'];
    
    move_uploaded_file($photo_tmp, "../uploads/" . $photo_name);

        
  
        $query = "UPDATE `users` SET `name`='$name',`email`='$email',`image`='$photo_name' WHERE `id`='1'";
        $run = mysqli_query($conn,$query);
        if($run) {
           echo "<script>alert('Profile updated successfully.!)</script>";
           echo "<br><a href='dashboard.php'>Back to Dashboard</a>";
        }
        else{
          echo "<script>alert('Profile updated.!)</script>";
        }
    } 
  }

  

?>

    <div class="tab-content" id="preferences">
      <h3 class="drip-text">System Preferences</h3>
      <label>Language</label>
      <select><option>English</option><option>Urdu</option><option>Arabic</option></select>
      <label>Theme</label>
      <select><option>Light</option><option>Dark</option></select>
      <label>Date Format</label>
      <select><option>DD/MM/YYYY</option><option>MM/DD/YYYY</option></select>
      <label>Time Format</label>
      <select><option>12-hour</option><option>24-hour</option></select>
      <button>Save Preferences</button>
      
    </div>

    <div class="tab-content" id="security">
      <h3 class="drip-text">Security Settings</h3>
      <label>Old Password</label><input type="password">
      <label>New Password</label><input type="password">
      <label>Confirm New Password</label><input type="password">
      <button>Change Password</button>

    </div>

    <div class="tab-content" id="hotel">
      <h3 class="drip-text">Hotel Information</h3>
      <label>Hotel Name</label><input type="text" placeholder="Royal Palace Hotel">
      <label>Logo</label><input type="file">
      <label>Contact</label><input type="text" placeholder="+92 300 0000000">
      <label>Address</label><textarea placeholder="Street, City, Country"></textarea>
      <button>Update Hotel Info</button>
    </div>

    <div class="tab-content" id="danger">
      <h3 class="drip-text">Danger Zone</h3>
      <button class="danger">Reset All Settings</button>
      <button class="danger">Delete My Account</button>
      <a href="dashboard.php"><button>Back To Dashboard</button></a>
    </div>
  </div>
</div>

<script>
  function showTab(tabId) {
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));

    event.target.classList.add('active');
    document.getElementById(tabId).classList.add('active');
  }




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

</script>

</body>
</html>