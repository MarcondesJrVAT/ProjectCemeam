<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
</script>

<template>
    <AuthenticatedLayout title="Sites">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Sites
                </h2>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            Página de configuração de SITES
        </div>
    </AuthenticatedLayout>
</template>
