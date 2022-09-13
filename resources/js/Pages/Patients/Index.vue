<template>
    <Head title="Patients" />
    <!-- New Patient -->
     <Link href="patients/create" class="mx-8 text-white
            bg-green-700 hover:bg-opacity-90 py-2 px-8 rounded-md">
            New Patient
     </Link>
     
     <Table>
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    NID
                </th>
                <th>
                    Phone No.
                </th>
                <th>
                    Emergency No.
                </th>
                <th>
                    Age
                </th>
                <th>
                    DOB
                </th>
                <th>
                    Gender
                </th>
                <th>
                    Email
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 divide-solid">
            <tr v-for="patient in patients.data" :key="patient.id">
                <td class="px-4">
                    {{patient.name}}
                </td>
                <td class="px-4">
                    {{patient.nid}}
                </td>
                <td class="px-4">
                    {{patient.phone_number}}
                </td>
                <td class="px-4">
                    {{patient.emergency_contact_number}}
                </td>
                <td v-bind:age="patient.age" v-if="patient.age > 1" class="px-4">
                    <span v-bind:age="patient.age">
                        {{patient.age}} y
                    </span>
                </td>
                <td v-bind:age="patient.age" v-else-if="patient.age == 1" class="px-4">
                    <span v-bind:age="patient.age">
                      1 yr, {{patient.month - 12}} m
                    </span>
                </td>
                <td v-else class="px-4">
                    <span v-bind:month= "patient.month">
                       {{patient.month}} m
                    </span>
                </td>
                 <td class="px-4">
                    {{patient.dob}}
                </td>
                <td class="px-4">
                    {{patient.gender}}
                </td>
                <td class="px-4">
                    {{patient.email}}
                </td>
                <td>
                    <Link :href="route('patients.edit', patient.id)" type="button" class="p-1 px-2 bg-yellow-300 text-yellow-600">
                        Edit
                    </Link>
                    <button @click="destroy(patient.id)" type="button" class="p-1 px-2 bg-red-300 text-red-600">
                        Delete
                    </button>
                </td>
            </tr>
        </tbody>
     </Table>
<pagination :links="patients.links" />

     
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

        <TabItem title="Currencies">Content</TabItem>
        <TabItem title="Rates">Rates Content</TabItem>
    </TabsWrapper>
</template>

<script>
import ModalNote from "../../Modals/AddNote.vue"
import TabsWrapper from "../../Shared/TabsWrapper.vue"
import TabItem from "../../Shared/TabItem.vue"
import { Inertia } from '@inertiajs/inertia'
import Pagination from "../../Shared/Pagination.vue"

export default {
    components: {
        Pagination,
        ModalNote,
        TabsWrapper,
        TabItem
    },
    props: {
        patients: Object
    },
    setup() {
        const destroy = (id) => {
            if (confirm('Are you sure?')) {
                Inertia.delete('patients/destroy/' + id)
            }
        }
        return {destroy}
    },
    data() {
        return {
            showModalNote: false,
        }
    }
}
</script>
