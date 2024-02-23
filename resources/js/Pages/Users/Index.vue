<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {
    EyeIcon,
    PencilAltIcon,
    UserGroupIcon,
    XCircleIcon,
    ChevronUpIcon,
    ChevronDownIcon,
    UserAddIcon
} from "@heroicons/vue/outline";
import Modal from "@/Components/Modal.vue";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";
import {router} from "@inertiajs/vue3";
import Pagination from '../../Shared/Pagination.vue';
import {ref} from "vue";
import Buttons from "@/Pages/Components/Buttons.vue";

let props = defineProps({
    search: {
        type: String,
        default: () => ''
    },
    sort: {
        type: String,
        default: () => 'id'
    },
    sortDir: {
        type: String,
        default: () => 'asc'
    },
    users: {
        type: Array,
        default: () => []
    },
    roles: {
        type: Array,
        default: () => []
    },
})


let term = ref(props.search)
let sort = ref(props.sort);
let sortDir = ref(props.sortDir);
function sortBy(field) {
    sort.value = field;
    sortDir.value = props.sort !== field ? 'asc' : (props.sortDir === 'asc' ? 'desc' : 'asc');
    updateTable();
}

function applySearch(event) {
    term = event.target.value;
    updateTable()
}

function updateTable() {
    let query = '';
    if (term) query += `search=${term}&`;
    if (sort) query += `sort=${sort.value}&sortDir=${sortDir.value}`;

    router.visit(`/usuarios?${query}`, {preserveState: true, replace: true})
}

function destroy(id) {
    router.delete(`/usuarios/${id}`, {
        onBefore: () => confirm('Tem certeza que deseja remover este usuário?'),
    });
    router.on('success', (event) => {
        console.log(`Sucesso`)
    })
    router.on('error', (errors) => {
        console.log(errors)
    })
}


</script>

<template>
    <AuthenticatedLayout title="Usuários">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Tabela de Usuários
                </h2>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                            <div class="py-3 px-4 flex justify-between">
                                <div class="relative max-w-xs">
                                    <Button variant="success" :href="route('users.create')">
                                        <UserAddIcon class="flex-shrink-0 w-6 h-6 mr-1" aria-hidden="true" :class="iconSizeClasses" />
                                        <span>Cadastrar Usuário</span>
                                    </Button>
                                </div>
                                <div class="relative max-w-xs">
                                    <label class="sr-only">Search</label>
                                    <input @keyup="applySearch" type="text" name="hs-table-with-pagination-search" id="hs-table-with-pagination-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Pesquise . . ">
                                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                        <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-4 pe-0">
                                            <div class="flex items-center h-5">
                                                <input id="hs-table-pagination-checkbox-all" type="checkbox" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                <label for="hs-table-pagination-checkbox-all" class="sr-only">Checkbox</label>
                                            </div>
                                        </th>
                                        <th @click="sortBy('id')" scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            #
                                            <span v-if="props.sort === 'id'" class="float-end">
                                                <span v-if="props.sortDir === 'asc'">
                                                    <ChevronUpIcon class="hover:text-blue-500 flex-shrink-0 w-6 h-6" aria-hidden="true"/>
                                                </span>
                                                <span v-if="props.sortDir === 'desc'">
                                                    <ChevronDownIcon class="hover:text-blue-500 flex-shrink-0 w-6 h-6" aria-hidden="true"/>
                                                </span>
                                            </span>
                                        </th>
                                        <th @click="sortBy('name')" scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Nome
                                            <span v-if="props.sort === 'name'" class="float-end">
                                                <span v-if="props.sortDir === 'asc'">
                                                    <ChevronUpIcon class="hover:text-blue-500 flex-shrink-0 w-6 h-6" aria-hidden="true"/>
                                                </span>
                                                <span v-if="props.sortDir === 'desc'">
                                                    <ChevronDownIcon class="hover:text-blue-500 flex-shrink-0 w-6 h-6" aria-hidden="true"/>
                                                </span>
                                            </span>
                                        </th>
                                        <th @click="sortBy('email')" scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase ">
                                            Email
                                            <span v-if="props.sort === 'email'" class="float-end">
                                                <span v-if="props.sortDir === 'asc'">
                                                    <ChevronUpIcon class="hover:text-blue-500 flex-shrink-0 w-6 h-6" aria-hidden="true"/>
                                                </span>
                                                <span v-if="props.sortDir === 'desc'">
                                                    <ChevronDownIcon class="hover:text-blue-500 flex-shrink-0 w-6 h-6" aria-hidden="true"/>
                                                </span>
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Regra</th>
                                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="user in users.data" :key="user.id">
                                        <td class="py-3 ps-4">
                                            <div class="flex items-center h-5">
                                                <input id="hs-table-pagination-checkbox-1" type="checkbox" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                <label for="hs-table-pagination-checkbox-1" class="sr-only">Checkbox</label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ user.id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-800 dark:text-gray-200">{{ user.name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-800 dark:text-gray-200">{{ user.email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-800 dark:text-gray-200">
                                            <span class="m-0.5 text-sm w-fit rounded-full bg-green-300 dark:bg-green-800 px-2 py-1 font-medium text-black dark:text-gray-300 ring-2 ring-inset ring-green-600 dark:ring-green-700">permissão</span>
                                            <span class="m-0.5 text-sm w-fit rounded-full bg-green-300 dark:bg-green-800 px-2 py-1 font-medium text-black dark:text-gray-300 ring-2 ring-inset ring-green-600 dark:ring-green-700">permissão</span>
                                            <span class="m-0.5 text-sm w-fit rounded-full bg-green-300 dark:bg-green-800 px-2 py-1 font-medium text-black dark:text-gray-300 ring-2 ring-inset ring-green-600 dark:ring-green-700">permissão</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                                <button class="hover:text-red-500" @click="destroy(user.id)">
                                                    <XCircleIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true"/>
                                                </button>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="py-1 px-4">
                                <nav class="flex justify-center space-x-1">
                                    <Pagination :link="users.links"/>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
