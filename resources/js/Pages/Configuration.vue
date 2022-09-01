<template>
    <Head title="Configuration" />
    <h1 class="text-3xl">Configuration</h1>
    <div>
        <!-- Create Session -->
        <button
            id="show-modal-note"
            @click="showModalNote = true"
            class="px-3 p-2 rounded-md bg-green-600 bg-opacity-10 text-green-700 flex space-x-1"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 mt-0.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                />
            </svg>
            <span>
                Create Session
            </span>
        </button>

        <Teleport to="body">
            <ModalNote
                :show="showModalNote"
                @close="showModalNote = false"
            >
                <template #header>
                    <h3>custom header</h3>
                </template>
            </ModalNote>
        </Teleport>
    </div>
</template>

<script>
import ModalNote from "../Modals/AddNote.vue"

export default {
    components: {
        ModalNote,
    },
    data() {
        return {
            showModalNote: false,
        }
    }
}
</script>
