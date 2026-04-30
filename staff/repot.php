<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Reports </title>
  <link href="https://fonts.googleapis.com/css2?family=Nosifer&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #4e73df;
      --secondary: #1cc88a;
      --bg-light: #f8f9fc;
      /* --bg-light: #1a1c23; */
      /* --text-light: #ffffff; */
      --text-light: #2e2e2e;
      --card-light: #ffffff;
      --card-light: #2a2d35;
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
  .dark{
    --bg: #f8fafc;
    --surface: #ffffffcc;
    --card: #ffffff;
    --text: #0f172a;
    --muted: #64748b;
    --shadow: 0 10px 30px rgba(2,8,23,.08);
    --ring: 0 0 0 2px #7c3aed33;
  }

    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      /* background-color: var(--bg-light); */
      background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      radial-gradient(1200px 600px at -15% 60%, #0b7285 0%, transparent 50%),
      var(--bg);
      color: var(--text);
      transition: background 0.4s, color 0.4s;
      height: 100vh;
    }
    
    body.light {
      background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),      
      radial-gradient(1200px 600px at -15% 60%, #0b7285 0%, transparent 50%),
      var(--bg-light);
      color: var(--text-light);
      transition: background 0.4s, color 0.4s;
      height: 100vh;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 25px;
      background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
      box-shadow: var(--shadow);
      color: #fff;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    header h1 {
      margin: 0;
      font-weight: bold;
      font-family: "Arial", sans-serif;
    }

  /* .drip-text{
    font-family: "Nosifer", sans-serif;
    color: var(--brand2);
    font-size: clamp(20px, 4vw, 60px);
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

  
  header h1.drip-text::after{
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

 
  header h1.drip-text::before{
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
  } */

    /* .theme-toggle {
      cursor: pointer;
      font-size: 20px;
      background: #fff;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      transition: 0.3s;
    }

    .theme-toggle:hover {
      transform: rotate(180deg);
    } */

         .right-actions{
    margin-left:auto; display:flex; align-items:center; gap:10px;
  }

  /* Theme toggle */
  .toggle{
    display:inline-flex; align-items:center; gap:8px; cursor:pointer;
    padding:8px 12px; border-radius:12px;
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
  }

  /* Bell */
  .icon-btn{
    position:relative; border:none; background:rgba(255,255,255,.06);
    padding:9px; border-radius:12px; cursor:pointer; color:inherit;
  }
  .badge{
    position:absolute; top:-4px; right:-4px;
    background: linear-gradient(135deg, #ef4444, #f97316);
    color:#fff; border-radius:999px; padding:2px 6px; font-size:11px;
    box-shadow: var(--shadow);
  }
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      padding: 20px;
    }

    .card {
      background: transparent;
      border:1px solid rgba(255,255,255,.08);
      border-radius:16px; padding:14px; box-shadow: var(--shadow);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: background 0.4s, transform 0.3s;
    }

    body.light .card {
      background: transparent;
      border:1px solid rgba(255,255,255,.08);
      border-radius:16px; padding:14px; box-shadow: var(--shadow);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: background 0.4s, transform 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h3 {
      margin: 0 0 5px;
      font-size: 18px;
    }

    .card p {
      font-size: 22px;
      font-weight: bold;
      margin: 0;
    }

    /* ---------- Filters ---------- */
    .filters {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      flex-wrap: wrap;
      gap: 10px;
    }

    .filters input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      outline: none;
      background: transparent;
      border:1px solid rgba(255,255,255,.08);
      border-radius:16px; padding:14px; box-shadow: var(--shadow);
      color: #fff;
    }
    body.light .filters input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      outline: none;
      background: transparent;
      border:1px solid rgba(255,255,255,.08);
      border-radius:16px; padding:14px; box-shadow: var(--shadow);
      color: #000;
    }
    .filter-buttons {
      display: flex;
      gap: 10px;
    }

    .filter-btn {
      padding: 8px 14px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      background: linear-gradient(135deg, #312e81cc, #0ea5b7cc);
      color: #fff;
      transition: 0.3s;
    }

    .filter-btn.active,
    .filter-btn:hover {
      background: linear-gradient(135deg, #312e81cc, #0ea5b7cc);
    }

    .report-table {
      margin: 20px;
      overflow-x: auto;
    }

    .panel{
    background: transparent;
    border:1px solid rgba(255,255,255,.08);
    border-radius:16px; padding:14px; box-shadow: var(--shadow);
    border:3px dotted rgba(255,255,255,.08);
  }
  body.light .panel{
    background: transparent;
    border-radius:16px; padding:14px; box-shadow: var(--shadow);
  }
  .panel h3{margin:0 0 10px 0; font-size:16px}
  .table{
    width:100%; border-collapse: collapse; font-size:14px;
  }
  .table th,.table td{
    border-bottom:1px dashed rgba(255,255,255,.08);
    padding:10px; text-align:left;
  }

    
    tbody tr:hover {
      background: rgba(78, 115, 223, 0.1);
      transition: 0.3s;
    }

    @media (max-width: 768px) {
      body{
        height: auto;
      }
      body.light{
        height: auto;
      }
      .filters {
        flex-direction: column;
        align-items: flex-start;
      }
      .filter-buttons {
        width: 100%;
        justify-content: space-around;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1 class="drip-text">Hotel Reports</h1>
    <!-- <div class="theme-toggle" onclick="toggleTheme()">🌙</div> -->
      <div class="right-actions">
        <label class="toggle" onclick="toggleTheme()" role="button" aria-pressed="false" tabindex="0">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 3v2m0 14v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M3 12h2m14 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          <span class="span">Theme</span>
        </label>

        <button class="icon-btn" aria-label="Notifications">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2c0 .53-.21 1.04-.59 1.41L4 17h5m6 0a3 3 0 1 1-6 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          <span class="badge" aria-hidden="true">3</span>
        </button>
      </div>
  </header>

  <!-- Summary Cards -->
  <section class="cards">
    <div class="card"><h3>Total Bookings</h3><p>120</p></div>
    <div class="card"><h3>Check-ins</h3><p>80</p></div>
    <div class="card"><h3>Check-outs</h3><p>70</p></div>
    <div class="card"><h3>Revenue</h3><p>$15,000</p></div>
    <div class="card"><h3>Feedbacks</h3><p>45</p></div>
  </section>

  <!-- Filters -->
  <section class="filters">
    <div>
      <label>From: <input type="date"></label>
      <label>To: <input type="date"></label>
    </div>
    <div class="filter-buttons">
      <button class="filter-btn active" data-filter="daily">Daily</button>
      <button class="filter-btn" data-filter="weekly">Weekly</button>
      <button class="filter-btn" data-filter="monthly">Monthly</button>
    </div>
  </section>

  <!-- Report Table -->
  <div class="panel" id="reportContent">
          <h3>Recent Bookings</h3>
          <table class="table" role="table">
      <tr><th>Room</th><th>Guests</th><th>Revenue</th></tr>
      <tr><td>101</td><td>2</td><td>$120</td></tr>
      <tr><td>102</td><td>1</td><td>$60</td></tr>
    </table>
  </div>

  <script>
    function toggleTheme() {
      document.body.classList.toggle("light");
      const toggle = document.querySelector(".span");
      if (document.body.classList.contains("light")) {
        toggle.textContent = "Theme";
      } else {
        toggle.textContent = "Theme";
      }
    }

    const filterBtns = document.querySelectorAll(".filter-btn");
    const reportContent = document.getElementById("reportContent");

    const reports = {
      daily: `
        <h3>Daily Report</h3>
        <table class="table" role="table">
          <tr><th>Room</th><th>Guests</th><th>Revenue</th></tr>
          <tr><td>101</td><td>2</td><td>$120</td></tr>
          <tr><td>102</td><td>1</td><td>$60</td></tr>
        </table>
      `,
      weekly: `
        <h3>Weekly Report</h3>
        <table class="table" role="table">
          <tr><th>Week</th><th>Bookings</th><th>Total Revenue</th></tr>
          <tr><td>1st - 7th</td><td>40</td><td>$2,800</td></tr>
          <tr><td>8th - 14th</td><td>38</td><td>$2,600</td></tr>
        </table>
      `,
      monthly: `
        <h3>Monthly Report</h3>
        <table class="table" role="table">
          <tr><th>Month</th><th>Bookings</th><th>Total Revenue</th></tr>
          <tr><td>January</td><td>150</td><td>$11,000</td></tr>
          <tr><td>February</td><td>140</td><td>$10,200</td></tr>
        </table>
      `
    };

    filterBtns.forEach(btn => {
      btn.addEventListener("click", () => {
        filterBtns.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        let filter = btn.getAttribute("data-filter");
        reportContent.innerHTML = reports[filter];
      });
    });
  </script>
</body>
</html>