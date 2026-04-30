<!--
  Hotel Services & Amenities - Single-file responsive page
  Features:
  - Responsive grid of amenity cards
  - Light/Dark theme toggle (CSS variables)
  - Subtle animations and hover effects
  - Animated hero + slider (auto + manual)
  - Modal for detailed amenity info
  - Accessible buttons and keyboard support

  Save as: hotel-amenities.html
-->

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hotel Services & Amenities</title>
  <meta name="description" content="Hotel Services & Amenities — responsive, animated, with dark & light mode" />
  <style>
    :root{
      --bg: #0f1724;
      --card: #0b1220;
      --muted: #94a3b8;
      --text: #e6eef8;
        --accent:#7c3aed; 
      --accent2:#06b6d4;
      --glass: rgba(255,255,255,0.04);
      --card-glow: 0 8px 30px rgba(0,0,0,0.6);
      --radius: 14px;
    }
    [data-theme='light']{
      --bg: #f7fafc;
      --card: #ffffff;
      --muted: #475569;
      --text: #0b1220;
        --accent:#7c3aed; 
      --accent2:#06b6d4;
      --glass: rgba(11,18,32,0.04);
      --card-glow: 0 8px 30px rgba(2,6,23,0.06);
    }

    *{
      box-sizing:border-box;
    }
    html,body{
      height:100%;
      margin:0;
      font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,'Helvetica Neue',Arial;
      line-height:1.35;
      background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
      color: var(--text);
      
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
  background:var(--accent2);
  border-radius: 8px;
  transition:1.5s;
}
::-webkit-scrollbar-thumb:hover {
  background:  #0f172a;

}
    .container{
      max-width:1200px;
      margin:32px auto;
      padding:24px;
    }

    header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:16px;
      background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
      border-radius:18px;
      padding:18px;
      overflow:hidden;
      border:1px solid rgba(255,255,255,.08);
      box-shadow: var(--shadow);
    }
    .brand{
      display:flex;
      align-items:center;
      gap:12px;
     
    }
    .logo{
      width:52px;
      height:52px;
      border-radius:12px;
      background:linear-gradient(90deg,var(--accent),var(--accent2));
      display:grid;
      place-items:center;
      font-weight:700;
      color:#fff;
      box-shadow:var(--card-glow);
    }
    h1{
      font-size:20px;
      margin:0;
    }
    p.lead{
      margin:0;
      color:var(--muted);
      font-size:13px;
    }

    .controls{
      display:flex;
      gap:8px;
      align-items:center;
    }
    .btn{
      background:transparent;
      border:0;
      padding:10px 14px;
      border-radius:10px;
      color:var(--text);
      cursor:pointer;
      box-shadow:var(--card-glow);
      transition:transform .18s ease,box-shadow .18s;
    }
    .btn:active{
      transform:translateY(1px);
    }
    .icon{
      width:18px;
      height:18px;
      display:inline-block
    }
    /* Hero */
    .hero{
      margin-top:18px;
      display:grid;
      grid-template-columns:1fr 360px;
      gap:20px;
      align-items:start;
    }
    .hero-card{
      background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);
      padding:20px;
      border-radius:16px;
      box-shadow:var(--card-glow);
    }
    .hero h2{
      margin:0 0 8px 0;
      font-size:22px;
    }
    .hero p{
      color:var(--muted);
      margin:0 0 12px;
    }
    .amenity-list{
      display:grid;
      grid-template-columns:repeat(2,1fr);
      gap:12px;
    }
    .amenity-pill{
      display:inline-flex;
      gap:10px;
      align-items:center;
      border:1px solid var(--accent2);
      padding:8px 12px;
      background:var(--glass);
      border-radius:999px;
      font-weight:600;
      color:var(--text);
    }

    /* Slider */
    .slider{
      position:relative;
      overflow:hidden;
      border-radius:12px;
    }
    .slides{
      display:flex;
      transition:transform .6s cubic-bezier(.22,.9,.37,1);
    }
    .slide{
      min-width:100%;
      padding:20px;
      display:grid;
      grid-template-columns:1fr;
      gap:10px
    }
    .slide img{
      width:100%;
      height:220px;
      object-fit:cover;
      border-radius:10px;
    }
    .slider-controls{
      position:absolute;
      right:12px;
      bottom:12px;
      display:flex;
      gap:8px;
    }

    /* Amenities grid */
    .grid{
      margin-top:28px;
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:18px;
    }
    .card{
      background:var(--card);
      padding:18px;
      border-radius:16px;
      box-shadow:var(--card-glow);
      transition:transform .22s,box-shadow .22s;
    }
    .card:hover{
      transform:translateY(-6px);
      box-shadow:0 18px 40px rgba(0,0,0,0.45);
    }
    .card h3{
      margin:0 0 6px 0;
    }
    .card p{
      margin:0;
      color:var(--muted);
      font-size:13px;
    }

    .amenity-icon{
      width:56px;
      height:56px;
      border-radius:12px;
      display:grid;
      place-items:center;
      font-weight:700;
      background:linear-gradient(135deg,rgba(255,255,255,0.03),transparent);
    }

    /* Footer */
    footer{
      margin-top:28px;
      padding:16px;
      border-radius:12px;
      background:linear-gradient(180deg,transparent,rgba(0,0,0,0.06));
      display:flex;
      justify-content:space-between;
      align-items:center;
    }

    /* Modal */
    .modal{
      position:fixed;
      inset:0;
      display:none;
      place-items:center;
      background:rgba(2,6,23,0.6);
      z-index:40;
    }
    .modal.show{
      display:grid
    }
    .modal-card{
      width:min(880px,96%);
    
      backdrop-filter:blur(50px);
      border-radius:14px;
      padding:20px;
      box-shadow:0 30px 80px var(--accent2);
    }
  

    /* Responsive */
    @media (max-width:1000px){
      .hero{
        grid-template-columns:1fr;
      }
      .grid{
        grid-template-columns:repeat(2,1fr);
      }
    }
    @media (max-width:640px){
      .container{
        padding:12px}
      .grid{
        grid-template-columns:1fr;
      }
      .hero{
        gap:12px;
      }
      .slides img{
        height:160px;
      }
      .brand h1{
        font-size:16px;
      }
    }

    /* Small animations */
    @keyframes floaty{
      0%{
        transform:translateY(0);
      }
        50%{
          transform:translateY(-6px);
        }
          100%{transform:translateY(0);
          }
        }
    .float{
      animation:floaty 4s ease-in-out infinite;
    }

    /* accessibility focus */
    .btn:focus,.card:focus{
      outline:3px solid rgba(255,255,255,0.06);
      outline-offset:3px;
    }
  </style>
</head>
<body data-theme="dark">
  <div class="container">
    <header>
      <div class="brand">
        <div class="logo">HMS</div>
        <div>
          <h1>Peradise Hotel — Services & Amenities</h1>
          <p class="lead">Curated comforts for a memorable stay!</p>
        </div>
      </div>

      <div class="controls">
        <button class="btn" id="themeToggle" title="Toggle theme" aria-pressed="false">Theme</button>
        <button class="btn" id="searchBtn" title="Search amenities">
          🔍 Search
        </button>
      </div>
    </header>

    <!-- HERO -->
    <section class="hero">
      <div class="hero-card">
        <h2>Top Amenities</h2>
        <p>We offer an array of services designed for relaxation, convenience and business needs.</p>

        <div class="amenity-list" style="margin-top:12px">
          <span class="amenity-pill">🏊 Pool</span>
          <span class="amenity-pill">🧖 Spa</span>
          <span class="amenity-pill">🍽️ Restaurant</span>
          <span class="amenity-pill">💼 Business Center</span>
        </div>

        <div style="margin-top:16px;display:flex;gap:10px">
          <button class="btn" id="viewAll">View all amenities</button>
          <button class="btn" id="bookNow">Book a service</button>
        </div>

        <div style="margin-top:18px;color:var(--muted);font-size:13px">Tip: Toggle between light/dark theme to preview contrast and accessibility.</div>
      </div>

      <!-- RIGHT: Slider -->
      <div class="slider hero-card" aria-label="amenity slider">
        <div class="slides" id="slides">
          <div class="slide">
            <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" alt="Hotel pool" loading="lazy">
            <div style="margin-top:8px"><strong>Rooftop Infinity Pool</strong><div style="color:var(--muted);font-size:13px">Open 6am - 10pm • Towels provided</div></div>
          </div>
          <div class="slide">
            <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" alt="Spa" loading="lazy">
            <div style="margin-top:8px"><strong>Signature Spa & Wellness</strong><div style="color:var(--muted);font-size:13px">Massages, sauna and steam room</div></div>
          </div>
          <div class="slide">
            <img src="../uploads/dining.png" alt="Restaurant" loading="lazy">
            <div style="margin-top:8px"><strong>All-day Dining</strong><div style="color:var(--muted);font-size:13px">Locally sourced menus & 24/7 room service</div></div>
          </div>
        </div>

        <div class="slider-controls">
          <button class="btn" id="prev">◀</button>
          <button class="btn" id="next">▶</button>
        </div>
      </div>
    </section>

    <!-- AMENITIES GRID -->
    <main>
      <div class="grid" id="amenityGrid" style="margin-top:22px">
        <!-- Card template: each card has data attributes for modal -->

        <article class="card" tabindex="0" data-title="Rooftop Infinity Pool" data-img="https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" data-desc="Heated outdoor pool with panoramic city views, lifeguard on duty during peak hours, towels provided.">
          <div style="display:flex;gap:14px;align-items:center">
            <div class="amenity-icon float">🏊</div>
            <div>
              <h3>Rooftop Infinity Pool</h3>
              <p>Open 6am — 10pm • Towels provided</p>
            </div>
          </div>
        </article>

        <article class="card" tabindex="0" data-title="Signature Spa" data-img="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" data-desc="Full-service spa offering massages, facials, sauna and personalized treatments. Book ahead for weekend slots.">
          <div style="display:flex;gap:14px;align-items:center">
            <div class="amenity-icon">🧖</div>
            <div>
              <h3>Signature Spa</h3>
              <p>Massages, sauna & steam room</p>
            </div>
          </div>
        </article>

        <article class="card" tabindex="0" data-title="All-day Dining" data-img="https://images.unsplash.com/photo-1555992336-03a23c84d8c8?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" data-desc="Farm-to-table restaurant with international and local cuisines. 24/7 room service and private dining available.">
          <div style="display:flex;gap:14px;align-items:center">
            <div class="amenity-icon">🍽️</div>
            <div>
              <h3>All-day Dining</h3>
              <p>Breakfast buffet • À la carte dinners</p>
            </div>
          </div>
        </article>

        <article class="card" tabindex="0" data-title="Fitness Center" data-img="https://images.unsplash.com/photo-1558611848-73f7eb4001d8?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" data-desc="24/7 gym with modern cardio & strength equipment, personal trainers on request.">
          <div style="display:flex;gap:14px;align-items:center">
            <div class="amenity-icon">🏋️</div>
            <div>
              <h3>Fitness Center</h3>
              <p>Open 24/7 • Trainers on request</p>
            </div>
          </div>
        </article>

        <article class="card" tabindex="0" data-title="Business Center" data-img="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" data-desc="Quiet workspaces, printing & meeting rooms with AV equipment. Day passes available.">
          <div style="display:flex;gap:14px;align-items:center">
            <div class="amenity-icon">💼</div>
            <div>
              <h3>Business Center</h3>
              <p>Meeting rooms • Printing</p>
            </div>
          </div>
        </article>

        <article class="card" tabindex="0" data-title="Concierge & Transport" data-img="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" data-desc="24/7 concierge, airport transfers, car rental and local tour booking assistance.">
          <div style="display:flex;gap:14px;align-items:center">
            <div class="amenity-icon">🚕</div>
            <div>
              <h3>Concierge & Transport</h3>
              <p>Airport transfers • Tours</p>
            </div>
          </div>
        </article>

      </div>

      <footer>
        <div style="font-size:14px">Need help? Contact our front desk at <strong>+92 300 1234567</strong></div>
        <div style="font-size:13px;color:var(--muted)">© Hotel Haven • Designed demo</div>
      </footer>
    </main>
  </div>

  <!-- Modal -->
  <div class="modal" id="modal" aria-hidden="true">
    <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <div style="display:flex;gap:16px;align-items:start">
        <div style="flex:1">
          <h2 id="modalTitle">Amenity title</h2>
          <p id="modalDesc" style="color:var(--muted)">Amenity description goes here.</p>
          <div style="margin-top:12px;display:flex;gap:8px">
            <button class="btn" id="modalBook">Book Service</button>
            <button class="btn" id="modalClose">Close</button>
          </div>
        </div>
        <div style="width:320px">
          <img id="modalImg" src="" alt="amenity image" style="width:100%;height:160px;object-fit:cover;border-radius:10px">
        </div>
      </div>
    </div>
  </div>

  <script>
    // Theme toggle
    const themeToggle = document.getElementById('themeToggle');
    const root = document.documentElement;
    const body = document.body;

    function setTheme(theme){
      body.setAttribute('data-theme', theme);
      themeToggle.textContent = theme === 'dark' ? 'Theme' : 'Theme';
      themeToggle.setAttribute('aria-pressed', theme === 'light');
      localStorage.setItem('site-theme', theme);
    }

    // Load theme
    const saved = localStorage.getItem('site-theme') || 'dark';
    setTheme(saved);

    themeToggle.addEventListener('click', ()=>{
      const next = body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      setTheme(next);
    });

    // Slider logic
    const slides = document.getElementById('slides');
    const total = slides.children.length;
    let index = 0;
    const prev = document.getElementById('prev');
    const nextBtn = document.getElementById('next');

    function go(i){
      index = (i + total) % total;
      slides.style.transform = `translateX(-${index * 100}%)`;
    }
    prev.addEventListener('click', ()=>go(index-1));
    nextBtn.addEventListener('click', ()=>go(index+1));

    // auto-play with pause on hover
    let autoplay = setInterval(()=>go(index+1), 4500);
    slides.parentElement.addEventListener('mouseenter', ()=>clearInterval(autoplay));
    slides.parentElement.addEventListener('mouseleave', ()=>autoplay = setInterval(()=>go(index+1),4500));

    // Modal: open when card clicked
    const modal = document.getElementById('modal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDesc = document.getElementById('modalDesc');
    const modalImg = document.getElementById('modalImg');
    const modalClose = document.getElementById('modalClose');

    document.getElementById('amenityGrid').addEventListener('click', (e)=>{
      const card = e.target.closest('.card');
      if(!card) return;
      openModal(card);
    });
    // keyboard open via Enter when focused
    document.getElementById('amenityGrid').addEventListener('keydown', (e)=>{
      if(e.key==='Enter'){
        const card = e.target.closest('.card');
        if(card) openModal(card);
      }
    });

    function openModal(card){
      modalTitle.textContent = card.dataset.title;
      modalDesc.textContent = card.dataset.desc;
      modalImg.src = card.dataset.img;
      modal.classList.add('show');
      modal.setAttribute('aria-hidden', 'false');
      // trap focus briefly
      document.getElementById('modalClose').focus();
    }
    function closeModal(){
      modal.classList.remove('show');
      modal.setAttribute('aria-hidden','true');
    }
    modalClose.addEventListener('click', closeModal);
    modal.addEventListener('click', (e)=>{ if(e.target===modal) closeModal(); });
    document.addEventListener('keydown', (e)=>{ if(e.key==='Escape') closeModal(); });

    // View all / search (simple demo behaviour)
    document.getElementById('searchBtn').addEventListener('click', ()=>{
      const q = prompt('Search amenities (try: pool, spa, dining, gym)');
      if(!q) return;
      const items = [...document.querySelectorAll('.card')];
      const found = items.find(c=>c.dataset.title.toLowerCase().includes(q.toLowerCase()));
      if(found){
        found.scrollIntoView({behavior:'smooth',block:'center'});
        found.classList.add('highlight');
        setTimeout(()=>found.classList.remove('highlight'),1800);
      } else alert('No amenity matched.');
    });

    // small highlight style injected
    const style = document.createElement('style');
    style.textContent = '.highlight{box-shadow:0 30px 60px rgba(255,186,107,0.14);transform:translateY(-6px)}';
    document.head.appendChild(style);

    // Book now & modal book sim
    document.getElementById('bookNow').addEventListener('click', ()=>{
      alert('Booking flow can be integrated here.');
    });
    document.getElementById('modalBook').addEventListener('click', ()=>{
      alert('Booking request sent.');
      closeModal();
    });

  </script>
</body>
</html>
