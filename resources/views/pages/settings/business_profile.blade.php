@extends('layouts.dashboard')

@section('dashboard-content')
<div class="animate-[fadeIn_0.4s_ease] flex gap-6 h-full">
    <!-- Left Sidebar Tabs -->
    <div class="w-64 flex-shrink-0 card rounded-2xl p-4 flex flex-col gap-2">
        <h3 class="font-bold text-sm mb-2" :class="darkMode?'text-primary-200':'text-primary-800'">Settings</h3>
        <button @click="activeTab = 'basic'" :class="[activeTab === 'basic' ? 'bg-primary-600 text-white' : (darkMode?'bg-primary-900/30 text-primary-200 hover:bg-primary-900/50':'bg-primary-50 text-primary-700 hover:bg-primary-100'), 'px-4 py-2 rounded-xl text-sm font-medium transition-all text-left']">
            <i class="fa-solid fa-building mr-2"></i>Basic Info
        </button>
        <button @click="activeTab = 'contact'" :class="[activeTab === 'contact' ? 'bg-primary-600 text-white' : (darkMode?'bg-primary-900/30 text-primary-200 hover:bg-primary-900/50':'bg-primary-50 text-primary-700 hover:bg-primary-100'), 'px-4 py-2 rounded-xl text-sm font-medium transition-all text-left']">
            <i class="fa-solid fa-address-book mr-2"></i>Contact Info
        </button>
        <button @click="activeTab = 'leadership'" :class="[activeTab === 'leadership' ? 'bg-primary-600 text-white' : (darkMode?'bg-primary-900/30 text-primary-200 hover:bg-primary-900/50':'bg-primary-50 text-primary-700 hover:bg-primary-100'), 'px-4 py-2 rounded-xl text-sm font-medium transition-all text-left']">
            <i class="fa-solid fa-users-gear mr-2"></i>Leadership
        </button>
        <button @click="activeTab = 'banking'" :class="[activeTab === 'banking' ? 'bg-primary-600 text-white' : (darkMode?'bg-primary-900/30 text-primary-200 hover:bg-primary-900/50':'bg-primary-50 text-primary-700 hover:bg-primary-100'), 'px-4 py-2 rounded-xl text-sm font-medium transition-all text-left']">
            <i class="fa-solid fa-university mr-2"></i>Payment & Banking
        </button>
        <button @click="activeTab = 'documents'" :class="[activeTab === 'documents' ? 'bg-primary-600 text-white' : (darkMode?'bg-primary-900/30 text-primary-200 hover:bg-primary-900/50':'bg-primary-50 text-primary-700 hover:bg-primary-100'), 'px-4 py-2 rounded-xl text-sm font-medium transition-all text-left']">
            <i class="fa-solid fa-file-lines mr-2"></i>Documents
        </button>
        <button @click="activeTab = 'system'" :class="[activeTab === 'system' ? 'bg-primary-600 text-white' : (darkMode?'bg-primary-900/30 text-primary-200 hover:bg-primary-900/50':'bg-primary-50 text-primary-700 hover:bg-primary-100'), 'px-4 py-2 rounded-xl text-sm font-medium transition-all text-left']">
            <i class="fa-solid fa-gear mr-2"></i>System Settings
        </button>
    </div>

    <!-- Main Content -->
    <div class="flex-1 space-y-4 overflow-y-auto">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold" :class="darkMode?'text-white':'text-primary-900'">Business Profile</h2>
            <button @click="saveBusinessProfile()" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
                Save Changes
            </button>
        </div>

        <!-- Basic Information -->
        <div x-show="activeTab === 'basic'" class="card rounded-2xl p-6 space-y-4">
            <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Group Name</label>
                    <input type="text" x-model="businessProfileForm.group_name" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Short Name / Acronym</label>
                    <input type="text" x-model="businessProfileForm.short_name" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Business Type</label>
                    <select x-model="businessProfileForm.business_type" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                        <option value="">Select Type</option>
                        <option value="microfinance">Microfinance Group</option>
                        <option value="savings_credit">Savings & Credit Group</option>
                        <option value="community">Community Based Organization</option>
                        <option value="cooperative">Cooperative</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Registration Status</label>
                    <select x-model="businessProfileForm.registration_status" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                        <option value="">Select Status</option>
                        <option value="registered">Registered</option>
                        <option value="not_registered">Not Registered</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Registration Number</label>
                    <input type="text" x-model="businessProfileForm.registration_number" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Date Established</label>
                    <input type="date" x-model="businessProfileForm.date_established" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div class="md:col-span-2">
                    <label class="form-label">Logo / Profile Image</label>
                    <div class="mt-2 flex items-center gap-4">
                        <template x-if="businessProfileForm.logo">
                            <div class="w-24 h-24 rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden" :class="darkMode?'bg-primary-900/50':''">
                                <img :src="'/storage/' + businessProfileForm.logo" class="w-full h-full object-cover" alt="Logo">
                            </div>
                        </template>
                        <template x-if="!businessProfileForm.logo">
                            <div class="w-24 h-24 rounded-xl bg-gray-100 flex items-center justify-center" :class="darkMode?'bg-primary-900/50':''">
                                <i class="fa-solid fa-image text-primary-600 text-2xl"></i>
                            </div>
                        </template>
                        <div class="flex-1">
                            <input type="file" x-ref="logoFile" accept="image/*" @change="handleLogoFileSelect($event)" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                            <p class="text-xs mt-1" :class="darkMode?'text-primary-400':'text-gray-500'">Upload your logo (Max 5MB, JPG/PNG/GIF)</p>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="form-label">Group Description / About</label>
                    <textarea x-model="businessProfileForm.description" rows="3" class="form-input input-field resize-none" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div x-show="activeTab === 'contact'" class="card rounded-2xl p-6 space-y-4">
            <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">Contact Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Phone Number</label>
                    <input type="text" x-model="businessProfileForm.phone" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Email Address</label>
                    <input type="email" x-model="businessProfileForm.email" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Website / Social Link</label>
                    <input type="text" x-model="businessProfileForm.website" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div class="md:col-span-2">
                    <label class="form-label">Physical Address</label>
                    <textarea x-model="businessProfileForm.physical_address" rows="2" class="form-input input-field resize-none" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'"></textarea>
                </div>
                <div>
                    <label class="form-label">Region</label>
                    <input type="text" x-model="businessProfileForm.region" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">District</label>
                    <input type="text" x-model="businessProfileForm.district" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Ward</label>
                    <input type="text" x-model="businessProfileForm.ward" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Street/Village</label>
                    <input type="text" x-model="businessProfileForm.street" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Postal Address</label>
                    <input type="text" x-model="businessProfileForm.postal_address" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
            </div>
        </div>

        <!-- Leadership -->
        <div x-show="activeTab === 'leadership'" class="card rounded-2xl p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Leadership & Administration</h3>
                <button @click="showLeaderModal = true" class="px-3 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
                    <i class="fa-solid fa-plus mr-1"></i> Add Leader
                </button>
            </div>

            <!-- Leader List -->
            <div class="space-y-3">
                <template x-for="leader in businessLeaders" :key="leader.id">
                    <div class="flex items-center justify-between p-3 rounded-lg" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary-200 flex items-center justify-center" :class="darkMode?'bg-primary-800':''">
                                <i class="fa-solid fa-user-tie text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium" :class="darkMode?'text-white':'text-primary-900'" x-text="leader.name"></p>
                                <p class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'">
                                    <span x-text="leader.role"></span> • 
                                    <span x-text="leader.phone"></span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="deleteLeader(leader.id)" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </template>
                <template x-if="businessLeaders.length === 0">
                    <div class="text-center py-8">
                        <p class="text-sm" :class="darkMode?'text-primary-400':'text-gray-500'">No leaders added yet</p>
                    </div>
                </template>
            </div>
        </div>

        <!-- Payment & Banking -->
        <div x-show="activeTab === 'banking'" class="card rounded-2xl p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Payment & Banking</h3>
                <button @click="showBankModal = true" class="px-3 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
                    <i class="fa-solid fa-plus mr-1"></i> Add Payment Detail
                </button>
            </div>

            <!-- Bank Details List -->
            <div class="space-y-3">
                <template x-for="bank in businessBankDetails" :key="bank.id">
                    <div class="flex items-center justify-between p-3 rounded-lg" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary-200 flex items-center justify-center" :class="darkMode?'bg-primary-800':''">
                                <i class="fa-solid fa-university text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium" :class="darkMode?'text-white':'text-primary-900'">
                                    <span x-text="bank.bank_name || bank.mpesa || bank.airtel_money || bank.tigo_pesa || bank.mobile_money_number || bank.lipa_number || 'Payment Detail'"></span>
                                </p>
                                <p class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'">
                                    <span x-text="bank.account_name || ''"></span>
                                    <template x-if="bank.account_name && bank.account_number"> • </template>
                                    <span x-text="bank.account_number || ''"></span>
                                    <template x-if="bank.mpesa"> • M-Pesa: <span x-text="bank.mpesa"></span></template>
                                    <template x-if="bank.airtel_money"> • Airtel: <span x-text="bank.airtel_money"></span></template>
                                    <template x-if="bank.tigo_pesa"> • Tigo: <span x-text="bank.tigo_pesa"></span></template>
                                    <template x-if="bank.lipa_number"> • Lipa: <span x-text="bank.lipa_number"></span></template>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="deleteBankDetail(bank.id)" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </template>
                <template x-if="businessBankDetails.length === 0">
                    <div class="text-center py-8">
                        <p class="text-sm" :class="darkMode?'text-primary-400':'text-gray-500'">No bank details added yet</p>
                    </div>
                </template>
            </div>
        </div>

        <!-- Documents -->
        <div x-show="activeTab === 'documents'" class="card rounded-2xl p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-sm" :class="darkMode?'text-primary-200':'text-primary-800'">Documents</h3>
                <button @click="showUploadModal = true" class="px-3 py-1.5 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-xs font-semibold transition-all">
                    <i class="fa-solid fa-plus mr-1"></i> Upload Document
                </button>
            </div>

            <!-- Document List -->
            <div class="space-y-3">
                <template x-for="doc in businessDocuments" :key="doc.id">
                    <div class="flex items-center justify-between p-3 rounded-lg" :class="darkMode?'bg-primary-900/30':'bg-primary-50'">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary-200 flex items-center justify-center" :class="darkMode?'bg-primary-800':''">
                                <i class="fa-solid fa-file text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium" :class="darkMode?'text-white':'text-primary-900'" x-text="doc.name"></p>
                                <p class="text-xs" :class="darkMode?'text-primary-400':'text-gray-500'">
                                    <span x-text="doc.type"></span> • 
                                    <span x-text="(doc.file_size / 1024).toFixed(2) + ' KB'"></span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="openPreview(doc)" class="text-primary-600 hover:text-primary-700 text-sm">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <a :href="'/storage/' + doc.file_path" target="_blank" class="text-primary-600 hover:text-primary-700 text-sm">
                                <i class="fa-solid fa-download"></i>
                            </a>
                            <button @click="deleteDocument(doc.id)" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </template>
                <template x-if="businessDocuments.length === 0">
                    <div class="text-center py-8">
                        <p class="text-sm" :class="darkMode?'text-primary-400':'text-gray-500'">No documents uploaded yet</p>
                    </div>
                </template>
            </div>
        </div>

        <!-- System Settings -->
        <div x-show="activeTab === 'system'" class="card rounded-2xl p-6 space-y-4">
            <h3 class="font-bold text-sm mb-4" :class="darkMode?'text-primary-200':'text-primary-800'">System Settings</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Time Zone</label>
                    <input type="text" x-model="businessProfileForm.time_zone" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Language</label>
                    <input type="text" x-model="businessProfileForm.language" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Date Format</label>
                    <input type="text" x-model="businessProfileForm.date_format" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div class="md:col-span-2">
                    <label class="form-label block mb-3">Notification Preferences</label>
                    <div class="flex flex-wrap gap-4">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" x-model="businessProfileForm.notif_sms" class="form-checkbox">
                            <span :class="darkMode?'text-primary-200':'text-primary-900'">SMS</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" x-model="businessProfileForm.notif_email" class="form-checkbox">
                            <span :class="darkMode?'text-primary-200':'text-primary-900'">Email</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" x-model="businessProfileForm.notif_push" class="form-checkbox">
                            <span :class="darkMode?'text-primary-200':'text-primary-900'">Push Notification</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Document Modal -->
    <div x-show="showUploadModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-transition>
        <div class="card rounded-2xl p-6 w-full max-w-md mx-4" @click.outside="showUploadModal = false">
            <h3 class="font-bold text-lg mb-4" :class="darkMode?'text-white':'text-primary-900'">Upload Document</h3>
            <div class="space-y-4">
                <div>
                    <label class="form-label">Document Name</label>
                    <input type="text" x-model="documentUploadForm.name" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Document Type</label>
                    <select x-model="documentUploadForm.type" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                        <option value="">Select Type</option>
                        <option value="Registration Certificate">Registration Certificate</option>
                        <option value="Constitution">Constitution / By-laws</option>
                        <option value="Leadership Appointment">Leadership Appointment Documents</option>
                        <option value="Tax Document">Tax Documents</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">File</label>
                    <input type="file" x-ref="documentFile" @change="handleDocumentFileSelect($event)" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div class="flex gap-3 justify-end pt-2">
                    <button @click="showUploadModal = false" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold transition-all" :class="darkMode?'bg-primary-900/50 text-primary-200 hover:bg-primary-900':''">
                        Cancel
                    </button>
                    <button @click="uploadDocument" class="px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold transition-all">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Document Modal -->
    <div x-show="showPreviewModal" class="fixed inset-0 z-[60] flex items-center justify-center bg-black/80" x-transition @keydown.escape.window="showPreviewModal = false">
        <div class="relative w-full max-w-5xl max-h-[90vh] mx-4 flex flex-col" @click.outside="showPreviewModal = false">
            <div class="flex items-center justify-between p-4 bg-white rounded-t-2xl" :class="darkMode?'bg-[#0d1f16] border-b border-primary-900/30':''">
                <h3 class="font-bold text-lg" :class="darkMode?'text-white':'text-primary-900'" x-text="previewDoc ? previewDoc.name : ''"></h3>
                <button @click="showPreviewModal = false" class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-100 transition-colors" :class="darkMode?'hover:bg-primary-900':''">
                    <i class="fa-solid fa-xmark" :class="darkMode?'text-white':'text-gray-500'"></i>
                </button>
            </div>
            <div class="flex-1 overflow-auto bg-gray-100 p-4 rounded-b-2xl" :class="darkMode?'bg-[#0a140e]':''">
                <template x-if="previewDoc && (previewDoc.mime_type.startsWith('image/') || ['jpg', 'jpeg', 'png', 'gif'].includes(previewDoc.file_name.split('.').pop().toLowerCase()))">
                    <div class="flex justify-center">
                        <img :src="'/storage/' + previewDoc.file_path" class="max-w-full h-auto rounded-lg shadow-lg" :alt="previewDoc.name" loading="lazy">
                    </div>
                </template>
                <template x-if="previewDoc && previewDoc.mime_type === 'application/pdf'">
                    <iframe :src="'/storage/' + previewDoc.file_path" class="w-full h-[70vh] rounded-lg shadow-lg" frameborder="0" :title="previewDoc.name"></iframe>
                </template>
                <template x-if="previewDoc && !previewDoc.mime_type.startsWith('image/') && previewDoc.mime_type !== 'application/pdf'">
                    <div class="flex flex-col items-center justify-center py-20">
                        <i class="fa-solid fa-file-lines text-6xl text-primary-600 mb-4"></i>
                        <p :class="darkMode?'text-white':'text-primary-900'">Preview not available for this file type.</p>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Add Leader Modal -->
    <div x-show="showLeaderModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-transition>
        <div class="card rounded-2xl p-6 w-full max-w-md mx-4" @click.outside="showLeaderModal = false">
            <h3 class="font-bold text-lg mb-4" :class="darkMode?'text-white':'text-primary-900'">Add Leader</h3>
            <div class="space-y-4">
                <div>
                    <label class="form-label">Full Name</label>
                    <input type="text" x-model="leaderForm.name" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Role</label>
                    <select x-model="leaderForm.role" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                        <option value="">Select Role</option>
                        <option value="Chairperson">Chairperson</option>
                        <option value="Secretary">Secretary</option>
                        <option value="Treasurer">Treasurer</option>
                        <option value="Manager">Manager</option>
                        <option value="Admin">Admin</option>
                        <option value="Official Contact">Official Contact Person</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Phone Number</label>
                    <input type="text" x-model="leaderForm.phone" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Email Address</label>
                    <input type="email" x-model="leaderForm.email" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div class="flex gap-3 justify-end pt-2">
                    <button @click="showLeaderModal = false" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold transition-all" :class="darkMode?'bg-primary-900/50 text-primary-200 hover:bg-primary-900':''">
                        Cancel
                    </button>
                    <button @click="saveLeader" class="px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold transition-all">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bank Detail Modal -->
    <div x-show="showBankModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-transition>
        <div class="card rounded-2xl p-6 w-full max-w-2xl mx-4 overflow-y-auto max-h-[90vh]" @click.outside="showBankModal = false">
            <h3 class="font-bold text-lg mb-2" :class="darkMode?'text-white':'text-primary-900'">Add Payment Detail</h3>
            <p class="text-xs mb-4" :class="darkMode?'text-primary-400':'text-gray-500'">Fill only the fields you need—no need to complete everything!</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Bank Name</label>
                    <input type="text" x-model="bankForm.bank_name" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Account Name</label>
                    <input type="text" x-model="bankForm.account_name" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Account Number</label>
                    <input type="text" x-model="bankForm.account_number" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Mobile Money Number</label>
                    <input type="text" x-model="bankForm.mobile_money_number" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">M-Pesa</label>
                    <input type="text" x-model="bankForm.mpesa" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Airtel Money</label>
                    <input type="text" x-model="bankForm.airtel_money" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Tigo Pesa</label>
                    <input type="text" x-model="bankForm.tigo_pesa" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Lipa Number</label>
                    <input type="text" x-model="bankForm.lipa_number" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Payment Gateway</label>
                    <input type="text" x-model="bankForm.payment_gateway" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                </div>
                <div>
                    <label class="form-label">Transaction Charges Handling</label>
                    <select x-model="bankForm.transaction_charges" class="form-input input-field" :class="darkMode?'bg-[#0a140e] border-[#1a3328] text-white':'bg-gray-50 border-primary-200'">
                        <option value="">Select</option>
                        <option value="member">Member pays</option>
                        <option value="group">Group pays</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 justify-end pt-6">
                <button @click="showBankModal = false" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold transition-all" :class="darkMode?'bg-primary-900/50 text-primary-200 hover:bg-primary-900':''">
                    Cancel
                </button>
                <button @click="saveBankDetail" class="px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold transition-all">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
