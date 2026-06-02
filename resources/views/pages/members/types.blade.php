@extends('layouts.dashboard')

@section('dashboard-content')
<!-- ============================================================
     MEMBER TYPES PAGE
     ============================================================ -->
<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Member Types</h2>
    <div class="flex gap-2 flex-wrap">
      <button @click="showModal('addMemberType')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-plus"></i> Add Type
      </button>
    </div>
  </div>

  <div class="card rounded-2xl p-5">
    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">Name</th>
            <th class="text-left">Description</th>
            <th class="text-left">Status</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="(type, i) in [
            {id:1, name:'Regular', description:'Standard member type', status:'Active'},
            {id:2, name:'Group', description:'Group/association membership', status:'Active'},
            {id:3, name:'Junior', description:'Youth/student membership', status:'Active'}
          ]" :key="type.id">
            <tr class="table-row">
              <td>
                <p class="font-semibold text-xs" :class="darkMode?'text-white':'text-primary-900'" x-text="type.name"></p>
              </td>
              <td class="text-xs" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="type.description"></td>
              <td><span class="badge badge-green" x-text="type.status"></span></td>
              <td>
                <div class="flex items-center gap-1">
                  <button class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900/30 text-[11px] transition-colors" title="Edit">
                    <i class="fa-solid fa-pen"></i>
                  </button>
                  <button class="p-1.5 rounded-lg text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 text-[11px] transition-colors" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
