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
    sidebarCollapsed: localStorage.getItem('feedtan_sidebar_collapsed') === 'true',
    activePage: initialData.activePage || 'dashboard',
    isLoading: initialData.isLoading ?? false,
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

    // Accounting & Finance
    ledgerEntries: [
      { code: '1000', name: 'Cash at Hand', cat: 'Asset', debit: 4200000, credit: 0, balance: 4200000 },
      { code: '1100', name: 'Bank Account - CRDB', cat: 'Asset', debit: 125800000, credit: 0, balance: 125800000 },
      { code: '1200', name: 'Loan Portfolio', cat: 'Asset', debit: 5420000000, credit: 0, balance: 5420000000 },
      { code: '2000', name: 'Member Savings', cat: 'Liability', debit: 0, credit: 3820000000, balance: -3820000000 },
      { code: '3000', name: 'Interest Income', cat: 'Income', debit: 0, credit: 450000000, balance: -450000000 },
      { code: '4000', name: 'Office Expenses', cat: 'Expense', debit: 12000000, credit: 0, balance: 12000000 },
    ],
    cashbookEntries: [
      { id: 1, date: '2026-05-24', ref: 'CB-99281', desc: 'Loan Repayment - John Doe', cat: 'Loan Inflow', in: 150000, out: 0, balance: 4200000 },
      { id: 2, date: '2026-05-24', ref: 'CB-99280', desc: 'Office Supplies', cat: 'Expense', in: 0, out: 45000, balance: 4050000 },
    ],
    journalEntries: [],
    incomeEntries: [],
    expenseEntries: [],
    bankRecItems: [],
    trialBalanceItems: [],

    // Investments Management
    investmentProducts: [
      { id: 1, name: 'Fixed Deposit – 12 Months', description: 'High-yield savings with 18% annual return paid at maturity.', rate: 18, duration: 12, min_amount: 500000, payout: 'At Maturity', color: '#10b981', icon: 'fa-solid fa-piggy-bank', active: true, allocation: 45 },
      { id: 2, name: 'Wealth Builder Plan', description: 'Compound interest plan with monthly profit distributions.', rate: 15, duration: 24, min_amount: 1000000, payout: 'Monthly', color: '#3b82f6', icon: 'fa-solid fa-chart-line', active: true, allocation: 30 },
      { id: 3, name: 'Treasury Bond Fund', description: 'Stable returns backed by government securities.', rate: 12, duration: 6, min_amount: 100000, payout: 'Quarterly', color: '#f59e0b', icon: 'fa-solid fa-building-columns', active: true, allocation: 15 },
      { id: 4, name: 'Real Estate Fund', description: 'Long-term capital appreciation from property investments.', rate: 20, duration: 60, min_amount: 5000000, payout: 'Annually', color: '#ef4444', icon: 'fa-solid fa-house-chimney', active: true, allocation: 10 },
    ],
    activeInvestments: [
      { id: 1, ref: 'INV-2026-001', member_name: 'John Doe', product_name: 'Fixed Deposit – 12 Months', principal: 5000000, rate: 18, start_date: '2026-01-15', maturity_date: '2027-01-15', accrued: 450000, status: 'Active' },
      { id: 2, ref: 'INV-2026-002', member_name: 'Jane Smith', product_name: 'Wealth Builder Plan', principal: 12000000, rate: 15, start_date: '2026-02-10', maturity_date: '2028-02-10', accrued: 600000, status: 'Active' },
      { id: 3, ref: 'INV-2025-098', member_name: 'Hamis Juma', product_name: 'Treasury Bond Fund', principal: 2500000, rate: 12, start_date: '2025-11-20', maturity_date: '2026-05-20', accrued: 150000, status: 'matured' },
    ],
    profitPayments: [
      { id: 1, date: '2026-05-01', ref: 'PAY-88291', member_name: 'John Doe', inv_ref: 'INV-2026-001', amount: 75000, method: 'Member Account' },
      { id: 2, date: '2026-05-01', ref: 'PAY-88292', member_name: 'Jane Smith', inv_ref: 'INV-2026-002', amount: 150000, method: 'Bank Transfer' },
    ],

    // Loans Management
    loanRepayments: [],
    approvalRequests: [],
    collateralItems: [],
    guarantorItems: [],
    penaltyLogs: [],
    restructuringLogs: [],
    refinancingLogs: [],
    writeOffLogs: [],
    loanProducts: [],
    interestRules: [],

    bulkSmsForm: { group: 'All Members', message: '' },
    marketingForm: { name: '', target: 'All', content: '' },
    receiptSettings: (initialData.systemSettings && initialData.systemSettings.receipts) ? initialData.systemSettings.receipts : { logo: '', footer: '' },
    otpSettings: (initialData.systemSettings && initialData.systemSettings.otp) ? initialData.systemSettings.otp : { sms: true, email: true, app: true, expiry: 10, retries: 3, length: 6 },
    reminders: (initialData.systemSettings && initialData.systemSettings.reminders) ? initialData.systemSettings.reminders : [],
    userForm: { id: null, name: '', email: '', password: '', role: 'teller', branch: '', phone: '', is_active: true },
    memberForm: { 
      id: null, 
      name: '', 
      email: '', 
      phone: '', 
      nida: '', 
      gender: '', 
      dob: '', 
      marital_status: '', 
      occupation: '', 
      employer: '', 
      region: 'Dar es Salaam', 
      district: '', 
      ward: '', 
      street: '', 
      po_box: '', 
      membership_type: 'Regular', 
      branch: 'Dar es Salaam HQ', 
      next_of_kin_name: '', 
      next_of_kin_relationship: '', 
      next_of_kin_phone: '', 
      status: 'Active' 
    },
    ipForm: { label: '', ip_address: '' },
    selectedMember: null,
    selectedMemberToDelete: null,
    deleteReason: '',
    memberTypes: initialData.memberTypes || [],
    documents: initialData.documents || [],
    blacklisted: initialData.blacklisted || [],
    selectedMemberType: null,
    selectedMemberTypeToDelete: null,
    memberTypeForm: {
        id: null,
        name: '',
        description: '',
        status: 'Active',
    },
    memberPhoto: null,
    memberPhotoPreview: null,
    memberNidaCard: null,
    memberNidaCardPreview: null,
    profileForm: { name: '', email: '', phone: '', profile_image: null },
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

    resetMemberForm() {
      this.memberForm = { 
        id: null, 
        name: '', 
        email: '', 
        phone: '', 
        nida: '', 
        gender: '', 
        dob: '', 
        marital_status: '', 
        occupation: '', 
        employer: '', 
        region: 'Dar es Salaam', 
        district: '', 
        ward: '', 
        street: '', 
        po_box: '', 
        membership_type: 'Regular', 
        branch: 'Dar es Salaam HQ', 
        next_of_kin_name: '', 
        next_of_kin_relationship: '', 
        next_of_kin_phone: '', 
        status: 'Active' 
      };
      this.memberPhoto = null;
      this.memberPhotoPreview = null;
      this.memberNidaCard = null;
      this.memberNidaCardPreview = null;
    },

    async saveMember() {
      try {
        const formData = new FormData();
        Object.keys(this.memberForm).forEach(key => {
          if (this.memberForm[key] !== null && this.memberForm[key] !== undefined) {
            formData.append(key, this.memberForm[key]);
          }
        });
        const response = await fetch('/members', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          this.members.push(result.member);
          this.activeModal = null;
          this.resetMemberForm();
          this.showToast('Member registered successfully', 'success');
        } else {
          this.showToast(result.message || 'Error registering member', 'error');
        }
      } catch (e) {
        this.showToast('Server error occurred', 'error');
      }
    },

    editMember(member) {
      this.memberForm = {
        id: member.id,
        name: member.user ? member.user.name : '',
        email: member.user ? member.user.email : '',
        phone: member.phone || '',
        nida: member.nida || '',
        gender: member.gender || '',
        dob: member.dob || '',
        marital_status: member.marital_status || '',
        occupation: member.occupation || '',
        employer: member.employer || '',
        region: member.region || 'Dar es Salaam',
        district: member.district || '',
        ward: member.ward || '',
        street: member.street || '',
        po_box: member.po_box || '',
        membership_type: member.membership_type || 'Regular',
        branch: member.branch || 'Dar es Salaam HQ',
        next_of_kin_name: member.next_of_kin_name || '',
        next_of_kin_relationship: member.next_of_kin_relationship || '',
        next_of_kin_phone: member.next_of_kin_phone || '',
        status: member.status || 'Active'
      };
      this.memberPhotoPreview = member.passport_photo || null;
      this.memberNidaCardPreview = member.nida_card || null;
      this.memberPhoto = null;
      this.memberNidaCard = null;
      this.activeModal = 'editMember';
    },

    async updateMember() {
      try {
        const formData = new FormData();
        formData.append('_method', 'PUT');
        Object.keys(this.memberForm).forEach(key => {
          if (this.memberForm[key] !== null && this.memberForm[key] !== undefined) {
            formData.append(key, this.memberForm[key]);
          }
        });
        if (this.memberPhoto) {
          formData.append('passport_photo', this.memberPhoto);
        }
        if (this.memberNidaCard) {
          formData.append('nida_card', this.memberNidaCard);
        }
        const response = await fetch(`/members/${this.memberForm.id}`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          const idx = this.members.findIndex(m => m.id === result.member.id);
          if (idx !== -1) this.members[idx] = result.member;
          this.activeModal = null;
          this.resetMemberForm();
          this.showToast('Member updated successfully', 'success');
        } else {
          this.showToast(result.message || 'Error updating member', 'error');
        }
      } catch (e) {
        this.showToast('Server error occurred', 'error');
      }
    },

    viewMember(member) {
      this.selectedMember = member;
      this.activeModal = 'viewMember';
    },
    async deleteMember(member) {
      this.selectedMemberToDelete = member;
      this.activeModal = 'deleteMember';
    },
    async confirmDeleteMember() {
      if (!this.selectedMemberToDelete || !this.deleteReason) return;
      try {
        const formData = new FormData();
        formData.append('reason', this.deleteReason);
        formData.append('_method', 'DELETE');
        
        const response = await fetch(`/members/${this.selectedMemberToDelete.id}`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          this.members = this.members.filter(m => m.id !== this.selectedMemberToDelete.id);
          this.showToast('Member deleted successfully', 'success');
        }
        this.activeModal = null;
        this.selectedMemberToDelete = null;
        this.deleteReason = '';
      } catch (e) {
        this.showToast('Error deleting member', 'error');
        this.activeModal = null;
        this.selectedMemberToDelete = null;
        this.deleteReason = '';
      }
    },
    resetMemberTypeForm() {
      this.memberTypeForm = {
        id: null,
        name: '',
        description: '',
        status: 'Active',
      };
      this.selectedMemberType = null;
      this.selectedMemberTypeToDelete = null;
    },
    viewMemberType(type) {
      this.selectedMemberType = type;
      this.activeModal = 'viewMemberType';
    },
    editMemberType(type) {
      this.memberTypeForm = {
        id: type.id,
        name: type.name,
        description: type.description || '',
        status: type.status || 'Active',
      };
      this.activeModal = 'editMemberType';
    },
    async saveMemberType() {
      try {
        const formData = new FormData();
        formData.append('name', this.memberTypeForm.name);
        formData.append('description', this.memberTypeForm.description);
        formData.append('status', this.memberTypeForm.status);
        
        const response = await fetch('/members/types', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          this.memberTypes.push(result.type);
          this.activeModal = null;
          this.resetMemberTypeForm();
          this.showToast('Member type added successfully', 'success');
        } else {
          this.showToast(result.message || 'Error adding member type', 'error');
        }
      } catch (e) {
        this.showToast('Server error occurred', 'error');
      }
    },
    async updateMemberType() {
      try {
        const formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('name', this.memberTypeForm.name);
        formData.append('description', this.memberTypeForm.description);
        formData.append('status', this.memberTypeForm.status);
        
        const response = await fetch(`/members/types/${this.memberTypeForm.id}`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          const index = this.memberTypes.findIndex(t => t.id === result.type.id);
          if (index !== -1) {
            this.memberTypes[index] = result.type;
          }
          this.activeModal = null;
          this.resetMemberTypeForm();
          this.showToast('Member type updated successfully', 'success');
        } else {
          this.showToast(result.message || 'Error updating member type', 'error');
        }
      } catch (e) {
        this.showToast('Server error occurred', 'error');
      }
    },
    deleteMemberType(type) {
      this.selectedMemberTypeToDelete = type;
      this.activeModal = 'deleteMemberType';
    },
    async confirmDeleteMemberType() {
      if (!this.selectedMemberTypeToDelete) return;
      try {
        const formData = new FormData();
        formData.append('_method', 'DELETE');
        
        const response = await fetch(`/members/types/${this.selectedMemberTypeToDelete.id}`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          this.memberTypes = this.memberTypes.filter(t => t.id !== this.selectedMemberTypeToDelete.id);
          this.showToast('Member type deleted successfully', 'success');
        }
        this.activeModal = null;
        this.resetMemberTypeForm();
      } catch (e) {
        this.showToast('Error deleting member type', 'error');
        this.activeModal = null;
        this.resetMemberTypeForm();
      }
    },
    uploadedImage: null,
    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.uploadedImage = file;
        const reader = new FileReader();
        reader.onload = (e) => {
          this.profileForm.profile_image = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    handleMemberPhoto(event) {
      const file = event.target.files[0];
      if (file) {
        this.memberPhoto = file;
        const reader = new FileReader();
        reader.onload = (e) => {
          this.memberPhotoPreview = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    handleMemberNidaCard(event) {
      const file = event.target.files[0];
      if (file) {
        this.memberNidaCard = file;
        const reader = new FileReader();
        reader.onload = (e) => {
          this.memberNidaCardPreview = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    async updateProfile() {
      try {
        const formData = new FormData();
        formData.append('name', this.profileForm.name);
        formData.append('email', this.profileForm.email);
        formData.append('phone', this.profileForm.phone);
        
        if (this.uploadedImage) {
          formData.append('profile_image', this.uploadedImage);
        }
        
        const response = await fetch('/profile/update', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          this.currentUser = result.user;
          if (result.user.profile_image) {
            this.profileForm.profile_image = result.user.profile_image;
          }
          this.uploadedImage = null;
          this.showToast('Profile updated successfully', 'success');
        } else {
          this.showToast(result.message || 'Error updating profile', 'error');
        }
      } catch (e) {
        this.showToast('Server error occurred', 'error');
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
        // Members Module
        { id:'members-section', items:[
            { id:'members', icon:'fa-solid fa-users', label:'Members', children:[
              {id:'members-active',label:'All Members', route: '/members/active'},
              {id:'member-register',label:'Add Member', route: '/members/register'},
              {id:'admin-kyc',label:'KYC Verification', route: '/admin/kyc'},
              {id:'members-docs',label:'Documents', route: '/members/documents'},
              {id:'members-blacklisted',label:'Blacklisted Members', route: '/members/blacklisted'},
              {id:'member-types',label:'Member Types', route: '/members/types'},
            ]},
          ]
        },

        // Savings & Deposits Module
        { id:'savings-section', items:[
            { id:'savings-deposits', icon:'fa-solid fa-piggy-bank', label:'Savings & Deposits', children:[
              {id:'savings-dashboard',label:'Dashboard', route: '/savings/dashboard'},
              {id:'savings-accounts',label:'Savings Accounts', route: '/savings/accounts'},
              {id:'savings-products',label:'Savings Products', route: '/savings/products'},
              {id:'deposits-group',label:'Deposits', children:[
                {id:'deposit-new',label:'New Deposit', route: '/deposits/new'},
                {id:'deposit-history',label:'Deposit History', route: '/deposits/history'},
                {id:'deposit-bulk',label:'Bulk Deposits', route: '/deposits/bulk'},
                {id:'deposit-mobile',label:'Mobile Deposits', route: '/deposits/mobile'},
                {id:'deposit-pending',label:'Pending Deposits', route: '/deposits/pending'},
                {id:'deposit-reports',label:'Deposit Reports', route: '/deposits/reports'},
              ]},
              {id:'withdrawals-group',label:'Withdrawals', children:[
                {id:'withdrawal-new',label:'New Withdrawal', route: '/withdrawals/new'},
                {id:'withdrawal-requests',label:'Withdrawal Requests', route: '/withdrawals/requests'},
                {id:'withdrawal-history',label:'Withdrawal History', route: '/withdrawals/history'},
                {id:'withdrawal-approved',label:'Approved Withdrawals', route: '/withdrawals/approved'},
                {id:'withdrawal-rejected',label:'Rejected Withdrawals', route: '/withdrawals/rejected'},
              ]},
              {id:'interest-group',label:'Interest Management', children:[
                {id:'interest-rules',label:'Interest Rules', route: '/interest/rules'},
                {id:'interest-posting',label:'Interest Posting', route: '/interest/posting'},
                {id:'interest-history',label:'Interest History', route: '/interest/history'},
              ]},
              {id:'statements-group',label:'Statements', children:[
                {id:'member-statements',label:'Member Statements', route: '/statements/member'},
                {id:'savings-statements',label:'Savings Statements', route: '/statements/savings'},
                {id:'download-reports',label:'Download Reports', route: '/statements/download'},
              ]},
              {id:'reports-group',label:'Reports', children:[
                {id:'savings-summary',label:'Savings Summary', route: '/reports/savings/summary'},
                {id:'reports-deposits',label:'Deposit Reports', route: '/reports/savings/deposits'},
                {id:'reports-withdrawals',label:'Withdrawal Reports', route: '/reports/savings/withdrawals'},
                {id:'reports-branch',label:'Branch Reports', route: '/reports/savings/branch'},
              ]},
            ]},
          ]
        },

        // Loan Management Module
        { id:'loans-section', items:[
            { id:'loans', icon:'fa-solid fa-hand-holding-dollar', label:'Loan Management', children:[
              {id:'loan-dashboard',label:'Loan Dashboard', route: '/loans/dashboard'},
              {id:'loan-apply',label:'Loan applications', route: '/loans/apply'},
              {id:'loan-approval',label:'Loan approval workflow', route: '/loans/approval-workflow'},
              {id:'loan-active',label:'Loan disbursement', route: '/loans/active'},
              {id:'loan-repayments',label:'Repayment schedules', route: '/loans/repayments'},
              {id:'loan-products',label:'Loan products', route: '/loans/products-setup'},
            ]},
          ]
        },

        // Investments Module
        { id:'investments-section', items:[
            { id:'investments', icon:'fa-solid fa-chart-line', label:'Investments', children:[
              {id:'investments-dashboard',label:'Investment Dashboard', route: '/investments/dashboard'},
              {id:'investments-products',label:'Investment Products', route: '/investments/products'},
              {id:'investments-open',label:'Open Investment', route: '/investments/open'},
              {id:'investments-active',label:'Active Investments', route: '/investments/active'},
              {id:'investments-matured',label:'Matured Investments', route: '/investments/matured'},
              {id:'investments-profit-payments',label:'Profit Payments', route: '/investments/profit-payments'},
              {id:'investments-reports',label:'Investment Reports', route: '/investments/reports'},
              {id:'investments-certificates',label:'Certificates', route: '/investments/certificates'},
            ]},
          ]
        },

        // System Settings Module
        { id:'settings-section', items:[
            { id:'settings-master', icon:'fa-solid fa-gears', label:'System Settings', children:[
              {id:'settings-currency',label:'Currency settings', route: '/settings/currency'},
              {id:'settings-fiscal',label:'Fiscal year setup', route: '/settings/fiscal-year'},
              {id:'settings-profile',label:'Business profile', route: '/settings/business-profile'},
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
              { id: 'admin-bulk-sms', label: 'Bulk SMS', route: '/admin/bulk-sms' },
            ]
          },
        ] },
      ],
    },

    async doLogin() {
      this.isLoading = true;
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
      } finally {
        this.isLoading = false;
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
      const staffRoles = ['admin', 'manager', 'teller', 'auditor', 'deposit_officer', 'loan_officer', 'swf_officer', 'marketing_officer', 'secretary', 'chairperson', 'accountant'];
      const role = staffRoles.includes(this.currentUser.role) ? 'admin' : 'member';
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
        this.isLoading = true;
        window.location.href = targetRoute;
        return;
      }

      // Fallback for pages not in sidebar or special cases
      if (page === 'profile' || page === 'settings') {
        this.isLoading = true;
        window.location.href = page === 'profile' ? '/profile' : '/settings';
        return;
      }
      
      this.activePage = page;
      this.sidebarOpen = false;
      if (this.activePage === 'dashboard' || this.activePage === 'investments-dashboard') {
        this.$nextTick(() => this.initCharts());
      }
    },

    hasAccess(page) {
      return true;
    },

    filteredSidebarSections() {
      const staffRoles = ['admin', 'manager', 'teller', 'auditor', 'deposit_officer', 'loan_officer', 'swf_officer', 'marketing_officer', 'secretary', 'chairperson', 'accountant'];
      const role = staffRoles.includes(this.currentUser.role) ? 'admin' : 'member';
      return this.sidebarSections[role] || this.sidebarSections.member;
    },

    toggleDropdown(id) {
      if (this.openDropdowns.includes(id)) {
        this.openDropdowns = this.openDropdowns.filter(d => d !== id);
      } else {
        // Only allow one dropdown open at a time
        this.openDropdowns = [id];
      }
      localStorage.setItem('sidebar-open-dropdowns', JSON.stringify(this.openDropdowns));
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

        // Investment Dashboard Chart
        const invDashCtx = document.getElementById('investmentDashboardChart');
        if (invDashCtx) {
          this.charts.investmentDashboard = new Chart(invDashCtx, {
            type: 'line',
            data: {
              labels: months.slice(0, 6),
              datasets: [
                { label: 'Total Portfolio', data: [1.2, 1.4, 1.65, 1.9, 2.2, 2.45].map(v => v * 1000000000), borderColor: '#10b981', backgroundColor: 'rgba(16,185,129,0.1)', fill: true, tension: 0.4 },
                { label: 'Monthly Returns', data: [15, 18, 22, 28, 35, 42].map(v => v * 1000000), borderColor: '#3b82f6', backgroundColor: 'rgba(59,130,246,0.1)', fill: true, tension: 0.4 }
              ]
            },
            options: { ...commonOptions, scales: { ...commonOptions.scales, y: { ...commonOptions.scales.y, ticks: { ...commonOptions.scales.y.ticks, callback: v => v >= 1000000000 ? (v/1000000000).toFixed(1) + 'B' : (v/1000000).toFixed(0) + 'M' } } } }
          });
        }

        // Investment Allocation Chart
        const invAllocCtx = document.getElementById('investmentAllocationChart');
        if (invAllocCtx) {
          this.charts.investmentAllocation = new Chart(invAllocCtx, {
            type: 'doughnut',
            data: {
              labels: this.investmentProducts.map(p => p.name),
              datasets: [{ data: this.investmentProducts.map(p => p.allocation), backgroundColor: this.investmentProducts.map(p => p.color), borderWidth: 2, borderColor: bgColor }]
            },
            options: { responsive: true, maintainAspectRatio: false, cutout: '75%', plugins: { legend: { display: false } } }
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
          // Use setTimeout to ensure the DOM is fully rendered and scrollable
          setTimeout(() => {
            sidebarNav.scrollTop = parseInt(savedPosition);
          }, 100);
        }

        // Save scroll position on scroll
        sidebarNav.addEventListener('scroll', () => {
          localStorage.setItem('sidebar-scroll', sidebarNav.scrollTop);
        });

        // Also save before page unloads
        window.addEventListener('beforeunload', () => {
          localStorage.setItem('sidebar-scroll', sidebarNav.scrollTop);
        });
      }
    },

    expandActiveSections() {
      const staffRoles = ['admin', 'manager', 'teller', 'auditor', 'deposit_officer', 'loan_officer', 'swf_officer', 'marketing_officer', 'secretary', 'chairperson', 'accountant'];
      const role = staffRoles.includes(this.currentUser.role) ? 'admin' : 'member';
      const sections = this.sidebarSections[role];
      if (!sections) return;

      sections.forEach(section => {
        if (section.items) {
          section.items.forEach(item => {
            if (item.children && item.children.some(child => child.id === this.activePage)) {
              if (!this.openDropdowns.includes(item.id)) {
                this.openDropdowns.push(item.id);
              }
            }
          });
        }
      });
    },

    init() {
      const stored = localStorage.getItem('feedtan_dark');
      if (stored !== null) this.darkMode = stored === 'true';

      const storedDropdowns = localStorage.getItem('sidebar-open-dropdowns');
      if (storedDropdowns) {
        try {
          this.openDropdowns = JSON.parse(storedDropdowns);
        } catch (e) {
          this.openDropdowns = [];
        }
      }

      this.calcLoan();
      this.initSettings();
      this.expandActiveSections();
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
