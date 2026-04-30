<?php
session_start();
include 'includes/db_connect.php';

error_reporting(0);
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Paradise Hotel — Luxury Hotel</title>
<meta name="description" content="A modern, luxurious hotel experience with fine dining, spa, and curated city views. Book your stay at Royal Aurora.">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
<style>
 
  :root{
    --bg: #0b1324;
    --panel: #0f1931;
    --card: #132243;
    --text: #e9f0ff;
    --muted:#a9b8d7;
    --primary:#8b5cf6; 
    --accent:#06b6d4;
    --gold:#f4c95d;
    --ring: rgba(139,92,246,.35);
    --glass: rgba(255,255,255,.06);
    --glass-b: rgba(255,255,255,.13);
    --shadow: 0 20px 60px rgba(0,0,0,.35);
    --grad: linear-gradient(135deg,var(--primary),var(--accent));
  }
  body.light{
    --bg:#f6f8ff;
    --panel:#ffffff;
    --card:#ffffff;
    --text:#0c1222;
    --muted:#4b5878;
    --glass: rgba(0,0,0,.05);
    --glass-b: rgba(0,0,0,.08);
    --shadow: 0 20px 60px rgba(6,18,78,.12);
    --ring: rgba(6,182,212,.25);
  }

 
  *{
    box-sizing:border-box;
  }
   ::-webkit-scrollbar {
  width: 5px;
  transition:1.5s;
}
::-webkit-scrollbar-track {
  background:#0f172a;
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
  html,body{
    height:100%;
  }
  body{
    margin:0; 
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Inter, Roboto, Arial;
    background:
    radial-gradient(1200px 400px at 15% -10%, #7c3aed40, transparent 40%),
    radial-gradient(1000px 320px at 85% 0%, #06b6d440, transparent 45%),
    linear-gradient(180deg,var(--bg),var(--bg));
    color:var(--text);
    overflow-x:hidden; 
    transition:background .4s,color .4s;
  }
  a{
    color:inherit;
    text-decoration:none;
  }
  img{
    max-width:100%;
    display:block;
  }

  .container{
    max-width:1200px;
    margin:auto;
    padding:0 24px;
  }


  .nav{
    position:sticky; 
    top:0; 
    z-index:50;
    backdrop-filter: blur(10px);
    background: color-mix(in oklab, var(--panel) 70%, transparent);
    border-bottom:1px solid var(--glass-b);
  }
  .nav-inner{
    display:flex; 
    align-items:center; 
    justify-content:space-between; 
    gap:14px;
    padding:14px 0;
  }
  .brand{
    display:flex;
    align-items:center;
    gap:10px;
  }
  .logo{
    width:60px;
    height:40px;
    border-radius:12px;
    display:grid;
    place-items:center;
    background:var(--grad); 
    color:white; 
    font-weight:900; 
    box-shadow:var(--shadow);
  }
  .logo i {
  font-size: 40px;
  color: gold;
}
  .brand h1{
    font-size:18px;
    letter-spacing:.4px;
    margin:0
  }
  .links{
    display:flex;
    gap:18px;
    align-items:center
  }
  .links a{
    font-size:14px;
    color:var(--muted)
  }
  .links a:hover{
    color:var(--text)
  }
  .nav-cta{
    display:flex;
    gap:10px;
    align-items:center
  }
  .btn,.ghost{
    border:none;
    padding:10px 14px;
    border-radius:12px;
    cursor:pointer;
    font-weight:700;
    letter-spacing:.2px;
  }




.trigger{
  position:relative;
  display:inline-block;
  padding:8px 12px;
  border-radius:8px;
  cursor:pointer;
  user-select:none;
}


.popup{
  position:absolute;
  left:170%;
  transform:translateX(-50%) translateY(8px) scale(.98);
  top: calc(100% + 12px); 
  min-width:200px;
  padding:12px 14px;
  background: var(--gard);
  border-radius:8px;
  border:2px solid var(--glass);
  box-shadow: 0 12px 30px rgba(40,60,100,0.12);
  opacity:0;
  pointer-events:none;
  transition: all .2200s cubic-bezier(.2,.9,.3,1);
  z-index:50;
}


.popup::before{
  content:"";
  position:absolute;
  left:10%;
  transform:translateX(-50%);
  top:-10px; 
  width:0; height:0;
  border-left:10px solid transparent;
  border-right:10px solid transparent;
  border-bottom:10px solid var(--glass-b); 
  z-index:60;
}


.popup .title{ 
  font-weight:700;
   margin-bottom:6px;
  border-bottom:2px dotted var(--glass);
   }
.popup .text{ 
  font-size:14px; 
  color:#fff;
 }


.trigger:hover + .popup,
.trigger:focus + .popup,
.trigger.active + .popup{
  opacity:1;
  transform:translateX(-50%) translateY(0) scale(1);
  pointer-events:auto;
}




  .btn{
    background:var(--grad); 
    color:white; 
    box-shadow:var(--shadow);
   }
  .btn:hover{
    filter:saturate(1.1); 
    transform:translateY(-1px);
  }
  .ghost{
    background:transparent;
    border:1px dashed var(--glass-b); 
    color:var(--muted);
  }

  .theme{
     display:inline-flex; align-items:center; gap:8px; cursor:pointer;
    padding:8px 12px; border-radius:12px;
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
  }
  .hamburger{
    display:none; 
    width:42px;
    height:42px;
    border-radius:12px;
    background:var(--panel);
    border:1px solid var(--glass-b);
    cursor:pointer;
  }
  @media (max-width:960px){
    .links{
      display:none;
    }
    .hamburger{
      display:grid; 
      place-items:center;
    }
  }

 
  .hero{
    position:relative; 
    padding: 60px 0 40px;
  }
  .hero-grid{display:grid; 
    grid-template-columns: 1.1fr .9fr; 
    gap:28px; align-items:center;
  }
  @media (max-width:1000px){
     .hero-grid{
      grid-template-columns:1fr;
    } 
  }

  .headline{
    line-height:1.1; margin:0 0 10px;
    font-family: 'arial', cursive;
    font-size: 24px;
    font-weight: normal;
    color: white;
  }
  .sub{
    color:var(--muted); 
    font-size:clamp(14px,1.4vw,16px); 
    margin:0 0 18px;
  }
  .hero-cta{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
  }
  .tick{
    display:flex; 
    gap:8px; 
    align-items:center; 
    color:var(--muted); 
    font-size:14px; 
    margin-top:10px;
  }
  .badge-row{
    display:flex;
    gap:10px;
    margin-top:16px;
  }
  .pill{
    padding:8px 12px;
    border-radius:999px;
    background:var(--glass);
    border:1px solid var(--glass-b);
    font-size:12px;
  }

  .art{
    position:relative; 
    border-radius:20px; 
    overflow:hidden; 
    background:var(--card);
    border:1px solid var(--glass-b); 
    box-shadow:var(--shadow);
  }
  .blob{
    position:absolute; 
    inset:auto -20% -25% auto; 
    width:380px; 
    height:380px; 
    border-radius:50%;
    background: radial-gradient(circle at 30% 30%, #8b5cf6aa, transparent 60%),
    radial-gradient(circle at 80% 70%, #06b6d4aa, transparent 55%);
    filter: blur(18px); 
    animation: float 6s ease-in-out infinite alternate;
  }
  @keyframes float{
    to{
      transform:translate(-14px,12px) scale(1.03);
    }
  }

  .video-wrap{
    position:relative; 
    aspect-ratio: 16/9; 
    background:#000;
  }
  .video-wrap video{
    width:100%; 
    height:100%; 
    object-fit:cover; 
    display:block;
  }
  .tag{
    position:absolute; 
    top:12px; left:12px; 
    padding:6px 10px; 
    border-radius:10px; 
    background:#00000080; 
    color:#fff; 
    font-size:12px;
  }

 
  .stats{
    display:grid; 
    grid-template-columns:repeat(4,1fr); 
    gap:14px; 
    margin-top:20px;
  }
  .stat{
    background:var(--card); 
    border:1px solid var(--glass-b); 
    border-radius:16px; 
    padding:16px; 
    text-align:center;
  }
  .stat .n{
    font-weight:900; 
    font-size:28px;
  }
  .stat .k{
    color:var(--muted); 
    font-size:12px;
  }
  @media (max-width:800px){ 
    .stats{
      grid-template-columns:repeat(2,1fr);
    } 
  }

 
  section{
    padding:48px 0;
  }
  .sec-head{
    display:flex;
    align-items:end;
    justify-content:space-between;
    margin-bottom:18px;
  }
  .sec-head h2{
    font-size: 24px;
    font-weight: normal;
    color: white;
  }
  .cards{
    display:grid; 
    grid-template-columns: repeat(3,1fr); 
    gap:18px;
  }
  @media (max-width:980px){ 
    .cards{
      grid-template-columns: repeat(2,1fr)
    } 
  }
  @media (max-width:640px){ 
    .cards{
      grid-template-columns: 1fr
    } 
  }
  .card{
    background:var(--card); 
    border:1px solid var(--glass-b); 
    border-radius:16px; 
    overflow:hidden;
    display:flex; 
    flex-direction:column; 
    box-shadow:var(--shadow); 
    transform:translateY(0); 
    transition:transform .2s, box-shadow .2s;
  }
  .card:hover{
    transform:translateY(-4px);
  }
  .card img{
    aspect-ratio: 16/11; 
    object-fit:cover;
  }
  .card .cap{
    padding:14px; 
    display:grid; 
    gap:8px;
  }
  .price{
    display:flex;
    justify-content:space-between; 
    align-items:center;
  }
  .price strong{
    font-size:18px}
  .chip{
    font-size:12px;
    color:#fff; 
    background:var(--grad); 
    padding:4px 8px;
    border-radius:999px;
  }

  
  .amen{
    display:flex; 
    flex-wrap:wrap; 
    gap:10px;
  }
  .amen .pill{
    display:flex; 
    gap:8px; align-items:center;
  }

 
  .split{
    display:grid; 
    grid-template-columns:1fr 1fr; 
    gap:18px;
  }
  @media (max-width:960px){ 
    .split{
      grid-template-columns:1fr;
    } 
  }
  .highlight{
    background:var(--card); 
    border:1px solid var(--glass-b); 
    border-radius:18px; 
    overflow:hidden; 
    display:grid; 
    grid-template-columns: .9fr 1.1fr;
  }
  .highlight.reverse{
    grid-template-columns: 1.1fr .9fr;
  }
  .highlight img{
    height:100%; 
    width:100%; 
    object-fit:cover;
  }
  @media (max-width:960px){ 
    .highlight{
      grid-template-columns:1fr;
    } .highlight.reverse{
      grid-template-columns:1fr;
    } 
  }

  
  .slider{
    position:relative;
  }
  .track{
    display:flex; 
    gap:16px; 
    overflow:hidden; 
    scroll-behavior:smooth;
  }
  .review{
    min-width: 320px; max-width: 360px;
    background:var(--card); 
    border:1px solid var(--glass-b); 
    border-radius:16px;
    padding:16px;
  }
  .stars{
    color:var(--gold);
  }
  .arrows{
    display:flex; 
    gap:8px; 
    justify-content:flex-end; 
    margin-top:12px;
  }
  .arrow{
    width:38px;
    height:38px;
    border-radius:10px;
    border:1px solid var(--glass-b); 
    background:var(--panel); 
    display:grid;
    place-items:center; 
    cursor:pointer;
  }

 
  .faq{
    display:grid; 
    gap:12px;
  }
  .qa{
    background:var(--card); 
    border:1px solid var(--glass-b); 
    border-radius:12px; 
    overflow:hidden;
  }
  .qa summary{
    padding:12px 14px; 
    cursor:pointer; 
    font-weight:700; 
    list-style:none;
  }
  .qa summary::-webkit-details-marker{
    display:none;  
  }
  .qa div{
    padding:0 14px 14px; 
    color:var(--muted);
  }

  
  footer{
    border-top:1px solid var(--glass-b); 
    padding:28px 0 36px; 
    background:linear-gradient(180deg,transparent,var(--glass));
  }
  .foot{
    display:grid; 
    grid-template-columns:1.5fr 1fr 1fr; 
    gap:18px;
  }
  .foot small{
    color:var(--muted);
  }
  .nl{
    display:flex; 
    gap:10px;
  }
  .nl input{
    flex:1;
    padding:12px;
    border-radius:12px;
    border:1px solid var(--glass-b); 
    background:transparent; 
    color:var(--text);
  }
  .nl button{
    white-space:nowrap;
  }
  @media (max-width:900px){ 
    .foot{
      grid-template-columns:1fr;
    } 
  }





.about{
  display: flex;
  align-items:center;
  justify-content:center;
}

 .about-card {
      background-color: transparent;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10 20px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      color:#fff;
    }
    .about-card:hover {
      transform: scale(1.02);
      box-shadow: 0 0 25px rgba(0,0,0,0.2);
    }
    .btn-discover {
      background-color: #ff8800;
      border: none;
    }
    .btn-discover:hover {
      background-color: #cc6e00;
    }









  
  .wave{
    background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
    border-radius:18px;
    padding:18px;
    overflow:hidden;
    border:1px solid rgba(255,255,255,.08);
    height:160px; opacity:.7;
  }










  .reveal{opacity:0; 
    transform: translateY(12px); 
    transition: .6s ease;
  }
  .reveal.show{
    opacity:1; 
    transform:none;
  }

 
  .modal{
    position:fixed; 
    inset:0; 
    display:none; 
    place-items:center; 
    background:rgba(0,0,0,.5); 
    backdrop-filter: blur(6px); 
    z-index:60;
  }
  .modal.show{
    display:grid;
  }
  .sheet{
    width:min(680px, 92vw); 
    background:var(--panel); 
    border:1px solid var(--glass-b); 
    border-radius:18px; 
    overflow:hidden; 
    box-shadow:var(--shadow);
  }
  .sheet .head{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px;
    border-bottom:1px solid var(--glass-b);
  }
  .sheet .body{
    padding:16px;
  }
  .grid-2{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
  }
  @media (max-width:620px){
     .grid-2{
      grid-template-columns:1fr;
    } 
  }
  .input{
    padding:12px;
    border-radius:12px;
    border:1px solid var(--glass-b);
    background:transparent;
    color:var(--text);
  }
  .select{
    padding:12px;
    border-radius:12px;
    border:1px solid var(--glass-b);
    background:transparent;
    color:var(--text);
    }




    .contact-section {
  padding: 50px 20px;
  background: transparent;
}

.container-one {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  justify-content: space-between;
  align-items: flex-start;
  max-width: 1200px;
  margin: auto;
}

.contact-form,
.map {
  flex: 1 1 45%;
  background: transparent;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  transition: transform 0.6s ease, opacity 0.6s ease;
}

.contact-form h2,
.map h2 {
  margin-bottom: 20px;
  color: #007bff;
}

.contact-form input,
.contact-form textarea {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  background-color:transparent;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 1rem;
}

.contact-form textarea {
  resize: vertical;
  min-height: 120px;
}

.contact-form button {
  padding: 12px 25px;
  border: none;
  background: linear-gradient(135deg, #312e81cc, #0ea5b7cc);
  box-shadow: var(--shadow);
  color: #fff;
  border-radius: 6px;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.3s ease;
}

.contact-form button:hover {
  background: linear-gradient(135deg, #0ea5b7cc,#312e81cc);
}


.animate-left {
  opacity: 0;
  transform: translateX(-50px);
  animation: slideInLeft 1s forwards;
}

.animate-right {
  opacity: 0;
  transform: translateX(50px);
  animation: slideInRight 1s forwards;
}

@keyframes slideInLeft {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideInRight {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}


@media (max-width: 768px) {
  .container {
    flex-direction: column;
  }

  .contact-form,
  .map {
    flex: 1 1 100%;
  }
}
#scrollTopBtn {
    position: fixed;
    bottom: 150px;
    right: 40px;
    width: 50px;
    height: 50px;
    background: transparent;
    border: 2px solid #0ea5b7cc;
    color: #312e81cc;
    border-radius: 50%;
    font-size: 22px;
    cursor: pointer;
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 9999;   /* 👈 ye add karo */
}

#scrollTopBtn:hover {
   background: linear-gradient(135deg, #312e81cc, #0ea5b7cc);
    color: black;
}
</style>
</head>
<body class="light">

  
  <nav class="nav">
    <div class="container nav-inner">
      <div class="brand">
        <div class="logo">HMS</div>
        <h1>Paradise Hotel</h1>
      </div>
      <div class="links" id="navLinks">
        <a href="#rooms">Rooms</a>
        <a href="#dining">Dining</a>
        <a href="#spa">Spa</a>
        <a href="#video">Experience</a>
        <a href="#reviews">Reviews</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
        <?php
          if ($_SESSION['user']['name']) {
            ?>
            <a href="profile/update_password.php">Profile</a>
            <!-- <a href="customer/room.php">All Rooms</a> -->
            <?php
          }else{
            ?>
            <div style="position:relative;">
              <div class="trigger" tabindex="0"><a href="loginsign.php">Login</a></div>
              <div class="popup" role="dialog" aria-hidden="true">
                <div class="title"><?=$_SESSION['user']['name']?></div>
                <div class="text">You Are Logged In</div>
              </div>
            </div>
            <?php
          }
        ?>
        <a href="logout.php">Logout</a>
    </div>
      <div class="nav-cta">
        <a href="./manage_bookings/bookings.php"><button class="ghost" id="openBook">Book Now</button></a>
        <button class="theme" id="themeBtn" title="Toggle theme">Theme</button>
        <button class="hamburger" id="menuBtn">☰</button>
      </div>
    </div>
  </nav>

 
  <header class="hero">
    <div class="container hero-grid">
      <div>
        <h2 class="headline reveal">Where City Lights Meet Quiet Nights.</h2>
        <p class="sub reveal">Five-star suites, award-winning dining, and a spa sanctuary—crafted for travelers who want more than just a stay.</p>
        <div class="hero-cta reveal">
          <a href="#rooms"><button class="btn">Explore Rooms</button></a>
          <a href="#video"><button class="ghost">Watch Experience</button></a>
        </div>
        <div class="tick reveal">✓ 24/7 concierge & airport transfers</div>
        <div class="tick reveal">✓ Early check-in & late checkout (on availability)</div>
        <div class="badge-row reveal">
          <span class="pill">Free High-Tea</span>
          <span class="pill">Skyline Bar</span>
          <span class="pill">Infinity Pool</span>
        </div>
      </div>



      <div class="art reveal">
        <div class="video-wrap">
          <span class="tag">Hotel Walkthrough • 1:12</span>
          <video id="heroVideo" src="assets/lobby.mp4" poster="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1200&auto=format&fit=crop" muted playsinline></video>
        </div>
        <div class="blob"></div>
      </div>
    </div>
    <br>
    <div class="wave"></div>
  </header>

 
  <section class="container">
    <div class="stats">
      <div class="stat reveal"><div class="n" data-count="120">0</div><div class="k">Luxury Suites</div></div>
      <div class="stat reveal"><div class="n" data-count="32">0</div><div class="k">Dining Awards</div></div>
      <div class="stat reveal"><div class="n" data-count="98">0</div><div class="k">% Guest Satisfaction</div></div>
      <div class="stat reveal"><div class="n" data-count="12">0</div><div class="k">Event Venues</div></div>
    </div>
  </section>






<br>
<br>
<br>
<section class="about" id="about">
    <div class="text-center mt-4">
        </div>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 about-card animate__animated animate__fadeIn">
        <h2 class="text-center mb-3">About Paradise Hotel</h2>
        <p style="font-size: 1.1rem;">
          Welcome to <strong>Paradise Hotel</strong> — your luxurious home away from home. Nestled in the heart of the city, we offer world-class amenities, stunning interiors, and exceptional hospitality to ensure your stay is as memorable as it is comfortable.
        </p>
        <p>
          Whether you're here for a business trip or a relaxing vacation, Paradise Hotel provides the perfect blend of comfort, elegance, and convenience. From premium rooms to gourmet dining, we’ve got everything covered.
        </p>
        <div class="text-center mt-4">
          <a href="./customer/room.php" class="btn btn-discover btn-lg text-white">All Rooms</a>
        </div>
      </div>
    </div>
  </div>
  </section>

  <section id="rooms" class="container">
    <div class="sec-head">
      <h2>Suites & Rooms</h2>
      <a href="#contact" class="ghost">Need help choosing?</a>
    </div>
    <div class="cards">
      <article class="card reveal">
        <img src="./uploads/room1.png" alt="">
        <div class="cap">
          <div class="price"><strong>Deluxe City View</strong><span class="chip">$149 / night</span></div>
          <div class="amen">
            <span class="pill">King Bed</span><span class="pill">Rain Shower</span><span class="pill">Smart TV</span>
          </div>
          <button class="btn" data-room="Deluxe City View">Book</button>
        </div>
      </article>
      <article class="card reveal">
        <img src="uploads/room2.png" alt="">
        <div class="cap">
          <div class="price"><strong>Executive Panorama</strong><span class="chip">$229 / night</span></div>
          <div class="amen">
            <span class="pill">Skyline Balcony</span><span class="pill">Butler</span><span class="pill">Workspace</span>
          </div>
          <button class="btn" data-room="Executive Panorama">Book</button>
        </div>
      </article>
      <article class="card reveal">
        <img src="uploads/room3.png" alt="">
        <div class="cap">
          <div class="price"><strong>Aurora Suite</strong><span class="chip">$389 / night</span></div>
          <div class="amen">
            <span class="pill">Private Spa</span><span class="pill">City + Sea</span><span class="pill">Club Access</span>
          </div>
          <button class="btn" data-room="Aurora Suite">Book</button>
        </div>
      </article>
    </div>
  </section>
      <br>
      <br>
      <br>
      <br>
  
  <section id="dining" class="container">
    <div class="split">
      <div class="highlight reveal">
        <img src="uploads/lobby.png" alt="">
        <div class="cap" style="padding:18px">
          <h3>Michelin-inspired Dining</h3>
          <p class="sub">Seasonal tasting menus, open kitchen theatrics, and a cellar curated by award-winning sommeliers.</p>
          <div class="amen">
            <span class="pill">Chef’s Table</span><span class="pill">Wine Pairing</span><span class="pill">Vegan Fine</span>
          </div>
          <div style="margin-top:12px"><button class="ghost">View Menus</button></div>
        </div>
      </div>
      <div id="spa" class="highlight reverse reveal">
        <img src="uploads/spa.png" alt="">
        <div class="cap" style="padding:18px">
          <h3>Sanctuary Spa & Infinity Pool</h3>
          <p class="sub">Hydrotherapy circuits, deep-tissue rituals, and sunrise laps with skyline views.</p>
          <div class="amen">
            <span class="pill">Hammam</span><span class="pill">Sauna</span><span class="pill">Aromatherapy</span>
          </div>
          <div style="margin-top:12px"><button class="ghost">Explore Spa</button></div>
        </div>
      </div>
    </div>
  </section>
  <br>
  <br>
  
  <section id="video" class="container">
    <div class="sec-head">
      <h2>Experience the Aurora</h2>
      <span class="sub">A glimpse of the lobby, suites, and rooftop deck.</span>
    </div>
    <div class="art reveal">
      <div class="video-wrap">
        <video muted autoplay src="uploads/Star_Hotel_Video_Generated.mp4" poster="https://images.unsplash.com/photo-1519710164239-da123dc03ef4?q=80&w=1200&auto=format&fit=crop" controls playsinline></video>
      </div>
    </div>
  </section>

 
  <section id="reviews" class="container">
    <div class="sec-head">
      <h2>Guest Stories</h2>
      <div class="arrows">
        <div class="arrow" id="prev">‹</div>
        <div class="arrow" id="next">›</div>
      </div>
    </div>
    <div class="slider reveal">
      <div class="track" id="track">
        <div class="review">
          <div class="stars">★★★★★</div>
          <p>“From check-in to spa, every detail felt curated just for us. The skyline bar is a dream.”</p>
          <small>— Ayesha K.</small>
        </div>
        <div class="review">
          <div class="stars">★★★★★</div>
          <p>“Room service at 2am, sunrise pool at 6am. Zero compromises. Will return.”</p>
          <small>— Daniel L.</small>
        </div>
        <div class="review">
          <div class="stars">★★★★☆</div>
          <p>“Loved the butler service and the tasting menu. Suite lighting was next-level.”</p>
          <small>— Zara R.</small>
        </div>
        <div class="review">
          <div class="stars">★★★★★</div>
          <p>“Closest thing to a private sanctuary in the middle of the city.”</p>
          <small>— Imran S.</small>
        </div>
      </div>
    </div>
  </section>
<br>
  
  <section class="container">
    <div class="sec-head"><h2>Frequently Asked</h2></div>
    <div class="faq reveal">
      <details class="qa">
        <summary>Is early check-in available?</summary>
        <div>Yes, subject to availability. Guests with Executive & Aurora Suites get priority.</div>
      </details>
      <details class="qa">
        <summary>Do you offer airport transfers?</summary>
        <div>Complimentary for 3+ night bookings and all Aurora Suite stays.</div>
      </details>
      <details class="qa">
        <summary>What’s your cancellation policy?</summary>
        <div>Free cancellation up to 48 hours before check-in. Non-refundable rates excluded.</div>
      </details>
    </div>
  </section>

  <br>
  <section class="contact-section">
  <div class="container-one">
    <div class="contact-form animate-left">
      <h2>Contact Us</h2>
      <form action="" method="POST">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <textarea name="text" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
      </form>
    </div>
    <div class="map animate-right">
      <h2>Our Location - Karachi</h2>
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28949.774266980667!2d67.0010856!3d24.8607343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f93c9b85cb5%3A0x35cdbd22e8dc88a5!2sKarachi%2C%20Sindh%2C%20Pakistan!5e0!3m2!1sen!2s!4v1633828810373!5m2!1sen!2s" 
        width="100%" 
        height="300" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy">
      </iframe>
    </div>
   <?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = htmlspecialchars(trim($_POST["name"]));
//     $contect = htmlspecialchars(trim($_POST["contect"]));
//     $message = htmlspecialchars(trim($_POST["message"]));

   
//     $query = "INSERT INTO contect(name,contect,message)values('$name','$contect','$message')";
//     $run = mysqli_query($conn,$query);
//     if ($run) {
//         echo "<h2>Thank you Your message has been received.</h2>";
//     } else {
//         echo "<h2>Please fill all fields properly.</h2>";
//     }
// } else {
//     echo "<h2>Invalid Request</h2>";
// }
?>
  </div>
</section>
 
  <section id="contact" class="container">
    <div class="sec-head"><h2>Stay in the Loop</h2></div>
    <div class="foot">
      <div>
        <p class="sub">Be the first to know about private tastings, spa retreats, and suite drops.</p>
        <div class="nl">
          <input type="email" placeholder="Your email address">
          <button class="btn">Subscribe</button>
        </div>
      </div>
      <div>
        <h3>Concierge</h3>
        <small>+92 300 123 4567</small><br>
        <small>PeradiseHotel@gmail.com</small><br>
        <small>Plot 7, Marine Drive, Karachi, Pakistan</small>
      </div>
      <div>
        <h3>Social</h3>
        <small>Instagram • Facebook • X</small><br>
        <small>#PeradiseHotel</small>
      </div>
    </div>
  </section>
<button id="scrollTopBtn">&#8593;</button>
  <footer>
    <div class="container">
      <small>© <span id="year"></span> Peradise Hotel. All rights reserved.</small>
    </div>
  </footer>
<button id="scrollTopBtn">&#8593;</button>
  <!-- ===================== BOOKING MODAL ===================== -->
  <!-- <div class="modal" id="bookModal">
    <div class="sheet">
      <div class="head">
        <strong>Quick Booking</strong>
        <button class="ghost" id="closeBook">Close</button>
      </div>
      <div class="body">
        <div class="grid-2">
          <input class="input" id="bkName" placeholder="Full Name">
          <input class="input" id="bkEmail" placeholder="Email">
            <select class="select" id="bkRoom">
            <option>Timeing</option>
            <option>Day</option>
            <option>Evening</option>
          </select>
          <input class="input" id="bkOut" type="date" placeholder="Check-out">
          <select class="select" id="bkGuests">
            <option>1 Guest</option><option selected>2 Guests</option><option>3 Guests</option><option>4 Guests</option>
          </select>
          <select class="select" id="bkRoom">
            <option>Deluxe City View</option>
            <option>Executive Panorama</option>
            <option>Aurora Suite</option>
          </select>
        </div>
        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:14px">
          <button class="ghost" id="goPayment"><a href="./customer/payment.php">Go to Payment</a></button>
          <button class="btn" id="confirmBk">Confirm</button>
        </div>
      </div>
    </div>
  </div> -->

<script>
//back-to-top-botton
const scrollBtn = document.getElementById("scrollTopBtn");

window.addEventListener("scroll", function () {
    if (window.scrollY > 300) {
        scrollBtn.style.display = "block";
        setTimeout(() => {
            scrollBtn.style.opacity = "1";
        }, 10);
    } else {
        scrollBtn.style.opacity = "0";
        setTimeout(() => {
            scrollBtn.style.display = "none";
        }, 300);
    }
});

scrollBtn.addEventListener("click", function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});








  document.getElementById('year').textContent = new Date().getFullYear();

  const themeBtn = document.getElementById('themeBtn');
  const savedTheme = localStorage.getItem('theme');
  if(savedTheme==='dark'){ document.body.classList.remove('light'); themeBtn.textContent='Theme'; }
  themeBtn.addEventListener('click', ()=>{
    document.body.classList.toggle('light');
    const dark = !document.body.classList.contains('light');
    themeBtn.textContent = dark ? 'Theme' : 'Theme';
    localStorage.setItem('theme', dark?'dark':'light');
  });

 
  const menuBtn = document.getElementById('menuBtn');
  const navLinks = document.getElementById('navLinks');
  menuBtn?.addEventListener('click', ()=>{
    if(getComputedStyle(navLinks).display==='none'){
      navLinks.style.display='grid'; navLinks.style.gap='10px';
    } else { navLinks.style.display=''; }
  });

  
  const hv = document.getElementById('heroVideo');
  hv?.play().catch(()=>{});

 
  const io = new IntersectionObserver((ents)=>{
    ents.forEach(e=>{
      if(e.isIntersecting){ e.target.classList.add('show'); io.unobserve(e.target); }
    })
  },{threshold:.12});
  document.querySelectorAll('.reveal').forEach(el=>io.observe(el));

  
  const counters = document.querySelectorAll('.stat .n');
  const io2 = new IntersectionObserver((ents)=>{
    ents.forEach(e=>{
      if(!e.isIntersecting) return;
      const el=e.target, target=+el.dataset.count;
      let cur=0, step=Math.max(1, Math.round(target/60));
      const t=setInterval(()=>{
        cur+=step; if(cur>=target){cur=target; clearInterval(t);}
        el.textContent = cur;
      },20);
      io2.unobserve(el);
    })
  },{threshold:.6});
  counters.forEach(el=>io2.observe(el));

  
  const track = document.getElementById('track');
  document.getElementById('next').onclick = ()=> track.scrollBy({left:340,behavior:'smooth'});
  document.getElementById('prev').onclick = ()=> track.scrollBy({left:-340,behavior:'smooth'});
  let auto = setInterval(()=>track.scrollBy({left:340,behavior:'smooth'}), 4000);
  track.addEventListener('pointerdown', ()=>clearInterval(auto));

  
  const modal = document.getElementById('bookModal');
  const openBook = document.getElementById('openBook');
  const closeBook = document.getElementById('closeBook');
  openBook.addEventListener('click', ()=> modal.classList.add('show'));
  closeBook.addEventListener('click', ()=> modal.classList.remove('show'));
  document.querySelectorAll('[data-room]').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      document.getElementById('bkRoom').value = btn.dataset.room;
      modal.classList.add('show');
    });
  });
  document.getElementById('goPayment').addEventListener('click', ()=>{
    
    alert('Demo: Redirecting to payment.html with booking details…');
  });
  document.getElementById('confirmBk').addEventListener('click', ()=>{
    modal.classList.remove('show');
    alert('Demo: Booking saved. Check My Bookings.');
  });

  const nav = document.querySelector('.nav');
  const shadow = ()=> nav.style.boxShadow = window.scrollY>4 ? '0 8px 24px rgba(0,0,0,.2)' : 'none';
  shadow(); window.addEventListener('scroll', shadow);


//back-to-top-botton
  
</script>
</body>
</html>
