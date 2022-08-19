<template>
    <Head title="Patients" />
      <TabsWrapper>
          <TabItem title="Rooms">
              <div class="flex space-x-3 p-10">
                  <h1 class="text-3xl">Patients</h1>
                <!-- Add Note-->
                <div>
                    <button
                        id="show-modal-note"
                        class="p-2 px-3 rounded-md bg-green-600 bg-opacity-10 text-green-700 flex space-x-1"
                        @click="showModalNote = true"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
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
                        Add Note
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
            </div>
        </TabItem>

        <TabItem title="Currencies">$$$ Content</TabItem>
        <TabItem title="Rates">Rates Content</TabItem>
    </TabsWrapper>
</template>

<script>
import ModalNote from "../Modals/AddNote.vue"
import TabsWrapper from "../Shared/TabsWrapper.vue"
import TabItem from "../Shared/TabItem.vue"

export default {
    components: {
        ModalNote,
        TabsWrapper,
        TabItem
    },
    data() {
        return {
            showModalNote: false,
        }
    }
}
</script>
