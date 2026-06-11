@extends('layouts.dashboard')

@section('dashboard-content')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
  .leaflet-container { z-index: 30; }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

<div class="animate-[fadeIn_0.4s_ease] space-y-4">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Geolocation Logs</h2>
    <div class="flex gap-2">
      <button @click="toggleGeoMap" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
        <i class="fa-solid fa-map-location-dot mr-2"></i>
        <span x-text="showGeoMap ? 'Hide Map' : 'View Map'"></span>
      </button>
    </div>
  </div>

  <!-- Map Section -->
  <div x-show="showGeoMap" x-transition class="card rounded-2xl p-5">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Location Map</h3>
    <div id="geoMap" class="h-[400px] rounded-xl"></div>
  </div>

  <div class="card rounded-2xl p-5">
    <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Access by Location</h3>
    <div class="overflow-x-auto">
      <table class="data-table">
        <thead>
          <tr>
            <th class="text-left">User</th>
            <th class="text-left">IP Address</th>
            <th class="text-left">Country</th>
            <th class="text-left">City</th>
            <th class="text-left">ISP</th>
            <th class="text-left">Coordinates</th>
            <th class="text-left">Last Activity</th>
            <th class="text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="log in auditLogs" :key="log.id">
            <tr class="table-row">
              <td class="text-xs font-semibold" :class="darkMode?'text-white':'text-primary-900'" x-text="log.user_name"></td>
              <td class="text-xs font-mono" :class="darkMode?'text-primary-300':'text-gray-600'" x-text="log.ip_address"></td>
              <td>
                <div class="flex items-center gap-2">
                  <span class="text-[10px]">🇹🇿</span>
                  <span class="text-xs" :class="darkMode?'text-primary-300':'text-gray-600'">Tanzania</span>
                </div>
              </td>
              <td class="text-xs" :class="darkMode?'text-primary-300':'text-gray-600'">Dar es Salaam</td>
              <td class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'">TTCL / Vodacom</td>
              <td class="text-[11px] font-mono" :class="darkMode?'text-primary-400':'text-gray-500'">-6.7924, 39.2083</td>
              <td class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'" x-text="log.time"></td>
              <td>
                <button @click="openGeoLogDetails(log)" class="text-primary-600 hover:text-primary-700 text-xs font-semibold">
                  View Details
                </button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Geo Log Details Modal -->
<div x-show="showGeoLogModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-transition>
  <div class="card rounded-2xl p-6 w-full max-w-3xl mx-4 max-h-[90vh] overflow-y-auto" @click.outside="showGeoLogModal = false">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-bold text-lg" :class="darkMode?'text-white':'text-primary-900'">Geolocation Log Details</h3>
      <button @click="showGeoLogModal = false" class="p-2 rounded-lg hover:bg-gray-100" :class="darkMode?'hover:bg-primary-900/30':''">
        <i class="fa-solid fa-xmark" :class="darkMode?'text-white':''"></i>
      </button>
    </div>
    <template x-if="selectedGeoLog">
      <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">User</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedGeoLog.user_name"></p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">Timestamp</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedGeoLog.time"></p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">IP Address</p>
            <p class="text-sm font-mono" :class="darkMode?'text-white':'text-primary-900'" x-text="selectedGeoLog.ip_address"></p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">Country</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'">🇹🇿 Tanzania</p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">City</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'">Dar es Salaam</p>
          </div>
          <div>
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">ISP</p>
            <p class="text-sm" :class="darkMode?'text-white':'text-primary-900'">TTCL / Vodacom</p>
          </div>
          <div class="col-span-2">
            <p class="text-xs font-semibold" :class="darkMode?'text-primary-400':'text-gray-500'">Coordinates</p>
            <p class="text-sm font-mono" :class="darkMode?'text-white':'text-primary-900'">-6.7924, 39.2083</p>
          </div>
        </div>
        <!-- Mini Map in Modal -->
        <div id="geoModalMap" class="h-[250px] rounded-xl"></div>
      </div>
    </template>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
  Alpine.store('dashboard').$watch('showGeoMap', (val) => {
    if (val) {
      setTimeout(() => {
        if (!window.geoMap) {
          window.geoMap = L.map('geoMap').setView([-6.7924, 39.2083], 10);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
          }).addTo(window.geoMap);
          
          // Add markers
          Alpine.store('dashboard').auditLogs.forEach(log => {
            L.marker([-6.7924, 39.2083])
              .addTo(window.geoMap)
              .bindPopup(`<strong>${log.user_name}</strong><br>${log.ip_address}`);
          });
        } else {
          window.geoMap.invalidateSize();
        }
      }, 100);
    }
  });

  Alpine.store('dashboard').$watch('selectedGeoLog', (val) => {
    if (val) {
      setTimeout(() => {
        if (!window.geoModalMap) {
          window.geoModalMap = L.map('geoModalMap').setView([-6.7924, 39.2083], 12);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
          }).addTo(window.geoModalMap);
        }
        L.marker([-6.7924, 39.2083])
          .addTo(window.geoModalMap)
          .bindPopup(`<strong>${val.user_name}</strong><br>${val.ip_address}`);
        window.geoModalMap.invalidateSize();
      }, 100);
    }
  });
});
</script>
@endpush
