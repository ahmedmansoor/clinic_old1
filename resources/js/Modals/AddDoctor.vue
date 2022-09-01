<script setup>
import { usePage } from "@inertiajs/inertia-vue3"
import axios from "axios"
import ValidationErrors from '@/Shared/ValidationErrors.vue';

const components = {
    ValidationErrors
};

let note = {
    name: "",
    description: "",
    _token: usePage().props.csrf_token
}

let postDoctor = () => {
    axios
        .post("/dashboard/doctors/new-doctor", note)
        .then((response) => {
            console.log(response)
            errors.value = null;
            }).catch(error => {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            });
}

const props = defineProps({
    show: Boolean
})
</script>

<template>
    <Transition name="modal-note">
        <div v-if="show"
            class="fixed flex z-50 top-0 left-0 w-full h-screen backdrop-blur-sm bg-opacity-30 
            bg-gray-700 transition-opacity font-circular">
            <div class="m-auto align-middle">
                <div class="min-w-max m-auto shadow-lg rounded-lg bg-white">
                    <div class="my-6 p-6 -mt-20">
                        <h2 class="text-lg text-gray-700 mb-5">
                            Add Doctor
                        </h2>
                        <div class="w-full">
                            <form @submit.prevent="postDoctor">
                                <div class="flex flex-col justify-center space-y-3">
                                    <div class="flex flex-col space-y-1">
                                        <label class="text-xs uppercase tracking-wide text-gray-500">
                                            Title
                                        </label>
                                        <input type="text"
                                            v-model="note.name"
                                            class="bg-white border focus:outline-2 outline-gray-400 
                                            border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 
                                            focus:border-green-600 block p-2"/>
                                    </div>
                                    <div class="flex flex-col space-y-1">
                                        <label class="text-xs uppercase tracking-wide text-gray-500">
                                            Description
                                        </label>
                                        <input
                                            type="text"
                                            v-model="note.description"
                                            class="w-80 bg-white border focus:outline-2 
                                            outline-gray-400 border-gray-300 text-gray-900 text-sm 
                                            rounded-lg focus:ring-green-600 focus:border-green-600 block p-2"/>
                                    </div>
                                </div>
                                <div class="flex flex-row space-x-2 mt-10 w-min text-sm">
                                    <button type="submit"
                                        @click="$emit('close')"
                                        class="bg-green-600 bg-opacity-10 text-green-700 hover:bg-opacity-30 
                                        py-2 px-10 rounded-md">
                                        Add
                                    </button>
                                    <button type="submit"
                                        @click="$emit('close')"
                                        class="border border-white hover:border-gray-300 hover:border py-2 px-3 
                                        rounded-md text-gray-500">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>
