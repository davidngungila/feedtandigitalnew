<script>
function FeedtanApp(initialData) {
  return {
    // ============================================================
    // AUTH STATE
    // ============================================================
    loggedIn: initialData.loggedIn || false,
    loginEmail: '',
    loginPassword: '',
    loginRole: 'admin', // for the UI selector
    currentUser: initialData.currentUser || {},
    
    darkMode: localStorage.getItem('feedtan_dark') === 'true',
    sidebarOpen: false,
    sidebarCollapsed: false,
    activePage: initialData.activePage || 'dashboard',
    activeModal: null,
    openDropdowns: [],
    memberPage: 1,
    memberSearch: '',

    // ============================================================
    // LOAN CALCULATOR
    // ============================================================
    loanCalc: { principal: 5000000, rate: 18, months: 12, interest: 0, total: 0, monthly: 0 },

    calcLoan() {
      const p = parseFloat(this.loanCalc.principal)||0;
      const r = (parseFloat(this.loanCalc.rate)||18)/100/12;
      const n = parseInt(this.loanCalc.months)||12;
      if (p > 0 && r > 0 && n > 0) {
        const m = p * r * Math.pow(1+r,n) / (Math.pow(1+r,n)-1);
        this.loanCalc.monthly = Math.round(m);
        this.loanCalc.total = Math.round(m * n);
        this.loanCalc.interest = this.loanCalc.total - p;
      }
    },

    // ============================================================
    // DATABASE DATA
    // ============================================================
    members: initialData.members || [],
    recentTransactions: initialData.recentTransactions || [],
    pendingLoans: initialData.pendingLoans || [],
    activeLoans: initialData.activeLoans || [],
    recentDeposits: [], // can be computed or fetched
    investments: initialData.investments || [],
    savingsAccounts: initialData.savingsAccounts || [],
    systemUsers: initialData.systemUsers || [],
    withdrawalRequests: [],
    memberAccounts: initialData.memberAccounts || [],
    memberLoan: (initialData.memberLoans && initialData.memberLoans.length > 0) ? initialData.memberLoans[0] : null,
    memberTransactions: initialData.memberTransactions || [],
    auditLogs: initialData.auditLogs || [],
    notifications: [
      { id:1, title:'Loan Approved', message:'Member Amina Salim has been approved for TZS 5M', type:'loan', icon:'fa-solid fa-check-circle', time:'2 mins ago', unread:true },
      { id:2, title:'New Deposit', message:'Received TZS 150,000 from M-Pesa ref: QW789...', type:'deposit', icon:'fa-solid fa-arrow-down', time:'15 mins ago', unread:true },
      { id:3, title:'Repayment Due', message:'Loan #LN0088 is due for repayment tomorrow', type:'alert', icon:'fa-solid fa-clock', time:'1 hour ago', unread:false },
    ],

    savingPlans: [
      { id:1, name:'RDA – Regular Deposit Account', desc:'Fixed monthly savings with annual dividends', rate:8, min:10000, term:'Ongoing', icon:'fa-solid fa-piggy-bank', color:'#10b981' },
      { id:2, name:'Emergency Savings Fund', desc:'Quick access funds for unexpected life events', rate:6, min:5000, term:'Ongoing', icon:'fa-solid fa-shield-halved', color:'#f59e0b' },
      { id:3, name:'FLEX – Flexible Savings', desc:'Save as you go with competitive interest rates', rate:10, min:1000, term:'Flexible', icon:'fa-solid fa-arrows-rotate', color:'#3b82f6' },
      { id:4, name:'SWF – Share Welfare Fund', desc:'Social protection and member welfare contributions', rate:5, min:5000, term:'Ongoing', icon:'fa-solid fa-hand-holding-heart', color:'#8b5cf6' },
      { id:5, name:'Education Savings Plan', desc:'Targeted savings for school and university fees', rate:12, min:20000, term:'3-10 Years', icon:'fa-solid fa-graduation-cap', color:'#ef4444' },
      { id:6, name:'Housing & Land Goal', desc:'Save specifically for home ownership or land purchase', rate:15, min:50000, term:'5+ Years', icon:'fa-solid fa-house-chimney', color:'#065f46' },
    ],

    depositChannels: [
      { name:'M-Pesa', pct:42 },
      { name:'Airtel Money', pct:22 },
      { name:'Cash', pct:20 },
      { name:'TigoPesa', pct:10 },
      { name:'Bank Transfer', pct:6 },
    ],

    savingsProducts: [
      { id:'rda', code:'RDA', icon:'fa-solid fa-piggy-bank', color:'#10b981', rate:8, total:1820000000, members:1243 },
      { id:'emergency', code:'Emergency', icon:'fa-solid fa-shield-halved', color:'#f59e0b', rate:6, total:780000000, members:892 },
      { id:'flex', code:'FLEX', icon:'fa-solid fa-arrows-rotate', color:'#3b82f6', rate:10, total:955000000, members:621 },
      { id:'swf', code:'SWF', icon:'fa-solid fa-hand-holding-heart', color:'#8b5cf6', rate:5, total:432000000, members:1243 },
      { id:'share', code:'Share Cap.', icon:'fa-solid fa-certificate', color:'#ef4444', rate:12, total:346000000, members:1243 },
    ],

    paymentProviders: [
      { id:'mpesa', name:'M-Pesa', code:'MP', desc:'Vodacom Tanzania', color:'#E31837', active:true, today:12400000, month:387000000 },
      { id:'airtel', name:'Airtel Money', code:'AM', desc:'Airtel Tanzania', color:'#FF0000', active:true, today:5800000, month:184000000 },
      { id:'tigo', name:'TigoPesa', code:'TP', desc:'Tigo Tanzania', color:'#0099D8', active:true, today:4200000, month:126000000 },
      { id:'halo', name:'HaloPesa', code:'HP', desc:'TTCL / HaloTel', color:'#FF6B00', active:false, today:0, month:42000000 },
      { id:'clickpesa', name:'ClickPesa', code:'CP', desc:'ClickPesa Ltd', color:'#1a56db', active:true, today:7100000, month:213000000 },
    ],

    reportTypes: [
      { id:'member', title:'Member Report', desc:'Full member listing with demographics and account status', icon:'fa-solid fa-users', color:'#10b981' },
      { id:'loan', title:'Loan Report', desc:'Disbursements, repayments, overdue and collection rate', icon:'fa-solid fa-file-invoice-dollar', color:'#3b82f6' },
      { id:'savings', title:'Savings Report', desc:'Savings balances by product, interest accrued', icon:'fa-solid fa-piggy-bank', color:'#8b5cf6' },
      { id:'investment', title:'Investment Report', desc:'ROI analysis, maturity schedule, portfolio performance', icon:'fa-solid fa-chart-line', color:'#f59e0b' },
      { id:'financial', title:'Financial Statements', desc:'Income statement, balance sheet, cash flow', icon:'fa-solid fa-balance-scale', color:'#ef4444' },
      { id:'audit', title:'Audit Trail Report', desc:'Complete system activity and change log', icon:'fa-solid fa-history', color:'#6b7280' },
    ],

    eligibilityChecks: [
      { label:'Active member (≥6 months)', pass:true },
      { label:'No overdue loans', pass:true },
      { label:'Savings ≥ 25% of loan', pass:true },
      { label:'Guarantors available', pass:true },
      { label:'Loan limit not exceeded', pass:true },
    ],

    notifSettings: [
      { id:'sms', label:'SMS Notifications', on:true },
      { id:'email', label:'Email Alerts', on:true },
      { id:'push', label:'Push Notifications', on:false },
      { id:'loan', label:'Loan Approvals', on:true },
      { id:'deposit', label:'Deposit Confirmations', on:true },
    ],

    branches: [
      { id:1, name:'Dar es Salaam HQ', region:'Dar es Salaam' },
    ],

    sidebarSections: {
      admin: [
        { id:'dashboard', icon:'fa-solid fa-gauge-high', label:'Dashboard', route: '/dashboard' },
        { id:'members-section', items:[
            { id:'members', icon:'fa-solid fa-users', label:'Members', children:[
              {id:'members-active',label:'Active Members', route: '/members/active'},
              {id:'member-register',label:'Register Member', route: '/members/register'},
              {id:'members-stmt',label:'Member Statements', route: '/members/statements'},
            ]},
          ]
        },
        { id:'savings-section', items:[
            { id:'savings', icon:'fa-solid fa-piggy-bank', label:'Savings', children:[
              {id:'savings-plans',label:'Saving Plans', route: '/savings/plans'},
              {id:'savings-deposit',label:'Deposit Money', route: '/savings/deposit'},
              {id:'savings-accounts',label:'Savings Accounts', route: '/savings/accounts'},
            ]},
          ]
        },
        { id:'loans-section', items:[
            { id:'loans', icon:'fa-solid fa-hand-holding-dollar', label:'Loans', children:[
              {id:'loan-apply',label:'Apply Loan', route: '/loans/apply'},
              {id:'loan-active',label:'Active Loans', route: '/loans/active'},
              {id:'loan-repayments',label:'Loan Repayments', route: '/loans/repayments'},
            ]},
          ]
        },
        { id:'payments-section', items:[
            { id:'payments', icon:'fa-solid fa-mobile-screen-button', label:'Mobile Payments', children:[
              {id:'payments-mpesa',label:'M-Pesa', route: '/payments/mpesa'},
              {id:'payments-mobile',label:'Mobile Money', route: '/payments/mobile'},
            ]},
          ]
        },
        { id:'comm-section', items:[
            { id:'comm', icon:'fa-solid fa-comment-dots', label:'Communications', children:[
              {id:'communication',label:'Communications', route: '/communication'},
            ]},
          ]
        },
        { id:'formula-section', items:[
            { id:'formula', icon:'fa-solid fa-calculator', label:'Formula Engine', children:[
              {id:'formula-engine',label:'Formula Engine', route: '/formula-engine'},
            ]},
          ]
        },
        { id:'reports-section', items:[
            { id:'reports', icon:'fa-solid fa-chart-pie', label:'Reports', children:[
              {id:'reports-members',label:'Member Activity', route: '/reports/members'},
              {id:'reports-savings',label:'Savings Growth', route: '/reports/savings'},
              {id:'reports-loans',label:'Loan Performance', route: '/reports/loans'},
              {id:'reports-financial',label:'Profit & Loss', route: '/reports/financial'},
              {id:'reports-audit',label:'Audit Trail', route: '/reports/audit'},
              {id:'reports-risk',label:'Default Risk', route: '/reports/risk'},
            ]},
          ]
        },
        { id:'admin-section', items:[
            { id:'admin', icon:'fa-solid fa-shield-halved', label:'Security & Compliance', children:[
              {id:'admin-users',label:'Users', route: '/admin/users'},
              {id:'admin-audit',label:'Login Logs & Tracking', route: '/admin/audit'},
              {id:'security',label:'Security', route: '/security'},
              {id:'settings',label:'System Settings', route: '/settings'},
            ]},
          ]
        },
      ],
      member: [
        { id:'dashboard', icon:'fa-solid fa-gauge-high', label:'Dashboard', route: '/dashboard' },
        { id:'savings-section', items:[
            { id:'savings', icon:'fa-solid fa-piggy-bank', label:'Savings', children:[
              {id:'savings-accounts',label:'My Accounts', route: '/savings/accounts'},
              {id:'savings-deposit',label:'Deposit Request', route: '/savings/deposit'},
            ]},
          ]
        },
        { id:'loans-section', items:[
            { id:'loans', icon:'fa-solid fa-hand-holding-dollar', label:'Loans', children:[
              {id:'loan-apply',label:'Apply for Loan', route: '/loans/apply'},
              {id:'loan-active',label:'My Active Loans', route: '/loans/active'},
            ]},
          ]
        },
      ]
    },

    async doLogin() {
      try {
        const response = await fetch('/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            email: this.loginEmail,
            password: this.loginPassword
          })
        });

        const result = await response.json();

        if (result.success) {
          this.currentUser = result.user;
          this.loggedIn = true;
          this.activePage = 'dashboard';
          
          // Populate data
          this.members = result.data.members || [];
          this.recentTransactions = result.data.recentTransactions || [];
          this.activeLoans = result.data.activeLoans || [];
          this.pendingLoans = result.data.pendingLoans || [];
          this.savingsAccounts = result.data.savingsAccounts || [];
          this.systemUsers = result.data.systemUsers || [];
          this.memberAccounts = result.data.memberAccounts || [];
          this.memberLoan = (result.data.memberLoans && result.data.memberLoans.length > 0) ? result.data.memberLoans[0] : null;
          this.memberTransactions = result.data.memberTransactions || [];

          this.$nextTick(() => {
            this.initCharts();
            this.calcLoan();
          });
          this.showToast(`Welcome back, ${this.currentUser.name}!`, 'success');
          
          // Redirect to dashboard after short delay
          setTimeout(() => {
            window.location.href = '/dashboard';
          }, 1000);
        } else {
          this.showToast(result.message || 'Login failed', 'error');
        }
      } catch (error) {
        this.showToast('An error occurred during login', 'error');
      }
    },

    async logout() {
      try {
        await fetch('/logout', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });
        this.loggedIn = false;
        this.activePage = 'dashboard';
        this.sidebarOpen = false;
        window.location.reload(); // Refresh to clear state
      } catch (error) {
        console.error('Logout failed', error);
      }
    },

    saveDarkMode() {
      localStorage.setItem('feedtan_dark', this.darkMode);
    },

    navigate(page) {
      // Find route in sidebarSections
      let targetRoute = null;
      const role = this.currentUser.role === 'admin' || this.currentUser.role === 'manager' || this.currentUser.role === 'teller' ? 'admin' : 'member';
      const sections = this.sidebarSections[role];
      
      for (const section of sections) {
        if (section.id === page && section.route) {
          targetRoute = section.route;
          break;
        }
        if (section.items) {
          for (const item of section.items) {
            if (item.id === page && item.route) {
              targetRoute = item.route;
              break;
            }
            if (item.children) {
              for (const child of item.children) {
                if (child.id === page && child.route) {
                  targetRoute = child.route;
                  break;
                }
              }
            }
            if (targetRoute) break;
          }
        }
        if (targetRoute) break;
      }

      if (targetRoute) {
        window.location.href = targetRoute;
        return;
      }

      // Fallback for pages not in sidebar or special cases
      if (page === 'profile') { window.location.href = '/profile'; return; }
      if (page === 'settings') { window.location.href = '/settings'; return; }
      
      this.activePage = page;
      this.sidebarOpen = false;
      if (page === 'dashboard') {
        this.$nextTick(() => this.initCharts());
      }
    },

    hasAccess(page) {
      return true;
    },

    filteredSidebarSections() {
      const role = this.currentUser.role === 'admin' || this.currentUser.role === 'manager' || this.currentUser.role === 'teller' ? 'admin' : 'member';
      return this.sidebarSections[role] || this.sidebarSections.member;
    },

    toggleDropdown(id) {
      if (this.openDropdowns.includes(id)) {
        this.openDropdowns = this.openDropdowns.filter(d => d !== id);
      } else {
        // Only allow one dropdown open at a time
        this.openDropdowns = [id];
      }
    },

    isChildActive(item) {
      if (!item.children) return false;
      return item.children.some(c => c.id === this.activePage);
    },

    getPageTitle() {
      const titles = {
        'dashboard':'Dashboard', 'profile':'My Profile', 'members-active':'Active Members',
        'member-register':'Register Member', 'member-profile':'Member Profile',
        'savings-deposit':'Deposit Money', 'savings-accounts':'Savings Accounts',
        'loan-apply':'Apply Loan', 'loan-active':'Active Loans',
        'report-members':'Member Reports', 'report-savings':'Savings Reports',
        'report-loans':'Loan Reports', 'report-financial':'Financial Reports',
        'report-audit':'Audit Reports',
        'settings':'Settings'
      };
      return titles[this.activePage] || this.activePage.replace('-',' ').replace(/\b\w/g,c=>c.toUpperCase());
    },

    getDashboardSubtitle() {
      const role = this.currentUser.role;
      const subtitles = {
        admin: 'Full system overview',
        manager: 'System performance overview',
        teller: 'Today\'s transactions and pending actions',
        member: 'Your financial summary and account overview',
      };
      return subtitles[role] || 'System overview';
    },

    getDashboardCards() {
      const role = this.currentUser.role;
      if (role === 'member') {
        const totalSavings = this.memberAccounts.reduce((sum, acc) => sum + parseFloat(acc.balance), 0);
        const loanBalance = this.memberLoan ? parseFloat(this.memberLoan.balance) : 0;
        return [
          { id:'savings', label:'My Total Savings', value:'TZS ' + totalSavings.toLocaleString(), sub:'Across all accounts', icon:'fa-solid fa-piggy-bank', color:'#10b981', trend:5.2 },
          { id:'loans', label:'Loan Balance', value:'TZS ' + loanBalance.toLocaleString(), sub:'Active loan outstanding', icon:'fa-solid fa-hand-holding-dollar', color:'#f59e0b', trend:-2.1 },
          { id:'investments', label:'Investments', value:'TZS 0', sub:'18% p.a. returns', icon:'fa-solid fa-chart-line', color:'#3b82f6', trend:0 },
          { id:'dividend', label:'Dividend Earned', value:'TZS 0', sub:'FY 2024 distribution', icon:'fa-solid fa-coins', color:'#8b5cf6', trend:0 },
        ];
      }
      
      const totalSavings = this.savingsAccounts.reduce((sum, acc) => sum + parseFloat(acc.balance), 0);
      const totalLoans = this.activeLoans.reduce((sum, loan) => sum + parseFloat(loan.balance), 0);
      
      return [
        { id:'members', label:'Total Members', value:this.members.length.toString(), sub:'System members', icon:'fa-solid fa-users', color:'#10b981', trend:3.8 },
        { id:'loans', label:'Active Loans', value:this.activeLoans.length.toString(), sub:'TZS ' + (totalLoans/1000000).toFixed(1) + 'M outstanding', icon:'fa-solid fa-hand-holding-dollar', color:'#f59e0b', trend:12.4 },
        { id:'savings', label:'Total Savings', value:'TZS ' + (totalSavings/1000000000).toFixed(2) + 'B', sub:'Across all products', icon:'fa-solid fa-piggy-bank', color:'#3b82f6', trend:8.1 },
        { id:'investments', label:'Investments', value:'TZS 0', sub:'0 active plans', icon:'fa-solid fa-chart-line', color:'#8b5cf6', trend:0 },
      ];
    },

    showToast(msg, type='success') {
      const container = document.getElementById('toastContainer');
      if(!container) return;
      const toast = document.createElement('div');
      toast.className = `toast toast-${type}`;
      const icons = { success:'fa-solid fa-circle-check', error:'fa-solid fa-circle-xmark', info:'fa-solid fa-circle-info' };
      toast.innerHTML = `<i class="${icons[type]||icons.info}"></i><span>${msg}</span>`;
      container.appendChild(toast);
      setTimeout(() => { toast.style.opacity='0'; toast.style.transition='opacity 0.3s'; setTimeout(()=>toast.remove(),300); }, 3500);
    },

    showModal(name) {
      this.activeModal = name;
    },

    filteredMembers() {
      if (!this.memberSearch) return this.members;
      const q = this.memberSearch.toLowerCase();
      return this.members.filter(m => {
        const name = m.user ? m.user.name.toLowerCase() : '';
        return name.includes(q) || m.member_no.toLowerCase().includes(q) || (m.phone && m.phone.includes(q));
      });
    },

    charts: {},

    initCharts() {
      const isDark = this.darkMode;
      const textColor = isDark ? '#6ee7b7' : '#047857';
      const gridColor = isDark ? '#1a3328' : '#d1fae5';
      const bgColor = isDark ? '#0d1f16' : '#ffffff';

      if (this.activePage !== 'dashboard' || !this.loggedIn) return;

      Object.values(this.charts).forEach(c => { try { c.destroy(); } catch(e){} });
      this.charts = {};

      const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

      const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        animation: { duration: 1000 },
        plugins: {
          legend: { labels: { color: textColor, font: { size: 11, family: 'Plus Jakarta Sans' } } }
        },
        scales: {
          x: { ticks: { color: textColor, font: { size: 10 } }, grid: { color: gridColor, drawBorder: false } },
          y: { ticks: { color: textColor, font: { size: 10 } }, grid: { color: gridColor, drawBorder: false } }
        }
      };

      this.$nextTick(() => {
        // Loan Chart
        const loanCtx = document.getElementById('loanChart');
        if (loanCtx) {
          this.charts.loan = new Chart(loanCtx, {
            type: 'bar',
            data: {
              labels: months,
              datasets: [
                { label:'Disbursed', data:[120,145,132,168,155,187,198,210,185,225,248,287].map(v=>v*1000000), backgroundColor:'rgba(16,185,129,0.8)', borderRadius:6, order:2 },
                { label:'Collections', data:[95,118,108,142,128,162,175,188,160,198,218,252].map(v=>v*1000000), backgroundColor:'rgba(52,211,153,0.5)', borderRadius:6, order:3 },
              ]
            },
            options: {
              ...commonOptions,
              plugins: { ...commonOptions.plugins, tooltip: { callbacks: { label: ctx => 'TZS ' + (ctx.raw/1000000).toFixed(1) + 'M' } } },
              scales: { ...commonOptions.scales, y: { ...commonOptions.scales.y, ticks: { ...commonOptions.scales.y.ticks, callback: v => (v/1000000) + 'M' } } }
            }
          });
        }

        // Savings Chart
        const savCtx = document.getElementById('savingsChart');
        if (savCtx) {
          this.charts.savings = new Chart(savCtx, {
            type: 'doughnut',
            data: {
              labels:['RDA','Emergency','FLEX','SWF','Share Capital'],
              datasets:[{ data:[42,18,22,10,8], backgroundColor:['#10b981','#f59e0b','#3b82f6','#8b5cf6','#ef4444'], borderWidth:2, borderColor:bgColor }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              cutout: '70%',
              plugins: { legend: { display: false } }
            }
          });
        }

        // Member Chart
        const memCtx = document.getElementById('memberChart');
        if (memCtx) {
          this.charts.members = new Chart(memCtx, {
            type: 'line',
            data: {
              labels: months,
              datasets: [{ label: 'Members', data: [980, 1005, 1024, 1062, 1089, 1112, 1134, 1156, 1178, 1198, 1221, 1243], borderColor: '#10b981', backgroundColor: 'rgba(16,185,129,0.1)', fill: true, tension: 0.4, pointRadius: 3 }]
            },
            options: { ...commonOptions, plugins: { legend: { display: false } } }
          });
        }

        // Investment Chart
        const invCtx = document.getElementById('investChart');
        if (invCtx) {
          this.charts.invest = new Chart(invCtx, {
            type: 'bar',
            data: {
              labels: ['Fixed 12M', 'Fixed 24M', 'Treasury', 'Real Estate', 'Bonds'],
              datasets: [{ label: 'Principal', data: [1200, 800, 650, 450, 300].map(v => v * 1000000), backgroundColor: 'rgba(59,130,246,0.6)', borderRadius: 6 }]
            },
            options: {
              ...commonOptions,
              scales: { ...commonOptions.scales, y: { ...commonOptions.scales.y, ticks: { ...commonOptions.scales.y.ticks, callback: v => (v / 1000000) + 'M' } } }
            }
          });
        }

        // Collection Chart
        const colCtx = document.getElementById('collectionChart');
        if (colCtx) {
          this.charts.collection = new Chart(colCtx, {
            type: 'doughnut',
            data: {
              labels: ['Collected', 'Overdue', 'Grace Period'],
              datasets: [{ data: [89, 7, 4], backgroundColor: ['#10b981', '#ef4444', '#f59e0b'], borderWidth: 2, borderColor: bgColor }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              cutout: '70%',
              plugins: { legend: { display: false } }
            }
          });
        }
      });
    },

    initProfileChart() {
      const isDark = this.darkMode;
      const textColor = isDark ? '#6ee7b7' : '#047857';
      const gridColor = isDark ? '#1a3328' : '#d1fae5';

      if (this.activePage !== 'profile' || !this.loggedIn) return;

      const ctx = document.getElementById('profilePerformanceChart');
      if (!ctx) return;

      if (this.charts.profile) this.charts.profile.destroy();

      this.charts.profile = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
          datasets: [
            {
              label: 'Savings Growth',
              data: [1.2, 1.5, 1.8, 2.1, 2.5, 2.84].map(v => v * 1000000),
              borderColor: '#10b981',
              backgroundColor: 'rgba(16,185,129,0.1)',
              fill: true,
              tension: 0.4
            },
            {
              label: 'Loan Balance',
              data: [2.0, 1.8, 1.6, 1.4, 1.2, 1.0].map(v => v * 1000000),
              borderColor: '#3b82f6',
              backgroundColor: 'rgba(59,130,246,0.1)',
              fill: true,
              tension: 0.4
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { labels: { color: textColor, font: { size: 11, family: 'Plus Jakarta Sans' } } },
            tooltip: { callbacks: { label: ctx => 'TZS ' + ctx.raw.toLocaleString() } }
          },
          scales: {
            x: { ticks: { color: textColor, font: { size: 10 } }, grid: { color: gridColor, drawBorder: false } },
            y: { ticks: { color: textColor, font: { size: 10 }, callback: v => (v / 1000000) + 'M' }, grid: { color: gridColor, drawBorder: false } }
          }
        }
      });
    },

    init() {
      const stored = localStorage.getItem('feedtan_dark');
      if (stored !== null) this.darkMode = stored === 'true';
      this.calcLoan();
      if (this.loggedIn) {
        this.$nextTick(() => {
          this.initCharts();
          this.initProfileChart();
        });
      }
      this.$watch('darkMode', () => {
        if (this.loggedIn) {
          this.$nextTick(() => {
            if (this.activePage === 'dashboard') this.initCharts();
            if (this.activePage === 'profile') this.initProfileChart();
          });
        }
      });
    }
  }
}
</script>
