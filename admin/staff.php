<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Staff Management — Multilingual & Multi-currency</title>
  <style>
    :root{
      --bg:#0f172a;
      --card:#0b1220;
      --muted:#94a3b8;
      --accent:#60a5fa;
      --glass:rgba(255,255,255,0.04);
      --radius:14px}
    [data-theme="light"]{
      --bg:#f6f9fb;
      --card:#ffffff;
      --muted:#475569;
      --accent:#0ea5e9;
      --glass:rgba(2,6,23,0.03)
    }
    *{
      box-sizing:border-box;
      font-family:Inter,Segoe UI,system-ui,-apple-system,"Helvetica Neue",Arial;
    }
    html,body{
      height:100%;
    }
    body{
      margin:0;
      padding:20px;
     background:
      radial-gradient(1200px 800px at 10% -10%, #1e293b 0%, transparent 60%),
      radial-gradient(1000px 700px at 110% 10%, #0b7285 0%, transparent 55%),
      radial-gradient(900px 600px at 50% 120%, #6d28d9 0%, transparent 50%),
      var(--bg);
    color: var(--muted);
    }
    .wrap{
      max-width:1100px;
      margin:0 auto;
      display:grid;
      grid-template-columns:1fr 420px;
      gap:20px;
    }
    @media (max-width:980px){
      .wrap{
        grid-template-columns:1fr;
      }
    }
    header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
    }
    .brand{
      display:flex;
      align-items:center;
      gap:12px;
    }
    .logo{
      width:100px;
      height:48px;
      border-radius:12px;
      background:linear-gradient(135deg,var(--accent),#7c3aed);
      display:grid;
      place-items:center;
      color:white;
      font-weight:800;
    }
    h1{
      margin:0;
      font-size:18px;
    }
    .controls{
      display:flex;
      gap:8px;
      align-items:center;
    }
    .select{
      padding:8px;
      border-radius:10px;
      border:1px solid var(--glass);
      background:var(--card);
      color:var(--muted);
    }
    .btn{
      padding:10px 14px;
      border-radius:10px;
      border:0;
      background:var(--accent);
      color:#fff;
      cursor:pointer;
    }
    .card{
      background:linear-gradient(180deg, rgba(255,255,255,0.02), transparent);
      padding:14px;
      border-radius:14px;
      border:1px solid var(--glass);
    }
    .search{
      padding:8px 10px;
      border-radius:10px;
      background:var(--card);
      border:1px solid var(--glass);
    }
    .search input{
      border:0;
      background:transparent;
      outline:none;
      color:var(--muted);
    }
    table{
      width:100%;
      border-collapse:collapse;
      margin-top:12px;
    }
    th,td{
      padding:10px 12px;
      text-align:left;
    }
    .avatar{
      width:44px;
      height:44px;
      border-radius:10px;
      display:grid;
      place-items:center;
      background:linear-gradient(135deg,#34d399,#60a5fa);
      color:white;
    }
    .ops{
      display:flex;
      gap:8px
    }
    .icon{
      padding:6px;
      border-radius:8px;
      border:1px solid var(--glass);
      background:var(--card);
      cursor:pointer;
    }
    .fab{
      position:fixed;
      right:26px;
      bottom:26px;
      background:var(--accent);
      width:64px;
      height:64px;
      border-radius:18px;
      display:grid;
      place-items:center;
      color:white;
      font-weight:800;
      border:0
    }
    .modal-backdrop{
      position:fixed;
      inset:0;
      display:none;
      align-items:center;
      justify-content:center;
      background:linear-gradient(180deg, rgba(2,6,23,0.6), rgba(2,6,23,0.7));
      padding:20px;
    }
    .modal{
      width:100%;
      max-width:760px;
      background:var(--card);
      border-radius:14px;
      padding:18px;
      border:1px solid var(--glass);
    }
    .form-grid{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:10px;
    }
    label{
      font-size:13px;
      color:var(--muted);
      display:block;
      margin-bottom:6px;
    }
    input,select,textarea{
      padding:10px;
      border-radius:10px;
      border:1px solid var(--glass);
      background:transparent;
      color:var(--muted);
      outline:none;
    }
    .drawer{
      position:fixed;
      right:0;
      top:0;
      height:100vh;
      width:420px;
      background:var(--card);
      border-left:1px solid var(--glass);
      padding:18px;
      transform:translateX(120%);
      transition:transform .25s;
    }
    .drawer.open{
      transform:translateX(0);
    }
  </style>
</head>
<body data-theme="dark">
  <div class="wrap">
    <div>
      <header>
        <div class="brand">
          <div class="logo">HMS</div>
          <div>
            <h1 id="title">Staff Management</h1>
            <div id="subtitle" style="font-size:13px;color:var(--muted)">Manage staff — multilingual & multi-currency</div>
          </div>
        </div>

        <div class="controls">
          <select id="lang" class="select" title="Language">
            <option value="en">English</option>
            <option value="ur">اردو (Urdu)</option>
            <option value="es">Español</option>
          </select>

          <select id="currency" class="select" title="Currency">
            <option value="PKR">PKR - ₨</option>
            <option value="USD">USD - $</option>
            <option value="AED">AED - د.إ</option>
            <option value="EUR">EUR - €</option>
          </select>

          <div class="search card">
            <input id="q" placeholder="Search..." />
          </div>

          <button id="themeToggle" class="btn">Theme</button>
          <button id="openAdd" class="btn">+ Add</button>
        </div>
      </header>

      <section class="card" style="margin-top:12px">
        <table aria-live="polite">
          <thead>
            <tr>
              <th id="th_member">Member</th>
              <th id="th_role">Role</th>
              <th id="th_phone">Phone</th>
              <th id="th_shift">Shift</th>
              <th id="th_actions">Actions</th>
            </tr>
          </thead>
          <tbody id="tbody"></tbody>
        </table>
        <div id="empty" style="display:none;padding:24px;text-align:center;color:var(--muted)"></div>
      </section>
    </div>

    <aside>
      <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center">
          <div>
            <div id="stat_total" style="font-weight:700;font-size:22px">0</div>
            <div style="font-size:13px;color:var(--muted)" id="stat_total_label">Total Staff</div>
          </div>
          <div style="font-size:22px;color:var(--accent)">👥</div>
        </div>
        <hr />
        <div style="margin-top:10px">
          <div style="font-size:13px;color:var(--muted)" id="stat_roles_label">Unique Roles</div>
          <div id="stat_roles" style="font-weight:700">0</div>
        </div>
      </div>
    </aside>
  </div>

  <button id="fab" class="fab">+</button>

 
  <div id="backdrop" class="modal-backdrop">
    <div class="modal" role="dialog" aria-modal="true">
      <h3 id="modalTitle">Add Staff</h3>
      <form id="staffForm">
        <div class="form-grid">
          <div>
            <label id="lbl_name">Full name</label>
            <input id="name" required />
          </div>
          <div>
            <label id="lbl_role">Role</label>
            <input id="role" required />
          </div>
          <div>
            <label id="lbl_email">Email</label>
            <input id="email" type="email" />
          </div>
          <div>
            <label id="lbl_phone">Phone</label>
            <input id="phone" />
          </div>
          <div>
            <label id="lbl_shift">Shift</label>
            <select id="shift">
              <option value="Morning">Morning</option>
              <option value="Evening">Evening</option>
              <option value="Night">Night</option>
              <option value="Flexible">Flexible</option>
            </select>
          </div>
          <div>
            <label id="lbl_salary">Salary</label>
            <input id="salary" type="number" />
          </div>
          <div class="full">
            <label id="lbl_notes">Notes / Bio</label>
            <textarea id="notes" rows="3"></textarea>
          </div>
        </div>
        <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:12px">
          <button type="button" id="closeModal" class="btn" style="background:transparent;border:1px solid var(--glass);color:var(--muted)">Cancel</button>
          <button type="submit" class="btn">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Drawer -->
  <aside id="drawer" class="drawer" aria-hidden="true">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <div>
        <h3 id="dname">Name</h3>
        <div id="drole" style="color:var(--muted)">Role</div>
      </div>
      <div style="display:flex;gap:8px">
        <div id="editBtn" class="icon">✏️</div>
        <div id="delBtn" class="icon">🗑️</div>
      </div>
    </div>
    <hr />
    <div style="margin-top:12px">
      <div style="color:var(--muted)" id="demail_label">Email</div>
      <div id="demail"></div>
      <div style="color:var(--muted);margin-top:8px" id="dphone_label">Phone</div>
      <div id="dphone"></div>
      <div style="color:var(--muted);margin-top:8px" id="dshift_label">Shift</div>
      <div id="dshift"></div>
      <div style="color:var(--muted);margin-top:8px" id="dsalary_label">Salary</div>
      <div id="dsalary"></div>
      <div style="color:var(--muted);margin-top:8px" id="dnotes_label">Notes</div>
      <div id="dnotes"></div>
    </div>
  </aside>

  <input id="filein" type="file" accept="application/json" style="display:none" />

  <script>
  
    const i18n = {
      en: {
        title: 'Staff Management', subtitle:'Manage staff — multilingual & multi-currency', add:'Add', save:'Save', cancel:'Cancel',
        member:'Member', role:'Role', phone:'Phone', shift:'Shift', actions:'Actions', search:'Search...', total:'Total Staff', uniqueRoles:'Unique Roles',
        fullName:'Full name', email:'Email', salary:'Salary', notes:'Notes / Bio', shiftOpt:['Morning','Evening','Night','Flexible'], empty:'No staff found — add using the button.'
      },
      ur: {
        title: 'اسٹاف مینجمنٹ', subtitle:'اسٹاف کا انتظام — کثیراللغت و کرنسی', add:'نیا', save:'محفوظ کریں', cancel:'منسوخ',
        member:'ممبر', role:'عہدہ', phone:'فون', shift:'شفٹ', actions:'عمل', search:'تلاش کریں...', total:'کل اسٹاف', uniqueRoles:'منفرد عہدے',
        fullName:'پورا نام', email:'ای میل', salary:'تنخواہ', notes:'نوٹس / تعارف', shiftOpt:['صبح','شام','رات','لچکدار'], empty:'کوئی اسٹاف نہیں ملا — بٹن سے شامل کریں.'
      },
      es: {
        title: 'Gestión de Personal', subtitle:'Gestiona el personal — multilingüe y multicurrency', add:'Añadir', save:'Guardar', cancel:'Cancelar',
        member:'Miembro', role:'Rol', phone:'Teléfono', shift:'Turno', actions:'Acciones', search:'Buscar...', total:'Personal Total', uniqueRoles:'Roles Únicos',
        fullName:'Nombre completo', email:'Correo', salary:'Salario', notes:'Notas / Bio', shiftOpt:['Mañana','Tarde','Noche','Flexible'], empty:'No hay personal — añade usando el botón.'
      }
    }

    const currencyData = {
      PKR: {symbol:'₨', rate:1},
      USD: {symbol:'$', rate:0.0036},
      AED: {symbol:'د.إ', rate:0.013},
      EUR: {symbol:'€', rate:0.0033}
    }

   
    const S = name=>document.getElementById(name)
    const tbody = S('tbody'), empty = S('empty'), q = S('q'), langSel = S('lang'), curSel = S('currency'),
          backdrop = S('backdrop'), staffForm = S('staffForm'), openAdd = S('openAdd'), fab = S('fab'), closeModal = S('closeModal'),
          modalTitle = S('modalTitle'), drawer = S('drawer'), dname=S('dname'), drole=S('drole'), demail=S('demail'), dphone=S('dphone'), dshift=S('dshift'), dsalary=S('dsalary'), dnotes=S('dnotes')

   
    let staff = [], editId = null
    const seed = [
      {id:genId(),name:'Ayesha Khan',role:'Front Desk Manager',email:'ayesha@hotel.com',phone:'+92 300 1112233',shift:'Morning',salary:90000,notes:'Experienced in luxury hotels'},
      {id:genId(),name:'Imran Ali',role:'Housekeeping Head',email:'imran@hotel.com',phone:'+92 312 4445566',shift:'Evening',salary:60000,notes:'Manages 20 staff'}
    ]

    function genId(){return 's_'+Math.random().toString(36).slice(2,9)}

   
    function saveSettings(){localStorage.setItem('hm_settings', JSON.stringify({lang:langSel.value, currency:curSel.value, theme:document.body.getAttribute('data-theme')}))}
    function loadSettings(){try{const s=JSON.parse(localStorage.getItem('hm_settings'))||{}; if(s.lang) langSel.value=s.lang; if(s.currency) curSel.value=s.currency; if(s.theme) document.body.setAttribute('data-theme',s.theme)}catch(e){}}

    function save(){localStorage.setItem('hm_staff',JSON.stringify(staff));}
    function load(){try{staff=JSON.parse(localStorage.getItem('hm_staff'))||[]; if(!staff.length){staff=seed; save()}}catch(e){staff=[]}}

    
    function t(k){const L = i18n[langSel.value]||i18n.en; return L[k]||''}
    function applyTranslations(){const L=i18n[langSel.value]||i18n.en;
      S('title').innerText = L.title; S('subtitle').innerText = L.subtitle; S('modalTitle').innerText = L.add + ' ' + L.member || L.add;
      S('lbl_name').innerText = L.fullName; S('lbl_role').innerText = L.role; S('lbl_email').innerText = L.email; S('lbl_phone').innerText = L.phone;
      S('lbl_shift').innerText = L.shift; S('lbl_salary').innerText = L.salary; S('lbl_notes').innerText = L.notes;
      S('th_member').innerText = L.member; S('th_role').innerText = L.role; S('th_phone').innerText = L.phone; S('th_shift').innerText = L.shift; S('th_actions').innerText = L.actions;
      q.placeholder = L.search; S('stat_total_label').innerText = L.total; S('stat_roles_label').innerText = L.uniqueRoles; empty.innerText = L.empty;
      const shift = S('shift'); shift.innerHTML = ''; (L.shiftOpt||[]).forEach(opt=>{const o=document.createElement('option'); o.value=opt; o.innerText=opt; shift.appendChild(o)})
    }

   
    function formatSalary(amount){const cur = curSel.value || 'PKR'; const data = currencyData[cur]||currencyData.PKR; const converted = Math.round(amount * data.rate); return `${data.symbol} ${Intl.NumberFormat().format(converted)}` }

    
    function render(filter=''){
      tbody.innerHTML=''
      const rows = staff.filter(s=>{const qv = filter.trim().toLowerCase(); if(!qv) return true; return (s.name+s.role+s.email+s.phone).toLowerCase().includes(qv) })
      if(!rows.length){empty.style.display='block'; tbody.style.display='none'}else{empty.style.display='none'; tbody.style.display='table-row-group'}
      rows.forEach(s=>{
        const tr=document.createElement('tr')
        tr.innerHTML = `
          <td style="padding:8px">
            <div style="display:flex;gap:12px;align-items:center">
              <div class="avatar">${initials(s.name)}</div>
              <div>
                <div style="font-weight:700;color:var(--muted)">${s.name}</div>
                <div style="font-size:13px;color:var(--muted)">${s.email||'—'}</div>
              </div>
            </div>
          </td>
          <td><div style="padding:6px;border-radius:8px;background:rgba(255,255,255,0.02);display:inline-block">${s.role}</div></td>
          <td>${s.phone||'—'}</td>
          <td>${s.shift||'—'}</td>
          <td>
            <div class="ops">
              <div class="icon" data-id="${s.id}" data-action="view">🔍</div>
              <div class="icon" data-id="${s.id}" data-action="edit">✏️</div>
              <div class="icon" data-id="${s.id}" data-action="del">🗑️</div>
            </div>
          </td>
        `
        tbody.appendChild(tr)
      })
      S('stat_total').innerText = staff.length
      S('stat_roles').innerText = new Set(staff.map(s=>s.role)).size
    }

    function initials(name){return name.split(' ').map(n=>n[0]).slice(0,2).join('').toUpperCase()}

   
    function openModal(mode='add',data=null){backdrop.style.display='flex'; S('name').value=data?data.name:''; S('role').value=data?data.role:''; S('email').value=data?data.email:''; S('phone').value=data?data.phone:''; S('shift').value=data?data.shift:'Morning'; S('salary').value=data?data.salary:''; S('notes').value=data?data.notes:''; editId = data?data.id:null; modalTitle.innerText = mode==='add'? (i18n[langSel.value]||i18n.en).add + ' ' + (i18n[langSel.value]||i18n.en).member : (i18n[langSel.value]||i18n.en).save }
    function closeModalFn(){backdrop.style.display='none'; staffForm.reset(); editId=null}

    staffForm.addEventListener('submit',e=>{e.preventDefault(); const obj={id: editId||genId(), name:S('name').value.trim(), role:S('role').value.trim(), email:S('email').value.trim(), phone:S('phone').value.trim(), shift:S('shift').value, salary: Number(S('salary').value)||0, notes:S('notes').value||''}; if(editId){ staff = staff.map(s=>s.id===editId?obj:s) }else{ staff.unshift(obj) } save(); render(q.value); closeModalFn() })

   
    tbody.addEventListener('click',e=>{const el=e.target.closest('[data-action]'); if(!el) return; const id=el.dataset.id; const action=el.dataset.action; const found=staff.find(s=>s.id===id); if(action==='view'){openDrawer(found)} if(action==='edit'){openModal('edit',found)} if(action==='del'){ if(confirm((i18n[langSel.value]||i18n.en).cancel + ' ?')){ staff = staff.filter(s=>s.id!==id); save(); render(q.value); closeDrawer() } } })

    function openDrawer(s){ if(!s) return; drawer.classList.add('open'); drawer.setAttribute('aria-hidden','false'); dname.innerText = s.name; drole.innerText = s.role; demail.innerText = s.email||'—'; dphone.innerText = s.phone||'—'; dshift.innerText = s.shift||'—'; dsalary.innerText = formatSalary(s.salary); dnotes.innerText = s.notes||'—'; S('editBtn').onclick = ()=>openModal('edit',s); S('delBtn').onclick = ()=>{ if(confirm('Delete this staff?')){ staff = staff.filter(x=>x.id!==s.id); save(); render(q.value); closeDrawer() } } }
    function closeDrawer(){ drawer.classList.remove('open'); drawer.setAttribute('aria-hidden','true') }

    
    q.addEventListener('input',e=>render(e.target.value))

    S('themeToggle').addEventListener('click',()=>{ const cur = document.body.getAttribute('data-theme'); document.body.setAttribute('data-theme', cur==='dark'?'light':'dark'); saveSettings() })

   
    langSel.addEventListener('change',()=>{ applyTranslations(); saveSettings(); })
    curSel.addEventListener('change',()=>{ saveSettings(); render(q.value) })

   
    openAdd.addEventListener('click',()=>openModal('add'))
    fab.addEventListener('click',()=>openModal('add'))
    closeModal.addEventListener('click',closeModalFn)
    backdrop.addEventListener('click',e=>{ if(e.target===backdrop) closeModalFn() })

   
    S('filein').addEventListener('change',e=>{ const f=e.target.files[0]; if(!f) return; const r=new FileReader(); r.onload=ev=>{ try{ const data=JSON.parse(ev.target.result); if(Array.isArray(data)){ staff = data; save(); render(); alert('Imported') }else alert('Invalid file') }catch(err){alert('Invalid JSON')} }; r.readAsText(f) })

    S('fab').addEventListener('click',()=>openModal('add'))

   
    document.addEventListener('keydown',e=>{ if(e.ctrlKey && e.key==='e'){ e.preventDefault(); const blob = new Blob([JSON.stringify(staff,null,2)],{type:'application/json'}); const url = URL.createObjectURL(blob); const a=document.createElement('a'); a.href=url; a.download='staff_export.json'; a.click(); URL.revokeObjectURL(url) } if(e.key==='Escape'){ closeModalFn(); closeDrawer() } if(e.key==='/' && document.activeElement.tagName!=='INPUT' && document.activeElement.tagName!=='TEXTAREA'){ e.preventDefault(); q.focus() } })

  
    loadSettings(); load(); applyTranslations(); render();
  </script>
</body>
</html>
