<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import ValidationErrors from '@/Shared/ValidationErrors.vue';

const components = {
    ValidationErrors
};

const form = useForm({
    name: '',
    user_role_id: '',
    user_status_id: '',
    nid: '',
    gender: '',
    address: '',
    street: '',
    island: '',
    atoll: '',
    city: '',
    country: '',
    phone_number: '',
    email: '',
    dob: '',
    marital_status: '',
    emergency_contact: '',
    emergency_contact_number: '',
    last_login: '',
    password: '',
    specialty_id: '',
    registration_number: '',
});

// const errors = [];
const errors = ref();

const submit = () => {
    form.post('store');
}

</script>

<template>
<div class="w-1/2 mx-auto">
        <div class="flex flex-col" v-for="messages, name in errors" :key="`errors` + name">
            <label class="text-sm bg-red-400 my-1" v-for="message,index in messages" :key="`error`+index">
                {{ message }}
            </label>
        </div>
    </div>
    <div>
        <form @submit.prevent="submit">
        <!-- <form @submit.prevent="form.post(route('doctors.store'))"> -->
            <div>
                <h3>Personal Information</h3>
                <!-- Full Name -->
                <div class="mb-6">
                    <label for="Name" class="text-sm"> Full Name </label>
                    <input
                        type="text"
                        v-model="form.name"
                        class="w-full"
                        placeholder="Full Name"
                    />
                    <div v-if="form.errors.name" class="text-red-600 text-sm">
                        {{ form.errors.name }}
                    </div>
                </div>
                <!-- NID -->
                <div class="mb-6">
                    <label for="NID" class="text-sm"> NID/Passport No. </label>
                    <input
                        type="text"
                        v-model="form.nid"
                        class="w-full"
                        placeholder="NID/PP No."
                    />
                    <div v-if="form.errors.nid" class="text-red-600 text-sm">
                        {{ form.errors.nid }}
                    </div>
                </div>
                 <!-- Gender -->
                <div class="mb-6">
                    <label for="Gender" class="text-sm">Gender</label>
                    <select name="gender" id="gender" v-model="form.gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div v-if="form.errors.gender" class="text-red-600 text-sm">
                        {{ form.errors.gender }}
                    </div>
                </div>
                 <!-- registration_number -->
                <div class="mb-6">
                    <label for="registration_number" class="text-sm">Registration No.</label>
                    <input
                        type="text"
                        v-model="form.registration_number"
                        class="w-full"
                        placeholder="Registration No."
                    />
                    <div v-if="form.errors.registration_number" class="text-red-600 text-sm">
                        {{ form.errors.registration_number }}
                    </div>
                </div>
            </div>
            <div>
                <h3>Contact Details</h3>
                <!-- phone_number -->
                <div class="mb-6">
                    <label for="Phone Number" class="text-sm">
                        Phone No.
                    </label>
                    <input
                        type="number"
                        v-model="form.phone_number"
                        class="w-full"
                        placeholder="Phone No."
                    />
                    <div
                        v-if="form.errors.phone_number" class="text-red-600 text-sm">
                        {{ form.errors.phone_number }}
                    </div>
                </div>
                <!-- email -->
                <div class="mb-6">
                    <label for="Phone Number" class="text-sm">
                        Email Address
                    </label>
                    <input
                        type="email"
                        v-model="form.email"
                        class="w-full"
                        placeholder="Email Address"
                    />
                    <div v-if="form.errors.email" class="text-red-600 text-sm">
                        {{ form.errors.email }}
                    </div>
                </div>
                <!-- dob -->
                <div class="mb-6">
                    <label for="Phone Number" class="text-sm">
                        Date of Birth
                    </label>
                    <input type="date" v-model="form.dob" class="w-full" />
                    <div v-if="form.errors.dob" class="text-red-600 text-sm">
                        {{ form.errors.dob }}
                    </div>
                </div>
            </div>
            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto 
                px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                :disabled="form.processing"
                :class="{ 'opacity-25': form.processing }">
                Submit
            </button>
        </form>
    </div>
</template>
