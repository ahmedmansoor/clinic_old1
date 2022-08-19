<template>
    <div class="flex flex-row text-gray-800 font-lato">
        <aside class="sidebar w-56 shadow-md min-h-screen">
            <section>
                <header class="flex-col space-y-3 fixed h-screen">
                    <div class="p-3 flex flex-row space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                        </svg>
                        <h1 class="text-xl font-extrabold">Clinic</h1>
                    </div>
                    <Nav />
                </header>
            </section>
        </aside>
        <div class="main-content flex flex-col flex-grow m-5 mt-16 max-w-7xl">
            <section class="relative">
                <slot />
            </section>
        </div>
    </div>
</template>

<script>
import Nav from "./Nav.vue"

export default {
    components: { Nav }
}
</script>
