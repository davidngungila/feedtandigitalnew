<style>
/* ============================================================
   GLOBAL STYLES
   ============================================================ */
*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; }

/* Custom Scrollbar */
::-webkit-scrollbar { width: 8px; height: 8px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; border: 2px solid transparent; background-clip: content-box; }
::-webkit-scrollbar-thumb:hover { background: #059669; border-radius: 10px; border: 2px solid transparent; background-clip: content-box; }

/* Firefox Scrollbar */
* { scrollbar-width: thin; scrollbar-color: #10b981 transparent; }

/* ============================================================
   SIDEBAR & BRANDING (Consistent across modes)
   ============================================================ */
.sidebar-bg { background: #064e3b !important; }
.sidebar-item:hover { background: rgba(255,255,255,0.1); }

/* ============================================================
   LIGHT MODE (Default)
   ============================================================ */
body:not(.dark) { background: #f0fdf4; color: #064e3b; }
body:not(.dark) .main-bg { background: #f0fdf4; }
body:not(.dark) .card { background: #ffffff; border: 1px solid #d1fae5; box-shadow: 0 2px 12px rgba(6,78,59,0.08); }
body:not(.dark) .navbar-bg { background: #ffffff; border-bottom: 1px solid #d1fae5; }
body:not(.dark) .text-main { color: #064e3b; }
body:not(.dark) .text-sub { color: #6b7280; }
body:not(.dark) .input-field { background: #f9fafb; border: 1px solid #d1fae5; color: #064e3b; }
body:not(.dark) .table-row:hover { background: #ecfdf5; }

/* ============================================================
   DARK MODE
   ============================================================ */
.dark .main-bg { background: #0a140e; }
.dark .card { background: #0d1f16; border: 1px solid #1a3328; box-shadow: 0 2px 12px rgba(0,0,0,0.4); }
.dark .navbar-bg { background: #0d1f16; border-bottom: 1px solid #1a3328; }
.dark .text-main { color: #ecfdf5; }
.dark .text-sub { color: #6ee7b7; }
.dark .input-field { background: #0a140e; border: 1px solid #1a3328; color: #ecfdf5; }
.dark .table-row:hover { background: #0d2318; }

/* Sidebar */
.sidebar { transition: width 0.3s cubic-bezier(0.4,0,0.2,1), transform 0.3s cubic-bezier(0.4,0,0.2,1); }
.sidebar:hover { width: 260px; }

/* Dropdown menus in sidebar */
.sidebar-dropdown { max-height: 0; overflow: hidden; transition: max-height 0.35s ease; }
.sidebar-dropdown.open { max-height: 1000px; }

/* Page transitions */
.page { display: none; animation: fadeIn 0.35s ease; }
.page.active { display: block; }

@keyframes fadeIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
@keyframes countUp { from { transform:translateY(8px); opacity:0; } to { transform:translateY(0); opacity:1; } }
@keyframes slideInLeft { from { transform:translateX(-100%); } to { transform:translateX(0); } }
@keyframes slideOutLeft { from { transform:translateX(0); } to { transform:translateX(-100%); } }

/* Glassmorphism cards */
.glass { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
.dark .glass { background: rgba(13,31,22,0.85); border: 1px solid rgba(26,51,40,0.8); }
body:not(.dark) .glass { background: rgba(255,255,255,0.85); border: 1px solid rgba(209,250,229,0.8); }

/* Status badges */
.badge { display:inline-flex; align-items:center; padding:2px 10px; border-radius:999px; font-size:11px; font-weight:600; letter-spacing:0.4px; }
.badge-green { background:#d1fae5; color:#065f46; }
.badge-red { background:#fee2e2; color:#991b1b; }
.badge-yellow { background:#fef9c3; color:#854d0e; }
.badge-blue { background:#dbeafe; color:#1e40af; }
.badge-gray { background:#f3f4f6; color:#4b5563; }
.dark .badge-green { background:#052e16; color:#6ee7b7; }
.dark .badge-red { background:#450a0a; color:#fca5a5; }
.dark .badge-yellow { background:#422006; color:#fde68a; }
.dark .badge-blue { background:#172554; color:#93c5fd; }
.dark .badge-gray { background:#1f2937; color:#9ca3af; }

/* Animated counter */
.counter { display:inline-block; }

/* Tables */
.data-table { width:100%; border-collapse:collapse; }
.data-table th { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; padding:10px 14px; }
.data-table td { padding:10px 14px; font-size:13px; }
.data-table tbody tr { transition:background 0.15s; border-bottom:1px solid transparent; }
.dark .data-table th { color:#6ee7b7; background:#052e16; border-bottom:1px solid #1a3328; }
.dark .data-table tbody tr { border-bottom-color:#1a3328; }
.dark .data-table tbody tr:hover { background:#0d2318; }
body:not(.dark) .data-table th { color:#065f46; background:#ecfdf5; border-bottom:1px solid #d1fae5; }
body:not(.dark) .data-table tbody tr { border-bottom-color:#f0fdf4; }
body:not(.dark) .data-table tbody tr:hover { background:#f0fdf4; }

/* Forms */
.form-input {
  width:100%; padding:9px 14px; border-radius:8px; font-size:13px;
  outline:none; transition:border-color 0.2s, box-shadow 0.2s;
  font-family:'Plus Jakarta Sans',sans-serif;
}
.form-input:focus { border-color:#10b981; box-shadow:0 0 0 3px rgba(16,185,129,0.15); }
.form-label { font-size:12px; font-weight:600; margin-bottom:4px; display:block; }

/* Notification dot */
.notif-dot { width:8px;height:8px;border-radius:50%;background:#ef4444;position:absolute;top:2px;right:2px;animation:pulse 1.5s infinite; }

/* Loader */
.skeleton { animation:skeleton-loading 1.2s linear infinite alternate; }
.dark .skeleton { background:linear-gradient(90deg,#0d2318 0%,#1a3328 50%,#0d2318 100%); }
body:not(.dark) .skeleton { background:linear-gradient(90deg,#f0fdf4 0%,#d1fae5 50%,#f0fdf4 100%); }
@keyframes skeleton-loading { from{background-position:0 0;} to{background-position:100% 0;} }

/* ============================================================
   STAT CARDS
   ============================================================ */
.stat-card {
  border-radius:14px; padding:20px 22px;
  transition:transform 0.2s, box-shadow 0.2s;
  position:relative; overflow:hidden;
}
.stat-card:hover { transform:translateY(-3px); box-shadow:0 12px 32px rgba(16,185,129,0.18); }
.stat-card .icon-wrap { width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px; }
.stat-card .bg-blob { position:absolute;right:-20px;top:-20px;width:100px;height:100px;border-radius:50%;opacity:0.08; }

/* Modal */
.modal-overlay {
  position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:999;
  display:flex;align-items:center;justify-content:center;
  backdrop-filter:blur(4px);animation:fadeIn 0.2s ease;
}
.modal-box {
  border-radius:16px;width:90%;max-width:600px;max-height:90vh;overflow-y:auto;
  animation:fadeIn 0.3s ease;
}

/* ============================================================
   CHART WRAPPERS
   ============================================================ */
.chart-wrapper { position:relative; }

/* Toast */
.toast-container { position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:10px; }
.toast {
  display:flex;align-items:center;gap:10px;padding:12px 18px;border-radius:12px;
  font-size:13px;font-weight:500;box-shadow:0 8px 24px rgba(0,0,0,0.2);
  animation:fadeIn 0.3s ease;
  min-width:240px;
}
.toast-success { background:#064e3b;color:#6ee7b7;border:1px solid #065f46; }
.toast-error { background:#450a0a;color:#fca5a5;border:1px solid #991b1b; }
.toast-info { background:#172554;color:#93c5fd;border:1px solid #1e40af; }

/* Progress bars */
.progress-bar { height:6px;border-radius:99px;background:#d1fae5;overflow:hidden; }
.dark .progress-bar { background:#1a3328; }
.progress-fill { height:100%;border-radius:99px;background:linear-gradient(90deg,#10b981,#34d399);transition:width 1s ease; }

/* Mobile and Tablet Adjustments */
@media(max-width:1024px) {
  .sidebar {
    position: fixed !important;
    left: 0;
    top: 0;
    bottom: 0;
    z-index: 50;
    width: 260px !important;
    transform: translateX(-100%);
    transition: transform 0.3s ease;
  }
  .sidebar.mobile-open {
    transform: translateX(0);
  }
  .main-content {
    margin-left: 0 !important;
    width: 100% !important;
  }
}

@media(max-width:640px) {
  .stat-card {
    padding: 15px;
  }
  .stat-card .text-xl {
    font-size: 1.25rem;
  }
  .data-table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }
  .modal-box {
    width: 95%;
    margin: 10px;
    padding: 15px !important;
  }
  .grid-cols-2 {
    grid-template-columns: repeat(1, minmax(0, 1fr));
  }
}

/* Ensure images and charts don't overflow */
canvas {
  max-width: 100% !important;
}

/* Role badge */
.role-tag { padding:3px 10px;border-radius:999px;font-size:10px;font-weight:700;letter-spacing:0.5px; }
.role-admin { background:#059669;color:#fff; }
.role-manager { background:#3b82f6;color:#fff; }
.role-teller { background:#f59e0b;color:#fff; }
.role-member { background:#6366f1;color:#fff; }
.role-auditor { background:#ef4444;color:#fff; }
.role-deposit_officer { background:#10b981;color:#fff; }
.role-loan_officer { background:#6366f1;color:#fff; }
.role-swf_officer { background:#8b5cf6;color:#fff; }
.role-marketing_officer { background:#ec4899;color:#fff; }
.role-secretary { background:#0ea5e9;color:#fff; }
.role-chairperson { background:#84cc16;color:#fff; }
.role-accountant { background:#f97316;color:#fff; }
</style>
