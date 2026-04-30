<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Secure Payment | Hotel</title>
<style>
   
  :root{
    --bg: #0b1020;
    --panel: #121a2e;
    --muted: #9fb0d1;
    --text: #eaf2ff;
    --primary: #7c3aed;      
    --primary-2:#06b6d4;   
    --success:#22c55e;
    --danger:#ef4444;
    --warning:#f59e0b;
    --ring: rgba(124,58,237,.35);
    --card-grad: radial-gradient(1200px 400px at 10% -10%, #7c3aed33, transparent 40%), radial-gradient(900px 400px at 110% 10%, #06b6d433, transparent 45%);
    --glass: rgba(255,255,255,.06);
    --glass-border: rgba(255,255,255,.12);
    --shadow: 0 10px 30px rgba(0,0,0,.35);
  }
  body.light{
    --bg:#f6f8ff;
    --panel:#ffffff;
    --muted:#51607f;
    --text:#0f172a;
    --card-grad: radial-gradient(1200px 400px at 10% -10%, #7c3aed18, transparent 40%), radial-gradient(900px 400px at 110% 10%, #06b6d418, transparent 45%);
    --glass: rgba(0,0,0,.04);
    --glass-border: rgba(0,0,0,.08);
    --shadow: 0 8px 20px rgba(2,7,62,.08);
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

  
  *{
    box-sizing:border-box
  }
  html,body{
    height:100%
  }
  body{
    margin:0;
    font-family: ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,Inter,Arial;
    background:
    var(--card-grad),
    radial-gradient(800px 200px at 50% -20%, #0ea5e97a, transparent 60%),
    linear-gradient(180deg, var(--bg), var(--bg));
    color:var(--text);
    transition: background .4s ease,color .4s ease;
  }
  .wrap{
    max-width:1100px; 
    margin:auto; 
    padding:24px;
  }

   
  .header{
    display:flex;
    gap:14px;
    align-items:center;
    justify-content:space-between;
    margin-bottom:18px;
    background: linear-gradient(135deg, #1e293b88, #0ea5b767), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="400"><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="%237c3aed"/><stop offset="1" stop-color="%2306b6d4"/></linearGradient></defs><g fill="none" stroke="url(%23g)" stroke-opacity=".25"><path d="M0 200 Q 350 120 700 200 T 1400 200" stroke-width="3"/><path d="M0 230 Q 350 150 700 230 T 1400 230" stroke-width="2"/></g></svg>') center/cover no-repeat;
    border-radius:18px;
    padding:18px;
    overflow:hidden;
    border:1px solid rgba(255,255,255,.08);
    box-shadow: var(--shadow);
  }
  .brand{
    display:flex;
    gap:12px;
    align-items:center;
  }
  .shield{
    width:42px;
    height:42px;
    border-radius:12px;
    background:linear-gradient(135deg,var(--primary),var(--primary-2));
    display:grid;
    place-items:center;
    color:#fff;
    font-weight:900;
    box-shadow:var(--shadow);
  }
  .title{
    font-weight:800;
    font-size:20px;
    letter-spacing:.3px;
  }
  .trust{
    display:flex;
    gap:10px;
    align-items:center;
    color:var(--muted);
    font-size:12px;
  }
  .trust .dot{
    width:6px;
    height:6px;
    border-radius:50%;
    background:var(--success);
  }
  .theme-toggle{
    display:inline-flex; 
    align-items:center; 
    gap:8px; 
    cursor:pointer;
    padding:8px 12px; 
    border-radius:12px;
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
    transition:transform .25s;
  }
  .theme-toggle:hover{
    transform:translateY(-2px);
  }

   
  .grid{
    display:grid;
    grid-template-columns: 1.1fr .9fr; 
    gap:22px;
  }
  @media (max-width:980px){ 
    .grid{grid-template-columns:1fr; 
    }
   }

  .panel{
    background:var(--panel);
    border:1px solid var(--glass-border);
    border-radius:22px;
    box-shadow:var(--shadow);
    overflow:hidden; position:relative;
  }
  .panel .head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:16px 18px;
    border-bottom:1px solid var(--glass-border);
    background:linear-gradient(180deg, var(--glass), transparent);
  }
  .panel .head h3{
    margin:0;
    font-size:15px;
    letter-spacing:.3px;
  }
  .panel .body{
    padding:18px;
  }

  
  .methods{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
  }
  .method{
    background:var(--glass);
    border:1px solid var(--glass-border);
    border-radius:14px;
    padding:10px 12px;
    display:flex;
    gap:8px;
    align-items:center;
    cursor:pointer;
    user-select:none;
    transition:transform .2s, border-color .2s;
  }
  .method.active{
    outline:2px solid var(--ring); border-color:transparent; transform:translateY(-1px)}
  .badge{
    width:26px;
    height:18px;
    border-radius:4px;
    display:grid;
    place-items:center;
    font-size:10px;
    color:#fff;
    font-weight:700;
  }
  .badge.visa{
    background:#1a6cf0
  }
  .badge.paypal{
    background:#0ea5e9
  }
  .badge.easyp{
    background:#10b981
  }
  .badge.bank{
    background:#64748b
  }

   
  .stack{
    display:grid;
    gap:14px;
  }
  .field{
    display:grid;
    gap:6px;
  }
  .label{
    font-size:12px;
    color:var(--muted);
  }
  .input{
    background:rgba(255,255,255,.04);
    border:1px solid var(--glass-border);
    border-radius:12px; 
    padding:12px 14px; 
    color:var(--text);
    outline:none; 
    transition:border-color .2s, box-shadow .2s, transform .12s;
  }
  .input:focus{
    border-color:transparent; 
    box-shadow:0 0 0 3px var(--ring); 
    transform:scale(1.01);
  }
  .row{display:grid;
    grid-template-columns:1fr 1fr; 
    gap:14px;
  }
  @media (max-width:520px){ 
    .row{grid-template-columns:1fr;
    } 
  }

   
  .card-preview{
    background:linear-gradient(135deg,#1f114a,#0b6480);
    border:1px solid #ffffff22;
    border-radius:18px;
    color:white;
    padding:18px; 
    height:190px; 
    position:relative;
    overflow:hidden; 
    display:flex; 
    flex-direction:column; 
    justify-content:space-between;
    box-shadow: inset 0 0 80px rgba(255,255,255,.05);
    isolation:isolate;
  }
  .card-preview::before{
    content:""; 
    position:absolute; 
    inset:-40% -20% auto auto;
    width:380px; 
    height:380px; 
    border-radius:50%;
    background: radial-gradient(closest-side, #7c3aed55, transparent 60%);
    filter: blur(10px); 
    z-index:-1;
    animation: float 6s ease-in-out infinite alternate;
  }
  @keyframes float{
    to{ 
      transform: translate(-10px, 12px) scale(1.02);
     }
  }
  .chip{
    width:36px;
    height:26px;
    border-radius:6px;
    background:linear-gradient(90deg,#e9d5ff,#f5f5f4);
    opacity:.9;
  }
  .cnum{
    letter-spacing:2.2px;
    font-weight:700;
    font-size:1.05rem;
  }
  .cline{
    display:flex;
    justify-content:space-between;
    gap:12px;
    font-size:.85rem;
    opacity:.9;
  }
  .brand-mini{
    padding:4px 8px;
    border-radius:8px;
    background:#00000066;
    color:#fff;
    font-weight:800;
    font-size:.75rem;
  }

  
  .grid2{display:grid;
    grid-template-columns:1fr 1fr; 
    gap:12px;
  }
  @media (max-width:560px){ 
    .grid2{
      grid-template-columns:1fr;
    } 
  }
  .wallet,.bank{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    border:1px dashed var(--glass-border);
    background:var(--glass);
    border-radius:14px;
    padding:12px 14px;
  }
  .logos{
    display:flex;
    gap:8px;
    align-items:center;
  }
  .logo-pill{
    display:flex;
    align-items:center;
    gap:6px;
    padding:8px 10px;
    border-radius:999px;
    background:rgba(255,255,255,.08);
    border:1px solid var(--glass-border);
    font-size:12px;
  }
  .bank .logo-pill{
    background:rgba(255,255,255,.05)}
  .mini{
    width:18px;
    height:12px;
    border-radius:4px;
  }
  .mini.paypal{
    background:#0ea5e9;
  }
  .mini.easyp{
    background:#10b981
  }
  .mini.hbl{
    background:#0b8e6e
  }
  .mini.ubl{
    background:#0a69a8
  }
  .mini.meezan{
    background:#6d28d9
  }
  .mini.visa{
    background:#1a6cf0
  }
  .mini.mc{
    background:#ef4444
  }

  
  .summary{
    display:grid; 
    gap:12px; 
    font-size:14px;
  }
  .kv{
    display:flex;
    justify-content:space-between; 
    gap:12px; 
    padding:10px 12px;
    background:var(--glass); 
    border:1px solid var(--glass-border); 
    border-radius:12px;
  }
  .total{
    font-weight:900;
    font-size:18px;
  }

   
  .paybar{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    align-items:center; 
    justify-content:space-between;
    padding:14px 18px;
    border-top:1px solid var(--glass-border); 
    background:linear-gradient(180deg,transparent,var(--glass));
  }
  .safe{
    display:flex;
    align-items:center;
    gap:8px;
    color:var(--muted);
    font-size:12px;
  }
  .paybtn{
    background: linear-gradient(135deg, var(--primary), var(--primary-2));
    color:#fff;
    border:none;
    padding:12px 16px;
    border-radius:12px;
    cursor:pointer;
    font-weight:800; 
    letter-spacing:.3px; 
    box-shadow:var(--shadow); 
    transition:transform .2s,filter .2s;
  }
  .paybtn:hover{ 
    transform:translateY(-1.5px); 
    filter:saturate(1.1);
  }
  .ghost{
    background:transparent;
    border:1px dashed var(--glass-border); 
    color:var(--muted);
    padding:12px 14px;
    border-radius:12px; 
    cursor:pointer;
  }

   
  .modal{
    position:fixed; 
    inset:0; 
    display:none; 
    place-items:center; 
    backdrop-filter: blur(6px);
    background: rgba(0,0,0,.4); 
    z-index:50;
  }
  .modal.show{
    display:grid; 
    animation:fade .2s ease;
  }
  @keyframes fade{
    from{
      opacity:0
    }
      to{
        opacity:1
      }
    }
  .sheet{
    width:min(520px, 92vw); 
    background:var(--panel); 
    border:1px solid var(--glass-border);
    border-radius:20px; 
    box-shadow:var(--shadow); 
    overflow:hidden;
  }
  .sheet .top{
    padding:16px 18px;
    border-bottom:1px solid var(--glass-border); 
    display:flex; 
    justify-content:space-between; 
    align-items:center;
  }
  .sheet .cont{
    padding:18px;
  }
  .spinner{
    width:22px;
    height:22px;
    border-radius:50%;
    border:3px solid #ffffff40;
    border-top-color:#fff; 
    animation:spin 1s linear infinite;
  }
  @keyframes spin{
    to{
      transform:rotate(360deg);
    }
  }
  .ok{
    width:42px;
    height:42px;
    border-radius:50%; 
    display:grid; 
    place-items:center;
    background: radial-gradient(90px 90px at 30% 20%, #22c55e, #16a34a);
    color:#fff; 
    font-weight:900;
  }

  
  .hide{
    display:none !important
    }
</style>
</head>
<body class="light">
   
  <div class="wrap">
    <div class="header">
      <div class="brand">
        <div class="shield">HMS</div>
        <div>
          <div class="title">Secure Payments</div>
          <div class="trust"><span class="dot"></span> TLS 1.3 encrypted • PCI-DSS ready • 3D Secure</div>
        </div>
      </div>
      <button class="theme-toggle" id="themeBtn" title="Toggle theme">Theme</button>
    </div>
    
    <div class="grid">
     
      <section class="panel">
        <div class="head">
          <h3>Select Payment Method</h3>
          <div class="methods" id="methodBar">
            <div class="method active" data-tab="card">
              <span class="badge visa">VISA</span><span>Card</span>
            </div>
            <div class="method" data-tab="wallets">
              <span class="badge paypal">WAL</span><span>Wallets</span>
            </div>
            <div class="method" data-tab="bank">
              <span class="badge bank">BNK</span><span>Bank</span>
            </div>
          </div>
        </div>
        
        <div class="body">
          <form action="" method="post">
           
            <div id="tab-card">
              <div class="row" style="margin-bottom:14px">
                <div class="card-preview">
                  <div class="chip"></div>
                  <div class="cnum" id="pv-num">**** **** ****</div>
                  <div class="cline">
                    <div>HOLDER: <strong id="pv-name">IRFSN SHER</strong></div>
                    <div>EXP: <strong id="pv-exp">MM/YY</strong></div>
                  </div>
                  <div class="cline">
                    <div class="brand-mini" id="pv-brand">VISA/MC</div>
                    <div>CVV •••</div>
                  </div>
                </div>
                <br>
                <br>
                <div class="stack">
                  <div class="field">
                    <label class="label">Your Name</label>
                    <input class="input" id="cardNumber" name="name" inputmode="numeric" autocomplete="cc-number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                  </div>
                  <div class="field">
                    <label class="label">Card Number</label>
                    <input class="input" id="cardNumber" name="card_number" inputmode="numeric" autocomplete="cc-number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                  </div>
                  <div class="row">
                    <div class="field">
                      <label class="label">Expiry</label>
                      <input class="input" id="cardExp" name="expiry_date" placeholder="MM/YY" maxlength="5" autocomplete="cc-exp" required>
                    </div>
                    <div class="field">
                      <label class="label">CVV</label>
                      <input class="input" id="cardCvv" name="cvv" placeholder="***" maxlength="4" inputmode="numeric" autocomplete="cc-csc" required>
                    </div>
                  </div>
                  <div class="field">
                    <label class="label">Card Holder Name</label>
                    <input class="input" id="cardName" name="card_holder_name" placeholder="As on card" autocomplete="cc-name" required>
                  </div>
                  <div class="field">
                    <label class="label">Billing Zip</label>
                    <input class="input" id="zip" name="billing_zip" placeholder="12345" inputmode="numeric" maxlength="10" required>
                  </div>
                  <div class="row">
                    <div class="field">
                      <label class="label" >Save this card</label>
                      <select class="input" name="save_card" id="saveCard" required>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="grid2">
                <div class="wallet">
                  <div class="logos">
                    <div class="logo-pill"><span class="mini visa"></span>Visa</div>
                    <div class="logo-pill"><span class="mini mc"></span>Mastercard</div>
                  </div>
                  <small style="color:var(--muted)">3D Secure enabled</small>
                </div>
                <div class="wallet">
                  <div class="logos">
                    <div class="logo-pill"><span class="mini paypal"></span>PayPal</div>
                    <div class="logo-pill"><span class="mini easyp"></span>Easypaisa</div>
                  </div>
                  <small style="color:var(--muted)">Express checkout available</small>
                </div>
              </div>
            </div>
            
           
            <div id="tab-wallets" class="hide">
              <div class="stack">
                <div class="wallet">
                  <div class="logos">
                    <div class="logo-pill"><span class="mini paypal"></span>PayPal</div>
                  </div>
                  <button class="paybtn" id="btnPayPal">Continue</button>
                </div>
                <div class="wallet">
                  <div class="logos">
                    <div class="logo-pill"><span class="mini easyp"></span>Easypaisa</div>
                  </div>
                  <div class="row" style="margin:0; width:55%">
                    <input class="input" id="easypNumber" placeholder="03XX-XXXXXXX" />
                    <button class="paybtn" id="btnEasyp">Get OTP</button>
                  </div>
                </div>
                <p style="color:var(--muted);margin:0 2px">Wallets redirect to their secure pages for approval. You’ll return here to confirm.</p>
              </div>
            </div>
            
          
            <div id="tab-bank" class="hide">
              <div class="stack">
                <div class="bank">
                  <div class="logos">
                    <div class="logo-pill"><span class="mini hbl"></span>HBL</div>
                    <div class="logo-pill"><span class="mini ubl"></span>UBL</div>
                    <div class="logo-pill"><span class="mini meezan"></span>Meezan</div>
                  </div>
                  <small style="color:var(--muted)">IBAN / Account transfer</small>
                </div>
                <div class="row">
                  <div class="field">
                    <label class="label">Select Bank</label>
                    <select class="input" id="bankSel">
                      <option>HBL</option>
                      <option>UBL</option>
                      <option>Meezan</option>
                    </select>
                  </div>
                  <div class="field">
                    <label class="label">Account / IBAN</label>
                    <input class="input" id="iban" placeholder="PK00-XXXX-XXXX-XXXX-XXXX">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Reference (optional)</label>
                  <input class="input" id="ref" placeholder="e.g. Booking #HTL-8472">
                </div>
                <div class="wallet">
                  <div style="display:flex;align-items:center;gap:10px">
                    <div class="spinner"></div><div>Manual verification takes ~2–5 min.</div>
                  </div>
                  <button class="ghost" id="bankUpload">Upload Receipt</button>
                </div>
              </div>
            </div>
            
            <div class="paybar">
              <div class="safe">🔒 256-bit encryption & PSD2 Strong Customer Authentication</div>
              <div style="display:flex; gap:10px; align-items:center">
                <button class="ghost" id="cancelBtn">Cancel</button>
                <button class="paybtn" id="payNow" name="pay_now" onclick="showAlert()">Pay Now</button>
              </div>
            </div>
          </form>
        </div>
        <?php
          if(isset($_POST["pay_now"])) {
            include '../includes/db_connect.php';
            $guest_name = $_POST['name'];
            $card_number = $_POST['card_number'];
            $expiry_date = $_POST['expiry_date'];
            $cvv = $_POST['cvv'];
            $card_holder_name = $_POST['card_holder_name'];
            $billing_zip = $_POST['billing_zip'];
            $save_card = $_POST['save_card'];
            
            
            $conns = "INSERT INTO `payment`(`name`,`card_number`, `expiry_date`, `cvv`, `card_holder_name`, `billing_zip`, `save_card`) VALUES ('$guest_name','$card_number','$expiry_date','$cvv','$card_holder_name','$billing_zip','$save_card')";
            $run = mysqli_query($conn,$conns);
            if($run) {
              echo "<script>alert('Payment Succesfully')</script>";
            }
            
          }
        ?>
      </section>

  
      <aside class="panel">
        <div class="head"><h3>Booking Summary</h3></div>
        <div class="body">
          <div class="summary">
            <div class="kv"><span>Hotel</span><strong>Royal Vista</strong></div>
            <div class="kv"><span>Room</span><strong>Deluxe Sea View</strong></div>
            <div class="kv"><span>Guests</span><strong>2 Adults</strong></div>
            <div class="kv"><span>Check-in</span><strong>12 Oct 2025</strong></div>
            <div class="kv"><span>Check-out</span><strong>15 Oct 2025</strong></div>
            <div class="kv"><span>Nights</span><strong>3</strong></div>
            <div class="kv"><span>Rate</span><strong>$120 / night</strong></div>
            <div class="kv"><span>Taxes & Fees</span><strong>$18</strong></div>
            <div class="kv total"><span>Total</span><strong id="grand">$378</strong></div>
          </div>
          <p style="color:var(--muted);margin-top:10px">By completing this payment you agree to our Cancellation & No-Show Policy.</p>
        </div>
      </aside>
    </div>
  </div>

  
  <div class="modal" id="modal">
    <div class="sheet">
      <div class="top">
        <strong id="mTitle">Processing Payment</strong>
        <button class="ghost" onclick="closeModal()">Close</button>
      </div>
      <div class="cont" id="mBody">
        <div style="display:flex;align-items:center;gap:12px">
          <div class="spinner"></div>
          <div>Please wait while we contact your bank…</div>
        </div>
      </div>
    </div>
  </div>
<center><footer>Secure Payment | Protected by SSL Encryption</footer></center>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function showAlert(){
      Swal.fire({
        title: 'Payment successfully!',
        text: 'Your room has been reserved successfully.',
        icon: 'success',
        confirmButtonText: 'Okay',
        background:'#1e293b', 
        color:'#fff',
        confirmButtonColor:'#3b82f6',
        showClass: { popup: 'animate__animated animate__fadeInDown' },
        hideClass: { popup: 'animate__animated animate__fadeOutUp' }
      });
    }
   
  const themeBtn = document.getElementById('themeBtn');
  themeBtn.addEventListener('click', ()=>{
    document.body.classList.toggle('light');
    themeBtn.textContent = document.body.classList.contains('light') ? 'Theme' : 'Theme';
  });

  
  const tabs = {
    card: document.getElementById('tab-card'),
    wallets: document.getElementById('tab-wallets'),
    bank: document.getElementById('tab-bank')
  };
  document.getElementById('methodBar').addEventListener('click', (e)=>{
    const m = e.target.closest('.method');
    if(!m) return;
    document.querySelectorAll('.method').forEach(x=>x.classList.remove('active'));
    m.classList.add('active');
    const tab = m.dataset.tab;
    Object.keys(tabs).forEach(k => tabs[k].classList.toggle('hide', k!==tab));
  });

   
  const num = document.getElementById('cardNumber');
  const exp = document.getElementById('cardExp');
  const cvv = document.getElementById('cardCvv');
  const nameI = document.getElementById('cardName');

  const pvNum = document.getElementById('pv-num');
  const pvExp = document.getElementById('pv-exp');
  const pvName= document.getElementById('pv-name');
  const pvBrand = document.getElementById('pv-brand');

  function detectBrand(n){
    const s = n.replace(/\s/g,'');
    if(/^4[0-9]{6,}$/.test(s)) return 'VISA';
    if(/^5[1-5][0-9]{5,}$/.test(s)) return 'MASTERCARD';
    if(/^3[47][0-9]{5,}$/.test(s)) return 'AMEX';
    if(/^6(?:011|5[0-9]{2})[0-9]{3,}$/.test(s)) return 'DISC';
    return 'CARD';
  }
  num.addEventListener('input', ()=>{
     
    let v = num.value.replace(/\D/g,'').slice(0,19);
    v = v.match(/.{1,4}/g)?.join(' ') ?? '';
    num.value=v;
    pvNum.textContent = v || '#### #### #### ####';
    pvBrand.textContent = detectBrand(v);
  });
  exp.addEventListener('input', ()=>{
    let v = exp.value.replace(/\D/g,'').slice(0,4);
    if(v.length>=3) v = v.slice(0,2) + '/' + v.slice(2);
    exp.value=v;
    pvExp.textContent = v || 'MM/YY';
  });
  nameI.addEventListener('input', ()=> pvName.textContent = (nameI.value||'YOUR NAME').toUpperCase());

   
  const modal = document.getElementById('modal');
  const mTitle= document.getElementById('mTitle');
  const mBody = document.getElementById('mBody');

  function openModal(){ modal.classList.add('show'); }
  function closeModal(){ modal.classList.remove('show'); }
  window.closeModal = closeModal;

   
  function validCard(){
    const okNum = num.value.replace(/\s/g,'').length >= 13;
    const okExp = /^\d{2}\/\d{2}$/.test(exp.value);
    const okCvv = cvv.value.replace(/\D/g,'').length>=3;
    const okName = nameI.value.trim().length>2;
    return okNum && okExp && okCvv && okName;
  }

  document.getElementById('payNow').addEventListener('click', ()=>{
     
    const activeTab = document.querySelector('.method.active')?.dataset.tab || 'card';

     
    if(activeTab==='card' && !validCard()){
      mTitle.textContent = 'Fix Card Details';
      mBody.innerHTML = `<div style="color:var(--danger);font-weight:700;margin-bottom:8px">Please check your card fields.</div>
        <ul style="margin:0 0 4px 18px;color:var(--muted)">
          <li>Enter valid Card Number</li><li>Use MM/YY expiry</li><li>CVV 3–4 digits</li><li>Card Holder name</li>
        </ul>`;
      openModal(); return;
    }

   
    mTitle.textContent = 'Processing Payment';
    mBody.innerHTML = `<div style="display:flex;align-items:center;gap:12px">
        <div class="spinner"></div><div>Contacting your ${activeTab==='card'?'card issuer':'provider'}…</div>
      </div>`;
    openModal();

    setTimeout(()=>{
      mTitle.textContent='Payment Successful';
      mBody.innerHTML = `
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px">
          <div class="ok">✓</div>
          <div><strong>Thank you!</strong><br><span style="color:var(--muted)">Booking ID:</span> <code>HTL-${Math.floor(Math.random()*9000+1000)}</code></div>
        </div>
        <div class="summary" style="margin-top:12px">
          <div class="kv"><span>Amount Charged</span><strong id="amt">${document.getElementById('grand').textContent}</strong></div>
          <div class="kv"><span>Method</span><strong>${activeTab.toUpperCase()}</strong></div>
          <div class="kv"><span>Status</span><strong style="color:var(--success)">PAID</strong></div>
        </div>
        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:14px">
          <button class="ghost" onclick="closeModal()">Close</button>
          <button class="paybtn" onclick="alert('Invoice download simulated')">Download Invoice</button>
        </div>`;
    }, 1500);
  });

  
  document.getElementById('btnPayPal').addEventListener('click', ()=>{
    mTitle.textContent='Redirecting to PayPal';
    mBody.innerHTML=`<div style="display:flex;align-items:center;gap:12px"><div class="spinner"></div><div>Opening secure PayPal window…</div></div>`;
    openModal();
    setTimeout(()=>{ closeModal(); alert('Demo: PayPal approved, returning to site.'); },1200);
  });
  document.getElementById('btnEasyp').addEventListener('click', ()=>{
    const ph = document.getElementById('easypNumber').value.trim();
    if(ph.length<8){ alert('Enter mobile number for Easypaisa OTP'); return; }
    mTitle.textContent='Easypaisa OTP';
    mBody.innerHTML=`<div class="stack">
      <div>We sent an OTP to <strong>${ph}</strong></div>
      <input class="input" id="otp" placeholder="Enter OTP">
      <div style="display:flex;gap:10px;justify-content:flex-end">
        <button class="ghost" onclick="closeModal()">Cancel</button>
        <button class="paybtn" onclick="closeModal(); alert('OTP verified (demo)')">Verify</button>
      </div>
    </div>`;
    openModal();
  });

   
  document.getElementById('bankUpload').addEventListener('click', ()=>{
    mTitle.textContent='Upload Receipt';
    mBody.innerHTML=`<div class="stack">
      <input type="file" class="input">
      <div style="display:flex;gap:10px;justify-content:flex-end">
        <button class="ghost" onclick="closeModal()">Close</button>
        <button class="paybtn" onclick="closeModal(); alert('Receipt submitted for verification (demo)')">Submit</button>
      </div>
    </div>`;
    openModal();
  });

  
  document.getElementById('cancelBtn').addEventListener('click', ()=>{
    if(confirm('Cancel checkout and return to My Bookings?')){
      alert('Demo: would navigate to My Bookings');
    }
  });
</script>
</body>
</html>
