<script setup>
import { inject } from "vue"

const props = defineProps({
    title: String
})

const selectedTitle = inject("selectedTitle")
</script>

<template>
    <div
        class="bg-white h-60 rounded-b-md rounded-tr-md border"
        v-show="selectedTitle === title"
    >
        <slot />
    </div>
</template>
