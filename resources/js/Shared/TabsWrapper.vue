<script setup>
import { useSlots, ref, provide } from "vue"

const slots = useSlots()
const tabTitles = ref(slots.default().map((tab) => tab.props.title))
const selectedTitle = ref(tabTitles.value[0])

provide("selectedTitle", selectedTitle)
</script>

<template>
    <div class="min-w-max mx-20 my-10 text-sm">
        <ul class="flex space-x-1 -mb-1">
            <li
                v-for="title in tabTitles"
                :key="title"
                class="tabs__item flex rounded-t-md p-2 px-4 transition-all ease-in-out cursor-pointer border-t border-gray-100 hover:border-t text-gray-500 hover:border-gray-200"
                :class="{ selected: selectedTitle === title }"
                @click="selectedTitle = title"
            >
                {{ title }}
            </li>
        </ul>

        <slot />
    </div>
</template>

<style>
.tabs__item.selected {
    background-color: #fff;
    border: 1px solid #e2e8f0;
    color: #1f2937;
    border-bottom: 0;
    border-radius: 5px 5px 0 0;
    padding: 7px 14px;
}
</style>
