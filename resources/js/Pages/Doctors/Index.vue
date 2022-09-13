<template>
    <Head title="Doctrs" />
    <!-- New Doctor -->
     <Link href="doctors/create" class="mx-8 text-white
            bg-green-700 hover:bg-opacity-90 py-2 px-8 rounded-md">
            New Doctor
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
                <th>
                    Specialty
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 divide-solid">
            <tr v-for="doctor in doctors.data" :key="doctor.id">
                <td class="px-4">
                    {{doctor.user.name}}
                </td>
                <td class="px-4">
                    {{doctor.user.nid}}
                </td>
                <td class="px-4">
                    {{doctor.user.phone_number}}
                </td>
                <td v-bind:age="doctor.user.age" v-if="doctor.user.age > 1" class="px-4">
                    <span v-bind:age="doctor.user.age">
                        {{doctor.user.age}} y
                    </span>
                </td>
                <td v-bind:age="doctor.user.age" v-else-if="doctor.user.age == 1" class="px-4">
                    <span v-bind:age="doctor.user.age">
                      1 yr, {{doctor.user.month - 12}} m
                    </span>
                </td>
                <td v-else class="px-4">
                    <span v-bind:month= "doctor.month">
                       {{doctor.user.month}} m
                    </span>
                </td>
                 <td class="px-4">
                    {{doctor.user.dob}}
                </td>
                <td class="px-4">
                    {{doctor.user.gender}}
                </td>
                <td class="px-4">
                    {{doctor.user.email}}
                </td>
                <td class="px-4">
                    {{doctor.specialty.name}}
                </td>
                <td>
                    <Link :href="route('doctors.edit', doctor.id)" type="button" class="p-1 px-2 bg-yellow-300 text-yellow-600">
                        Edit
                    </Link>
                    <button @click="destroy(doctor.id)" type="button" class="p-1 px-2 bg-red-300 text-red-600">
                        Delete
                    </button>
                </td>
            </tr>
        </tbody>
     </Table>
<pagination :links="doctors.links" />
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
        doctors: Object
    },
    setup() {
        const destroy = (id) => {
            if (confirm('Are you sure?')) {
                Inertia.delete('doctors/destroy/' + id)
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
