@extends('layouts.dashboard')

@section('dashboard-content')
<div 
    class="space-y-6" 
    x-data="{
        currentStep: 1,
        totalSteps: 5,
        form: {
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
        },
        passport_photo: null,
        nida_card: null,
        passport_photo_preview: null,
        nida_card_preview: null,
        nextStep() {
            if (this.currentStep < this.totalSteps) {
                this.currentStep++;
            }
        },
        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
            }
        },
        handlePassportPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                this.passport_photo = file;
                const reader = new FileReader();
                reader.onload = (e) => this.passport_photo_preview = e.target.result;
                reader.readAsDataURL(file);
            }
        },
        handleNidaCard(event) {
            const file = event.target.files[0];
            if (file) {
                this.nida_card = file;
                const reader = new FileReader();
                reader.onload = (e) => this.nida_card_preview = e.target.result;
                reader.readAsDataURL(file);
            }
        },
        async submit() {
            const formData = new FormData();
            Object.keys(this.form).forEach(key => {
                if (this.form[key] !== null && this.form[key] !== undefined) {
                    formData.append(key, this.form[key]);
                }
            });
            if (this.passport_photo) {
                formData.append('passport_photo', this.passport_photo);
            }
            if (this.nida_card) {
                formData.append('nida_card', this.nida_card);
            }

            try {
                const response = await fetch('{{ route('members.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });
                const result = await response.json();
                if (result.success) {
                    showToast('Member registered successfully!', 'success');
                    window.location.href = '{{ route('members.active') }}';
                } else {
                    showToast(result.message || 'Error registering member!', 'error');
                }
            } catch (error) {
                showToast('Server error occurred!', 'error');
            }
        }
    }"
>
    <h2 class="text-2xl font-bold text-primary-900 dark:text-white">Register New Member</h2>

    <!-- Progress Steps -->
    <div class="flex items-center justify-between mb-6">
        <template x-for="step in totalSteps" :key="step">
            <div class="flex items-center">
                <div 
                    class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all"
                    :class="currentStep >= step ? 'bg-primary-600 text-white' : 'bg-gray-300 text-gray-700'"
                >
                    <span x-text="step"></span>
                </div>
                <span class="ml-2 font-semibold text-sm" 
                    :class="currentStep >= step ? 'text-primary-800 dark:text-primary-200' : 'text-gray-500'">
                    <span x-show="step === 1">Personal</span>
                    <span x-show="step === 2">Address</span>
                    <span x-show="step === 3">Membership</span>
                    <span x-show="step === 4">Next of Kin</span>
                    <span x-show="step === 5">Documents</span>
                </span>
                <div 
                    x-show="step < totalSteps" 
                    class="w-16 sm:w-24 h-1 mx-2"
                    :class="currentStep > step ? 'bg-primary-600' : 'bg-gray-300'"
                ></div>
            </div>
        </template>
    </div>

    <!-- Form Container -->
    <div class="card rounded-2xl p-8">
        <form @submit.prevent="submit()" class="space-y-6">
            <!-- Step 1: Personal Info -->
            <div x-show="currentStep === 1" x-transition class="space-y-6">
                <h3 class="font-bold text-xl text-primary-800 dark:text-primary-200">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Full Name *</label>
                        <input 
                            type="text" 
                            x-model="form.name" 
                            required 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="Enter Full Name"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Phone *</label>
                        <input 
                            type="text" 
                            x-model="form.phone" 
                            required 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="+255 7XX XXX XXX"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Email</label>
                        <input 
                            type="email" 
                            x-model="form.email" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="email@example.com"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">NIDA</label>
                        <input 
                            type="text" 
                            x-model="form.nida" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="NIDA Number"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Gender</label>
                        <select 
                            x-model="form.gender" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                        >
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Date of Birth</label>
                        <input 
                            type="date" 
                            x-model="form.dob" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Marital Status</label>
                        <select 
                            x-model="form.marital_status" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                        >
                            <option value="">Select</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Occupation</label>
                        <input 
                            type="text" 
                            x-model="form.occupation" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="Occupation"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Employer</label>
                        <input 
                            type="text" 
                            x-model="form.employer" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="Employer/Company Name"
                        >
                    </div>
                </div>
            </div>

            <!-- Step 2: Address -->
            <div x-show="currentStep === 2" x-transition class="space-y-6">
                <h3 class="font-bold text-xl text-primary-800 dark:text-primary-200">Address Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Region *</label>
                        <select 
                            x-model="form.region" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                        >
                            <option value="Dar es Salaam">Dar es Salaam</option>
                            <option value="Mwanza">Mwanza</option>
                            <option value="Arusha">Arusha</option>
                            <option value="Mbeya">Mbeya</option>
                            <option value="Dodoma">Dodoma</option>
                            <option value="Morogoro">Morogoro</option>
                            <option value="Tanga">Tanga</option>
                            <option value="Kilimanjaro">Kilimanjaro</option>
                            <option value="Kagera">Kagera</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">District *</label>
                        <input 
                            type="text" 
                            x-model="form.district" 
                            required 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="District"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Ward</label>
                        <input 
                            type="text" 
                            x-model="form.ward" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="Ward"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Street</label>
                        <input 
                            type="text" 
                            x-model="form.street" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="Street"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">P.O. Box</label>
                        <input 
                            type="text" 
                            x-model="form.po_box" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="P.O. Box"
                        >
                    </div>
                </div>
            </div>

            <!-- Step 3: Membership -->
            <div x-show="currentStep === 3" x-transition class="space-y-6">
                <h3 class="font-bold text-xl text-primary-800 dark:text-primary-200">Membership Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Membership Type *</label>
                        <select 
                            x-model="form.membership_type" 
                            required
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                        >
                            <option value="Regular">Regular Member</option>
                            <option value="Group">Group Member</option>
                            <option value="Junior">Junior Member</option>
                            <option value="Institutional">Institutional</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Branch *</label>
                        <select 
                            x-model="form.branch" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                        >
                            <option value="Dar es Salaam HQ">Dar es Salaam HQ</option>
                            <option value="Mwanza Branch">Mwanza Branch</option>
                            <option value="Arusha Branch">Arusha Branch</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Step 4: Next of Kin -->
            <div x-show="currentStep === 4" x-transition class="space-y-6">
                <h3 class="font-bold text-xl text-primary-800 dark:text-primary-200">Next of Kin / Beneficiaries</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Next of Kin Name *</label>
                        <input 
                            type="text" 
                            x-model="form.next_of_kin_name" 
                            required 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="Full Name"
                        >
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Relationship *</label>
                        <select 
                            x-model="form.next_of_kin_relationship" 
                            required 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                        >
                            <option value="">Select</option>
                            <option value="Spouse">Spouse</option>
                            <option value="Parent">Parent</option>
                            <option value="Sibling">Sibling</option>
                            <option value="Child">Child</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="form-label block mb-2 text-primary-700 dark:text-primary-300">Next of Kin Phone</label>
                        <input 
                            type="text" 
                            x-model="form.next_of_kin_phone" 
                            class="form-input input-field w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-primary-900/30 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="+255 7XX XXX XXX"
                        >
                    </div>
                </div>
            </div>

            <!-- Step 5: Documents -->
            <div x-show="currentStep === 5" x-transition class="space-y-6">
                <h3 class="font-bold text-xl text-primary-800 dark:text-primary-200">Documents</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div 
                        class="border-2 border-dashed border-primary-300 dark:border-primary-700 rounded-xl p-8 text-center cursor-pointer hover:border-primary-500 transition-colors"
                    >
                        <label class="cursor-pointer">
                            <template x-if="!passport_photo_preview">
                                <div>
                                    <i class="fa-solid fa-camera text-4xl text-primary-500 mb-4"></i>
                                    <p class="text-lg font-semibold text-primary-700 dark:text-primary-300">Passport Photo</p>
                                    <p class="text-sm text-gray-500 dark:text-primary-400">Click to upload or drag & drop</p>
                                </div>
                            </template>
                            <template x-if="passport_photo_preview">
                                <img 
                                    :src="passport_photo_preview" 
                                    class="w-40 h-40 object-cover rounded-xl mx-auto shadow-lg"
                                >
                            </template>
                            <input 
                                type="file" 
                                class="hidden" 
                                accept="image/*" 
                                @change="handlePassportPhoto($event)"
                            >
                        </label>
                    </div>

                    <div 
                        class="border-2 border-dashed border-primary-300 dark:border-primary-700 rounded-xl p-8 text-center cursor-pointer hover:border-primary-500 transition-colors"
                    >
                        <label class="cursor-pointer">
                            <template x-if="!nida_card_preview">
                                <div>
                                    <i class="fa-solid fa-id-card text-4xl text-primary-500 mb-4"></i>
                                    <p class="text-lg font-semibold text-primary-700 dark:text-primary-300">NIDA Card / ID</p>
                                    <p class="text-sm text-gray-500 dark:text-primary-400">Click to upload or drag & drop</p>
                                </div>
                            </template>
                            <template x-if="nida_card_preview">
                                <img 
                                    :src="nida_card_preview" 
                                    class="w-40 h-40 object-cover rounded-xl mx-auto shadow-lg"
                                >
                            </template>
                            <input 
                                type="file" 
                                class="hidden" 
                                accept="image/*" 
                                @change="handleNidaCard($event)"
                            >
                        </label>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 justify-end pt-6 border-t border-gray-200 dark:border-gray-700">
                <button 
                    @click="prevStep()" 
                    x-show="currentStep > 1" 
                    type="button"
                    class="px-8 py-3 border border-gray-300 dark:border-gray-600 text-primary-800 dark:text-primary-200 rounded-lg font-semibold hover:bg-gray-100 dark:hover:bg-primary-900/30 transition-all"
                >
                    Previous
                </button>
                <button 
                    @click="nextStep()" 
                    x-show="currentStep < totalSteps" 
                    type="button"
                    class="px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-semibold transition-all"
                >
                    Next
                </button>
                <button 
                    x-show="currentStep === totalSteps" 
                    type="submit"
                    class="px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-semibold transition-all"
                >
                    <i class="fa-solid fa-user-plus mr-2"></i> Register Member
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
