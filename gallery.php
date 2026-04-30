<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Over Gallery</title>
  <link href="https://fonts.googleapis.com/css2?family=Nosifer&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-light: #f5f7fa;
      --bg-dark: #1c1c1c;
      --text-light: #1c1c1c;
      --text-dark: #f5f7fa;
      --primary: #4e9eff;
      --secondary: #ff7e67;
      --card-bg-light: #ffffff;
      --card-bg-dark: #2c2c2c;
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
      font-family: "Segoe UI", sans-serif;
      background: var(--bg-light);
      color: var(--text-light);
      transition: all 0.3s;
       background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg-light);
    }

    body.dark {
      /* background: var(--bg); */
      /* color: var(--text-dark); */
          background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
    color: var(--text);
    overflow-x:hidden;
    transition: background .3s ease,color .3s ease;
    }

    header {
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
      border-bottom-left-radius:18px;
      border-bottom-right-radius:18px;
      padding:18px;
      overflow:hidden;
      border:1px solid rgba(255,255,255,.08);
      box-shadow: var(--shadow);
      color: white;
    }
    header h2{margin:0 0 6px 0; font-size:20px}

   header h2.drip-text{
    font-family: "Nosifer", sans-serif;
    color: var(--brand2);
    font-size: clamp(10px, 2vw, 30px);
    line-height: 1.05;
    letter-spacing: 2px;
    margin: 0;
    position: relative;
    /* heavy shadow for thick “paint” look + glow */
    text-shadow:
      0 1px 0 #0008,
      0 2px 0 #0007,
      0 3px 0 #0006,
      0 6px 12px rgba(0,0,0,.55),
      0 0 18px color-mix(in oklab, var(--ink) 70%, white 30%);
    /* little beveled edge */
    -webkit-text-stroke: 1px rgba(0,0,0,.35);
    filter: drop-shadow(0 10px 22px rgba(0,0,0,.45));
  }

  /* Small “drops” under the text — purely CSS */
  header h2.drip-text::after{
    content:"";
    position:absolute; left:0; right:0; bottom:-8px; height:22px;
    /* multiple radial circles = droplets */
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

  /* Occasional longer drips */
  header h2.drip-text::before{
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

      .right-actions{
    margin-left:auto; display:flex; align-items:center; gap:10px;
  }

  
  .toggle{
    display:inline-flex; align-items:center; gap:8px; cursor:pointer;
    padding:8px 12px; border-radius:12px;
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
  }


    .filters {
      padding: 1rem 2rem;
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;

    }

    .filters select, .filters input {
      padding: 0.7rem;
      background:transparent;
      border-radius: 8px;
      border: 1px solid #ccc;
      min-width: 150px;
    }
    .filters button{
       padding: 0.7rem;
      background:transparent;
      border-radius: 8px;
      border: 1px solid #ccc;
      min-width: 150px;
    }
      body.dark.filters select, .filters input{
        color:var(--text);
      }
    .room-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
      padding: 2rem;
    }

    .room-card {
      background: transparent;
      border-radius: 15px;
       border:1px solid rgba(255,255,255,.08);
       box-shadow: var(--shadow);
      overflow: hidden;
      transition: 0.3s;
    }

    body.dark .room-card {
      background: transparent;
      box-shadow: 0 4px 12px rgba(255,255,255,0.1);
    }

    .room-card:hover {
      transform: translateY(-5px);
    }

    .room-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .room-info {
      padding: 1rem;
    }

    .room-info h3 {
      margin: 0;
      font-size: 1.2rem;
    }

    .price {
      color: var(--ok);
      font-weight: bold;
      margin: 0.5rem 0;
    }

    .btn-book {
      display: inline-block;
      padding: 0.7rem 1.2rem;
      border-radius: 8px;
      border:2px solid var(--primary) ;
      background: transparent;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-book:hover {
      background: var(--primary);
    }



  </style>
</head>
<body>
  <header>
    <h2 class="drip-text">Over Gallery</h2>

          <div class="right-actions" onclick="toggleMode()">
        <label class="toggle" id="themeToggle" role="button" aria-pressed="false" tabindex="0">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 3v2m0 14v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M3 12h2m14 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          <span>Theme</span>
        </label>
  </div>
   
  </header>
  <section class="room-container">
    <div class="room-card">
      <img src="./uploads/room1.png" alt="Room">
      <div class="room-info">
        <h3>Deluxe Room</h3>
        <p class="price">$120 / night</p>
        <p>Enjoy comfort with modern amenities, free Wi-Fi, and breakfast.</p>
      </div>
    </div>

    <div class="room-card">
      <img src="./uploads/room2.png" alt="Room">
      <div class="room-info">
        <h3>Executive Suite</h3>
        <p class="price">$200 / night</p>
        <p>Spacious suite with balcony, luxury bath, and room service.</p>
      </div>
    </div>

    <div class="room-card">
      <img src="./uploads/room3.png" alt="Room">
      <div class="room-info">
        <h3>Suite Room</h3>
        <p class="price">$150 / night</p>
        <p>Perfect for Friends, extra beds included, and Free Wifi</p>
      </div>
    </div>

      <div class="room-card">
      <img src="./uploads/room4.png" alt="Room">
      <div class="room-info">
        <h3>VIP Room</h3>
        <p class="price">$150 / night</p>
        <p>Perfect for VIP Feel And Luxury Service, and City View</p>
      </div>
    </div>

      <div class="room-card">
      <img src="./uploads/penthousesuite.png" alt="Room">
      <div class="room-info">
        <h3>Pent House</h3>
        <p class="price">$150 / night</p>
        <p>Perfect for Business, and pool access.</p>
      </div>
    </div>

      <div class="room-card">
      <img src="./uploads/double-bad.png" alt="Room">
      <div class="room-info">
        <h3>Double Bad</h3>
        <p class="price">$100 / night</p>
        <p>Perfect for Adults, extra beds included.</p>
      </div>
    </div>

      <div class="room-card">
      <img src="./uploads/familyroom.png" alt="Room">
      <div class="room-info">
        <h3>Family Room</h3>
        <p class="price">$150 / night</p>
        <p>Perfect for families, extra beds included, and pool access.</p>
      </div>
    </div>

      <div class="room-card">
      <img src="./uploads/room5.png" alt="Room">
      <div class="room-info">
        <h3>For One Person</h3>
        <p class="price">5,000 / Per Day</p>
        <p>Perfect and chip price, AC and pool access.</p>
      </div>
    </div>
  </section>



  <script>
    function toggleMode() {
      document.body.classList.toggle("dark");
      const btn = document.querySelector(".toggle-btn");
      if (document.body.classList.contains("dark")) {
        btn.textContent = "☀️ Light Mode";
      } else {
        btn.textContent = "🌙 Dark Mode";
      }
    }



  </script>
</body>
</html>









