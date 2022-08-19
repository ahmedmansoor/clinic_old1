<template>
    <div class="w-1/2 mx-auto">
        <div class="flex flex-col" v-for="messages, name in errors" :key="`errors` + name">
            <label class="text-sm bg-red-400 my-1" v-for="message,index in messages" :key="`error`+index">
                {{ message }}
            </label>
        </div>
    </div>
</template>

<script setup>

import { defineProps } from 'vue';

const props = defineProps({
    errors: {
        type: Object,
        default: () => ({})
    }
});

</script>
