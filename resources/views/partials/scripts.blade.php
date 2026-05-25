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
    failedLogins: initialData.failedLogins || [],
    ipRestrictions: initialData.ipRestrictions || [],
    kycVerifications: initialData.kycVerifications || [],
    amlAlerts: initialData.amlAlerts || [],
    activeSessions: initialData.activeSessions || [],
    systemSettings: initialData.systemSettings || {},
    bulkSmsForm: { group: 'All Members', message: '' },
    marketingForm: { name: '', target: 'All', content: '' },
    receiptSettings: initialData.systemSettings.receipts || { logo: '', footer: '' },
    otpSettings: initialData.systemSettings.otp || { sms: true, email: true, app: true, expiry: 10, retries: 3, length: 6 },
    reminders: initialData.systemSettings.reminders || [],
    userForm: { id: null, name: '', email: '', password: '', role: 'member', branch: '', phone: '', is_active: true },
    ipForm: { label: '', ip_address: '' },
    kycUpdateForm: { id: null, status: 'Approved', notes: '' },
    amlUpdateForm: { id: null, status: 'Resolved' },
    settingsForm: {},
    securityForm: {},
    commSettingsForm: { email: {}, sms: {} },
    commTab: 'email',
    tfaSetupData: { secret: '', backup_codes: [] },
    
    getQrCodeUrl() {
      if (!this.tfaSetupData.secret) return '';
      const issuer = 'FeedTanDigital';
      const label = this.currentUser.email || 'user';
      const secret = this.tfaSetupData.secret;
      const otpauth = `otpauth://totp/${issuer}:${label}?secret=${secret}&issuer=${issuer}`;
      return `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(otpauth)}`;
    },

    passwordForm: { current_password: '', password: '', password_confirmation: '' },
    selectedUser: null,
    selectedUserLogs: [],

    async viewUserDetails(user) {
      this.selectedUser = user;
      this.selectedUserLogs = [];
      this.showModal('userDetails');
      
      try {
        const response = await fetch(`/admin/users/${user.id}/logs`);
        const result = await response.json();
        if (result.success) {
          this.selectedUserLogs = result.logs;
        }
      } catch (e) {
        console.error('Error fetching user logs', e);
      }
    },

    initSettings() {
      // Initialize settingsForm from systemSettings
      if (this.systemSettings.general) {
        this.systemSettings.general.forEach(s => {
          this.settingsForm[s.key] = s.value;
        });
      }
      if (this.systemSettings.security) {
        this.systemSettings.security.forEach(s => {
          this.securityForm[s.key] = s.value;
        });
      }
      if (this.systemSettings.email) {
        this.systemSettings.email.forEach(s => {
          this.commSettingsForm.email[s.key] = s.value;
        });
      }
      if (this.systemSettings.sms) {
        this.systemSettings.sms.forEach(s => {
          this.commSettingsForm.sms[s.key] = s.value;
        });
      }
    },

    async saveUser() {
      const isEdit = !!this.userForm.id;
      const url = isEdit ? `/admin/users/${this.userForm.id}` : '/admin/users';
      const method = isEdit ? 'PUT' : 'POST';

      try {
        const response = await fetch(url, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.userForm)
        });
        const result = await response.json();
        if (result.success) {
          if (isEdit) {
            const idx = this.systemUsers.findIndex(u => u.id === result.user.id);
            if (idx !== -1) this.systemUsers[idx] = result.user;
          } else {
            this.systemUsers.push(result.user);
          }
          this.activeModal = null;
          this.showToast(`User ${isEdit ? 'updated' : 'created'} successfully`, 'success');
        } else {
          this.showToast(result.message || 'Error saving user', 'error');
        }
      } catch (e) {
        this.showToast('Server error occurred', 'error');
      }
    },

    async deleteUser(id) {
      if (!confirm('Are you sure you want to delete this user?')) return;
      try {
        const response = await fetch(`/admin/users/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });
        const result = await response.json();
        if (result.success) {
          this.systemUsers = this.systemUsers.filter(u => u.id !== id);
          this.showToast('User deleted successfully', 'success');
        }
      } catch (e) {
        this.showToast('Error deleting user', 'error');
      }
    },

    async saveSettings() {
      try {
        const response = await fetch('/settings', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.settingsForm)
        });
        const result = await response.json();
        if (result.success) {
          this.showToast('Settings saved successfully', 'success');
        }
      } catch (e) {
        this.showToast('Error saving settings', 'error');
      }
    },

    async saveSecurity() {
      try {
        const response = await fetch('/security', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.securityForm)
        });
        const result = await response.json();
        if (result.success) {
          this.showToast('Security settings saved successfully', 'success');
        }
      } catch (e) {
        this.showToast('Error saving security settings', 'error');
      }
    },

    async saveCommSettings(group) {
      try {
        const response = await fetch('/admin/comm-settings', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            group: group,
            settings: this.commSettingsForm[group]
          })
        });
        const result = await response.json();
        if (result.success) {
          this.showToast('Communication settings updated', 'success');
        }
      } catch (e) {
        this.showToast('Error updating communication settings', 'error');
      }
    },

    async sendBulkSms() {
      try {
        const response = await fetch('/admin/bulk-sms', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.bulkSmsForm)
        });
        const result = await response.json();
        if (result.success) {
          this.showToast('Bulk SMS campaign initiated', 'success');
          this.bulkSmsForm.message = '';
        }
      } catch (e) {
        this.showToast('Error sending bulk SMS', 'error');
      }
    },

    async saveReceiptSettings() {
      try {
        const response = await fetch('/admin/receipts', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.receiptSettings)
        });
        const result = await response.json();
        if (result.success) {
          this.showToast('Receipt settings updated', 'success');
        }
      } catch (e) {
        this.showToast('Error updating receipt settings', 'error');
      }
    },

    async saveOtpSettings() {
      try {
        const response = await fetch('/admin/otp-settings', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.otpSettings)
        });
        const result = await response.json();
        if (result.success) {
          this.showToast('OTP settings updated', 'success');
        }
      } catch (e) {
        this.showToast('Error updating OTP settings', 'error');
      }
    },

    async changePassword() {
      try {
        const response = await fetch('/security/password', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.passwordForm)
        });
        const result = await response.json();
        if (result.success) {
          this.passwordForm = { current_password: '', password: '', password_confirmation: '' };
          this.showToast('Password changed successfully', 'success');
        } else {
          this.showToast(result.message || 'Error changing password', 'error');
        }
      } catch (e) {
        this.showToast('Error changing password', 'error');
      }
    },

    async toggle2FA(type, currentStatus) {
      try {
        const response = await fetch('/security/2fa', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            type: type,
            enabled: !currentStatus
          })
        });
        const result = await response.json();
        if (result.success) {
          this.currentUser = result.user;
          this.showToast(result.message, 'success');
          
          if (type === 'authenticator' && !currentStatus) {
            this.tfaSetupData = {
              secret: result.secret,
              backup_codes: result.backup_codes
            };
            this.showModal('tfaSetup');
          }
        }
      } catch (e) {
        this.showToast('Error updating 2FA settings', 'error');
      }
    },

    async saveIpRestriction() {
      try {
        const response = await fetch('/admin/ip-restrictions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.ipForm)
        });
        const result = await response.json();
        if (result.success) {
          this.ipRestrictions.push(result.restriction);
          this.ipForm = { label: '', ip_address: '' };
          this.showToast('IP restriction added successfully', 'success');
        }
      } catch (e) {
        this.showToast('Error adding IP restriction', 'error');
      }
    },

    async deleteIpRestriction(id) {
      if (!confirm('Are you sure you want to remove this IP restriction?')) return;
      try {
        const response = await fetch(`/admin/ip-restrictions/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });
        const result = await response.json();
        if (result.success) {
          this.ipRestrictions = this.ipRestrictions.filter(r => r.id !== id);
          this.showToast('IP restriction removed', 'success');
        }
      } catch (e) {
        this.showToast('Error removing IP restriction', 'error');
      }
    },

    async updateKycStatus() {
      try {
        const response = await fetch(`/admin/kyc/${this.kycUpdateForm.id}/status`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.kycUpdateForm)
        });
        const result = await response.json();
        if (result.success) {
          const idx = this.kycVerifications.findIndex(k => k.id === result.kyc.id);
          if (idx !== -1) this.kycVerifications[idx] = result.kyc;
          this.activeModal = null;
          this.showToast('KYC status updated', 'success');
        }
      } catch (e) {
        this.showToast('Error updating KYC status', 'error');
      }
    },

    async updateAmlStatus(alertId, status) {
      try {
        const response = await fetch(`/admin/aml/${alertId}/status`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ status: status })
        });
        const result = await response.json();
        if (result.success) {
          const idx = this.amlAlerts.findIndex(a => a.id === result.alert.id);
          if (idx !== -1) this.amlAlerts[idx] = result.alert;
          this.showToast('AML status updated', 'success');
        }
      } catch (e) {
        this.showToast('Error updating AML status', 'error');
      }
    },

    async terminateSession(id) {
      if (!confirm('Are you sure you want to terminate this session?')) return;
      try {
        const response = await fetch(`/admin/sessions/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });
        const result = await response.json();
        if (result.success) {
          this.activeSessions = this.activeSessions.filter(s => s.id !== id);
          this.showToast('Session terminated', 'success');
        }
      } catch (e) {
        this.showToast('Error terminating session', 'error');
      }
    },

    async terminateAllSessions() {
      if (!confirm('Are you sure you want to terminate all other sessions?')) return;
      try {
        const response = await fetch('/admin/sessions/terminate-all', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        });
        const result = await response.json();
        if (result.success) {
          const myId = this.currentUser.id;
          this.activeSessions = this.activeSessions.filter(s => s.user_id === myId);
          this.showToast('All other sessions terminated', 'success');
        }
      } catch (e) {
        this.showToast('Error terminating sessions', 'error');
      }
    },
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
        
        // Members Module
        { id:'members-section', items:[
            { id:'members', icon:'fa-solid fa-users', label:'Members', children:[
              {id:'members-active',label:'All Members', route: '/members/active'},
              {id:'member-register',label:'Add Member', route: '/members/register'},
              {id:'members-groups',label:'Groups', route: '/members/groups'},
              {id:'members-guarantors',label:'Guarantors', route: '/members/guarantors'},
              {id:'admin-kyc',label:'KYC Verification', route: '/admin/kyc'},
              {id:'members-accounts',label:'Member Accounts', route: '/members/active'},
              {id:'members-docs',label:'Documents', route: '/members/documents'},
              {id:'reports-members',label:'Member Reports', route: '/reports/members'},
              {id:'members-blacklisted',label:'Blacklisted Members', route: '/members/blacklisted'},
            ]},
          ]
        },

        // Loan Management Module
        { id:'loans-section', items:[
            { id:'loans', icon:'fa-solid fa-hand-holding-dollar', label:'Loan Management', children:[
              {id:'loan-apply',label:'Loan applications', route: '/loans/apply'},
              {id:'loan-approval',label:'Loan approval workflow', route: '/loans/approval-workflow'},
              {id:'loan-guarantors',label:'Guarantor management', route: '/loans/guarantor-mgmt'},
              {id:'loan-active',label:'Loan disbursement', route: '/loans/active'},
              {id:'loan-repayments',label:'Repayment schedules', route: '/loans/repayments'},
              {id:'loan-penalty',label:'Penalty calculations', route: '/loans/penalty-calc'},
              {id:'loan-restructure',label:'Loan restructuring', route: '/loans/restructuring'},
              {id:'loan-refinance',label:'Loan refinancing', route: '/loans/refinancing'},
              {id:'loan-writeoffs',label:'Loan write-offs', route: '/loans/write-offs'},
              {id:'loan-products',label:'Loan products setup', route: '/loans/products-setup'},
              {id:'loan-interest',label:'Interest configuration', route: '/loans/interest-config'},
              {id:'loan-collateral',label:'Collateral management', route: '/loans/collateral-mgmt'},
            ]},
          ]
        },

        // Accounting & Finance Module
        { id:'accounting-section', items:[
            { id:'accounting', icon:'fa-solid fa-calculator', label:'Accounting & Finance', children:[
              {id:'accounting-ledger',label:'General ledger', route: '/accounting/ledger'},
              {id:'accounting-cashbook',label:'Cashbook', route: '/accounting/cashbook'},
              {id:'accounting-journals',label:'Journal entries', route: '/accounting/journals'},
              {id:'accounting-trial',label:'Trial balance', route: '/accounting/trial-balance'},
              {id:'accounting-pl',label:'Profit & loss', route: '/accounting/profit-loss'},
              {id:'accounting-bs',label:'Balance sheet', route: '/accounting/balance-sheet'},
              {id:'accounting-expenses',label:'Expense tracking', route: '/accounting/expenses'},
              {id:'accounting-income',label:'Income tracking', route: '/accounting/income'},
              {id:'accounting-bankrec',label:'Bank reconciliation', route: '/accounting/bank-rec'},
            ]},
          ]
        },

        // Reports & Analytics Module
        { id:'reports-section', items:[
            { id:'reports', icon:'fa-solid fa-chart-pie', label:'Reports & Analytics', children:[
              {id:'reports-loans',label:'Loan portfolio reports', route: '/reports/loans'},
              {id:'reports-risk',label:'PAR (Portfolio at Risk)', route: '/reports/risk'},
              {id:'admin-due-alerts',label:'Collection reports', route: '/admin/due-alerts'},
              {id:'reports-financial',label:'Financial statements', route: '/reports/financial'},
              {id:'reports-branch',label:'Branch performance', route: '/reports/branch-performance'},
              {id:'reports-staff',label:'Staff performance', route: '/reports/staff-performance'},
              {id:'reports-defaulter',label:'Defaulter analysis', route: '/reports/defaulter-analysis'},
              {id:'reports-cashflow',label:'Cash flow analytics', route: '/reports/cashflow-analytics'},
              {id:'reports-ai',label:'AI-powered business insights', route: '/reports/ai-insights'},
            ]},
          ]
        },

        // System Settings Module
        { id:'settings-section', items:[
            { id:'settings-master', icon:'fa-solid fa-gears', label:'System Settings', children:[
              {id:'settings-currency',label:'Currency settings', route: '/settings/currency'},
              {id:'settings-interest',label:'Interest calculation methods', route: '/settings/interest'},
              {id:'settings-penalty',label:'Penalty rules', route: '/settings/penalty'},
              {id:'settings-fiscal',label:'Fiscal year setup', route: '/settings/fiscal-year'},
              {id:'settings-profile',label:'Business profile', route: '/settings/business-profile'},
              {id:'settings-tax',label:'Tax configuration', route: '/settings/tax'},
              {id:'admin-receipts',label:'Receipt templates', route: '/admin/receipts'},
              {id:'settings-numbers',label:'Number generation rules', route: '/settings/number-generation'},
              {id:'settings-backup',label:'Backup & restore', route: '/settings/backup'},
              {id:'settings-lang',label:'Language settings', route: '/settings/language'},
            ]},
          ]
        },

        { id: 'users-section', items: [
          {
            id: 'admin-users-mgmt', icon: 'fa-solid fa-users-gear', label: 'Users Management', children: [
              { id: 'admin-users', label: 'Users Management', route: '/admin/users' },
              { id: 'admin-roles', label: 'User roles & permissions', route: '/admin/roles' },
              { id: 'admin-staff-activity', label: 'Staff activity tracking', route: '/admin/audit' },
              { id: 'admin-staff-performance', label: 'Staff targets & performance', route: '/admin/performance' },
            ]
          },
        ] },
        { id: 'security-section', items: [
          {
            id: 'admin-security-compliance', icon: 'fa-solid fa-shield-halved', label: 'Security & Compliance', children: [
              { id: 'security', label: 'Two-factor authentication (2FA)', route: '/security' },
              { id: 'admin-sessions', label: 'Device/session management', route: '/admin/sessions' },
              { id: 'admin-ip-restrictions', label: 'IP restrictions', route: '/admin/ip-restrictions' },
              { id: 'admin-password-policies', label: 'Password policies', route: '/admin/password-policies' },
              { id: 'reports-audit', label: 'Audit trails', route: '/reports/audit' },
              { id: 'admin-encryption', label: 'Data encryption', route: '/admin/encryption' },
              { id: 'reports-compliance', label: 'Compliance reports', route: '/reports/compliance' },
              { id: 'admin-kyc', label: 'KYC verification', route: '/admin/kyc' },
              { id: 'admin-aml', label: 'AML monitoring', route: '/admin/aml' },
              { id: 'admin-fraud', label: 'Fraud detection alerts', route: '/admin/fraud' },
              { id: 'admin-regulatory', label: 'Regulatory reporting', route: '/admin/regulatory' },
            ]
          },
        ] },
        { id: 'logs-section', items: [
          {
            id: 'admin-logs-tracking', icon: 'fa-solid fa-list-check', label: 'Login Logs & Tracking', children: [
              { id: 'admin-audit', label: 'Login history', route: '/admin/audit' },
              { id: 'admin-failed-logins', label: 'Failed login attempts', route: '/admin/failed-logins' },
              { id: 'admin-device-tracking', label: 'Device tracking', route: '/admin/device-tracking' },
              { id: 'admin-browser-tracking', label: 'Browser tracking', route: '/admin/browser-tracking' },
              { id: 'admin-geo-logs', label: 'Geolocation logs', route: '/admin/geo-logs' },
              { id: 'admin-active-sessions', label: 'Active sessions', route: '/admin/active-sessions' },
              { id: 'admin-suspicious-alerts', label: 'Suspicious activity alerts', route: '/admin/suspicious-alerts' },
            ]
          },
        ] },
        { id: 'comm-section', items: [
          {
            id: 'admin-comm-settings-section', icon: 'fa-solid fa-bullhorn', label: 'Communication Settings', children: [
              { id: 'admin-comm-settings', label: 'SMS & Email Configuration', route: '/admin/settings/communication' },
              { id: 'admin-reminders', label: 'Payment reminders', route: '/admin/reminders' },
              { id: 'admin-due-alerts', label: 'Due-date alerts', route: '/admin/due-alerts' },
              { id: 'admin-bulk-sms', label: 'Bulk SMS', route: '/admin/bulk-sms' },
              { id: 'admin-marketing', label: 'Marketing campaigns', route: '/admin/marketing' },
              { id: 'admin-receipts', label: 'Auto-generated receipts', route: '/admin/receipts' },
              { id: 'admin-otp-settings', label: 'OTP settings', route: '/admin/otp-settings' },
            ]
          },
        ] },
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
      this.activeSessions = result.data.activeSessions || [];
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

    initSidebarScroll() {
      const sidebarNav = document.getElementById('sidebar-nav');
      if (sidebarNav) {
        // Restore scroll position
        const savedPosition = localStorage.getItem('sidebar-scroll');
        if (savedPosition) {
          sidebarNav.scrollTop = parseInt(savedPosition);
        }

        // Save scroll position on scroll
        sidebarNav.addEventListener('scroll', () => {
          localStorage.setItem('sidebar-scroll', sidebarNav.scrollTop);
        });
      }
    },

    init() {
      const stored = localStorage.getItem('feedtan_dark');
      if (stored !== null) this.darkMode = stored === 'true';
      this.calcLoan();
      this.initSettings();
      this.initSidebarScroll();
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
