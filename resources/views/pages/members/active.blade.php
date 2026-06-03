@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     ACTIVE MEMBERS PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Active Members</h2>
    <div class="flex gap-2 flex-wrap">
      <button @click="showModal('addMember')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-plus"></i> Add Member
      </button>
      <button class="flex items-center gap-2 px-4 py-2 rounded-xl border text-xs font-semibold transition-colors"
              :class="darkMode?'border-[#1a3328] text-primary-300 hover:bg-primary-900/30':'border-primary-200 text-primary-700 hover:bg-primary-50'">
        <i class="fa-solid fa-file-excel"></i> Export
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <!-- Search & Filters -->
    <div class="flex flex-col sm:flex-row gap-3 mb-4">
      <div class="relative flex-1">
        <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-xs" :class="darkMode?'text-primary-500':'text-primary-400'"></i>
        <input type="text" x-model="memberSearch" placeholder="Search by name, phone, NIDA..."
               class="form-input input-field pl-8 text-xs py-2"
               :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"/>
      </div>
      <select class="form-input input-field text-xs py-2 w-full sm:w-auto"
              :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
        <option>All Regions</option>
        <option>Dar es Salaam</option>
        <option>Mwanza</option>
        <option>Arusha</option>
        <option>Mbeya</option>
        <option>Dodoma</option>
      </select>
      <select class="form-input input-field text-xs py-2 w-full sm:w-auto"
              :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
        <option>All Types</option>
        <option>Regular</option>
        <option>Group</option>
        <option>Junior</option>
      </select>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Member</th>
            <th class="text-left">NIDA / ID</th>
            <th class="text-left">Region</th>
            <th class="text-left">Savings</th>
            <th class="text-left">Loans</th>
            <th class="text-left">Joined</th>
            <th class="text-left">Status</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="(m,i) in filteredMembers()" :key="m.id">
            <tr class="table-row" x-show="i < memberPage*15 && i >= (memberPage-1)*15">
              <td>
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 overflow-hidden">
                    <template x-if="m.passport_photo">
                      <img :src="'/storage/' + m.passport_photo.replace('storage/', '')" class="w-full h-full object-cover" alt="">
                    </template>
                    <template x-if="!m.passport_photo">
                      <span x-text="m.user ? m.user.name.charAt(0) : '?'"></span>
                    </template>
                  </div>
                  <div>
                    <p class="font-semibold text-xs" :class="darkMode?'text-white':'text-primary-900'" x-text="m.user ? m.user.name : 'Unknown'"></p>
                    <p class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="m.phone"></p>
                  </div>
                </div>
              </td>
              <td class=" text-[11px]" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="m.member_no"></td>
              <td class="text-xs" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="m.region"></td>
              <td class=" text-xs text-green-500 font-semibold" x-text="'TZS '+parseFloat(m.total_savings || 0).toLocaleString()"></td>
              <td class=" text-xs" :class="m.total_loans>0?'text-yellow-500 font-semibold':darkMode?'text-primary-400':'text-gray-400'"
                  x-text="m.total_loans>0?'TZS '+parseFloat(m.total_loans).toLocaleString():'None'"></td>
              <td class="text-[11px]" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="new Date(m.joined_at).toLocaleDateString()"></td>
              <td><span class="badge" :class="m.status==='Active'?'badge-green':m.status==='Inactive'?'badge-red':'badge-yellow'" x-text="m.status"></span></td>
              <td>
                <div class="flex items-center gap-1">
                  <button @click="viewMember(m)" class="p-1.5 rounded-lg text-primary-500 hover:bg-primary-100 dark:hover:bg-primary-900/30 text-[11px] transition-colors" title="View">
                    <i class="fa-solid fa-eye"></i>
                  </button>
                  <button @click="editMember(m)" class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900/30 text-[11px] transition-colors" title="Edit">
                    <i class="fa-solid fa-pen"></i>
                  </button>
                  <button @click="deleteMember(m)" class="p-1.5 rounded-lg text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 text-[11px] transition-colors" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-4">
      <p class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'">Showing <span x-text="(memberPage-1)*15+1"></span>–<span x-text="Math.min(memberPage*15,filteredMembers().length)"></span> of <span x-text="filteredMembers().length"></span> members</p>
      <div class="flex items-center gap-1">
        <button @click="memberPage>1&&memberPage--" class="p-1.5 rounded-lg text-xs transition-colors"
                :class="darkMode?'text-primary-300 hover:bg-primary-900/30':'text-primary-700 hover:bg-primary-100'">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <template x-for="p in Math.ceil(filteredMembers().length/15)" :key="p">
          <button @click="memberPage=p" class="w-7 h-7 rounded-lg text-xs font-semibold transition-colors"
                  :class="memberPage===p?'bg-primary-600 text-white':darkMode?'text-primary-300 hover:bg-primary-900/30':'text-primary-700 hover:bg-primary-100'"
                  x-text="p" x-show="p<=5"></button>
        </template>
        <button @click="memberPage<Math.ceil(filteredMembers().length/15)&&memberPage++" class="p-1.5 rounded-lg text-xs transition-colors"
                :class="darkMode?'text-primary-300 hover:bg-primary-900/30':'text-primary-700 hover:bg-primary-100'">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</div>
@endsection
