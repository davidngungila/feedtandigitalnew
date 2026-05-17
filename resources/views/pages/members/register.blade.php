@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     MEMBER REGISTRATION PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Register New Member</h2>

  <div class="card rounded-2xl p-6 space-y-6">
    <!-- Personal Info -->
    <div>
      <h3 class="text-sm font-bold mb-4 flex items-center gap-2" :class="darkMode?'text-primary-200':'text-primary-800'">
        <span class="w-6 h-6 rounded-full bg-primary-600 text-white text-xs flex items-center justify-center">1</span>
        Personal Information
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Full Name *</label>
          <input type="text" class="form-input input-field" placeholder="Jina Kamili" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Gender *</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>Chagua Jinsia</option><option>Male</option><option>Female</option></select></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">NIDA Number *</label>
          <input type="text" class="form-input input-field" placeholder="19XXXXXXXXXXXXXXXXXXX" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Date of Birth *</label>
          <input type="date" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Marital Status</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>Single</option><option>Married</option><option>Divorced</option><option>Widowed</option></select></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Mobile Number *</label>
          <input type="tel" class="form-input input-field" placeholder="+255 7XX XXX XXX" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Email Address</label>
          <input type="email" class="form-input input-field" placeholder="email@example.com" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Occupation</label>
          <input type="text" class="form-input input-field" placeholder="e.g. Teacher, Farmer" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Employer</label>
          <input type="text" class="form-input input-field" placeholder="Employer/Company Name" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      </div>
    </div>

    <!-- Address -->
    <div>
      <h3 class="text-sm font-bold mb-4 flex items-center gap-2" :class="darkMode?'text-primary-200':'text-primary-800'">
        <span class="w-6 h-6 rounded-full bg-primary-600 text-white text-xs flex items-center justify-center">2</span>
        Address Information
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Region *</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>Dar es Salaam</option><option>Mwanza</option><option>Arusha</option>
            <option>Mbeya</option><option>Dodoma</option><option>Morogoro</option>
            <option>Tanga</option><option>Kilimanjaro</option><option>Kagera</option>
          </select></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">District *</label>
          <input type="text" class="form-input input-field" placeholder="District" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Ward</label>
          <input type="text" class="form-input input-field" placeholder="Ward" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Street</label>
          <input type="text" class="form-input input-field" placeholder="Street" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">P.O. Box</label>
          <input type="text" class="form-input input-field" placeholder="S.L.P" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      </div>
    </div>

    <!-- Membership -->
    <div>
      <h3 class="text-sm font-bold mb-4 flex items-center gap-2" :class="darkMode?'text-primary-200':'text-primary-800'">
        <span class="w-6 h-6 rounded-full bg-primary-600 text-white text-xs flex items-center justify-center">3</span>
        Membership Details
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Membership Type *</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>Regular Member</option><option>Group Member</option><option>Junior Member</option><option>Institutional</option></select></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Branch *</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>Dar es Salaam HQ</option><option>Mwanza Branch</option><option>Arusha Branch</option></select></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Share Capital (TZS)</label>
          <input type="number" class="form-input input-field" placeholder="100,000" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      </div>
    </div>

    <!-- Next of Kin -->
    <div>
      <h3 class="text-sm font-bold mb-4 flex items-center gap-2" :class="darkMode?'text-primary-200':'text-primary-800'">
        <span class="w-6 h-6 rounded-full bg-primary-600 text-white text-xs flex items-center justify-center">4</span>
        Next of Kin / Beneficiaries
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Next of Kin Name *</label>
          <input type="text" class="form-input input-field" placeholder="Full Name" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Relationship *</label>
          <select class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
            <option>Spouse</option><option>Parent</option><option>Sibling</option><option>Child</option></select></div>
        <div><label class="form-label" :class="darkMode?'text-primary-300':'text-primary-700'">Next of Kin Phone</label>
          <input type="tel" class="form-input input-field" placeholder="+255 7XX XXX XXX" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      </div>
    </div>

    <!-- Document Upload -->
    <div>
      <h3 class="text-sm font-bold mb-4 flex items-center gap-2" :class="darkMode?'text-primary-200':'text-primary-800'">
        <span class="w-6 h-6 rounded-full bg-primary-600 text-white text-xs flex items-center justify-center">5</span>
        Documents
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="border-2 border-dashed rounded-xl p-6 text-center cursor-pointer transition-colors"
             :class="darkMode?'border-[#1a3328] hover:border-primary-600':'border-primary-200 hover:border-primary-500'">
          <i class="fa-solid fa-camera text-2xl mb-2" :class="darkMode?'text-primary-400':'text-primary-400'"></i>
          <p class="text-xs font-semibold" :class="darkMode?'text-primary-300':'text-primary-700'">Passport Photo</p>
          <p class="text-[11px] mt-1" :class="darkMode?'text-primary-500':'text-gray-400'">Click to upload or drag & drop</p>
        </div>
        <div class="border-2 border-dashed rounded-xl p-6 text-center cursor-pointer transition-colors"
             :class="darkMode?'border-[#1a3328] hover:border-primary-600':'border-primary-200 hover:border-primary-500'">
          <i class="fa-solid fa-id-card text-2xl mb-2" :class="darkMode?'text-primary-400':'text-primary-400'"></i>
          <p class="text-xs font-semibold" :class="darkMode?'text-primary-300':'text-primary-700'">NIDA Card / ID</p>
          <p class="text-[11px] mt-1" :class="darkMode?'text-primary-500':'text-gray-400'">Click to upload or drag & drop</p>
        </div>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex gap-3 justify-end">
      <button class="px-6 py-2.5 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
        Cancel
      </button>
      <button @click="showToast('Member registered successfully!','success')"
              class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-user-plus mr-2"></i> Register Member
      </button>
    </div>
  </div>
</div>
@endsection
