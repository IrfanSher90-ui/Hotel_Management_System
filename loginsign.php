<?php

session_start();


include 'includes/db_connect.php';

function flash($msg, $type = 'info') {
    $_SESSION['flash'] = ['msg'=>$msg,'type'=>$type];
}

// If user requested logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    session_start();
    flash('You have been logged out.', 'success');
    header('Location: '.$_SERVER['PHP_SELF']); exit;
}

// Process POST (signup or login)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'signup') {
    // Sanitize input
    $name     = trim($_POST['name']);
    $email    = trim(strtolower($_POST['email']));
    $password = $_POST['password'];
    $confirm  = $_POST['password2'];

    // Validate
    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    if ($password !== $confirm) {
        die("Passwords do not match.");
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Email already registered.");
    }
    $stmt->close();

    // Image upload
    $image_path = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_exts)) {
            die("Only JPG, JPEG, PNG, and GIF files are allowed.");
        }

        $new_filename = uniqid("img_", true) . '.' . $file_ext;
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $image_path = $upload_dir . $new_filename;
        if (!move_uploaded_file($file_tmp, $image_path)) {
            die("Image upload failed.");
        }
    } else {
        die("Image is required.");
    }

    // Hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hash, $image_path);
    if ($stmt->execute()) {
                    flash('Welcome back, ' . htmlspecialchars($name) . '!', 'success');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();


    }

    else if ($action === 'login') {
        $email = trim(strtolower($_POST['email']));
    $password = $_POST['password'];

    // Validate
    if (!$email || !$password) {
        die("All fields are required.");
    }

    // Fetch user
    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $name, $db_email, $db_pass, $role);
        $stmt->fetch();

        if (password_verify($password, $db_pass)) {
            // Login success
            $_SESSION['user'] = [
                'id'    => $id,
                'name'  => $name,
                'email' => $db_email,
                'role'  => $role
            ];

            // Redirect based on role
            if ($role === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            die(" Incorrect password.");
        }
    } else {
        die(" No account found with this email.");
    }

    $stmt->close();
    }
}

// If already logged in, you can redirect to dashboard or show logout option
$loggedIn = isset($_SESSION['user']);

// Get flash (if any)
$flash = $_SESSION['flash'] ?? null; unset($_SESSION['flash']);

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Auth — Login / Signup</title>
  <style>
    :root{
      --bg:#0f1724;
      --card:#0b1220;
      --muted:#cbd5e1;
      --accent:#60a5fa;
      --glass:rgba(255,255,255,0.04);
      --radius:12px;
    }
    [data-theme='light']
    {
      --bg:#f6f9fb;
      --card:#fff;
      --muted:#0f1724;
      --accent:#0ea5e9;
      --glass:rgba(2,6,23,0.04);
    }
    *{
      box-sizing:border-box;
      font-family:Inter,Segoe UI,system-ui,-apple-system,'Helvetica Neue',Arial;
    }
    html,body{
      height:100%;
      margin:0
    }
    body{
      background:linear-gradient(180deg,var(--bg), rgba(0,0,0,0));
      color:var(--muted);
      display:grid;
      place-items:center;
      padding:24px;
    }

    .frame{
      width:100%;
      max-width:920px;
      background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);
      border-radius:18px;
      padding:18px;
      display:grid;
      grid-template-columns:1fr 420px;
      gap:18px;
      border:1px solid var(--glass);
      box-shadow:0 18px 50px rgba(2,6,23,0.4);
    }
    @media (max-width:460px){
      .frame{
        grid-template-columns:1fr;
      }
    }

    .left{padding:18px}
    .brand{
      display:flex;
      gap:12px;
      align-items:center;
      margin-bottom:12px;
    }
    .logo{
      width:56px;
      height:56px;
      border-radius:12px;
      background:linear-gradient(135deg,var(--accent),#7c3aed);
      display:grid;
      place-items:center;
      color:white;
      font-weight:800;
    }
    h1{
      margin:0;
      font-size:20px;
    }
    p.lead{
      margin:6px 0 12px;
      color:var(--muted);
    }

    /* toggler */
    .switcher{
      display:flex;
      gap:8px;
      margin-bottom:12px;
    }
    .tab{
      padding:10px 12px;
      border-radius:10px;
      cursor:pointer;
      border:1px solid transparent;
    }
    .tab.active{
      background:linear-gradient(90deg, rgba(255,255,255,0.02), transparent);
      border-color:var(--glass);
    }

    form{
      display:grid;
      gap:10px
    }
    label{
      font-size:13px;
      color:var(--muted);
    }
    input{
      padding:10px;
      border-radius:10px;
      border:1px solid var(--glass);
      background:transparent;
      color:var(--muted);
      outline:none;
     }
    .row{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:8px
    }
    .actions{
      display:flex;
      gap:8px;
      align-items:center;
      justify-content:flex-end;
      margin-top:6px;
    }
    .btn{
      padding:10px 14px;
      border-radius:10px;
      border:0;
      background:var(--accent);
      color:white;
      cursor:pointer
    }
    .btn.ghost{
      background:transparent;
      border:1px solid var(--glass);
      color:var(--muted);
    }

   
    .right{padding:18px;
      border-left:1px solid var(--glass);
    }
    .info{
      margin-bottom:12px;
    }
    .small{
      font-size:13px;
      color:var(--muted);
    }

    
    .flash{
      padding:10px;
      border-radius:10px;
      margin-bottom:10px;
    }
    .flash.success{
      background:rgba(34,197,94,0.12);
      border:1px solid rgba(34,197,94,0.18);
      color:#bbf7d0;
    }
    .flash.error{
      background:rgba(239,68,68,0.08);
      border:1px solid rgba(239,68,68,0.12);
      color:#fecaca;
    }

   
    .logo, .tab, .btn{
      transition:transform .12s ease, box-shadow .12s ease
    }
    .tab:active, .btn:active{
      transform:translateY(1px)
    }

   
    .themeWrap{
      display:flex;
      align-items:center;
      gap:8px
    }

   
    .muted{
      color:var(--muted);
      font-size:13px
    }
  </style>
</head>
<body data-theme="dark">
  <div class="frame">
    <div class="left">
      <div class="brand">
        <div class="logo">HMS</div>
        <div>
          <h1>Peradise Hotel —</h1>
          <p class="lead"> Login or Signup Frist.</p>
        </div>
      </div>

      <?php if ($flash): ?>
        <div class="flash <?=htmlspecialchars($flash['type'])?>"><?=htmlspecialchars($flash['msg'])?></div>
      <?php endif; ?>

      <?php if ($loggedIn): ?>
        <div class="card" style="padding:12px;border-radius:12px;margin-bottom:12px">
          <div style="font-weight:700">Hello, <?=htmlspecialchars($_SESSION['user']['name'])?></div>
          <div class="small"><?=htmlspecialchars($_SESSION['user']['email'])?></div>
          <div style="margin-top:10px;display:flex;gap:8px">
            <a class="btn" href="index.php">Peradise Hotel</a>
            <a class="btn ghost" href="?action=logout">Logout</a>
          </div>
        </div>
      <?php endif; ?>

      <div class="switcher" role="tablist" aria-label="auth tabs">
        <div id="tabLogin" class="tab active" data-mode="login">Login</div>
        <div id="tabSignup" class="tab" data-mode="signup">Signup</div>
      </div>

      <form id="authForm" method="post" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
        <input type="hidden" name="action" id="actionInput" value="login">

        <div id="signupFields" style="display:none">
          <label for="name">Full name</label>
          <input type="text" id="name" name="name" placeholder="Name" />
        </div>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email Address" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required />

        <div id="signupField" style="display:none">
          <label for="image">User Image</label>
          <input type="file" id="image" name="image" placeholder="Upload your Image" />
        </div>


        <div id="pwConfirm" style="display:none">
          <label for="password2">Confirm password</label>
          <input type="password" id="password2" name="password2" placeholder="Confirm password" />
        </div>

        <div class="actions">
            <button type="submit" class="btn" id="submitBtn">Login</button>
          <button type="button" class="btn ghost" id="clearBtn">Clear</button>
        </div>
      </form>

      <div style="margin-top:12px" class="small">Tip: Use one form to signup or login. After signup you will be automatically logged in.</div>
    </div>

    <div class="right">
      <div class="info">
        <div style="display:flex;justify-content:space-between;align-items:center">
          <div>
            <div class="small">Theme</div>
            <div class="themeWrap"><label class="small">Dark</label><button id="themeToggle" class="btn ghost">Toggle</button><label class="small">Light</label></div>
          </div>
          <div style="text-align:right">
            <!-- <div class="small">Quick Links</div> -->
            <div style="margin-top:8px;display:flex;gap:8px;justify-content:flex-end">
              <!-- <a class="btn ghost" href="index.php">Home</a>
              <a class="btn ghost" href="contact.php">Contact</a> -->
            </div>
          </div>
        </div>
      </div>

      <hr />

      <div style="margin-top:10px">
        <div style="font-weight:700">Why this Secure Hotel Access</div>
        <div class="muted" style="margin-top:6px">This login system ensures secure access for hotel staff and administrators. All user sessions and data are protected to maintain privacy and system integrity.</div>
      </div>

      <div style="margin-top:12px">
        <div style="font-weight:700">DB Note</div>
        <div class="muted">Configure database credentials properly before use. The system supports authentication, session handling, and can be extended for full hotel operations.</div>
      </div>
    </div>
  </div>

  <script>
    // Small JS for toggling login/signup in the same form
    (function(){
      const tabLogin = document.getElementById('tabLogin');
      const tabSignup = document.getElementById('tabSignup');
      const signupFields = document.getElementById('signupFields');
      const signupField = document.getElementById('signupField');
      const pwConfirm = document.getElementById('pwConfirm');
      const actionInput = document.getElementById('actionInput');
      const submitBtn = document.getElementById('submitBtn');
      const clearBtn = document.getElementById('clearBtn');
      const themeToggle = document.getElementById('themeToggle');

      function switchMode(mode){
        if(mode === 'signup'){
          signupFields.style.display = 'block';
          signupField.style.display = 'block';
          pwConfirm.style.display = 'block';
          actionInput.value = 'signup';
          tabSignup.classList.add('active');
          tabLogin.classList.remove('active');
          submitBtn && (submitBtn.textContent = 'Signup');
        } else {
          signupFields.style.display = 'none';
          pwConfirm.style.display = 'none';
          actionInput.value = 'login';
          tabLogin.classList.add('active');
          tabSignup.classList.remove('active');
          submitBtn && (submitBtn.textContent = 'Login');
        }
      }

      tabLogin.addEventListener('click',()=>switchMode('login'));
      tabSignup.addEventListener('click',()=>switchMode('signup'));

      clearBtn.addEventListener('click',()=>{ document.getElementById('authForm').reset(); });

      themeToggle.addEventListener('click',()=>{
        const el = document.body;
        const cur = el.getAttribute('data-theme');
        el.setAttribute('data-theme', cur === 'dark' ? 'light' : 'dark');
      });

      // init: show login by default
      switchMode('login');
    })();
  </script>
</body>
</html>
