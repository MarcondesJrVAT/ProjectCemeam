<template>
    <div v-if="link.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(item, key) in link">
                <div v-if="item.url === null" :key="key" class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded" v-html="item.label" />
                <Link v-else :key="`link-${key}`" class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 hover:bg-blue-400 dark:hover:bg-blue-400 border focus:border-indigo-500 rounded" :class="{ 'bg-blue-400': item.active }" :href="item.url" v-html="item.label" />
            </template>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import {computed, defineProps} from "vue";

const props = defineProps({
    link: {
        type: Array,
        default: () => [],
        required: true
    },
})

const itemCount = computed(() => props.link.length || 0)

</script>
