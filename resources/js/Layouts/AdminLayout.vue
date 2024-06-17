<template>
    <div class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <div :class="sidebarClasses" @click.self="toggleSidebar">
            <div class="bg-gray-800 text-white h-full p-4 shadow-lg">
                <h2 class="text-2xl font-semibold mb-6">Admin Panel</h2>
                <nav class="space-y-2">
                    <ResponsiveNavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                        Dashboard
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('students.index')" :active="route().current('students.*')">
                        Students
                    </ResponsiveNavLink>
                </nav>
            </div>
        </div>

        <!-- Overlay for mobile -->
        <div v-show="isSidebarOpen" class="fixed inset-0 bg-black bg-opacity-50 lg:hidden z-20" @click="toggleSidebar">
            <div class="bg-gray-800 text-white h-full p-4 shadow-lg w-64">
                <h2 class="text-2xl font-semibold mb-6">Admin Panel</h2>
                <nav class="space-y-2">
                    <ResponsiveNavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                        Dashboard
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('students.index')" :active="route().current('students.*')">
                        Students
                    </ResponsiveNavLink>
                </nav>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex items-center justify-between p-4 bg-gray-800 text-white shadow-md">
                <button @click="toggleSidebar" class="lg:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <h1 class="text-2xl">Admin Panel</h1>
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-200 bg-gray-800 hover:text-gray-400 focus:outline-none transition ease-in-out duration-150"
                            >
                                {{ $page.props.auth.user.first_name+' '+$page.props.auth.user.last_name}}
                                <svg
                                    class="ms-2 -me-0.5 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <DropdownLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </DropdownLink>
                    </template>
                </Dropdown>
            </header>
            <main class="flex-1 p-6 overflow-y-auto">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script setup>
import {ref, watch, computed, onMounted} from 'vue';
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import NavLink from "@/Components/NavLink.vue";
import {Link} from "@inertiajs/vue3";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import {useToast} from "vue-toast-notification";
import {usePage} from "@inertiajs/vue3";


const isSidebarOpen = ref(false);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};
const toastMessage = computed(() => usePage().props.auth.toast)

const sidebarClasses = {
    'fixed lg:relative z-30 inset-y-0 left-0 w-64 transition-transform transform': true,
    '-translate-x-full': !isSidebarOpen.value,
    'lg:translate-x-0': true,
};

watch(toastMessage, function () {
    if(toastMessage.value){
        const toast = useToast();
        if(toastMessage.value.status=='success'){
            toast.success(toastMessage.value.message)
        }
        if(toastMessage.value.status=='error'){
            toast.error(toastMessage.value.message)
        }
        if(toastMessage.value.status=='info'){
            toast.info(toastMessage.value.message)
        }
        if(toastMessage.value.status=='warning'){
            toast.warning(toastMessage.value.message)
        }
    }
    toastMessage.value = null
})

onMounted(()=> {
    console.log(usePage().props);
    console.log(toastMessage.value)
    if (toastMessage.value) {
        const toast = useToast();
        toast.clear();
        if (toastMessage.value.status == 'success') {
            toast.success(toastMessage.value.message)
        }
        if (toastMessage.value.status == 'error') {
            toast.error(toastMessage.value.message)
        }
        if (toastMessage.value.status == 'info') {
            toast.info(toastMessage.value.message)
        }
        if (toastMessage.value.status == 'warning') {
            toast.warning(toastMessage.value.message)
        }
    }
})

</script>

<style scoped>
/* Add any additional custom styles here */
</style>
