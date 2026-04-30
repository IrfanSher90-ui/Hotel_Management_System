<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hotel Restaurant & Dining</title>
  <link href="https://fonts.googleapis.com/css2?family=Nosifer&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg:#0f172a;
      --card:#1e293b;
      --text:#f8fafc;
      --muted:#94a3b8;
      --accent:#fbbf24;
      --radius:14px;
      --shadow:0 8px 28px rgba(0,0,0,0.5);
       --brand2: #06b6d4; 
    }
    [data-theme='light']{
      --bg:#f8fafc;
      --card:#ffffff;
      --text:#1e293b;
      --muted:#475569;
      --accent:#ea580c;
      --shadow:0 8px 24px rgba(0,0,0,0.12);
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
    body{
      margin:0;
      font-family:Inter,ui-sans-serif;
      /* background:var(--bg); */
       background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
      color:var(--text);
      line-height:1.4;
    }
    .container{
      max-width:1200px;
      margin:auto;
      padding:24px;
    }

    header{
      height: 70px;
      background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
      border-radius:18px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      overflow:hidden;
      border:1px solid rgba(255,255,255,.08);
      box-shadow: var(--shadow);
    }
    /* .drip-text{
      font-size:22px;
      font-weight:700;
      color:var(--accent);
    } */


    header .drip-text{
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
  header.drip-text::after{
    content:"";
    position:absolute;
    left:0;
    right:0;
    bottom:-8px;
    height:22px;
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
  header.drip-text::before{
    content:"";
    position:absolute;
    left:0; 
    right:0; 
    bottom:-26px; 
    height:28px;
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

    .btn{
    display:inline-flex; 
    align-items:center; 
    margin-right:10px;
    color:#fff;
    gap:10px; 
    cursor:pointer;
    padding:10px 16px; 
    border-radius:8px;
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
    background-color:transparent;
    }

    /* Hero */
    .hero{
      margin-top:20px;
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:20px;
      align-items:center;
    
    }
    .hero img{
      width:100%;
      height:320px;
      object-fit:cover;
      border-radius:var(--radius);
      box-shadow:var(--shadow);
        border:2px solid #0D495B;
    }
    .hero-text h1{
      font-family: 'arial', cursive;
      font-weight:normal;
      margin:0;
      font-size:30px;
    }
    .hero-text p{
      color:var(--muted);
    }

    /* Menu Grid */
    h2{
      margin-top:40px;
      margin-bottom:12px;
       font-family: 'arial', cursive;
      font-weight:normal;
    }
    .menu-grid{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:18px;
    }
    .chefs-grid{
      display:grid;
      justify-content: center;
      align-items: center;
      grid-template-columns:repeat(4,1fr);
      gap:18px;
    }
    .card{
      background:var(--card);
      padding:16px;
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      transition:transform .2s;
    }
    .card:hover{
      transform:translateY(-6px);
    }
    .card img{
      width:100%;
      height:160px;
      object-fit:cover;
      border-radius:10px;
      margin-bottom:10px;
    }
    .card h3{
      margin:0
    }
    .card p{
      margin:4px 0;
      color:var(--muted);
      font-size:14px;
    }

    /* Specials */
    .specials{
      margin-top:40px;
      display:grid;
      grid-template-columns:repeat(2,1fr);
      gap:20px
    }
    .special{
      background:linear-gradient(135deg,var(--brand2),transparent);
      padding:20px;
      border-radius:var(--radius);
      color:#fff;
      box-shadow:var(--shadow);
    }
    .special h3{
      margin:0 0 8px 0;
    }

    footer{
      margin-top:40px;
      text-align:center;
      color:var(--muted);
      font-size:14px
    }

    @media(max-width:900px){
      .hero{grid-template-columns:1fr}
      .menu-grid{grid-template-columns:repeat(2,1fr)}
      .specials{grid-template-columns:1fr}
    }
    @media(max-width:600px){
      .menu-grid{grid-template-columns:1fr}
    }


     .menus{
      


    }
      .card{
      background:var(--card);
      padding:16px;
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      transition:transform .2s;
    }
    .card:hover{
      transform:translateY(-6px);
    }
    .card img{
      width:100%;
      height:160px;
      object-fit:cover;
      border-radius:10px;
      margin-bottom:10px;
    }
    .card h3{
      margin:0
    }
    .card p{
      margin:4px 0;
      color:var(--muted);
      font-size:14px;
    }

  </style>
</head>
<body data-theme="dark">
  <div class="container">
    <header>
      <div class="drip-text">&nbsp; Hotel Dining</div>
      <button class="btn" id="themeToggle">
      <span>Theme</span>
      </button>
    </header>

    <section class="hero">
      <div class="hero-text">
        <h1>Restaurant&nbsp;&&nbsp;Dining</h1>
        <p>Discover exquisite flavors, crafted by world-class chefs. From international cuisine to local delicacies, enjoy dining experiences tailored for every guest.</p>
        <button class="btn" style="margin-top:12px;background: linear-gradient(135deg, #1e293b88, #0ea5b767);">Reserve a Table</button>
      </div>
      <img src="../uploads/dining.png" alt="Restaurant Dining Hall">
    </section>

    <h2>Our Menu Highlights</h2>
    <div class="menu-grid">
      <div class="card">
        <img src="../uploads/breakfast.jpg" alt="Breakfast Buffet">
        <h3>Breakfast Buffet</h3>
        <p>Freshly baked breads, fruits & juices</p>
      </div>
      <div class="card">
        <img src="https://images.unsplash.com/photo-1600891963938-94d1d0c4d97d?q=80&w=1600&auto=format&fit=crop" alt="Seafood Dinner">
        <h3>Seafood Dinner</h3>
        <p>Signature lobster & shrimp platters</p>
      </div>
      <div class="card">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1600&auto=format&fit=crop" alt="Desserts">
        <h3>Artisan Desserts</h3>
        <p>Chocolate lava, cheesecakes & tarts</p>
      </div>
      <div class="card">
        <img src="https://images.unsplash.com/photo-1504674900247-733b720d1f30?q=80&w=1600&auto=format&fit=crop" alt="Local Cuisine">
        <h3>Local Cuisine</h3>
        <p>Authentic regional specialties</p>
      </div>
      <div class="card">
        <img src="https://images.unsplash.com/photo-1506368083636-6defb67639c5?q=80&w=1600&auto=format&fit=crop" alt="Beverages">
        <h3>Beverages</h3>
        <p>Fresh juices, cocktails & wines</p>
      </div>
      <div class="card">
        <img src="" alt="Room Service">
        <h3>24/7 Room Service</h3>
        <p>Meals delivered to your room anytime</p>
      </div>
    </div>

    <h2>Chef's Specials</h2>
    <div class="specials">
      <div class="special">
        <h3>Chef’s Tasting Menu</h3>
        <p>Multi-course journey crafted from seasonal ingredients.</p>
      </div>
      <div class="special">
        <h3>Wine Pairing Night</h3>
        <p>Exclusive selection of wines paired with gourmet dishes.</p>
      </div>
    </div>

    <h2>Our Chef's</h2>
    <div class="chefs-grid">
      <div class="menus">
        <div class="card">
          <img src="../uploads/about.png" alt="Breakfast Buffet">
          <h3>Asif</h3>
          <p>Freshly baked breads, fruits & juices</p>
        </div>
      </div>
      <div class="menus">
        <div class="card">
          <img src="../uploads/about.png" alt="Breakfast Buffet">
          <h3>Asif</h3>
          <p>Freshly baked breads, fruits & juices</p>
        </div>
      </div>
      <div class="menus">
        <div class="card">
          <img src="../uploads/about.png" alt="Breakfast Buffet">
          <h3>Asif</h3>
          <p>Freshly baked breads, fruits & juices</p>
        </div>
      </div>
      <div class="menus">
        <div class="card">
          <img src="../uploads/about.png" alt="Breakfast Buffet">
          <h3>Aqib Sheikh</h3>
          <p>Freshly baked breads, fruits & juices</p>
        </div>
      </div>
      <div class="menus">
        <div class="card">
          <img src="https://images.unsplash.com/photo-1600891963938-c9b6c6a7e0b5?q=80&w=1600&auto=format&fit=crop" alt="Breakfast Buffet">
          <h3>Ahmad khan</h3>
          <p>Freshly baked breads, fruits & juices</p>
        </div>
      </div>
      <div class="menus">
        <div class="card">
          <img src="https://images.unsplash.com/photo-1600891963938-c9b6c6a7e0b5?q=80&w=1600&auto=format&fit=crop" alt="Breakfast Buffet">
          <h3>Rawal Nohani</h3>
          <p>Freshly baked breads, fruits & juices</p>
        </div>
      </div>
    </div>

    <footer>
      © 2025 Hotel Dining Experience. All Rights Reserved.
    </footer>
  </div>

  <script>
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    function setTheme(t){body.setAttribute('data-theme',t);themeToggle.textContent=t==='dark'?'Theme':'Theme';localStorage.setItem('dining-theme',t)}
    setTheme(localStorage.getItem('dining-theme')||'dark');
    themeToggle.addEventListener('click',()=>{
      const next=body.getAttribute('data-theme')==='dark'?'light':'dark';setTheme(next)
    })
  </script>
</body>
</html>
