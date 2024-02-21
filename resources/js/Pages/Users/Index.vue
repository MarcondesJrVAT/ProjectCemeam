<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {EyeIcon, PencilAltIcon, XCircleIcon} from "@heroicons/vue/outline";
import {nextTick, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Modal from "@/Components/Modal.vue";
import Label from "@/Components/Label.vue";
import InputError from "@/Components/InputError.vue";
import Input from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";
const props = defineProps({
    users: Array
})

const confirmingUserDeletion = ref(false)
const passwordInput = ref(null)

const form = useForm({
    password: '',
})

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true

    nextTick(() => passwordInput.value.focus())
}

const deleteUser = () => {
    form.delete(route('user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    })
}

const closeModal = () => {
    confirmingUserDeletion.value = false

    form.reset()
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
                            <div class="py-3 px-4">
                                <div class="relative max-w-xs">
                                    <label class="sr-only">Pesquisar</label>
                                    <input type="text" name="hs-table-with-pagination-search" id="hs-table-with-pagination-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Pesquisar...">
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
                                                <label for="hs-table-pagination-checkbox-all" class="sr-only">Selecione</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">ID</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nome</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">E-mail</th>
                                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Opções</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="user in users" :key="user.id">
                                        <td class="py-3 ps-4">
                                            <div class="flex items-center h-5">
                                                <input id="hs-table-pagination-checkbox-1" type="checkbox" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                <label for="hs-table-pagination-checkbox-1" class="sr-only">Checkbox</label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ user.id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ user.name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ user.email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium flex justify-end">
                                            <a href="#" ><EyeIcon class="flex-shrink-0 w-6 h-6 m-0.5 hover:text-blue-400" aria-hidden="true"/></a>
                                            <a href="#" ><PencilAltIcon class="flex-shrink-0 w-6 h-6 m-0.5 hover:text-green-400" aria-hidden="true"/></a>
                                            <a @click="confirmUserDeletion" ><XCircleIcon class="flex-shrink-0 w-6 h-6 m-0.5 hover:text-red-500" aria-hidden="true"/>
                                                <Modal :show="confirmingUserDeletion" @close="closeModal">
                                                    <div class="p-6">
                                                        <h2
                                                            class="text-lg font-medium text-gray-900 dark:text-gray-100"
                                                        >
                                                            Tem certeza de que deseja excluir este usuário?
                                                        </h2>

                                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                            Depois que o usuário for excluído, todos os seus recursos e dados
                                                            serão excluídos permanentemente. Por favor digite sua senha para
                                                            confirme que deseja excluir permanentemente este usuário.
                                                        </p>

                                                        <div class="mt-6">
                                                            <Label for="password" value="Password" class="sr-only" />

                                                            <Input
                                                                id="password"
                                                                ref="passwordInput"
                                                                v-model="form.password"
                                                                type="password"
                                                                class="mt-1 block w-3/4"
                                                                placeholder="Senha"
                                                                @keyup.enter="deleteUser"
                                                            />

                                                            <InputError :message="form.errors.password" class="mt-2" />
                                                        </div>

                                                        <div class="mt-6 flex justify-end">
                                                            <Button variant="secondary" @click="closeModal">
                                                                Cancelar
                                                            </Button>

                                                            <Button
                                                                variant="danger"
                                                                class="ml-3"
                                                                :class="{ 'opacity-25': form.processing }"
                                                                :disabled="form.processing"
                                                                @click="deleteUser"
                                                            >
                                                                Remover Usuário
                                                            </Button>
                                                        </div>
                                                    </div>
                                                </Modal>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="py-1 px-4">
                                <nav class="flex items-center space-x-1">
                                    Paginação
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
