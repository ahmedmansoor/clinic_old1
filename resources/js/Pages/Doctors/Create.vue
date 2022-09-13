<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import ValidationErrors from '@/Shared/ValidationErrors.vue';
import { ref, computed, defineProps } from 'vue';
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
} from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
  specialties: { type: Array, required: true },
})


let selected = ref({})
let query = ref('')

let filteredSpecialties = computed(() =>
  query.value === ''
    ? props.specialties
    : props.specialties.filter((specialty) =>
        specialty.name
          .toLowerCase()
          .replace(/\s+/g, '')
          .includes(query.value.toLowerCase().replace(/\s+/g, ''))
      )
)
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
    // form.put('store');
     form.post(route("doctors.store"));
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
    <!-- Combobox Autocomplete -->
<Combobox v-model="selected">
      <div class="relative mt-1">
        <div
          class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
        >
          <ComboboxInput
            class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
            :displayValue="(specialty) => specialty.name"
            @change="query = $event.target.value"
          />
          <ComboboxButton
            class="absolute inset-y-0 right-0 flex items-center pr-2"
          >
            <ChevronUpDownIcon
              class="h-5 w-5 text-gray-400"
              aria-hidden="true"
            />
          </ComboboxButton>
        </div>
        <TransitionRoot
          leave="transition ease-in duration-100"
          leaveFrom="opacity-100"
          leaveTo="opacity-0"
          @after-leave="query = ''"
        >
          <ComboboxOptions
            class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
          >
            <div
              v-if="filteredSpecialties.length === 0 && query !== ''"
              class="relative cursor-default select-none py-2 px-4 text-gray-700"
            >
              Nothing found.
            </div>

            <ComboboxOption
              v-for="specialty in filteredSpecialties"
              as="template"
              :key="specialty.id"
              :value="specialty"
              v-slot="{ selected, active }"
            >
              <li
                class="relative cursor-default select-none py-2 pl-10 pr-4"
                :class="{
                  'bg-teal-600 text-white': active,
                  'text-gray-900': !active,
                }"
              >
                <span
                  class="block truncate"
                  :class="{ 'font-medium': selected, 'font-normal': !selected }"
                >
                  {{ specialty.name }}
                </span>
                <span
                  v-if="selected"
                  class="absolute inset-y-0 left-0 flex items-center pl-3"
                  :class="{ 'text-white': active, 'text-teal-600': !active }"
                >
                  <CheckIcon class="h-5 w-5" aria-hidden="true" />
                </span>
              </li>
            </ComboboxOption>
          </ComboboxOptions>
        </TransitionRoot>
      </div>
    </Combobox>
<!-- End Combobox -->
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
