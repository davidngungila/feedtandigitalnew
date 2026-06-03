<!-- ============================================================
     MODALS
     ============================================================ -->

<!-- View Member Modal -->
<div x-cloak x-show="activeModal==='viewMember'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-4xl">
    <div class="flex items-center justify-between mb-6">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Member Details</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm" :class="darkMode?'text-primary-300':'text-gray-500'"></i>
      </button>
    </div>
    <template x-if="selectedMember">
      <div class="space-y-6">
        <!-- Member Info Header -->
        <div class="flex items-center gap-4 p-4 rounded-2xl" :class="darkMode?'bg-primary-900/20 border border-primary-800':'bg-primary-50 border border-primary-100'">
          <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary-500 to-primary-800 flex items-center justify-center text-white text-2xl font-bold shadow-lg overflow-hidden" x-show="!selectedMember.passport_photo" x-text="selectedMember.user ? selectedMember.user.name.charAt(0) : '?'"></div>
          <img x-show="selectedMember.passport_photo" :src="(selectedMember.passport_photo.startsWith('http') || selectedMember.passport_photo.startsWith('data:image')) ? selectedMember.passport_photo : '/' + selectedMember.passport_photo" class="w-16 h-16 rounded-full object-cover shadow-lg">
          <div class="flex-1">
            <h4 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.user ? selectedMember.user.name : 'Unknown'"></h4>
            <p class="text-xs mt-1" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="selectedMember.phone"></p>
            <span class="badge mt-2" :class="selectedMember.status==='Active'?'badge-green':selectedMember.status==='Inactive'?'badge-red':'badge-yellow'" x-text="selectedMember.status"></span>
          </div>
        </div>
        <!-- Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Member Number</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.member_no"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">NIDA</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.nida || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Gender</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.gender || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Email</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.user ? selectedMember.user.email : 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Date of Birth</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.dob ? new Date(selectedMember.dob).toLocaleDateString() : 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Marital Status</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.marital_status || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Region</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.region || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">District</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.district || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Ward</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.ward || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Street</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.street || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">P.O. Box</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.po_box || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Occupation</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.occupation || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Employer</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.employer || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Membership Type</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.membership_type || 'Regular'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Branch</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.branch || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Next of Kin</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.next_of_kin_name || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Next of Kin Relationship</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.next_of_kin_relationship || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Next of Kin Phone</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.next_of_kin_phone || 'N/A'"></p>
          </div>
          <div>
            <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Joined At</p>
            <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMember.joined_at ? new Date(selectedMember.joined_at).toLocaleDateString() : 'N/A'"></p>
          </div>
        </div>
        <!-- Footer Buttons -->
        <div class="flex gap-3 justify-end pt-4 border-t" :class="darkMode?'border-primary-800':'border-primary-100'">
          <button @click="activeModal=null" class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
                  :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Close</button>
          <button @click="editMember(selectedMember);activeModal=null" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold transition-all">
            <i class="fa-solid fa-pen mr-1.5"></i> Edit Member
          </button>
          <button @click="window.location.href='/members/' + selectedMember.id + '/profile';activeModal=null" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
            <i class="fa-solid fa-eye mr-1.5"></i> View Full Page
          </button>
        </div>
      </div>
    </template>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div x-cloak x-show="activeModal==='deleteMember'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-md">
    <div class="space-y-4">
      <div class="text-center">
        <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mx-auto">
          <i class="fa-solid fa-trash text-red-500 text-2xl"></i>
        </div>
        <h3 class="font-bold text-base mt-4" :class="darkMode?'text-white':'text-primary-900'">Delete Member</h3>
        <p class="text-xs mt-2" :class="darkMode?'text-primary-400':'text-gray-500'">This action cannot be undone. All member data will be permanently removed.</p>
      </div>
      <div>
        <label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Reason for Deletion *</label>
        <textarea x-model="deleteReason" rows="3" required class="form-input input-field text-xs w-full" placeholder="Please provide a reason for deleting this member..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
      </div>
      <div class="flex gap-3 justify-end pt-2">
        <button @click="activeModal=null;selectedMemberToDelete=null;deleteReason=''" class="px-6 py-2.5 rounded-xl border text-xs font-semibold transition-colors"
                :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
        <button @click="confirmDeleteMember" :disabled="!deleteReason" class="px-6 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-semibold transition-all disabled:opacity-50 disabled:cursor-not-allowed">
          Delete Member
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Add Member Modal -->
<div x-cloak x-show="activeModal==='addMember'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-3xl">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Register New Member</h3>
      <button @click="activeModal=null; resetMemberForm()" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm" :class="darkMode?'text-primary-300':'text-gray-500'"></i>
      </button>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div class="col-span-2"><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Full Name *</label>
        <input x-model="memberForm.name" class="form-input input-field text-xs" placeholder="Jina Kamili" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Email</label>
        <input x-model="memberForm.email" type="email" class="form-input input-field text-xs" placeholder="email@example.com" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Gender</label>
        <select x-model="memberForm.gender" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Phone *</label>
        <input x-model="memberForm.phone" class="form-input input-field text-xs" placeholder="+255 7XX XXX XXX" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">NIDA</label>
        <input x-model="memberForm.nida" class="form-input input-field text-xs" placeholder="NIDA Number" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Date of Birth</label>
        <input x-model="memberForm.dob" type="date" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Marital Status</label>
        <select x-model="memberForm.marital_status" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="">Select</option><option value="Single">Single</option><option value="Married">Married</option><option value="Divorced">Divorced</option><option value="Widowed">Widowed</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Occupation</label>
        <input x-model="memberForm.occupation" class="form-input input-field text-xs" placeholder="Occupation" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Employer</label>
        <input x-model="memberForm.employer" class="form-input input-field text-xs" placeholder="Employer" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Region *</label>
        <select x-model="memberForm.region" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Dar es Salaam</option><option>Mwanza</option><option>Arusha</option><option>Mbeya</option><option>Dodoma</option><option>Morogoro</option><option>Tanga</option><option>Kilimanjaro</option><option>Kagera</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">District</label>
        <input x-model="memberForm.district" class="form-input input-field text-xs" placeholder="District" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Ward</label>
        <input x-model="memberForm.ward" class="form-input input-field text-xs" placeholder="Ward" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Street</label>
        <input x-model="memberForm.street" class="form-input input-field text-xs" placeholder="Street" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">P.O. Box</label>
        <input x-model="memberForm.po_box" class="form-input input-field text-xs" placeholder="P.O. Box" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Membership Type *</label>
        <select x-model="memberForm.membership_type" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="Regular">Regular</option><option value="Group">Group</option><option value="Junior">Junior</option><option value="Institutional">Institutional</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Branch</label>
        <select x-model="memberForm.branch" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Dar es Salaam HQ</option><option>Mwanza Branch</option><option>Arusha Branch</option></select></div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null; resetMemberForm()" class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="saveMember()"
              class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-user-plus mr-1.5"></i> Register
      </button>
    </div>
  </div>
</div>

<!-- Edit Member Modal -->
<div x-cloak x-show="activeModal==='editMember'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-3xl">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Edit Member</h3>
      <button @click="activeModal=null; resetMemberForm()" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm" :class="darkMode?'text-primary-300':'text-gray-500'"></i>
      </button>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div class="col-span-2"><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Full Name *</label>
        <input x-model="memberForm.name" class="form-input input-field text-xs" placeholder="Jina Kamili" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Email</label>
        <input x-model="memberForm.email" type="email" class="form-input input-field text-xs" placeholder="email@example.com" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Gender</label>
        <select x-model="memberForm.gender" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Phone</label>
        <input x-model="memberForm.phone" class="form-input input-field text-xs" placeholder="+255 7XX XXX XXX" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">NIDA</label>
        <input x-model="memberForm.nida" class="form-input input-field text-xs" placeholder="NIDA Number" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Date of Birth</label>
        <input x-model="memberForm.dob" type="date" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Marital Status</label>
        <select x-model="memberForm.marital_status" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="">Select</option><option value="Single">Single</option><option value="Married">Married</option><option value="Divorced">Divorced</option><option value="Widowed">Widowed</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Occupation</label>
        <input x-model="memberForm.occupation" class="form-input input-field text-xs" placeholder="Occupation" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Employer</label>
        <input x-model="memberForm.employer" class="form-input input-field text-xs" placeholder="Employer" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Region</label>
        <select x-model="memberForm.region" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Dar es Salaam</option><option>Mwanza</option><option>Arusha</option><option>Mbeya</option><option>Dodoma</option><option>Morogoro</option><option>Tanga</option><option>Kilimanjaro</option><option>Kagera</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">District</label>
        <input x-model="memberForm.district" class="form-input input-field text-xs" placeholder="District" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Ward</label>
        <input x-model="memberForm.ward" class="form-input input-field text-xs" placeholder="Ward" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Street</label>
        <input x-model="memberForm.street" class="form-input input-field text-xs" placeholder="Street" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">P.O. Box</label>
        <input x-model="memberForm.po_box" class="form-input input-field text-xs" placeholder="P.O. Box" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Membership Type</label>
        <select x-model="memberForm.membership_type" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="Regular">Regular</option><option value="Group">Group</option><option value="Junior">Junior</option><option value="Institutional">Institutional</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Branch</label>
        <select x-model="memberForm.branch" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Dar es Salaam HQ</option><option>Mwanza Branch</option><option>Arusha Branch</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Next of Kin Name</label>
        <input x-model="memberForm.next_of_kin_name" class="form-input input-field text-xs" placeholder="Next of Kin Name" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Next of Kin Relationship</label>
        <select x-model="memberForm.next_of_kin_relationship" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="">Select</option><option value="Spouse">Spouse</option><option value="Parent">Parent</option><option value="Sibling">Sibling</option><option value="Child">Child</option></select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Next of Kin Phone</label>
        <input x-model="memberForm.next_of_kin_phone" type="tel" class="form-input input-field text-xs" placeholder="+255 7XX XXX XXX" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Status</label>
        <select x-model="memberForm.status" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="Active">Active</option><option value="Inactive">Inactive</option><option value="Suspended">Suspended</option></select></div>
    </div>
    
    <!-- Documents Upload -->
    <div class="grid grid-cols-2 gap-3 mt-4">
      <div class="space-y-1">
        <label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Passport Photo</label>
        <div class="border-2 border-dashed border-primary-300 dark:border-primary-700 rounded-xl p-4 text-center cursor-pointer hover:border-primary-500 transition-colors">
          <label class="cursor-pointer">
            <template x-if="!memberPhotoPreview">
              <div>
                <i class="fa-solid fa-camera text-3xl text-primary-500 mb-2"></i>
                <p class="text-[11px] font-semibold text-primary-700 dark:text-primary-300">Click to upload</p>
              </div>
            </template>
            <template x-if="memberPhotoPreview">
              <img :src="(memberPhotoPreview.startsWith('http') || memberPhotoPreview.startsWith('data:image')) ? memberPhotoPreview : '/' + memberPhotoPreview" class="w-20 h-20 object-cover rounded-lg mx-auto shadow-lg">
            </template>
            <input type="file" class="hidden" accept="image/*" @change="handleMemberPhoto($event)">
          </label>
        </div>
      </div>
      <div class="space-y-1">
        <label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">NIDA Card / ID</label>
        <div class="border-2 border-dashed border-primary-300 dark:border-primary-700 rounded-xl p-4 text-center cursor-pointer hover:border-primary-500 transition-colors">
          <label class="cursor-pointer">
            <template x-if="!memberNidaCardPreview">
              <div>
                <i class="fa-solid fa-id-card text-3xl text-primary-500 mb-2"></i>
                <p class="text-[11px] font-semibold text-primary-700 dark:text-primary-300">Click to upload</p>
              </div>
            </template>
            <template x-if="memberNidaCardPreview">
              <img :src="(memberNidaCardPreview.startsWith('http') || memberNidaCardPreview.startsWith('data:image')) ? memberNidaCardPreview : '/' + memberNidaCardPreview" class="w-20 h-20 object-cover rounded-lg mx-auto shadow-lg">
            </template>
            <input type="file" class="hidden" accept="image/*" @change="handleMemberNidaCard($event)">
          </label>
        </div>
      </div>
    </div>
    
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null; resetMemberForm()" class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="updateMember()"
              class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-save mr-1.5"></i> Save Changes
      </button>
    </div>
  </div>
</div>

<!-- Repayment Modal -->
<div x-cloak x-show="activeModal==='repayment'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Record Loan Repayment</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="space-y-3">
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Loan Reference</label>
        <input class="form-input input-field text-xs" value="LN/2024/00156" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Amount Paid (TZS)</label>
        <input type="number" class="form-input input-field text-xs" placeholder="0.00" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Payment Channel</label>
        <select class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Cash</option><option>M-Pesa</option><option>Bank Transfer</option></select></div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null" class="px-4 py-2 rounded-xl border text-xs font-semibold" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="activeModal=null;showToast('Repayment recorded successfully!','success')"
              class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-money-bill mr-1.5"></i> Record Payment
      </button>
    </div>
  </div>
</div>

<!-- Add Investment Modal -->
<div x-cloak x-show="activeModal==='addInvestment'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">New Investment</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="space-y-3">
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Member</label>
        <input class="form-input input-field text-xs" placeholder="Search member..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Investment Plan</label>
        <select class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option>Fixed Deposit – 12 Months (18% p.a.)</option>
          <option>Fixed Deposit – 24 Months (20% p.a.)</option>
          <option>Treasury Bond Fund (16% p.a.)</option>
        </select></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Amount (TZS)</label>
        <input type="number" class="form-input input-field text-xs" placeholder="Min: TZS 500,000" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null" class="px-4 py-2 rounded-xl border text-xs font-semibold" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="activeModal=null;showToast('Investment created successfully!','success')"
              class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-chart-line mr-1.5"></i> Create Investment
      </button>
    </div>
  </div>
</div>

<!-- Quick Action Modal -->
<div x-cloak x-show="activeModal==='quickAction'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6" style="max-width:400px">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Quick Actions</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <button @click="navigate('member-register');activeModal=null" class="p-4 rounded-xl text-center transition-all hover:scale-105"
              :class="darkMode?'bg-primary-900/50 hover:bg-primary-900':'bg-primary-50 hover:bg-primary-100'">
        <i class="fa-solid fa-user-plus text-xl text-primary-500 mb-2 block"></i>
        <span class="text-xs font-semibold" :class="darkMode?'text-primary-200':'text-primary-800'">Add Member</span>
      </button>
      <button @click="navigate('savings-deposit');activeModal=null" class="p-4 rounded-xl text-center transition-all hover:scale-105"
              :class="darkMode?'bg-primary-900/50 hover:bg-primary-900':'bg-primary-50 hover:bg-primary-100'">
        <i class="fa-solid fa-money-bill-transfer text-xl text-green-500 mb-2 block"></i>
        <span class="text-xs font-semibold" :class="darkMode?'text-primary-200':'text-primary-800'">Deposit</span>
      </button>
      <button @click="navigate('loan-apply');activeModal=null" class="p-4 rounded-xl text-center transition-all hover:scale-105"
              :class="darkMode?'bg-primary-900/50 hover:bg-primary-900':'bg-primary-50 hover:bg-primary-100'">
        <i class="fa-solid fa-file-invoice-dollar text-xl text-blue-500 mb-2 block"></i>
        <span class="text-xs font-semibold" :class="darkMode?'text-primary-200':'text-primary-800'">Apply Loan</span>
      </button>
      <button @click="navigate('withdrawal-requests');activeModal=null" class="p-4 rounded-xl text-center transition-all hover:scale-105"
              :class="darkMode?'bg-primary-900/50 hover:bg-primary-900':'bg-primary-50 hover:bg-primary-100'">
        <i class="fa-solid fa-money-bill-wave text-xl text-yellow-500 mb-2 block"></i>
        <span class="text-xs font-semibold" :class="darkMode?'text-primary-200':'text-primary-800'">Withdrawal</span>
      </button>
    </div>
  </div>
</div>

<!-- Add User Modal -->
<div x-cloak x-show="activeModal==='addUser'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'" x-text="userForm.id ? 'Edit System User' : 'Add System User'"></h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="grid grid-cols-2 gap-3">
      <div class="col-span-2"><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Full Name *</label>
        <input x-model="userForm.name" class="form-input input-field text-xs" placeholder="Full Name" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Email *</label>
        <input x-model="userForm.email" type="email" class="form-input input-field text-xs" placeholder="user@feedtan.co.tz" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Role *</label>
        <select x-model="userForm.role" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="admin">Admin</option>
          <option value="manager">Manager</option>
          <option value="teller">Teller</option>
          <option value="auditor">Auditor</option>
          <option value="deposit_officer">Deposit Officer</option>
          <option value="loan_officer">Loan Officer</option>
          <option value="swf_officer">SWF Officer</option>
          <option value="marketing_officer">Marketing Officer</option>
          <option value="secretary">Secretary</option>
          <option value="chairperson">Chairperson</option>
          <option value="accountant">Accountant</option>
        </select></div>
      <div class="col-span-2"><label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'" x-text="userForm.id ? 'Password (leave blank to keep current)' : 'Password *'"></label>
        <input x-model="userForm.password" type="password" class="form-input input-field text-xs" placeholder="Temporary password" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/></div>
      <div class="flex items-center gap-2 mt-2">
        <input type="checkbox" x-model="userForm.is_active" id="userActive">
        <label for="userActive" class="text-xs" :class="darkMode?'text-primary-300':'text-primary-700'">Account Active</label>
      </div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null" class="px-4 py-2 rounded-xl border text-xs font-semibold" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="saveUser()"
              class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-user-shield mr-1.5"></i> <span x-text="userForm.id ? 'Update User' : 'Create User'"></span>
      </button>
    </div>
  </div>
</div>

<!-- 2FA Setup Modal -->
<div x-cloak x-show="activeModal==='tfaSetup'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-md">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Authenticator Setup</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    
    <div class="space-y-5">
      <div class="text-center space-y-3">
        <p class="text-xs" :class="darkMode?'text-primary-400':'text-gray-600'">Scan this QR code with your Authenticator App (Google Authenticator, Authy, etc.)</p>
        <div class="inline-block p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
          <template x-if="tfaSetupData.secret">
            <img :src="getQrCodeUrl()" class="w-40 h-40" alt="QR Code">
          </template>
          <template x-if="!tfaSetupData.secret">
            <div class="w-40 h-40 bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-xl">
               <i class="fa-solid fa-qrcode text-4xl text-gray-400"></i>
            </div>
          </template>
        </div>
        <div class="space-y-1">
          <p class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Manual Entry Key</p>
          <p class="text-sm font-mono font-bold tracking-widest bg-primary-900/10 p-2 rounded-lg border border-primary-900/20" :class="darkMode?'text-primary-400':'text-primary-700'" x-text="tfaSetupData.secret"></p>
        </div>
      </div>

      <div class="p-4 rounded-2xl border border-yellow-500/30 bg-yellow-500/5">
        <h4 class="text-[11px] font-bold text-yellow-600 mb-2 flex items-center gap-2">
          <i class="fa-solid fa-triangle-exclamation"></i> Save Your Backup Codes
        </h4>
        <p class="text-[10px] text-gray-500 mb-3">If you lose your device, these codes are the ONLY way to access your account. Store them securely.</p>
        <div class="grid grid-cols-2 gap-2">
          <template x-for="code in tfaSetupData.backup_codes">
            <div class="text-[11px] font-mono font-bold p-1.5 rounded bg-gray-100 dark:bg-primary-900/30 text-center" x-text="code"></div>
          </template>
        </div>
      </div>

      <button @click="activeModal=null" class="w-full py-3 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-bold text-xs transition-all">
        I've Saved the Codes
      </button>
    </div>
  </div>
</div>

<!-- View Member Type Modal -->
<div x-cloak x-show="activeModal==='viewMemberType'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-md">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Member Type Details</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <template x-if="selectedMemberType">
      <div class="space-y-4">
        <div>
          <label class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Name</label>
          <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMemberType.name"></p>
        </div>
        <div>
          <label class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Description</label>
          <p class="text-sm" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="selectedMemberType.description || 'No description'"></p>
        </div>
        <div>
          <label class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Status</label>
          <span 
            class="badge" 
            :class="selectedMemberType.status === 'Active' ? 'badge-green' : 'badge-red'" 
            x-text="selectedMemberType.status"
          ></span>
        </div>
        <div>
          <label class="text-[10px] font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-gray-400'">Member Count</label>
          <p class="text-sm font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedMemberType.count || 0"></p>
        </div>
      </div>
    </template>
  </div>
</div>

<!-- Add Member Type Modal -->
<div x-cloak x-show="activeModal==='addMemberType'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-md">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Add Member Type</h3>
      <button @click="activeModal=null; resetMemberTypeForm()" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="space-y-4">
      <div>
        <label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Name</label>
        <input x-model="memberTypeForm.name" class="form-input input-field text-xs" placeholder="e.g. Ordinary" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
      </div>
      <div>
        <label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Description</label>
        <textarea x-model="memberTypeForm.description" rows="3" class="form-input input-field text-xs" placeholder="Brief description of the member type" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
      </div>
      <div>
        <label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Status</label>
        <select x-model="memberTypeForm.status" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null; resetMemberTypeForm()" class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="saveMemberType()" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-save mr-1.5"></i> Save
      </button>
    </div>
  </div>
</div>

<!-- Edit Member Type Modal -->
<div x-cloak x-show="activeModal==='editMemberType'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-md">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Edit Member Type</h3>
      <button @click="activeModal=null; resetMemberTypeForm()" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    <div class="space-y-4">
      <div>
        <label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Name</label>
        <input x-model="memberTypeForm.name" class="form-input input-field text-xs" placeholder="e.g. Ordinary" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
      </div>
      <div>
        <label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Description</label>
        <textarea x-model="memberTypeForm.description" rows="3" class="form-input input-field text-xs" placeholder="Brief description of the member type" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
      </div>
      <div>
        <label class="form-label text-[11px]" :class="darkMode?'text-primary-300':'text-primary-700'">Status</label>
        <select x-model="memberTypeForm.status" class="form-input input-field text-xs" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
    </div>
    <div class="flex justify-end gap-3 mt-5">
      <button @click="activeModal=null; resetMemberTypeForm()" class="px-4 py-2 rounded-xl border text-xs font-semibold transition-colors" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
      <button @click="updateMemberType()" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-save mr-1.5"></i> Update
      </button>
    </div>
  </div>
</div>

<!-- Delete Member Type Confirmation Modal -->
<div x-cloak x-show="activeModal==='deleteMemberType'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-sm">
    <div class="text-center space-y-4">
      <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mx-auto">
        <i class="fa-solid fa-trash text-red-500 text-2xl"></i>
      </div>
      <div>
        <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Delete Member Type?</h3>
        <p class="text-xs mt-2" :class="darkMode?'text-primary-400':'text-gray-600'">This action cannot be undone. Are you sure you want to delete this member type?</p>
      </div>
      <div class="flex gap-3 justify-center pt-2">
        <button @click="activeModal=null; selectedMemberTypeToDelete=null" class="px-6 py-2.5 rounded-xl border text-xs font-semibold transition-colors" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
        <button @click="confirmDeleteMemberType()" class="px-6 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-semibold transition-all">
          Delete
        </button>
      </div>
    </div>
  </div>
</div>

<!-- KYC Update Modal -->
<div x-cloak x-show="activeModal==='kycUpdate'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-md">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'">Review KYC Submission</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    
    <div class="space-y-4">
      <div>
        <label class="form-label">Decision</label>
        <select x-model="kycUpdateForm.status" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
          <option value="Approved">Approve</option>
          <option value="Rejected">Reject</option>
        </select>
      </div>
      <div>
        <label class="form-label">Internal Notes</label>
        <textarea x-model="kycUpdateForm.notes" rows="3" class="form-input input-field resize-none" placeholder="Reason for rejection or approval notes..." :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
      </div>
      <div class="flex gap-3 mt-5">
        <button @click="activeModal=null" class="flex-1 py-3 rounded-xl border font-bold text-xs transition-all" :class="darkMode?'border-[#1a3328] text-primary-300':'border-primary-200 text-primary-700'">Cancel</button>
        <button @click="updateKycStatus()" class="flex-1 py-3 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-bold text-xs transition-all shadow-lg shadow-primary-600/20">
          Save Decision
        </button>
      </div>
    </div>
  </div>
</div>
<div x-cloak x-show="activeModal==='userDetails'" class="modal-overlay" @click.self="activeModal=null">
  <div class="modal-box card p-6 max-w-2xl">
    <div class="flex items-center justify-between mb-6">
      <h3 class="font-bold text-lg" :class="darkMode?'text-white':'text-primary-900'">User Profile & Activity</h3>
      <button @click="activeModal=null" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors" :class="darkMode?'hover:bg-primary-900/50':'hover:bg-gray-100'">
        <i class="fa-solid fa-xmark text-sm"></i>
      </button>
    </div>
    
    <template x-if="selectedUser">
      <div class="space-y-6">
        <!-- User Info Header -->
        <div class="flex items-start gap-4 p-4 rounded-2xl" :class="darkMode?'bg-primary-900/20 border border-primary-800':'bg-primary-50 border border-primary-100'">
          <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary-500 to-primary-800 flex items-center justify-center text-white text-2xl font-bold shadow-lg" x-text="selectedUser.name?.charAt(0)"></div>
          <div class="flex-1">
            <div class="flex items-center justify-between">
              <h4 class="font-bold text-base" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedUser.name"></h4>
              <span class="role-tag" :class="'role-'+(selectedUser.role || '')" x-text="selectedUser.role_label || selectedUser.role || ''"></span>
            </div>
            <p class="text-xs mt-1" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="selectedUser.email"></p>
            <div class="flex items-center gap-4 mt-3">
              <div class="text-[10px]">
                <span :class="darkMode?'text-primary-500':'text-gray-400'">Phone:</span>
                <span class="font-semibold ml-1" :class="darkMode?'text-primary-200':'text-primary-700'" x-text="selectedUser.phone || 'N/A'"></span>
              </div>
              <div class="text-[10px]">
                <span :class="darkMode?'text-primary-500':'text-gray-400'">Branch:</span>
                <span class="font-semibold ml-1" :class="darkMode?'text-primary-200':'text-primary-700'" x-text="selectedUser.branch || 'Main HQ'"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Activity Tabs -->
        <div class="space-y-3">
          <h5 class="text-xs font-bold uppercase tracking-wider" :class="darkMode?'text-primary-500':'text-primary-700'">Recent Operations</h5>
          <div class="overflow-y-auto max-h-[300px] pr-2 custom-scrollbar">
            <div class="space-y-2">
              <template x-if="selectedUserLogs.length === 0">
                <div class="text-center py-8 opacity-50 italic text-xs">No recent activity found</div>
              </template>
              <template x-for="log in selectedUserLogs" :key="log.id">
                <div class="p-3 rounded-xl border flex items-center justify-between transition-all hover:scale-[1.01]" 
                     :class="darkMode?'border-primary-900/50 bg-primary-900/10':'border-gray-100 bg-white'">
                  <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs"
                         :class="log.success ? (darkMode?'bg-green-900/30 text-green-400':'bg-green-50 text-green-600') : (darkMode?'bg-red-900/30 text-red-400':'bg-red-50 text-red-600')">
                      <i :class="log.success ? 'fa-solid fa-check-circle' : 'fa-solid fa-triangle-exclamation'"></i>
                    </div>
                    <div>
                      <p class="text-[11px] font-bold" :class="darkMode?'text-white':'text-primary-900'" x-text="log.action"></p>
                      <p class="text-[10px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="log.module + ' • ' + log.ip_address"></p>
                    </div>
                  </div>
                  <div class="text-right">
                    <p class="text-[10px] font-medium" :class="darkMode?'text-primary-500':'text-gray-400'" x-text="log.time"></p>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </template>
    </div>
  </div>
</div>
