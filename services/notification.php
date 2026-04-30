<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-light: #f9f9f9;
      --bg-dark: #0f172a;
      --text-light: #333;
      --text-dark: #f9f9f9;
      --card-light: #fff;
      --card-dark: #2a2a2a;
      --accent: #ff9800;
      --shadow: 0 10px 30px rgba(2,8,23,.08);
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
      color: var(--text-light);
      transition: background 0.3s, color 0.3s;
    }

    body.dark {
      background-color: var(--bg-dark);
      color: var(--text-dark);
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


    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      /* background: var(--accent); */
      background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
      border-bottom-left-radius:18px;
      border-bottom-right-radius:18px;
      padding:18px;
      overflow:hidden;
      border:1px solid rgba(255,255,255,.08);
      box-shadow: var(--shadow);
      color: white;
      font-family: 'Arial', cursive;
      font-weight:normal;
      letter-spacing:4px;
    }

    .toggle-btn {
      display:inline-flex; align-items:center; gap:8px; cursor:pointer;
        padding:12px 16px; border-radius:10px;
       background: rgba(255,255,255,.06);
       border:1px solid rgba(255,255,255,.08);
    }

    .container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 1rem;
    }

    .notification {
      background: transparent;
      margin: 1rem 0;
      padding: 1rem;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      opacity: 0;
      transform: translateY(20px);
      animation: slideUp 0.6s forwards;
      transition: background 0.3s, color 0.3s;
       border:1px solid rgba(255,255,255,.08);
       box-shadow: var(--shadow);
    }

    body.dark .notification {
      background: transparent;
      color: var(--text-dark);
      box-shadow: var(--shadow);
    }

    .notification h3 {
      margin: 0 0 0.5rem;
    }

    @keyframes slideUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <header>
    <h2>Notifications</h2>
    <button class="toggle-btn" onclick="toggleMode()">Theme</button>
  </header>

  <div class="container">
    <div class="notification">
      <h3>Booking Confirmed </h3>
      <p>Your hotel booking for 30th Aug has been confirmed.</p>
    </div>
    <div class="notification">
      <h3>Payment Successful </h3>
      <p>Your payment of $250 has been received.</p>
    </div>
    <div class="notification">
      <h3>Special Offer </h3>
      <p>Enjoy 20% off on your next dining experience.</p>
    </div>
    <div class="notification">
      <h3>System Alert </h3>
      <p>Your profile is 80% complete. Update now for better experience.</p>
    </div>
  </div>

  <script>
    function toggleMode() {
      document.body.classList.toggle("dark");
      const btn = document.querySelector(".toggle-btn");
      if (document.body.classList.contains("dark")) {
        btn.textContent = "Theme";
      } else {
        btn.textContent = "Theme";
      }
    }
  </script>
</body>
</html>
