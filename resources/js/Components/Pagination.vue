<template>
    <div v-if="paginationLinks">
        <div class="flex justify-end items-center space-x-4">
            <a
                v-if="paginationLinks.prev"
                :href="paginationLinks.prev"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
            >
                Previous
            </a>

            <a
                v-if="paginationLinks.next"
                :href="paginationLinks.next"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
            >
                Next
            </a>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    paginationLinks: {
        type: Object,
        required: true,
    },
});

</script>
