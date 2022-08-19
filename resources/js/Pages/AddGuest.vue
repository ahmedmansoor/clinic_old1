<template>
    <Head title="Reservation" />
    <div class="mx-20 space-y-4">
        <h1 class="text-3xl">Reservation</h1>
        <h2 class="text-2xl">Create Guest Profile</h2>

        <ValidationErrors :errors="errors" />
        <div class="flex flex-row space-x-3 mt-3 justify-end">
            <div class="w-max">
                <label class="text-xs uppercase tracking-wide text-gray-500">&nbsp;</label>
                <button form="create-guest" class="bg-green-600 bg-opacity-10 text-green-700 hover:bg-opacity-30 
                py-2 px-10 rounded-md" type="submit">Create Guest</button>
            </div>
            <div class="w-max">
                <label class="text-xs uppercase tracking-wide text-gray-500">&nbsp;</label>
                <a href="/dashboard/reservations">
                    <button class="border border-white hover:border-gray-300 hover:border py-2 
                    px-3 rounded-md text-gray-500">Cancel</button>
                </a>
            </div>
        </div>
        <div class="bg-white rounded-lg">
            <form id="create-guest" @submit.prevent="postGuest" class="w-full flex flex-col space-y-5 mb-20">
                <div class="-mt-5 space-y-5">
                    <p class="text-lg my-2">Basic Information</p>
                    <div class="flex flex-row space-x-3">
                        <div class="flex flex-col space-y-1">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Title</label>
                            <input type="text" v-model="guestForm.title"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                        <div class="flex flex-col space-y-1 w-2/4">
                            <label class="text-xs uppercase tracking-wide text-gray-500">First Name</label>
                            <input type="text" v-model="guestForm.first_name"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                        <div class="flex flex-col space-y-1 w-2/4">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Last Name</label>
                            <input type="text" v-model="guestForm.last_name"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                    </div>
                    <div class="flex flex-row space-x-3">
                        <div class="flex flex-col space-y-1">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Gender</label>
                            <select class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" v-model="guestForm.gender">
                                <option v-for="name,index in genders" :value="index" :key="`gender_`+index">{{
                                    name }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-1 w-2/4">
                            <label class="text-xs uppercase tracking-wide text-gray-500">PP No. / Id No.</label>
                            <input type="text" v-model="guestForm.id_number"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                        <div class="flex flex-col space-y-1 w-2/4">
                            <label class="text-xs uppercase tracking-wide text-gray-500">DOB</label>
                            <input type="date" v-model="guestForm.dob"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                    </div>
                    <div class="flex flex-row space-x-3">
                        <div class="flex flex-col space-y-1 w-1/3">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Language</label>
                            <input type="text" v-model="guestForm.language"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                        <div class="flex flex-col space-y-1 w-1/3">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Nationality</label>
                            <select class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                                text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" v-model="guestForm.nationality">
                                    <option v-for="country in countries" :value="country.id" :key="`nationality_`+country.id">
                                        {{ country.nationality_string ?
                                        `${country.name}(${country.nationality_string})` :
                                        country.name }}
                                    </option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-1 w-1/3">
                                <label class="text-xs uppercase tracking-wide text-gray-500">Company</label>
                                <input type="text" v-model="guestForm.company"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                                text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                    </div>
                </div>
                <div class="-mt-5 space-y-5">
                    <p class="text-lg my-2">Contact Details</p>
                    <div class="flex flex-row space-x-3">
                        <div class="flex flex-col space-y-1 w-1/2">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Phone</label>
                            <input type="text" v-model="guestForm.phone"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                        <div class="flex flex-col space-y-1 w-1/2">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Email Address</label>
                            <input type="text" v-model="guestForm.email"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                    </div>
                    <div class="flex flex-row space-x-3">
                        <div class="flex flex-col space-y-1 w-1/3">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Country</label>
                            <select class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" v-model="guestForm.country_id">
                                <option v-for="country in countries" :value="country.id" :key="`room_type_`+country.id">{{
                                    country.name }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-1 w-1/3">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Address</label>
                            <input type="text" v-model="guestForm.address_line_1"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                        <div class="flex flex-col space-y-1 w-1/3">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Address Line 2</label>
                            <input type="text" v-model="guestForm.address_line_2"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                    </div>
                    <div class="flex flex-row space-x-3">
                        <div class="flex flex-col space-y- w-2/3">
                            <label class="text-xs uppercase tracking-wide text-gray-500">City</label>
                            <input type="text" v-model="guestForm.city"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                        <div class="flex flex-col space-y- w-2/3">
                            <label class="text-xs uppercase tracking-wide text-gray-500">State</label>
                            <input type="text" v-model="guestForm.state"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                        <div class="flex flex-col space-y-1 w-1/3">
                            <label class="text-xs uppercase tracking-wide text-gray-500">Zip Code</label>
                            <input type="text" v-model="guestForm.zip_code"  class="bg-white border focus:outline-2 outline-gray-400 border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block p-2" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
    import { usePage } from '@inertiajs/inertia-vue3';
    import axios from 'axios';
    import { ref, onMounted } from 'vue';
    import ValidationErrors from '@/Shared/ValidationErrors.vue';

    const components = {
        ValidationErrors
    };

    const countries = ref();
    onMounted(() => {
        axios.get('/dashboard/countries/for-select')
            .then(response => {
                console.log(response.data)
                countries.value = response.data;
                countries.value.unshift({ id:null, name: 'Not Selected'});
                console.log(countries.value)
            }).catch(error => {
                console.log(error);
            });
    });

    const genders = {
        0 : 'Not Selected',
        1 : 'Male',
        2 : 'Female',
        3 : 'Other',
    }

    //@todo remove the values
    let guestForm = {
        first_name: 'first_name_dummy_value',
        last_name: 'last_name_dummy_value',
        id_number: 'id_number_dummy_value',
        gender: 1,
        title: 'title_dummy_value',
        dob: 'dob_dummy_value',
        company: 'company_dummy_value',
        nationality: null,
        language: 'language_dummy_value',
        phone: 'phone_dummy_value',
        email: 'email_dummy_value',
        address_line_1: 'address_line_1_dummy_value',
        address_line_2: 'address_line_2_dummy_value',
        city: 'city_dummy_value',
        state: 'state_dummy_value',
        zip_code: 'zip_code_dummy_value',
        country_id: null,
        _token: usePage().props.csrf_token
    };

    const errors = ref();

    let postGuest = () => {
        axios.post('/dashboard/guests', guestForm)
            .then(response => {
                console.log(response);
                errors.value = null;
            }).catch(error => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            });
    }
</script>

