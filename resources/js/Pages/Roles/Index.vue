<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {
    EyeIcon,
    PencilAltIcon,
    UserGroupIcon,
    XCircleIcon,
    ChevronUpIcon,
    ChevronDownIcon,
    PlusIcon
} from "@heroicons/vue/outline";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";
import Pagination from '../../Shared/Pagination.vue';
import {router} from "@inertiajs/vue3";
import {nextTick, ref} from "vue";
import Modal from "@/Components/Modal.vue";
import Checkbox from "@/Components/Checkbox.vue";

let props = defineProps({
    sort: {
        type: String,
        default: () => 'id'
    },
    sortDir: {
        type: String,
        default: () => 'asc'
    },
    roles: {
        type: Array,
        default: () => []
    },
    abilities: {
        type: Array,
        default: () => []
    },
})

let sort = ref(props.sort);
let sortDir = ref(props.sortDir);
const creatingPermission = ref(false);

const createPermission = () => {
    creatingPermission.value = true
}
const closeModal = () => {
    creatingPermission.value = false
}

function sortBy(field) {
    sort.value = field;
    sortDir.value = props.sort !== field ? 'asc' : (props.sortDir === 'asc' ? 'desc' : 'asc');
    updateTable();
}

function updateTable() {
    let query = '';
    if (sort) query += `sort=${sort.value}&sortDir=${sortDir.value}`;

    router.visit(`/permissoes?${query}`, {preserveState: true, replace: true})
}

function destroy(id) {
    router.delete(`/permissoes/${id}`, {
        onBefore: () => confirm('Tem certeza que deseja remover esta permissão?'),
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
    <AuthenticatedLayout title="Permissões">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Permissões
                </h2>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                            <div class="py-3 px-4 flex justify-between">
                                <div class="relative max-w-xs">
                                    <Button variant="success" @click="createPermission">
                                        <PlusIcon class="flex-shrink-0 w-6 h-6 mr-1" aria-hidden="true"/>
                                        <span>Criar Nova Permissão</span>
                                    </Button>
                                    <Modal :show="creatingPermission" @close="closeModal">
                                        <div class="p-6">
                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                Criar Nova Permissão
                                            </h2>

                                            <p class="mt-1 text-md text-gray-600 dark:text-gray-400">
                                                Preencha o título e nome de exibição da permissão:
                                            </p>

                                            <div class="mt-2">
                                                <Label for="name" value="name" class="sr-only" />
                                                <Input id="name" ref="passwordInput" type="text" class="my-2 block w-full" placeholder="Título"/>
                                                <Label for="description" value="description" class="sr-only" />
                                                <Input id="description" ref="passwordInput" type="text" class="my-2 block w-full" placeholder="Nome de Exibição"/>
                                            </div>

                                            <p class="mt-4 text-md text-gray-600 dark:text-gray-400">
                                                Selecione as habilidades desta permissão:
                                            </p>

                                            <div class="mt-2">
                                                <div>
                                                    <Label for="name" value="Funções" class="text-xl" />
                                                    <div v-for="ability in abilities" :key="ability.id">
                                                        <Label :for="ability.name" :value="ability.name"/>
                                                        <Checkbox value="true" />
                                                    </div>

                                                    <hr>
                                                    <Label for="description" value="Geral" class="text-xl" />
                                                    <Checkbox />
                                                    <hr>
                                                </div>

                                            </div>

                                            <div class="mt-6 flex justify-end">
                                                <Button variant="secondary" @click="closeModal">
                                                    Cancelar
                                                </Button>

                                                <Button
                                                    variant="success"
                                                    class="ml-3"

                                                    @click="createPermission"
                                                >
                                                    Finalizar
                                                </Button>
                                            </div>
                                        </div>
                                    </Modal>
                                </div>
                            </div>
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3 px-4 pe-0">
                                            <div class="flex items-center h-5">
                                                <input id="hs-table-pagination-checkbox-all" type="checkbox"
                                                       class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                <label for="hs-table-pagination-checkbox-all"
                                                       class="sr-only">Selecionar</label>
                                            </div>
                                        </th>
                                        <th @click="sortBy('name')" scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            Permissão
                                            <span v-if="props.sort === 'name'" class="float-end">
                                                <span v-if="props.sortDir === 'asc'">
                                                    <ChevronUpIcon class="hover:text-blue-500 flex-shrink-0 w-6 h-6"
                                                                   aria-hidden="true"/>
                                                </span>
                                                <span v-if="props.sortDir === 'desc'">
                                                    <ChevronDownIcon class="hover:text-blue-500 flex-shrink-0 w-6 h-6"
                                                                     aria-hidden="true"/>
                                                </span>
                                            </span>
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                            Habilidades
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Ações
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="role in roles">
                                        <td class="py-3 ps-4">
                                            <div class="flex items-center h-5">
                                                <input id="hs-table-pagination-checkbox-1" type="checkbox"
                                                       class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                <label for="hs-table-pagination-checkbox-1"
                                                       class="sr-only">Checkbox</label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-start text-xl text-gray-800 dark:text-gray-200">
                                            <span
                                                class="m-0.5 text-xl w-fit rounded-full bg-gray-200 hover:bg-blue-500 dark:bg-gray-500 hover:dark:bg-blue-500 px-2 py-1 font-medium text-black dark:text-gray-300 ring-inset">
                                                {{ role.name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-start text-sm text-gray-800 dark:text-gray-200">
                                            <span
                                                class="m-0.5 text-sm w-fit rounded-full bg-green-300 dark:bg-green-800 px-2 py-1 font-medium text-black dark:text-gray-300 ring-2 ring-inset ring-green-600 dark:ring-green-700">Habilidades</span>
                                            <span
                                                class="m-0.5 text-sm w-fit rounded-full bg-green-300 dark:bg-green-800 px-2 py-1 font-medium text-black dark:text-gray-300 ring-2 ring-inset ring-green-600 dark:ring-green-700">Habilidades</span>
                                            <span
                                                class="m-0.5 text-sm w-fit rounded-full bg-green-300 dark:bg-green-800 px-2 py-1 font-medium text-black dark:text-gray-300 ring-2 ring-inset ring-green-600 dark:ring-green-700">Habilidades</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <button type="button"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-red-400 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-red-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                                    @click="destroy(role.id)">
                                                <XCircleIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true"/>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="py-1 px-4">
                                <nav class="flex justify-center space-x-1">
                                    <Pagination :link="roles.links"/>
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
