<template>
    <h2 class="text-2xl">Add Note</h2>

    <ValidationErrors :errors="errors" />

    <div class="w-1/2 mx-auto">
        <form @submit.prevent="postNote">
            <div class="flex flex-col space-y-1">
                <label class="text-sm">Title</label>
                <input type="text" v-model="note.name" class="w-full" />
            </div>
            <div class="flex flex-col space-y-1">
                <label class="text-sm">Description</label>
                <input type="text" v-model="note.description" class="w-full" />
            </div>
            <div class="flex flex-col space-y-1">
                <label class="text-sm">&nbsp;</label>
                <button class="bg-blue-500" type="submit">Add</button>
            </div>
        </form>
    </div>

</template>

<script setup>
    import { usePage } from '@inertiajs/inertia-vue3';
    import axios from 'axios';
    import { ref } from 'vue';
    import ValidationErrors from '@/Shared/ValidationErrors.vue';

    const components = {
        ValidationErrors
    };

    let note = {
        name: '',
        description: '',
        _token: usePage().props.csrf_token
    };

    const errors = ref();

    let postNote = () => {
        axios.post('/dashboard/notes', note)
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

