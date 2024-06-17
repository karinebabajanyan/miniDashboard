<template>
    <admin-layout>
        <div>
            <h2>Dashboard</h2>
            <!-- Add dashboard widgets and charts -->
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    components: {AdminLayout},
    // Component logic
    metaInfo() {
        return {
            title: 'Dashboard - Admin Panel'
        };
    }
};
</script>

<style scoped>
/* Add specific styles for the dashboard */
</style>
