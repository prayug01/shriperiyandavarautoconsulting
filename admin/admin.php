<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sri Periyandavar Auto Consulting Admin | Premium Control Center</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Syne:wght@800&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<style>
  :root {
    --sidebar-bg: #0A192F;
    --sidebar-hover: rgba(255, 255, 255, 0.05);
    --sidebar-active-bg: rgba(0, 180, 216, 0.1);
    --accent: #00B4D8;
    --bg-color: #F1F5F9;
    --text-main: #0F172A;
    --text-muted: #64748B;
    --border-color: #E2E8F0;
    --white: #FFFFFF;
    
    --green-text: #16A34A;
    --red-text: #DC2626;
    --badge-orange-bg: #FFEDD5;
    --badge-orange-text: #C2410C;
    --badge-red-bg: #FEE2E2;
    --badge-red-text: #EF4444;
    --badge-green-bg: #DCFCE7;
    --badge-green-text: #15803D;
    --badge-blue-bg: #DBEAFE;
    --badge-blue-text: #1E3A8A;
    --badge-gray-bg: #F1F5F9;
    --badge-gray-text: #475569;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
  body { display: flex; height: 100vh; background-color: var(--bg-color); color: var(--text-main); overflow: hidden; }
  .hidden { display: none !important; }

  /* ================= SIDEBAR ================= */
  .sidebar { width: 260px; background-color: var(--sidebar-bg); color: #94A3B8; display: flex; flex-direction: column; flex-shrink: 0; transition: transform 0.3s ease; z-index: 10000; }
  .brand { display: flex; align-items: center; gap: 12px; padding: 24px; color: var(--white); border-bottom: 1px solid rgba(255,255,255,0.05); }
  .brand-logo { width: 40px; height: 40px; border-radius: 8px; object-fit: cover; }
  .brand-text h1 { font-size: 16px; font-weight: 700; letter-spacing: 0.5px; }
  .brand-text span { font-size: 10px; color: var(--accent); letter-spacing: 1px; text-transform: uppercase; font-weight: 600; }
  
  .menu-section { font-size: 11px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; padding: 24px 24px 8px 24px; color: #475569; }
  .nav-item { display: flex; align-items: center; justify-content: space-between; padding: 12px 24px; cursor: pointer; transition: 0.2s; font-size: 14px; font-weight: 500; border-left: 3px solid transparent; color: #94A3B8; text-decoration: none; }
  .nav-item:hover { background-color: var(--sidebar-hover); color: var(--white); }
  .nav-item.active { background-color: var(--sidebar-active-bg); color: var(--accent); border-left-color: var(--accent); }
  .nav-item-left { display: flex; align-items: center; gap: 12px; }
  .nav-icon { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
  .badge-red { background-color: #EF4444; color: white; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 12px; }

  .admin-profile { margin-top: auto; padding: 20px; border-top: 1px solid rgba(255,255,255,0.05); }
  .admin-card { display: flex; align-items: center; gap: 12px; background-color: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px; }
  .admin-avatar { width: 36px; height: 36px; background-color: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--sidebar-bg); font-weight: 700; }
  .admin-info h4 { font-size: 13px; color: var(--white); font-weight: 600; }
  .admin-info span { font-size: 11px; color: #94A3B8; }

  /* ================= MAIN CONTENT ================= */
  .main-content { flex: 1; display: flex; flex-direction: column; overflow-y: auto; position: relative; }
  .topbar { display: flex; justify-content: space-between; align-items: center; background-color: var(--white); padding: 16px 32px; border-bottom: 1px solid var(--border-color); position: sticky; top: 0; z-index: 10; }
  .page-header { display: flex; align-items: center; }
  .page-header h2 { font-size: 22px; font-weight: 700; color: var(--text-main); margin-bottom: 2px; }
  .page-header .breadcrumb { font-size: 13px; color: var(--text-muted); }
  
  .topbar-actions { display: flex; align-items: center; gap: 16px; }
  .status-indicator { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-muted); font-weight: 500; }
  .dot { width: 8px; height: 8px; background-color: #22C55E; border-radius: 50%; }
  .dot.offline { background-color: #EF4444; }

  .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 9px 16px; font-size: 14px; font-weight: 600; border-radius: 6px; cursor: pointer; transition: 0.2s; border: none; }
  .btn-primary { background-color: #0A192F; color: var(--white); }
  .btn-accent { background: var(--accent); color: #fff; }
  .btn-outline { background-color: var(--white); border: 1px solid var(--border-color); color: var(--text-main); }
  .btn-outline:hover { background-color: #f8fafc; }
  .btn-danger { background-color: #EF4444; color: white; }
  
  .btn-action-blue:hover { background-color: #1d4ed8 !important; }
  .btn-action-green:hover { background-color: #15803d !important; }
  .btn-action-red:hover { background-color: #b91c1c !important; }
  .btn-action-purple { background-color: #8B5CF6; color: white; }
  .btn-action-purple:hover { background-color: #7C3AED !important; }

  .view-section { display: none; padding: 32px; max-width: 1400px; margin: 0 auto; width: 100%; animation: fadeIn 0.3s ease; }
  .view-section.active { display: block; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

  /* ================= TABS ================= */
  .tabs { display: flex; gap: 24px; border-bottom: 1px solid var(--border-color); margin-bottom: 24px; overflow-x: auto; white-space: nowrap; padding-bottom: 5px; align-items: center; }
  .tab-btn { padding-bottom: 12px; font-size: 14px; font-weight: 600; color: var(--text-muted); cursor: pointer; border-bottom: 2px solid transparent; transition: 0.2s; }
  .tab-btn:hover { color: var(--text-main); }
  .tab-btn.active { color: var(--accent); border-bottom-color: var(--accent); }

  /* FILTER DROPDOWN */
  .sort-dropdown { margin-left: auto; padding: 6px 12px; border: 1px solid var(--border-color); border-radius: 6px; font-size: 13px; font-family: inherit; font-weight: 500; color: var(--text-main); outline: none; cursor: pointer; background-color: #f8fafc; }

  /* ================= METRIC CARDS ================= */
  .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 24px; }
  .stat-card { background-color: var(--white); padding: 24px; border-radius: 12px; border: 1px solid var(--border-color); position: relative; overflow: hidden; display: flex; flex-direction: column; gap: 12px; }
  .stat-card::after { content: ''; position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; border-radius: 50%; opacity: 0.4; }
  .stat-card:nth-child(1)::after { background-color: #E0F2FE; } .stat-card:nth-child(2)::after { background-color: #F1F5F9; } .stat-card:nth-child(3)::after { background-color: #FEE2E2; } .stat-card:nth-child(4)::after { background-color: #DCFCE7; } 
  .stat-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; z-index: 2; }
  .stat-card:nth-child(1) .stat-icon { background-color: #E0F2FE; color: #0284C7; } .stat-card:nth-child(2) .stat-icon { background-color: #F1F5F9; color: #475569; } .stat-card:nth-child(3) .stat-icon { background-color: #FEE2E2; color: #DC2626; } .stat-card:nth-child(4) .stat-icon { background-color: #DCFCE7; color: #16A34A; }
  .stat-title { font-size: 11px; font-weight: 700; color: #94A3B8; text-transform: uppercase; z-index: 2; }
  .stat-value { font-family: 'Inter', sans-serif; font-size: 36px; font-weight: 800; color: var(--sidebar-bg); line-height: 1; letter-spacing: -1px; z-index: 2; margin: 4px 0; }
  .stat-trend { font-size: 13px; font-weight: 600; z-index: 2; }
  .trend-green { color: var(--green-text); } .trend-red { color: var(--red-text); }

  /* ================= DATA TABLES ================= */
  .bottom-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
  .card { background-color: var(--white); border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden; display: flex; flex-direction: column; margin-bottom: 24px; }
  .card-header { padding: 20px 24px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;}
  .card-title { font-size: 16px; font-weight: 700; color: var(--text-main); }
  .card-body { padding: 24px; }

  table { width: 100%; border-collapse: collapse; text-align: left; }
  th { background-color: #F8FAFC; padding: 14px 24px; font-size: 11px; font-weight: 700; color: #94A3B8; text-transform: uppercase; border-bottom: 1px solid var(--border-color); white-space: nowrap; }
  td { padding: 18px 24px; font-size: 14px; color: var(--text-main); border-bottom: 1px solid var(--border-color); vertical-align: middle; }
  .font-bold { font-weight: 700; }

  /* GROUP HEADER ROW CSS */
  .group-header { background-color: #f1f5f9; padding: 10px 24px; font-size: 14px; font-weight: 700; color: #0f172a; border-bottom: 1px solid var(--border-color); text-transform: uppercase; letter-spacing: 0.5px;}

  .badge { display: inline-flex; align-items: center; justify-content: center; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; white-space: nowrap; }
  .badge-orange { background-color: var(--badge-orange-bg); color: var(--badge-orange-text); }
  .badge-red-outline { background-color: var(--badge-red-bg); color: var(--badge-red-text); padding: 4px 10px; font-size: 11px; border: 1px solid var(--badge-red-text); }
  .badge-green { background-color: var(--badge-green-bg); color: var(--badge-green-text); }
  .badge-blue { background-color: var(--badge-blue-bg); color: var(--badge-blue-text); }
  .badge-purple { background-color: #EDE9FE; color: #6D28D9; } 
  .badge-gray { background-color: var(--badge-gray-bg); color: var(--badge-gray-text); }
  
  .badge-days { background-color: #E2E8F0; color: #0F172A; margin-left: 10px; padding: 2px 8px; font-size: 11px; border-radius: 4px; }
  .badge-days.overdue { background-color: #FEE2E2; color: #DC2626; border: 1px solid #DC2626; }
  .badge-days.today { background-color: #DCFCE7; color: #16A34A; border: 1px solid #16A34A; }

  .alert-list { display: flex; flex-direction: column; margin: 0; padding: 0; }
  .alert-item { display: flex; flex-direction: row; justify-content: space-between; align-items: center; padding: 16px 24px; border-bottom: 1px solid var(--border-color); }
  .alert-item:last-child { border-bottom: none; }
  .alert-info { display: flex; flex-direction: column; gap: 4px; }
  .alert-info h4 { font-size: 14px; font-weight: 700; color: var(--text-main); margin: 0; }
  .alert-info span { font-size: 12px; color: var(--text-muted); font-weight: 500; }

  /* FORMS */
  .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px; }
  .form-group { display: flex; flex-direction: column; gap: 8px; }
  .form-group.full { grid-column: 1 / -1; }
  .form-group label { font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; }
  .form-group input, .form-group select, .form-group textarea { padding: 12px 16px; border: 1px solid var(--border-color); border-radius: 6px; font-size: 14px; outline: none; font-family: 'Inter', sans-serif; }
  .img-preview { width: 50px; height: 50px; border-radius: 6px; object-fit: cover; background: #eee; }

  /* STOCK PANEL LOGIC */
  .stock-summary-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
  .stock-box { padding: 20px; border-radius: 8px; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; }
  .stock-box .val { font-family: 'Inter', sans-serif; font-size: 32px; font-weight: 800; line-height: 1; margin-bottom: 8px; }
  .stock-box .lbl { font-size: 12px; color: #94A3B8; font-weight: 500; }
  .sb-gray { background: #F8FAFC; } .sb-gray .val { color: #334155; }
  .sb-green { background: #F0FDF4; } .sb-green .val { color: #16A34A; }
  .sb-orange { background: #FFF7ED; } .sb-orange .val { color: #EA580C; }
  .sb-red { background: #FEF2F2; } .sb-red .val { color: #DC2626; }

  .stock-bar-container { flex: 1; height: 6px; background: var(--border-color); border-radius: 4px; margin-right: 12px; overflow: hidden; display: flex; }
  .stock-bar-fill { height: 100%; transition: width 0.3s ease; border-radius: 4px; }
  .stock-bar-fill.high { background: var(--green-text); }
  .stock-bar-fill.low { background: var(--badge-orange-text); }
  .stock-bar-fill.empty { background: var(--red-text); }

  /* ================= MODAL STYLES ================= */
  .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 10000; opacity: 0; transition: opacity 0.3s; }
  .modal-overlay.active { display: flex; opacity: 1; }
  
  .modal-content { background: var(--white); width: 95%; max-width: 850px; border-radius: 12px; padding: 32px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); transform: translateY(-20px); transition: transform 0.3s; max-height: 90vh; overflow-y: auto; }
  
  .modal-overlay.active .modal-content { transform: translateY(0); }
  .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px; }
  .modal-title { font-size: 1.25rem; font-weight: 700; color: var(--text-main); }
  .close-btn { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted); }
  
  .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }
  .detail-item { display: flex; flex-direction: column; gap: 4px; }
  .detail-label { font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; }
  .detail-value { font-size: 0.95rem; font-weight: 500; color: var(--text-main); word-break: break-word; }
  
  .pw-reset-section { background: var(--gray-100); padding: 20px; border-radius: 8px; border: 1px solid var(--border-color); margin-top: 24px; }

  .search-input { padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; font-size: 13px; width: 100%; max-width: 300px; outline: none; font-family: 'Inter', sans-serif; transition: 0.2s; }
  .search-input:focus { border-color: var(--accent); }

  /* ================= RESPONSIVE DESIGN LOGIC ================= */
  .mobile-nav-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9998; display: none; opacity: 0; transition: opacity 0.3s; }
  .mobile-nav-overlay.active { display: block; opacity: 1; }
  .menu-toggle { display: none; background: transparent; border: none; font-size: 1.8rem; color: var(--text-main); cursor: pointer; margin-right: 15px; }

  @media (max-width: 1024px) {
      .bottom-grid { grid-template-columns: 1fr; }
      .stock-summary-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 992px) {
      .sidebar { position: fixed; top: 0; left: 0; height: 100%; transform: translateX(-100%); z-index: 9999; }
      .sidebar.active { transform: translateX(0); }
      .menu-toggle { display: block; }
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 576px) {
      .stats-grid { grid-template-columns: 1fr; }
      .stock-summary-grid { grid-template-columns: 1fr; }
      .topbar { padding: 15px 20px; }
      .page-header h2 { font-size: 1.2rem; }
      .view-section { padding: 20px 15px; }
      .detail-grid { grid-template-columns: 1fr; }
      .card-header { flex-direction: column; align-items: flex-start; gap: 10px; }
      .card-header .btn { width: 100%; text-align: center; margin-top: 10px; }
      .search-input { max-width: 100%; }
      .form-grid { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

  <div class="mobile-nav-overlay" id="mobile-overlay" onclick="toggleSidebar()"></div>

  <aside class="sidebar">
    <div class="brand">
      <i class="ti ti-car" style="font-size: 2.2rem; color: var(--accent); margin-right: 8px;"></i>
      <div class="brand-text"><h1>Sri Periyandavar</h1><span>Auto Consulting</span></div>
    </div>
    <div class="menu-section">Overview</div>
    <div class="nav-item active" data-tab="dashboard" onclick="switchTab('dashboard', this)">
      <div class="nav-item-left"><svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg> Dashboard</div>
    </div>
    <div class="nav-item" data-tab="orders" onclick="switchTab('orders', this)">
      <div class="nav-item-left"><svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Orders</div>
      <span class="badge-red" id="nav-pending-orders">0</span>
    </div>
    <div class="menu-section">Inventory</div>
    <div class="nav-item" data-tab="products" onclick="switchTab('products', this)">
      <div class="nav-item-left"><svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 16.2A23.06 23.06 0 0 1 12 22a23.06 23.06 0 0 1-8-5.8M12 2v20M2 12h20"></path></svg> Products</div>
    </div>
    <div class="nav-item" data-tab="stock" onclick="switchTab('stock', this)">
      <div class="nav-item-left"><svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="16" y1="4" x2="16" y2="20"></line><line x1="8" y1="4" x2="8" y2="20"></line><line x1="4" y1="8" x2="20" y2="8"></line><line x1="4" y1="16" x2="20" y2="16"></line></svg> Stock Management</div>
      <span class="badge-red" id="nav-low-stock">0</span>
    </div>
    <div class="menu-section">Business</div>
    <div class="nav-item" data-tab="customers" onclick="switchTab('customers', this)">
      <div class="nav-item-left"><svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> Customers</div>
    </div>
    <div class="nav-item" onclick="window.location.href='../index.php'">
      <div class="nav-item-left"><svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"></path></svg> View Shop Frontend</div>
    </div>

    <div class="admin-profile">
      <div class="admin-card">
        <div class="admin-avatar">A</div>
        <div class="admin-info"><h4>Admin</h4><span>SPAC Owner</span></div>
      </div>
      <button onclick="logoutAdmin()" style="width: 100%; margin-top: 15px; padding: 10px; background: rgba(220, 38, 38, 0.1); color: #EF4444; border: 1px solid rgba(220, 38, 38, 0.2); border-radius: 6px; font-weight: 600; cursor: pointer; transition: 0.2s;">Logout</button>
    </div>
  </aside>

  <main class="main-content">
    <header class="topbar">
      <div class="page-header">
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <div>
            <h2 id="page-title">Dashboard</h2>
            <div class="breadcrumb" id="page-crumb">Admin → Overview</div>
        </div>
      </div>
      <div class="topbar-actions">
        <div class="status-indicator" id="db-status"><div class="dot"></div> Database Connected</div>
      </div>
    </header>

    <div id="view-dashboard" class="view-section active">
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg></div>
          <div class="stat-title">TOTAL ORDERS TODAY</div><div class="stat-value" id="val-orders">0</div><div class="stat-trend trend-green">Live from DB</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg></div>
          <div class="stat-title">TOTAL PRODUCTS</div><div class="stat-value" id="val-products">0</div><div class="stat-trend trend-green">Active in shop</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></div>
          <div class="stat-title">LOW STOCK ALERTS</div><div class="stat-value" id="val-lowstock">0</div><div class="stat-trend trend-red">Needs restock</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div>
          <div class="stat-title">TOTAL CUSTOMERS</div><div class="stat-value" id="val-customers">0</div><div class="stat-trend trend-green">Registered users</div>
        </div>
      </div>
      <div class="bottom-grid">
        <div class="card" style="grid-column: 1 / -1;">
          <div class="card-header"><h3 class="card-title">Recent Orders</h3><button class="btn btn-outline" style="padding:6px 12px;font-size:13px;" onclick="switchTab('orders', document.querySelector('.nav-item[data-tab=\'orders\']'))">View All</button></div>
          <div style="overflow-x: auto; width: 100%;">
            <table style="min-width: 600px;"><thead><tr><th>ORDER #</th><th>PHONE</th><th>ORDER DETAILS</th><th>AMOUNT</th><th>STATUS</th></tr></thead><tbody id="dash-orders-table"></tbody></table>
          </div>
        </div>
      </div>
      <div class="card" style="margin-top: 24px;">
        <div class="card-header"><h3 class="card-title">Stock Alerts</h3></div><div class="alert-list" id="dash-stock-alerts"></div>
      </div>
    </div>

    <div id="view-orders" class="view-section">
      <div class="tabs">
        <div class="tab-btn active" onclick="filterOrders('all', this)">All Orders</div>
        <div class="tab-btn" onclick="filterOrders('Processing', this)">Processing</div>
        <div class="tab-btn" onclick="filterOrders('Accepted', this)">Accepted</div>
        <div class="tab-btn" onclick="filterOrders('Out for Delivery', this)">Out for Delivery</div>
        <div class="tab-btn" onclick="filterOrders('Delivered', this)">Delivered</div>
        <div class="tab-btn" onclick="filterOrders('Cancelled', this)">Cancelled</div>
        
        <select class="sort-dropdown" id="order-sort-filter" onchange="renderOrdersTable()">
            <option value="nearest">Nearest Delivery Date</option>
            <option value="furthest">Furthest Delivery Date</option>
            <option value="newest">Newest Order First</option>
        </select>
      </div>
      <div class="card">
        <div class="card-header"><h3 class="card-title">Order Management</h3></div>
        <div style="overflow-x: auto; width: 100%;">
            <table style="min-width: 1000px;"><thead><tr><th>ORDER #</th><th>CUSTOMER & CONTACT</th><th>ORDER DETAILS</th><th>DELIVERY SLOT</th><th>AMOUNT</th><th>STATUS</th><th>ACTION</th></tr></thead><tbody id="full-orders-table"></tbody></table>
        </div>
      </div>
    </div>

    <div id="view-products" class="view-section">
      <div class="card" style="margin-bottom: 24px;">
        <div class="card-header"><h3 class="card-title" id="product-form-title">Add New Product</h3></div>
        <div class="card-body">
          <input type="hidden" id="p-id">
          <input type="hidden" id="p-hidden-stock" value="0"> 
          
          <div class="form-grid">
            <div class="form-group"><label>Product Name</label><input type="text" id="p-name" placeholder="e.g. Maruti Suzuki Swift"></div>
            <div class="form-group"><label>Category</label>
              <select id="p-category">
                <option value="SUV">SUV</option>
                <option value="Sedan">Sedan</option>
                <option value="Hatchback">Hatchback</option>
                <option value="Electric">Electric</option>
                <option value="General">General</option>
              </select>
            </div>
            <div class="form-group"><label>Price (₹)</label><input type="text" id="p-price" placeholder="e.g. 245000"></div>
            
            <div class="form-group"><label>Selling Unit</label>
              <select id="p-unit">
                <option value="pcs" selected>Pieces (pcs)</option>
              </select>
            </div>

            <div class="form-group"><label>Year</label><input type="number" id="p-year" value="2020" placeholder="e.g. 2018"></div>
            <div class="form-group"><label>Kms Driven</label><input type="text" id="p-kms" placeholder="e.g. 45,000"></div>
            
            <div class="form-group"><label>Transmission</label>
              <select id="p-transmission">
                <option value="Manual" selected>Manual</option>
                <option value="Automatic">Automatic</option>
              </select>
            </div>
            <div class="form-group"><label>Fuel Type</label>
              <select id="p-fuel">
                <option value="Petrol" selected>Petrol</option>
                <option value="Diesel">Diesel</option>
                <option value="Electric">Electric</option>
                <option value="Hybrid">Hybrid</option>
                <option value="CNG">CNG</option>
              </select>
            </div>
            
            <div class="form-group"><label>Owner</label>
              <select id="p-owner">
                <option value="1st Owner" selected>1st Owner</option>
                <option value="2nd Owner">2nd Owner</option>
                <option value="3rd Owner">3rd Owner</option>
                <option value="4th Owner">4th Owner</option>
                <option value="4th+ Owner">4th+ Owner</option>
              </select>
            </div>
            <div class="form-group"><label>Condition</label>
              <select id="p-condition_text">
                <option value="Excellent" selected>Excellent</option>
                <option value="Very Good">Very Good</option>
                <option value="Good">Good</option>
                <option value="Fair">Fair</option>
              </select>
            </div>
            
            <div class="form-group"><label>Fitness Up To</label><input type="text" id="p-fitness" placeholder="e.g. 2035"></div>
            <div class="form-group"><label>Insurance Details</label><input type="text" id="p-insurance" placeholder="e.g. Comprehensive Nov 2026"></div>
            
            <div class="form-group"><label>Tax Details</label><input type="text" id="p-tax" placeholder="e.g. Life Time Paid"></div>
            <div class="form-group"><label>Location</label><input type="text" id="p-location" value="Madurai" placeholder="e.g. Madurai"></div>
            
            <div class="form-group"><label>Final Offer (Price display text)</label><input type="text" id="p-final_offer" placeholder="e.g. ₹2,45,000"></div>
            <div class="form-group"><label>WhatsApp Contact Number</label><input type="text" id="p-contact" value="8098364254" placeholder="e.g. 8098364254"></div>
            
            <div class="form-group"><label>Upload Cover Image</label><input type="file" id="p-image" accept="image/*"></div>
            <div class="form-group"><label>Upload Gallery Images (Select Multiple)</label><input type="file" id="p-images" accept="image/*" multiple></div>
            
            <div class="form-group full"><label>Internal Product Note / Comment</label><textarea id="p-comment" rows="1" placeholder="Sourced locally..."></textarea></div>
            
            <div class="form-group full" style="flex-direction: row; align-items: center; gap: 10px;">
              <input type="checkbox" id="p-hidden" style="width: auto; transform: scale(1.2); margin-left: 4px;">
              <label for="p-hidden" style="margin: 0; cursor: pointer; color: var(--red-text);">Hide product from customer storefront</label>
            </div>
          </div>
          <div style="display:flex; justify-content: flex-end; gap:10px; margin-top: 20px;">
            <button class="btn btn-outline" onclick="document.getElementById('p-name').value=''; document.getElementById('p-price').value=''; document.getElementById('p-image').value=''; document.getElementById('p-images').value=''; document.getElementById('p-comment').value='';">Clear</button>
            <button class="btn btn-accent" id="btn-submit-product" onclick="submitProduct('add')">Add Product</button>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h3 class="card-title">Product Catalog</h3></div>
        <div style="overflow-x: auto; width: 100%;">
            <table style="min-width: 800px;">
              <thead><tr><th>IMAGE</th><th>CAR NAME</th><th>SPECS</th><th>PRICE</th><th>DETAILS & NOTE</th><th>ACTION</th></tr></thead>
              <tbody id="full-products-table"><tr><td colspan="6">Loading data...</td></tr></tbody>
            </table>
        </div>
      </div>
    </div>

    <div id="view-stock" class="view-section">
      <div class="card" style="margin-bottom: 24px;">
        <div class="card-header">
            <h3 class="card-title">Stock Summary</h3>
        </div>
        <div class="card-body">
          <div class="stock-summary-grid">
            <div class="stock-box sb-gray"><div class="val" id="sum-total">0</div><div class="lbl">Total Products</div></div>
            <div class="stock-box sb-green"><div class="val" id="sum-in">0</div><div class="lbl">In Stock</div></div>
            <div class="stock-box sb-orange"><div class="val" id="sum-low">0</div><div class="lbl">Low Stock</div></div>
            <div class="stock-box sb-red"><div class="val" id="sum-out">0</div><div class="lbl">Out of Stock</div></div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Product Stock Levels</h3>
        </div>
        <div style="overflow-x: auto; width: 100%;">
            <table style="min-width: 800px;">
              <thead><tr><th>PRODUCT</th><th>CATEGORY</th><th>PRICE</th><th>STOCK LEVEL</th><th>STATUS</th><th>ADJUST</th></tr></thead>
              <tbody id="full-stock-table"></tbody>
            </table>
        </div>
      </div>
    </div>

    <div id="view-customers" class="view-section">
      <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
          <h3 class="card-title">Customer Details</h3>
          <input type="text" id="search-customers" class="search-input" placeholder="Search by name, phone, or ID..." oninput="renderCustomersTable()">
        </div>
        <div style="overflow-x: auto; width: 100%;">
          <table style="min-width: 1000px;">
            <thead>
              <tr>
                <th>SYSTEM ID</th>
                <th>NAME</th>
                <th>PHONE</th>
                <th>ADDRESS</th>
                <th>LANDMARK</th>
                <th>PINCODE</th>
                <th>GPS</th>
                <th>ROLE</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody id="full-customers-table"></tbody>
          </table>
        </div>
      </div>
    </div>

    <div id="customer-modal" class="modal-overlay">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Customer Profile</h3>
          <button class="close-btn" onclick="closeCustomerModal()">×</button>
        </div>
        <div class="detail-grid" id="customer-detail-grid"></div>
        <div class="pw-reset-section">
          <h4 style="font-size: 1rem; margin-bottom: 12px; color: var(--text-main);">Security: Reset Password</h4>
          <div style="display: flex; gap: 10px;">
            <input type="text" id="new-password-input" placeholder="Enter new password" style="flex: 1; padding: 10px 12px; border: 1px solid var(--border-color); border-radius: 6px; outline: none; font-size: 14px;">
            <button class="btn btn-danger" onclick="resetCustomerPassword()" style="padding: 10px 20px;">Reset Password</button>
          </div>
          <input type="hidden" id="reset-customer-id">
        </div>
      </div>
    </div>

    <div id="whatsapp-prompt-modal" class="modal-overlay" style="z-index: 10001;">
      <div class="modal-content" style="max-width: 450px; text-align: center; padding: 40px 30px;">
        <div style="width: 65px; height: 65px; background: #dcfce7; color: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto;">
            <svg width="34" height="34" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        </div>
        <h3 style="margin-top:0; color: var(--primary-navy); font-size: 1.5rem;">Action Successful</h3>
        <p style="color: var(--text-muted); margin-bottom: 30px; line-height: 1.5;">The system has been updated. Would you like to notify the customer via WhatsApp?</p>
        <div style="display: flex; gap: 15px; justify-content: center;">
          <button class="btn btn-outline" style="padding: 10px 24px;" onclick="closeWaPrompt()">No, Skip</button>
          <button class="btn" style="background: #25D366; color: white; padding: 10px 24px;" onclick="confirmSendWa()">Yes, Send WhatsApp</button>
        </div>
      </div>
    </div>

    <div id="order-modal" class="modal-overlay">
        <div class="modal-content" style="max-width: 850px; padding: 0;">
          <div class="modal-header" style="padding: 20px 30px; margin-bottom: 0; background: #f8fafc; border-radius: 12px 12px 0 0;">
            <h3 class="modal-title">Order Fulfillment Details</h3>
            <button class="close-btn" onclick="closeOrderModal()">×</button>
          </div>
          
          <div id="printable-receipt" style="padding: 30px; background: white; color: black; overflow-x: auto;">
              </div>
          
          <div style="display: flex; justify-content: flex-end; gap: 10px; padding: 20px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; border-radius: 0 0 12px 12px;" id="order-modal-footer">
            </div>
        </div>
    </div>

    <div id="edit-product-modal" class="modal-overlay">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="edit-modal-title">Edit Product</h3>
          <button class="close-btn" onclick="closeEditModal()">×</button>
        </div>
        
        <div class="card-body" style="padding: 0;">
          <input type="hidden" id="edit-p-existing-images">
          <div class="form-grid">
            <div class="form-group"><label>Product Name</label><input type="text" id="edit-p-name"></div>
            <div class="form-group"><label>Category</label>
              <select id="edit-p-category">
                <option value="SUV">SUV</option>
                <option value="Sedan">Sedan</option>
                <option value="Hatchback">Hatchback</option>
                <option value="Electric">Electric</option>
                <option value="General">General</option>
              </select>
            </div>
            <div class="form-group"><label>Price (₹)</label><input type="text" id="edit-p-price"></div>
            
            <div class="form-group"><label>Selling Unit</label>
              <select id="edit-p-unit">
                <option value="pcs" selected>Pieces (pcs)</option>
              </select>
            </div>
            
            <div class="form-group"><label>Year</label><input type="number" id="edit-p-year"></div>
            <div class="form-group"><label>Kms Driven</label><input type="text" id="edit-p-kms"></div>
            
            <div class="form-group"><label>Transmission</label>
              <select id="edit-p-transmission">
                <option value="Manual">Manual</option>
                <option value="Automatic">Automatic</option>
              </select>
            </div>
            <div class="form-group"><label>Fuel Type</label>
              <select id="edit-p-fuel">
                <option value="Petrol">Petrol</option>
                <option value="Diesel">Diesel</option>
                <option value="Electric">Electric</option>
                <option value="Hybrid">Hybrid</option>
                <option value="CNG">CNG</option>
              </select>
            </div>
            
            <div class="form-group"><label>Owner</label>
              <select id="edit-p-owner">
                <option value="1st Owner">1st Owner</option>
                <option value="2nd Owner">2nd Owner</option>
                <option value="3rd Owner">3rd Owner</option>
                <option value="4th Owner">4th Owner</option>
                <option value="4th+ Owner">4th+ Owner</option>
              </select>
            </div>
            <div class="form-group"><label>Condition</label>
              <select id="edit-p-condition_text">
                <option value="Excellent">Excellent</option>
                <option value="Very Good">Very Good</option>
                <option value="Good">Good</option>
                <option value="Fair">Fair</option>
              </select>
            </div>
            
            <div class="form-group"><label>Fitness Up To</label><input type="text" id="edit-p-fitness"></div>
            <div class="form-group"><label>Insurance Details</label><input type="text" id="edit-p-insurance"></div>
            
            <div class="form-group"><label>Tax Details</label><input type="text" id="edit-p-tax"></div>
            <div class="form-group"><label>Location</label><input type="text" id="edit-p-location"></div>
            
            <div class="form-group"><label>Final Offer (Price display text)</label><input type="text" id="edit-p-final_offer"></div>
            <div class="form-group"><label>WhatsApp Contact Number</label><input type="text" id="edit-p-contact"></div>
            
            <div class="form-group"><label>Update Cover Image (Optional)</label><input type="file" id="edit-p-image" accept="image/*"></div>
            <div class="form-group"><label>Update Gallery Images (Select Multiple, Optional)</label><input type="file" id="edit-p-images" accept="image/*" multiple></div>
            
            <div class="form-group full"><label>Internal Product Note / Comment</label><textarea id="edit-p-comment" rows="1" placeholder="Sourced locally..."></textarea></div>
            
            <div class="form-group full" style="flex-direction: row; align-items: center; gap: 10px;">
              <input type="checkbox" id="edit-p-hidden" style="width: auto; transform: scale(1.2); margin-left: 4px;">
              <label for="edit-p-hidden" style="margin: 0; cursor: pointer; color: var(--red-text);">Hide product from customer storefront</label>
            </div>
          </div>
          <div style="display:flex; justify-content: flex-end; gap:10px; margin-top: 20px;">
            <button class="btn btn-outline" onclick="closeEditModal()">Cancel</button>
            <button class="btn btn-accent" id="btn-update-product" onclick="submitProduct('edit')">Save Changes</button>
          </div>
        </div>
      </div>
    </div>

    <div id="stock-modal" class="modal-overlay">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Adjust Stock Levels</h3>
          <button class="close-btn" onclick="closeStockModal()">×</button>
        </div>
        <div class="card-body" style="padding: 0; text-align: left;">
          <div class="form-group" style="margin-bottom: 20px;">
            <label>Select Product</label>
            <select id="stock-product-select" onchange="updateStockModalInfo()"><option value="">Choose product...</option></select>
          </div>
          
          <div id="stock-modal-display-box" style="margin-bottom: 20px; border: 1px solid var(--border-color); border-radius: 8px; overflow: hidden; display: none;">
            <div style="display: flex; align-items: center; justify-content: space-between; background: #F8FAFC;">
              <div style="flex: 1; padding: 16px; text-align: center; background: #f1f5f9;">
                <span style="font-size: 11px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; display: block; margin-bottom: 6px;">Current Stock</span>
                <span id="stock-modal-current-val" style="font-size: 20px; font-weight: 800; color: var(--text-main);">0 kg</span>
              </div>
              <div style="padding: 0 10px; color: #cbd5e1; background: #fff; height: 100%; display: flex; align-items: center;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </div>
              <div style="flex: 1; padding: 16px; text-align: center; background: #ecfdf5;">
                <span style="font-size: 11px; font-weight: 700; color: #065f46; text-transform: uppercase; display: block; margin-bottom: 6px;">New Quantity</span>
                <span id="stock-preview-val" style="font-size: 20px; font-weight: 800; color: var(--text-muted);">0 kg</span>
              </div>
            </div>
          </div>

          <div class="form-grid">
            <div class="form-group">
              <label>Movement Type</label>
              <select id="stock-movement" onchange="calculateStockPreview()">
                <option value="add">Add Stock (+)</option>
                <option value="remove">Remove Stock (−)</option>
                <option value="set">Set Exact Quantity</option>
              </select>
            </div>
            <div class="form-group">
              <label>Quantity (kg / pcs)</label>
              <input type="number" id="stock-qty-input" placeholder="e.g. 10" oninput="calculateStockPreview()">
            </div>
          </div>

          <div style="display:flex; justify-content: flex-end; gap:10px; margin-top: 25px;">
            <button class="btn btn-outline" onclick="closeStockModal()">Cancel</button>
            <button class="btn btn-primary" id="btn-save-stock" onclick="submitStockMovement()">Save Stock Movement</button>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script>
    const API_URL = 'api.php';
    const LOW_STOCK_THRESHOLD = 5;
    let globalData = { orders: [], products: [], users: [] };
    let currentOrderFilter = 'all';
    let currentViewedOrder = null;
    let pendingWaOrder = null;
    let pendingWaStatus = null;

    function numberToWords(num) {
        var a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
        var b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return; var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';
        return str.trim() + ' Only';
    }

    function calculateDaysRemaining(deliveryDateStr) {
        if (!deliveryDateStr) return null;
        
        // Use local timezone dates
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Reset to midnight for accurate day comparison
        
        const dDate = new Date(deliveryDateStr);
        dDate.setHours(0, 0, 0, 0);
        
        const diffTime = dDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        return diffDays;
    }

    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
        document.getElementById('mobile-overlay').classList.toggle('active');
    }

    function switchTab(tabId, element) {
        localStorage.setItem('adminLastTab', tabId);
        document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
        if (!element) {
            element = document.querySelector(`.nav-item[data-tab="${tabId}"]`);
        }
        if (element) {
            element.classList.add('active');
        }
        document.querySelectorAll('.view-section').forEach(el => el.classList.remove('active'));
        document.getElementById(`view-${tabId}`).classList.add('active');
        
        const titles = { 
            'dashboard': { t: 'Dashboard', c: 'Admin → Overview' }, 
            'orders': { t: 'Orders Directory', c: 'Admin → Orders' }, 
            'products': { t: 'Product Catalog', c: 'Admin → Inventory → Products' }, 
            'stock': { t: 'Stock Management', c: 'Admin → Inventory → Stock' },
            'customers': { t: 'Customers', c: 'Admin → Business → Customers' }
        };
        document.getElementById('page-title').innerText = titles[tabId].t;
        document.getElementById('page-crumb').innerText = titles[tabId].c;

        if(window.innerWidth <= 992) {
            document.querySelector('.sidebar').classList.remove('active');
            document.getElementById('mobile-overlay').classList.remove('active');
        }
    }

    function filterOrders(status, element) {
        currentOrderFilter = status;
        document.querySelectorAll('#view-orders .tab-btn').forEach(btn => btn.classList.remove('active'));
        if (element) element.classList.add('active');
        renderOrdersTable();
    }

    async function fetchData() {
        try {
            const sessRes = await fetch(`${API_URL}?action=check_session`, { credentials: 'include' });
            const sessData = await sessRes.json();
            
            if (sessData.status !== 'active') {
                window.location.href = 'admin-login.html'; 
                return;
            }

            const res = await fetch(`${API_URL}?action=get_admin_data`, { credentials: 'include' });
            if (!res.ok) throw new Error('DB connection failed.');
            globalData = await res.json();
            document.getElementById('db-status').innerHTML = `<div class="dot"></div> Database Connected`;
            
            const savedTab = localStorage.getItem('adminLastTab') || 'dashboard';
            switchTab(savedTab, null);

            renderAllViews();
        } catch (error) {
            console.error("Fetch Data Error:", error);
            document.getElementById('db-status').innerHTML = `<div class="dot offline"></div> Database Offline`;
            document.getElementById('db-status').style.color = '#EF4444';
        }
    }

    async function logoutAdmin() {
        await fetch(`${API_URL}?action=admin_logout`, { credentials: 'include' });
        window.location.href = 'admin-login.html';
    }

    function renderOrdersTable() {
        let filteredOrders = currentOrderFilter === 'all' 
            ? globalData.orders 
            : globalData.orders.filter(o => o.status === currentOrderFilter);

        let groupedOrdersMap = {};
        for (let order of filteredOrders) {
            let dateKey = order.delivery_date || 'No Date Specified';
            if (!groupedOrdersMap[dateKey]) groupedOrdersMap[dateKey] = [];
            groupedOrdersMap[dateKey].push(order);
        }

        let groupedOrdersArr = [];
        for (let date in groupedOrdersMap) {
            let orders = groupedOrdersMap[date];
            let allCompleted = orders.every(o => o.status === 'Delivered' || o.status === 'Cancelled');
            let diff = (date === 'No Date Specified') ? 99999 : calculateDaysRemaining(date);
            groupedOrdersArr.push({ date, orders, allCompleted, diff });
        }

        groupedOrdersArr.sort((a, b) => {
            // 1. Completed groups always go to the bottom
            if (a.allCompleted && !b.allCompleted) return 1;
            if (!a.allCompleted && b.allCompleted) return -1;
            
            // 2. Sort by Date Diff (Overdue -> Today -> 1 day -> 2 days)
            const sortFilter = document.getElementById('order-sort-filter').value;
            if (sortFilter === 'furthest') {
                return b.diff - a.diff;
            } else {
                return a.diff - b.diff; // nearest / newest will sort nearest first
            }
        });

        let finalHtml = '';

        for (let group of groupedOrdersArr) {
            let date = group.date;
            let diff = group.diff;
            let allCompleted = group.allCompleted;
            let orders = group.orders;

            // Generate dynamic time remaining text
            let timeBadge = '';
            if (date !== 'No Date Specified') {
                if (allCompleted) {
                    timeBadge = `<span class="badge-days" style="background-color:#F8FAFC; color:#64748B; border:1px solid #E2E8F0;">✓ All Completed</span>`;
                } else {
                    if (diff < 0) {
                        timeBadge = `<span class="badge-days overdue">Overdue (${Math.abs(diff)} days ago)</span>`;
                    } else if (diff === 0) {
                        timeBadge = `<span class="badge-days today">Today</span>`;
                    } else if (diff === 1) {
                        timeBadge = `<span class="badge-days">Tomorrow</span>`;
                    } else {
                        timeBadge = `<span class="badge-days">In ${diff} days</span>`;
                    }
                }
            }

            // Group Header Row
            finalHtml += `
                <tr>
                    <td colspan="7" class="group-header">
                        📅 Delivery Date: ${date} ${timeBadge} <span style="color:var(--text-muted); font-size:12px; margin-left:10px; font-weight: 500; text-transform: none;">(${orders.length} Orders)</span>
                    </td>
                </tr>
            `;

            // Orders inside that group
            finalHtml += orders.map(o => {
                const statusClass = { 
                    'Delivered': 'badge-green', 
                    'Out for Delivery': 'badge-blue', 
                    'Accepted': 'badge-purple', 
                    'Processing': 'badge-orange', 
                    'Cancelled': 'badge-red-outline' 
                }[o.status] || 'badge-orange';
                
                const customer = globalData.users.find(u => u.phone === o.customer_phone) || {};
                const custName = customer.name || o.customer_name || 'Anonymous User';
                
                const hasGPS = o.lat && o.lng && o.lat !== "0";
                
                // FIXED GPS URL FOR GOOGLE MAPS DIRECTIONS
                const mapUrl = hasGPS ? `https://www.google.com/maps/dir/?api=1&destination=${o.lat},${o.lng}` : '';
                const locLink = hasGPS ? `<a href="${mapUrl}" target="_blank" style="color:var(--accent); text-decoration:underline; font-size:12px;">📍 Maps Navigation</a>` : `<span style="color:#94a3b8; font-size:12px;">No GPS</span>`;

                let itemsHtml = '<span style="color:var(--text-muted); font-size:12px;">No items</span>';
                if (o.items) {
                    try {
                        const parsed = JSON.parse(o.items);
                        itemsHtml = `<div style="display:flex; flex-direction:column; gap:4px;">` + 
                            Object.keys(parsed).map(k => {
                                let u = parsed[k].unit || 'kg';
                                return `
                                <div style="font-size:12px; color:var(--text-main); display:flex; justify-content:space-between; width: 180px; border-bottom: 1px dashed #eee; padding-bottom: 2px;">
                                    <span style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">${k}</span>
                                    <b>${parsed[k].qty} ${u}</b>
                                </div>
                            `}).join('') + `</div>`;
                    } catch(e) {}
                }

                return `<tr style="background-color: #fff;">
                    <td class="font-bold">#${o.id}</td>
                    <td>
                        <div style="font-weight:600; color:var(--primary-navy);">${custName}</div>
                        <div style="color:var(--text-muted); font-size:12px; margin-bottom:4px;">${o.customer_phone}</div>
                        ${locLink}
                    </td>
                    <td>${itemsHtml}</td>
                    <td>
                        <div style="color:var(--text-muted); font-size:13px; font-weight:600;">${o.delivery_slot || 'No slot'}</div>
                    </td>
                    <td class="font-bold">₹${o.total}</td>
                    <td><span class="badge ${statusClass}">${o.status}</span></td>
                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap; align-items:center;">
                            <button class="btn btn-outline" style="padding:6px 12px; font-size:12px; color:#475569; border-color:#cbd5e1;" onclick="viewOrder(${o.id})">👁️ View</button>
                            
                            ${(o.status !== 'Delivered' && o.status !== 'Cancelled') ? `
                                ${o.status === 'Processing' ? `<button class="btn btn-action-purple" style="padding:6px 12px; font-size:12px; border:none;" onclick="updateOrder(${o.id}, 'Accepted')">Accept</button>` : ''}
                                
                                <button class="btn btn-action-blue" style="padding:6px 12px; font-size:12px; background-color:#2563EB; color:white; border:none;" onclick="updateOrder(${o.id}, 'Out for Delivery')">Out for Delivery</button>
                                <button class="btn btn-action-green" style="padding:6px 12px; font-size:12px; background-color:var(--green-text); color:white; border:none;" onclick="updateOrder(${o.id}, 'Delivered')">Delivered</button>
                                <button class="btn btn-action-red" style="padding:6px 12px; font-size:12px; background-color:var(--red-text); color:white; border:none;" onclick="updateOrder(${o.id}, 'Cancelled')">Cancel</button>
                            ` : `<span style="color:#64748B; font-size:12px; font-weight: 600; margin-left:5px;">${o.status === 'Cancelled' ? 'Cancelled' : 'Completed'}</span>`}
                        </div>
                    </td>
                </tr>`;
            }).join('');
        }

        document.getElementById('full-orders-table').innerHTML = finalHtml || `<tr><td colspan="7" style="text-align:center;">No orders found in this category.</td></tr>`;
    }

    function renderCustomersTable() {
        const customersList = globalData.users.filter(u => u.role === 'customer');
        const searchQuery = (document.getElementById('search-customers')?.value || '').toLowerCase().trim();

        const filteredList = customersList.filter(c => {
            if (!searchQuery) return true;
            const name = (c.name || '').toLowerCase();
            const phone = (c.phone || '').toLowerCase();
            const idStr = `uid-${c.id}`.toLowerCase();
            return name.includes(searchQuery) || phone.includes(searchQuery) || idStr.includes(searchQuery);
        });

        document.getElementById('full-customers-table').innerHTML = filteredList.map(c => {
            const addr1 = c.address_1 || '';
            const addr2 = c.address_2 || '';
            const fullAddress = [addr1, addr2].filter(Boolean).join(', ') || '<span style="color:var(--text-muted)">Not provided</span>';
            const landmark = c.landmark || '<span style="color:var(--text-muted)">—</span>';
            
            const lat = c.lat && c.lat !== "0" ? c.lat : '';
            const lng = c.lng && c.lng !== "0" ? c.lng : '';
            
            const gps = lat && lng ? `<a href="https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}" target="_blank" style="color:var(--accent); text-decoration:underline;">${lat}, ${lng}</a>` : '<span style="color:var(--text-muted)">Not set</span>';

            return `
            <tr>
                <td class="font-bold">#UID-${c.id}</td>
                <td style="font-weight:600;">${c.name || 'Anonymous User'}</td>
                <td>${c.phone}</td>
                <td style="max-width: 200px; font-size: 13px; line-height: 1.4;">${fullAddress}</td>
                <td style="font-size: 13px;">${landmark}</td>
                <td class="font-bold">${c.pincode || '<span style="color:var(--text-muted); font-weight:normal;">—</span>'}</td>
                <td style="font-size: 13px;">${gps}</td>
                <td><span class="badge badge-blue">Customer</span></td>
                <td>
                    <button class="btn btn-outline" style="padding: 6px 12px; font-size: 12px;" onclick="viewCustomer(${c.id})">View</button>
                </td>
            </tr>
            `;
        }).join('') || `<tr><td colspan="9" style="text-align:center;padding:24px;color:#64748B;">No matching customer records found.</td></tr>`;
    }

    function renderAllViews() {
        const lowStockItems = globalData.products.filter(p => parseFloat(p.stock) > 0 && parseFloat(p.stock) < LOW_STOCK_THRESHOLD && p.is_hidden != 1);
        const outOfStockItems = globalData.products.filter(p => parseFloat(p.stock) <= 0 && p.is_hidden != 1);
        const pendingOrders = globalData.orders.filter(o => o.status === 'Processing');
        const customersList = globalData.users.filter(u => u.role === 'customer');

        document.getElementById('val-orders').textContent = globalData.orders.length;
        document.getElementById('val-products').textContent = globalData.products.filter(p => p.is_hidden != 1).length;
        document.getElementById('val-lowstock').textContent = lowStockItems.length + outOfStockItems.length;
        document.getElementById('val-customers').textContent = customersList.length;
        document.getElementById('nav-pending-orders').textContent = pendingOrders.length;
        document.getElementById('nav-low-stock').textContent = lowStockItems.length + outOfStockItems.length;

        const dashOrders = document.getElementById('dash-orders-table');
        if(globalData.orders.length > 0) {
            dashOrders.innerHTML = globalData.orders.slice(0,5).map(o => {
                const statusClass = { 
                    'Delivered': 'badge-green', 
                    'Out for Delivery': 'badge-blue',
                    'Accepted': 'badge-purple', 
                    'Processing': 'badge-orange', 
                    'Cancelled': 'badge-red-outline' 
                }[o.status] || 'badge-orange';
                
                let itemsHtml = '<span style="color:var(--text-muted); font-size:12px;">No items</span>';
                if (o.items) {
                    try {
                        const parsed = JSON.parse(o.items);
                        itemsHtml = `<div style="display:flex; flex-direction:column; gap:4px;">` + 
                            Object.keys(parsed).map(k => {
                                let u = parsed[k].unit || 'kg';
                                return `
                                <div style="font-size:12px; color:var(--text-main); display:flex; justify-content:space-between; width: 180px; border-bottom: 1px dashed #eee; padding-bottom: 2px;">
                                    <span>${k}</span>
                                    <b>${parsed[k].qty} ${u}</b>
                                </div>
                            `}).join('') + `</div>`;
                    } catch(e) {}
                }

                return `<tr>
                    <td class="font-bold">#${o.id}</td>
                    <td>${o.customer_phone}</td>
                    <td>${itemsHtml}</td>
                    <td class="font-bold">₹${o.total}</td>
                    <td><span class="badge ${statusClass}">${o.status}</span></td>
                </tr>`;
            }).join('');
        } else {
            dashOrders.innerHTML = `<tr><td colspan="5" style="text-align:center;">No orders logged today.</td></tr>`;
        }

        const alertsList = document.getElementById('dash-stock-alerts');
        const allAlerts = [...outOfStockItems, ...lowStockItems];
        if (allAlerts.length > 0) {
            alertsList.innerHTML = allAlerts.slice(0,6).map(p => {
                let unit = p.unit || 'kg';
                return `<div class="alert-item"><div class="alert-info"><h4>${p.name}</h4><span>${p.stock} ${unit} remaining</span></div><span class="badge badge-red-outline">${parseFloat(p.stock)<=0 ? 'Out' : 'Low'}</span></div>`;
            }).join('');
        } else {
            alertsList.innerHTML = `<div style="padding:24px;text-align:center;color:#16A34A;font-weight:600;">✓ All stock parameters normal.</div>`;
        }

        renderOrdersTable();

        document.getElementById('full-products-table').innerHTML = globalData.products.map(p => {
            const isHidden = p.is_hidden == 1;
            const hiddenBadge = isHidden ? `<br><span class="badge badge-red-outline" style="margin-top: 4px; border: 1px solid var(--red-text); background: var(--badge-red-bg);">Hidden</span>` : '';
            const hideBtnText = isHidden ? 'Show' : 'Hide';
            const hideBtnColor = isHidden ? 'var(--text-muted)' : 'var(--accent-red)';
            const toggleState = isHidden ? 0 : 1;
            const priceFormatted = formatCarPrice(p.price);

            const specs = `
                <div style="font-size: 12px; color: var(--text-muted); line-height: 1.4;">
                    <strong>Year:</strong> ${p.year || '—'}<br>
                    <strong>Kms:</strong> ${p.kms || '—'} km<br>
                    <strong>Fuel:</strong> ${p.fuel || '—'}<br>
                    <strong>Gear:</strong> ${p.transmission || '—'}<br>
                    <strong>Owner:</strong> ${p.owner || '—'}
                </div>
            `;
            const detailsNote = `
                <div style="font-size: 12px; color: var(--text-muted); line-height: 1.4;">
                    <strong>Loc:</strong> ${p.location || 'Madurai'}<br>
                    <strong>Contact:</strong> ${p.contact || '—'}<br>
                    <strong>Offer:</strong> ${p.final_offer || '—'}<br>
                    <strong>Note:</strong> ${p.comment || '—'}
                </div>
            `;

            return `
            <tr style="opacity: ${isHidden ? '0.6' : '1'};">
                <td><img src="${p.image || 'https://via.placeholder.com/50'}" class="img-preview" style="filter: ${isHidden ? 'grayscale(100%)' : 'none'};"></td>
                <td><span class="font-bold">${p.name}</span>${hiddenBadge}</td>
                <td>${specs}</td>
                <td>${priceFormatted}</td>
                <td>${detailsNote}</td>
                <td>
                    <div style="display:flex;gap:8px;">
                        <button class="btn btn-outline" style="padding:6px;font-size:12px;" onclick="openEditModal(${p.id})">Edit</button>
                        <button class="btn btn-outline" style="padding:6px;font-size:12px; color:${hideBtnColor}; border-color:${hideBtnColor};" onclick="toggleProductVisibility(${p.id}, ${toggleState})">${hideBtnText}</button>
                        <button class="btn btn-danger" style="padding:6px;font-size:12px;" onclick="deleteProduct(${p.id})">Delete</button>
                    </div>
                </td>
            </tr>`;
        }).join('') || `<tr><td colspan="6" style="text-align:center;">No items active.</td></tr>`;

        document.getElementById('sum-total').textContent = globalData.products.length;
        document.getElementById('sum-in').textContent = globalData.products.filter(p => parseFloat(p.stock) >= LOW_STOCK_THRESHOLD).length;
        document.getElementById('sum-low').textContent = lowStockItems.length;
        document.getElementById('sum-out').textContent = outOfStockItems.length;

        document.getElementById('stock-product-select').innerHTML = '<option value="">Choose product...</option>' + globalData.products.map(p => `<option value="${p.id}">${p.name}</option>`).join('');

        document.getElementById('full-stock-table').innerHTML = globalData.products.map(p => {
            const stockVal = parseFloat(p.stock) || 0;
            const pctFill = Math.min(100, (stockVal / 20) * 100);
            const levelClass = stockVal <= 0 ? 'empty' : stockVal < LOW_STOCK_THRESHOLD ? 'low' : 'high';
            const statusLabel = stockVal <= 0 ? '<span class="badge badge-red-outline">Out of Stock</span>' : stockVal < LOW_STOCK_THRESHOLD ? '<span class="badge badge-orange">Low Stock</span>' : '<span class="badge badge-green">In Stock</span>';
            const textColor = stockVal <= 0 ? 'var(--red-text)' : stockVal < LOW_STOCK_THRESHOLD ? 'var(--badge-orange-text)' : 'var(--green-text)';

            const unit = p.unit || 'kg';

            return `<tr>
                <td class="font-bold">${p.name}</td>
                <td><span class="badge badge-gray">${p.category || 'General'}</span></td>
                <td>₹${p.price}/${unit}</td>
                <td>
                    <div style="display:flex;align-items:center;">
                        <div class="stock-bar-container"><div class="stock-bar-fill ${levelClass}" style="width:${pctFill}%;"></div></div>
                        <span style="font-size:13px;font-weight:700;color:${textColor};">${stockVal} ${unit}</span>
                    </div>
                </td>
                <td>${statusLabel}</td>
                <td>
                    <button class="btn btn-outline" style="padding:6px 12px; font-size:13px;" onclick="openStockModal(${p.id})">Edit</button>
                </td>
            </tr>`;
        }).join('') || `<tr><td colspan="6" style="text-align:center;">No stock levels mapped.</td></tr>`;

        renderCustomersTable();
    }

    function promptWhatsAppReceipt(orderId) {
        const order = globalData.orders.find(o => o.id == orderId);
        if (order) {
            pendingWaOrder = order;
            pendingWaStatus = 'Receipt';
            document.getElementById('whatsapp-prompt-modal').classList.add('active');
        }
    }

    function viewOrder(id) {
        const order = globalData.orders.find(o => o.id == id);
        if (!order) return;
        currentViewedOrder = order;

        const customer = globalData.users.find(u => u.phone === order.customer_phone) || {};
        const custName = customer.name || order.customer_name || 'Anonymous User';
        
        const hasGPS = order.lat && order.lng && order.lat !== "0";
        const mapUrl = hasGPS ? `https://www.google.com/maps/dir/?api=1&destination=${order.lat},${order.lng}` : '';
        const mapLink = hasGPS ? `<a href="${mapUrl}" target="_blank" style="color: #00B4D8; text-decoration: underline;">Click Here to Navigate</a>` : 'Not Available';

        let itemRows = '';
        let orderSubtotal = 0;
        let totalQty = 0;
        const numWords = numberToWords(Math.round(order.total));
        
        if (order.items) {
            try {
                const parsed = JSON.parse(order.items);
                let slNo = 1;
                for(let key in parsed) {
                    const itm = parsed[key];
                    const rowTotal = itm.price * itm.qty;
                    const unit = itm.unit || 'kg';
                    orderSubtotal += rowTotal; 
                    totalQty += parseFloat(itm.qty);
                    
                    itemRows += `
                        <tr style="border-bottom: 1px solid #000;">
                            <td style="border-right: 1px solid #000; padding: 4px 8px;">${slNo++}</td>
                            <td style="border-right: 1px solid #000; padding: 4px 8px;"><b>${key}</b></td>
                            <td style="border-right: 1px solid #000; padding: 4px 8px;"></td>
                            <td style="border-right: 1px solid #000; padding: 4px 8px; text-align: center;"><b>${itm.qty} ${unit}</b></td>
                            <td style="border-right: 1px solid #000; padding: 4px 8px; text-align: right;">${itm.price.toFixed(2)}</td>
                            <td style="border-right: 1px solid #000; padding: 4px 8px; text-align: center;">${unit}</td>
                            <td style="padding: 4px 8px; text-align: right;"><b>${rowTotal.toFixed(2)}</b></td>
                        </tr>
                    `;
                }
                
                let explicitDeliveryFee = order.total - orderSubtotal;
                if(explicitDeliveryFee < 0) explicitDeliveryFee = 0;

                itemRows += `
                    <tr>
                        <td style="border-right: 1px solid #000; padding: 4px 8px;"></td>
                        <td style="border-right: 1px solid #000; padding: 4px 8px;">Delivery Charges</td>
                        <td style="border-right: 1px solid #000; padding: 4px 8px;"></td>
                        <td style="border-right: 1px solid #000; padding: 4px 8px; text-align: center;"></td>
                        <td style="border-right: 1px solid #000; padding: 4px 8px; text-align: right;"></td>
                        <td style="border-right: 1px solid #000; padding: 4px 8px; text-align: center;"></td>
                        <td style="padding: 4px 8px; text-align: right;"><b>${explicitDeliveryFee > 0 ? explicitDeliveryFee.toFixed(2) : 'FREE'}</b></td>
                    </tr>
                `;
            } catch(e) {}
        }

        const html = `
        <div style="font-family: Arial, sans-serif; color: #000; font-size: 12px; border: 1px solid #000; background: #fff; position: relative;">
            
            <div style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%); opacity: 0.05; z-index: 0; pointer-events: none;">
                <img src="../assets/logo.png" style="width: 400px; height: 400px; object-fit: contain;">
            </div>

            <div style="position: relative; z-index: 1;">
                
                <div style="display: flex; justify-content: space-between; padding: 4px 8px;">
                    <div style="font-weight: bold; font-size: 14px;">GST INVOICE</div>
                    <div style="font-style: italic; font-size: 11px;">(ORIGINAL FOR RECIPIENT)</div>
                </div>
                <div style="text-align: center; font-weight: bold; font-size: 16px; color: #DC2626; margin-bottom: 5px;">
                    INVOICE CUM DELIVERY CHALLAN
                </div>

                
                <div style="display: flex; border-top: 1px solid #000; border-bottom: 1px solid #000;">
                    
                    <div style="width: 50%; border-right: 1px solid #000; padding: 8px;">
                        <div style="display: flex; gap: 10px;">
                            <img src="../assets/logo.png" style="width: 50px; height: 50px; object-fit: contain; border: 1px solid #ccc;">
                            <div>
                                <strong style="font-size: 14px;">Sri Periyandavar Auto Consulting</strong><br>
                                Bulgishbegam Complex, Main road,<br>
                                Vadipatty - 625218<br>
                                Phone: 9894997008<br>
                                Email: periyandavar.consulting@gmail.com
                            </div>
                        </div>
                    </div>
                    
                    <div style="width: 50%; display: grid; grid-template-columns: 1fr 1fr;">
                        <div style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 4px 8px;">
                            Invoice No.<br><strong style="font-size:14px;">#SPAC-${order.id}</strong>
                        </div>
                        <div style="border-bottom: 1px solid #000; padding: 4px 8px;">
                            Date<br><strong>${order.delivery_date || 'N/A'}</strong>
                        </div>
                        <div style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 4px 8px;">
                            Delivery Slot<br><strong>${order.delivery_slot || '-'}</strong>
                        </div>
                        <div style="border-bottom: 1px solid #000; padding: 4px 8px;">
                            Mode/Terms of Payment<br><strong>Cash on Delivery</strong>
                        </div>
                        <div style="grid-column: 1 / -1; padding: 4px 8px;">
                            Destination<br><strong>Vadipatty & Surrounding</strong>
                        </div>
                    </div>
                </div>

                
                <div style="display: flex; border-bottom: 1px solid #000;">
                    <div style="width: 50%; border-right: 1px solid #000; padding: 8px;">
                        Buyer (Bill to)<br>
                        <strong style="font-size: 14px;">${custName}</strong><br>
                        Phone: ${order.customer_phone}<br>
                        Address: ${order.delivery_address || 'N/A'}<br>
                        GPS Map: ${mapLink}
                    </div>
                    <div style="width: 50%; padding: 8px;">
                        Terms of Delivery<br>
                        <strong>Deliver on time maintaining standard hygiene protocols.</strong>
                        <div style="margin-top: 15px;">
                            <div id="receipt-qrcode"></div>
                        </div>
                    </div>
                </div>

                
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <tr style="border-bottom: 1px solid #000; background: #f8f8f8;">
                        <th style="border-right: 1px solid #000; padding: 6px 8px; width: 5%;">Sl No.</th>
                        <th style="border-right: 1px solid #000; padding: 6px 8px; width: 40%;">Description of Goods and Services</th>
                        <th style="border-right: 1px solid #000; padding: 6px 8px; width: 10%;">HSN/SAC</th>
                        <th style="border-right: 1px solid #000; padding: 6px 8px; width: 10%; text-align: center;">Quantity</th>
                        <th style="border-right: 1px solid #000; padding: 6px 8px; width: 10%; text-align: right;">Rate</th>
                        <th style="border-right: 1px solid #000; padding: 6px 8px; width: 5%; text-align: center;">per</th>
                        <th style="padding: 6px 8px; width: 15%; text-align: right;">Amount</th>
                    </tr>
                    ${itemRows}
                    
                    <tr style="border-top: 1px solid #000; font-size: 14px;">
                        <td colspan="3" style="border-right: 1px solid #000; padding: 6px 8px; text-align: right;"><strong>Total</strong></td>
                        <td style="border-right: 1px solid #000; padding: 6px 8px; text-align: center;"><strong>${totalQty} Nos</strong></td>
                        <td colspan="2" style="border-right: 1px solid #000;"></td>
                        <td style="padding: 6px 8px; text-align: right;"><strong>₹ ${order.total}</strong></td>
                    </tr>
                </table>

                
                <div style="border-top: 1px solid #000; display: flex;">
                    <div style="width: 60%; border-right: 1px solid #000; padding: 8px;">
                        Amount Chargeable (in words)<br>
                        <strong>INR ${numWords}</strong><br><br>
                        Declaration<br>
                        We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
                    </div>
                    <div style="width: 40%; padding: 8px; text-align: right; display: flex; flex-direction: column; justify-content: space-between;">
                        <div><strong>for Sri Periyandavar Auto Consulting</strong></div>
                        <div style="margin-top: 50px;">Authorised Signatory</div>
                    </div>
                </div>
            </div>
        </div>
        `;

        document.getElementById('printable-receipt').innerHTML = html;
        
        // Add WhatsApp button to modal footer dynamically
        document.getElementById('order-modal-footer').innerHTML = `
            <button class="btn btn-outline" onclick="closeOrderModal()">Close</button>
            <button class="btn" style="background: #25D366; color: white; border: none;" onclick="promptWhatsAppReceipt(${order.id})">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="margin-right: 5px;"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                Share on WhatsApp
            </button>
            <button class="btn btn-primary" onclick="generatePDF()">Download PDF</button>
        `;

        document.getElementById('order-modal').classList.add('active');
        document.getElementById('receipt-qrcode').innerHTML = ''; 
        
        const qrDataString = hasGPS ? mapUrl : `tel:${order.customer_phone}`;
        new QRCode(document.getElementById('receipt-qrcode'), { text: qrDataString, width: 60, height: 60, colorDark : "#0A192F", colorLight : "#ffffff", correctLevel : QRCode.CorrectLevel.L });
    }

    function closeOrderModal() {
        document.getElementById('order-modal').classList.remove('active');
    }

    function generatePDF() {
        const element = document.getElementById('printable-receipt');
        const opt = {
            margin:       0.5,
            filename:     `Order_Receipt_${currentViewedOrder.id}.pdf`,
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        };
        element.style.padding = '0'; 
        html2pdf().set(opt).from(element).save();
        
        setTimeout(() => { element.style.padding = '30px'; }, 1000); 
    }

    function viewCustomer(id) {
        const c = globalData.users.find(u => u.id == id);
        if (!c) return;

        const addr1 = c.address_1 || 'Not provided';
        const addr2 = c.address_2 || 'Not provided';
        
        document.getElementById('customer-detail-grid').innerHTML = `
            <div class="detail-item"><span class="detail-label">System ID</span><span class="detail-value">#UID-${c.id}</span></div>
            <div class="detail-item"><span class="detail-label">Full Name</span><span class="detail-value">${c.name || 'Anonymous User'}</span></div>
            <div class="detail-item"><span class="detail-label">Phone Number</span><span class="detail-value font-bold">${c.phone}</span></div>
            <div class="detail-item"><span class="detail-label">Role Profile</span><span class="detail-value"><span class="badge badge-blue">Customer</span></span></div>
            <div class="detail-item"><span class="detail-label">Address Line 1</span><span class="detail-value">${addr1}</span></div>
            <div class="detail-item"><span class="detail-label">Address Line 2</span><span class="detail-value">${addr2}</span></div>
            <div class="detail-item"><span class="detail-label">Landmark</span><span class="detail-value">${c.landmark || 'Not provided'}</span></div>
            <div class="detail-item"><span class="detail-label">Postal Pincode</span><span class="detail-value font-bold">${c.pincode || 'Not provided'}</span></div>
            <div class="detail-item"><span class="detail-label">GPS Latitude</span><span class="detail-value">${c.lat || 'Not set'}</span></div>
            <div class="detail-item"><span class="detail-label">GPS Longitude</span><span class="detail-value">${c.lng || 'Not set'}</span></div>
        `;

        document.getElementById('reset-customer-id').value = c.id;
        document.getElementById('new-password-input').value = '';
        document.getElementById('customer-modal').classList.add('active');
    }

    function closeCustomerModal() {
        document.getElementById('customer-modal').classList.remove('active');
    }

    async function resetCustomerPassword() {
        const id = document.getElementById('reset-customer-id').value;
        const newPassword = document.getElementById('new-password-input').value.trim();

        if(!newPassword) return alert("Please type a new password in the input field.");
        if(!confirm("Are you sure you want to forcibly reset this user's password?")) return;

        try {
            const res = await fetch(`${API_URL}?action=reset_password`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id, password: newPassword }),
                credentials: 'include'
            });

            if (res.ok) {
                alert("Password successfully reset in database!");
                closeCustomerModal();
            } else {
                alert("Failed to reset password.");
            }
        } catch(e) { alert("Connection error while attempting to reset password."); }
    }

    function formatCarPrice(price) {
        const num = parseFloat(price);
        if (isNaN(num)) return 'N/A';
        if (num >= 10000000) {
            return '₹' + (num / 10000000).toFixed(2) + ' Cr';
        } else if (num >= 100000) {
            return '₹' + (num / 100000).toFixed(2) + 'L';
        }
        return '₹' + num.toLocaleString('en-IN');
    }

    function readFilesAsBase64(files) {
        return Promise.all(Array.from(files).map(file => {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = e => resolve(e.target.result);
                reader.onerror = err => reject(err);
                reader.readAsDataURL(file);
            });
        }));
    }

    function openEditModal(id) {
        const p = globalData.products.find(x => x.id == id);
        if(!p) return;
        
        document.getElementById('edit-p-id').value = p.id;
        document.getElementById('edit-p-hidden-stock').value = p.stock || 0;
        document.getElementById('edit-p-name').value = p.name;
        document.getElementById('edit-p-price').value = p.price;
        document.getElementById('edit-p-category').value = p.category || 'General';
        document.getElementById('edit-p-unit').value = p.unit || 'pcs';
        document.getElementById('edit-p-comment').value = p.comment || '';
        document.getElementById('edit-p-hidden').checked = p.is_hidden == 1; 
        document.getElementById('edit-p-image').value = ''; 
        document.getElementById('edit-p-images').value = ''; 
        document.getElementById('edit-p-existing-images').value = p.images || '';
        
        document.getElementById('edit-p-year').value = p.year || 2020;
        document.getElementById('edit-p-kms').value = p.kms || '';
        document.getElementById('edit-p-transmission').value = p.transmission || 'Manual';
        document.getElementById('edit-p-fuel').value = p.fuel || 'Petrol';
        document.getElementById('edit-p-owner').value = p.owner || '1st Owner';
        document.getElementById('edit-p-condition_text').value = p.condition_text || 'Excellent';
        document.getElementById('edit-p-fitness').value = p.fitness || '';
        document.getElementById('edit-p-insurance').value = p.insurance || '';
        document.getElementById('edit-p-tax').value = p.tax || '';
        document.getElementById('edit-p-location').value = p.location || 'Madurai';
        document.getElementById('edit-p-final_offer').value = p.final_offer || '';
        document.getElementById('edit-p-contact').value = p.contact || '8098364254';
        
        document.getElementById('edit-modal-title').innerText = 'Edit Product: ' + p.name;
        
        document.getElementById('edit-product-modal').classList.add('active');
    }

    function closeEditModal() { document.getElementById('edit-product-modal').classList.remove('active'); }

    async function submitProduct(mode) {
        let prefix = mode === 'edit' ? 'edit-p-' : 'p-';

        const id = document.getElementById(prefix + 'id').value;
        const stock = document.getElementById(prefix + 'hidden-stock').value;
        const name = document.getElementById(prefix + 'name').value.trim();
        const priceRaw = document.getElementById(prefix + 'price').value;
        const price = priceRaw.replace(/[^0-9.]/g, '');
        const category = document.getElementById(prefix + 'category').value;
        const unit = document.getElementById(prefix + 'unit').value;
        const comment = document.getElementById(prefix + 'comment').value.trim();
        const isHidden = document.getElementById(prefix + 'hidden').checked ? 1 : 0; 
        
        const year = document.getElementById(prefix + 'year').value;
        const kms = document.getElementById(prefix + 'kms').value.trim();
        const transmission = document.getElementById(prefix + 'transmission').value;
        const fuel = document.getElementById(prefix + 'fuel').value;
        const owner = document.getElementById(prefix + 'owner').value;
        const condition_text = document.getElementById(prefix + 'condition_text').value;
        const fitness = document.getElementById(prefix + 'fitness').value.trim();
        const insurance = document.getElementById(prefix + 'insurance').value.trim();
        const tax = document.getElementById(prefix + 'tax').value.trim();
        const location = document.getElementById(prefix + 'location').value.trim();
        const final_offer = document.getElementById(prefix + 'final_offer').value.trim();
        const contact = document.getElementById(prefix + 'contact').value.trim();

        if(!name || !price) return alert("Product name and price are required.");

        const fileInput = document.getElementById(prefix + 'image');
        const file = fileInput.files[0];
        if (!id && !file) return alert("Missing Image: Please upload an image before creating a new product.");

        if (file) {
            const maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) return alert("Upload failed: Image exceeds the 2MB limit. Please compress the image or choose a smaller file.");
        }

        const action = id ? 'update_product' : 'add_product';
        const payload = { 
            id, name, price, stock, category, unit, comment, is_hidden: isHidden,
            year, kms, transmission, fuel, owner, condition_text, fitness, insurance, tax, location, final_offer, contact
        };

        const submitBtn = mode === 'edit' ? document.getElementById('btn-update-product') : document.getElementById('btn-submit-product');
        const originalText = submitBtn.innerText;
        submitBtn.innerText = 'Saving...';
        submitBtn.disabled = true;

        const handleComplete = () => {
            submitBtn.innerText = originalText;
            submitBtn.disabled = false;
            if (mode === 'edit') {
                closeEditModal();
            } else {
                document.getElementById('p-name').value = '';
                document.getElementById('p-price').value = '';
                document.getElementById('p-unit').value = 'pcs';
                document.getElementById('p-image').value = '';
                document.getElementById('p-images').value = '';
                document.getElementById('p-comment').value = '';
                document.getElementById('p-hidden').checked = false; 
                document.getElementById('p-year').value = '2020';
                document.getElementById('p-kms').value = '';
                document.getElementById('p-transmission').value = 'Manual';
                document.getElementById('p-fuel').value = 'Petrol';
                document.getElementById('p-owner').value = '1st Owner';
                document.getElementById('p-condition_text').value = 'Excellent';
                document.getElementById('p-fitness').value = '';
                document.getElementById('p-insurance').value = '';
                document.getElementById('p-tax').value = '';
                document.getElementById('p-location').value = 'Madurai';
                document.getElementById('p-final_offer').value = '';
                document.getElementById('p-contact').value = '8098364254';
            }
            fetchData();
        };

        try {
            // Read main cover image
            let mainImageBase64 = null;
            if (file) {
                mainImageBase64 = await new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = e => resolve(e.target.result);
                    reader.onerror = err => reject(err);
                    reader.readAsDataURL(file);
                });
            }
            payload.image = mainImageBase64;

            // Read gallery images
            let galleryImagesJSON = null;
            if (mode === 'edit') {
                galleryImagesJSON = document.getElementById('edit-p-existing-images').value || null;
            }
            const galleryFiles = document.getElementById(prefix + 'images').files;
            if (galleryFiles && galleryFiles.length > 0) {
                const galleryImages = await readFilesAsBase64(galleryFiles);
                galleryImagesJSON = JSON.stringify(galleryImages);
            }
            payload.images = galleryImagesJSON;

            await fetch(`${API_URL}?action=${action}`, { 
                method: 'POST', 
                headers: {'Content-Type': 'application/json'}, 
                body: JSON.stringify(payload),
                credentials: 'include'
            });
            handleComplete();
        } catch (err) {
            console.error(err);
            alert("An error occurred while saving the product.");
            submitBtn.innerText = originalText;
            submitBtn.disabled = false;
        }
    }

    async function toggleProductVisibility(id, newStatus) {
        await fetch(`${API_URL}?action=toggle_visibility`, { 
            method: 'POST', headers: {'Content-Type': 'application/json'}, 
            body: JSON.stringify({ id: id, is_hidden: newStatus }), credentials: 'include' 
        });
        fetchData();
    }

    async function deleteProduct(id) {
        if(confirm('Purge target entry?')) {
            await fetch(`${API_URL}?action=delete_product`, { 
                method: 'POST', headers: {'Content-Type': 'application/json'}, 
                body: JSON.stringify({ id }), credentials: 'include' 
            });
            fetchData();
        }
    }

    function openStockModal(productId = null) {
        const selectBox = document.getElementById('stock-product-select');
        if(productId) {
            selectBox.value = productId;
        } else {
            selectBox.value = "";
        }
        
        document.getElementById('stock-qty-input').value = '';
        document.getElementById('stock-movement').value = 'add';
        
        updateStockModalInfo();
        document.getElementById('stock-modal').classList.add('active');
    }

    function closeStockModal() {
        document.getElementById('stock-modal').classList.remove('active');
    }

    function updateStockModalInfo() {
        const selectBox = document.getElementById('stock-product-select');
        const displayBox = document.getElementById('stock-modal-display-box');
        const currentValSpan = document.getElementById('stock-modal-current-val');
        
        if (!selectBox.value) {
            displayBox.style.display = 'none';
            return;
        }

        const product = globalData.products.find(p => p.id == selectBox.value);
        if (product) {
            const unit = product.unit || 'kg';
            currentValSpan.innerText = `${product.stock} ${unit}`;
            displayBox.style.display = 'block';
            calculateStockPreview();
        } else {
            displayBox.style.display = 'none';
        }
    }

    function calculateStockPreview() {
        const selectBox = document.getElementById('stock-product-select');
        const qtyInput = document.getElementById('stock-qty-input');
        const movementType = document.getElementById('stock-movement').value;
        const previewValSpan = document.getElementById('stock-preview-val');

        if (!selectBox.value) {
            return;
        }

        const product = globalData.products.find(p => p.id == selectBox.value);
        if (!product) return;

        const currentStock = parseFloat(product.stock) || 0;
        const inputQty = parseFloat(qtyInput.value) || 0;
        const unit = product.unit || 'kg';
        
        let targetQty = currentStock;

        if (qtyInput.value && !isNaN(qtyInput.value)) {
            if (movementType === 'add') {
                targetQty = currentStock + inputQty;
            } else if (movementType === 'remove') {
                targetQty = currentStock - inputQty;
            } else if (movementType === 'set') {
                targetQty = inputQty;
            }
        }

        if (targetQty < 0) targetQty = 0;

        previewValSpan.innerText = `${targetQty} ${unit}`;
        
        if (targetQty !== currentStock) {
            previewValSpan.style.color = 'var(--green-text)';
        } else {
            previewValSpan.style.color = 'var(--text-muted)';
        }
    }

    async function submitStockMovement() {
        const id = document.getElementById('stock-product-select').value;
        const type = document.getElementById('stock-movement').value;
        const qty = document.getElementById('stock-qty-input').value;
        if (!id || !qty || isNaN(qty) || qty <= 0) return alert("Data mismatch. Please select a product and valid quantity.");
        
        const btn = document.getElementById('btn-save-stock');
        const origText = btn.innerText;
        btn.innerText = 'Saving...';
        btn.disabled = true;

        await fetch(`${API_URL}?action=adjust_stock`, { 
            method: 'POST', 
            headers: {'Content-Type': 'application/json'}, 
            body: JSON.stringify({ id, type, qty }),
            credentials: 'include' 
        });
        
        document.getElementById('stock-qty-input').value = '';
        btn.innerText = origText;
        btn.disabled = false;
        closeStockModal();
        fetchData();
    }

    function sendWhatsAppNotification(order, newStatus) {
        if (!order || !order.customer_phone) return;
        
        let phoneStr = order.customer_phone.replace(/\D/g, '');
        if (phoneStr.length === 10) phoneStr = '91' + phoneStr;

        let cName = 'Customer';
        const userObj = globalData.users.find(u => u.phone === order.customer_phone);
        if (userObj && userObj.name) cName = userObj.name;
        else if (order.customer_name) cName = order.customer_name;

        let itemListStr = '';
        if (order.items) {
            try {
                const parsed = JSON.parse(order.items);
                for (let key in parsed) {
                    let u = parsed[key].unit || 'kg';
                    itemListStr += `• ${key} - ${parsed[key].qty} ${u} (₹${(parsed[key].price * parsed[key].qty).toFixed(2)})\n`;
                }
            } catch(e) {}
        }

        let msg = `Hi ${cName}, `;
        if (newStatus === 'Receipt') {
            msg += `here is the invoice for your booking (#SPAC-${order.id}) from *Sri Periyandavar Auto Consulting*.\n\n`;
        } else {
            msg += `your booking (#SPAC-${order.id}) from *Sri Periyandavar Auto Consulting* is now: *${newStatus}*!\n\n`;
        }
        
        msg += `*Order Summary:*\n${itemListStr}\n`;
        msg += `*Total Amount:* ₹${order.total} (Cash on Delivery)\n\n`;

        if (newStatus === 'Accepted') {
            msg += `We have received your booking and are currently preparing it.`;
        } else if (newStatus === 'Out for Delivery') {
            msg += `Our transport executive is on the way to your location!`;
        } else if (newStatus === 'Delivered') {
            msg += `Your vehicle has been successfully delivered. Thank you for choosing Sri Periyandavar Auto Consulting!`;
        } else if (newStatus === 'Cancelled') {
            msg += `We apologize, but your booking has been cancelled. Please contact us if you need assistance.`;
        } else if (newStatus === 'Receipt') {
            msg += `Thank you for shopping with us!`;
        }

        const encodedMsg = encodeURIComponent(msg);
        const waUrl = `https://wa.me/${phoneStr}?text=${encodedMsg}`;
        window.open(waUrl, '_blank');
    }

    async function updateOrder(id, status) {
        if (status === 'Cancelled' && !confirm('Are you sure you want to cancel this order?')) return;
        
        const order = globalData.orders.find(o => o.id == id);

        await fetch(`${API_URL}?action=update_order`, { 
            method: 'POST', headers: {'Content-Type': 'application/json'}, 
            body: JSON.stringify({ id, status }), credentials: 'include' 
        });
        
        // Show the WhatsApp prompt after a successful update
        if (order) {
            pendingWaOrder = order;
            pendingWaStatus = status;
            document.getElementById('whatsapp-prompt-modal').classList.add('active');
        }

        fetchData();
    }

    function closeWaPrompt() {
        document.getElementById('whatsapp-prompt-modal').classList.remove('active');
        pendingWaOrder = null;
        pendingWaStatus = null;
    }

    function confirmSendWa() {
        if (pendingWaOrder && pendingWaStatus) {
            sendWhatsAppNotification(pendingWaOrder, pendingWaStatus);
        }
        closeWaPrompt();
    }

    document.getElementById('p-image').addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.size > (2 * 1024 * 1024)) {
            alert("File is too large! Please select an image smaller than 2MB."); this.value = ''; 
        }
    });

    document.getElementById('edit-p-image').addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.size > (2 * 1024 * 1024)) {
            alert("File is too large! Please select an image smaller than 2MB."); this.value = ''; 
        }
    });

    window.addEventListener('DOMContentLoaded', fetchData);
    
  </script>
</body>
</html>