<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Room Status</title>
  <style>
    :root {
      --bg: #0f172a;
      --card: #0b1222;
      --text: #e5e7eb;
      --muted: #9ca3af;
      --success: #22c55e;
      --danger: #ef4444;
      --warning: #f59e0b;
      --shadow: 0 10px 30px rgba(0,0,0,.35);
      --glass: blur(8px) saturate(120%);
      --ring: 0 0 0 2px #7c3aed55;
    }
    .light {
      --bg: #f8fafc;
      --card: #ffffff;
      --text: #111;
      --muted: #555;
      --success: #22c55e;
      --danger: #ef4444;
      --warning: #f59e0b;
      --shadow: 0 10px 30px rgba(2,8,23,.08);
      --ring: 0 0 0 2px #7c3aed33;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
      color: var(--text);
      transition: background 0.4s ease, color 0.4s ease;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
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

    header{
    position:relative;
    background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
    border-bottom-left-radius:18px;
    border-bottom-right-radius:18px;
    padding:18px;
    overflow:hidden;
    border:1px solid rgba(255,255,255,.08);
    box-shadow: var(--shadow);
    }
   .right-actions{
    margin-top:-50px; 
    display:flex; 
    justify-content:right;
    align-items:right;
    }
   
    .toggle{
     display:inline-flex; align-items:center; gap:8px; cursor:pointer;
     padding:8px 12px; border-radius:12px;
     background: rgba(255,255,255,.06);
     border:1px solid rgba(255,255,255,.08);
    }


     .container {
      max-width: 1100px;
      padding: 0 15px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .room-card {
      background: var(--card);
      border-radius: 15px;
      border:1px solid rgba(255,255,255,.08);
      box-shadow: var(--shadow);
      padding: 25px 20px;
      text-align: center;
      animation: fadeInUp 0.6s ease;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .room-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.5);
    }

    .room-card h5 {
      margin: 0;
      font-size: 20px;
      margin-bottom: 10px;
    }

    .status {
      font-size: 16px;
      font-weight: bold;
      padding: 6px 12px;
      border-radius: 8px;
      display: inline-block;
    }

    .success { 
      color: #fff; 
       border:1px solid  var(--success); 
    }
    .success:hover { 
      background: var(--success); 
      color: #fff; 
    }
    .danger { 
      color: #fff;
      border:1px solid  var(--danger); 
    }
     .danger:hover { 
      background: var(--danger); 
      color: #fff; 
    }
    .warning {
      color: #fff; 
      border:1px solid  var(--warning); 
    }
     .warning:hover { 
      background:  var(--warning); 
      color: #fff; 
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }


  </style>
</head>
<body>
 <header>
  <h2>Rooms Status</h2>
  <div class="right-actions" onclick="toggleMode()">
      <label class="toggle" id="themeToggle" role="button" aria-pressed="false" tabindex="0">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 3v2m0 14v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M3 12h2m14 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        <span>Theme</span>
      </label>
  <!-- <button class="toggle-btn" onclick="toggleMode()">Theme</button> -->
</header>
<br>

  <center><div class="container">
    <div class="grid">
      <?php
        $statuses = ['Available', 'Occupied', 'Maintenance'];
        $colors = ['success', 'danger', 'warning'];
        for ($i = 1; $i <= 12; $i++):
          $statusIndex = $i % 3;
          $status = $statuses[$statusIndex];
          $color = $colors[$statusIndex];
      ?>
      <div class="room-card">
        <h5>Room <?= 0 + $i ?></h5>
        <span class="status <?= $color ?>"><?= $status ?></span>
      </div>
      <?php endfor; ?>
    </div>
  </div>
  <center>

 
  <script>
    function toggleMode() {
      document.body.classList.toggle("light");
    }
  </script>
</body>
</html>
