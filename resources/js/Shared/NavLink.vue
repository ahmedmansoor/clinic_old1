<template>
    <Link
        class="flex space-x-2 text-gray-400 p-1.5 px-3 w-full hover:bg-gray-50 hover:text-gray-500 transition-colors"
        :class="{
            'bg-blue-600 bg-opacity-10 hover:text-blue-700 hover:bg-blue-50 text-blue-700 w-full p-1.5 px-3 transition-colors':
                active
        }"
    >
        <slot />
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3"

export default {
    components: { Link },

    props: {
        active: Boolean
    }
}
</script>
