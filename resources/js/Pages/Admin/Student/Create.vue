<template>
    <admin-layout>
        <div class="grid">
            <h1 class="text-3xl font-bold text-gray-800 mb-5">Create Student</h1>
            <form @submit.prevent="createStudent()" class="mb-4 grid">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                    <div>
                        <label class="block text-gray-700">First Name</label>
                        <input v-model="form.first_name" type="text" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-gray-300" required>
                        <input-error v-if="Object.keys(form.errors).length && form.errors.first_name" :message="form.errors.first_name"></input-error>
                    </div>
                    <div>
                        <label class="block text-gray-700">Last Name</label>
                        <input v-model="form.last_name" type="text" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-gray-300" required>
                        <input-error v-if="Object.keys(form.errors).length && form.errors.last_name" :message="form.errors.last_name"></input-error>
                    </div>
                    <div>
                        <label class="block text-gray-700">Email</label>
                        <input v-model="form.email" type="email" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-gray-300" required>
                        <input-error v-if="Object.keys(form.errors).length && form.errors.email" :message="form.errors.email"></input-error>
                    </div>
                    <div>
                        <label class="block text-gray-700">Birthday</label>
                        <input v-model="form.birthday" type="date" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-gray-300" required>
                        <input-error v-if="Object.keys(form.errors).length && form.errors.birthday" :message="form.errors.birthday"></input-error>
                    </div>
                    <div>
                        <label class="block text-gray-700">Country</label>
                        <select v-model="form.country" v-if="countries" name="country" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-gray-300" required>
                            <option :value="null" selected>Choose...</option>
                            <option v-for="country in countries" :key="country.id" :value="country.id">{{country.name}}</option>
                        </select>
                        <input-error v-if="Object.keys(form.errors).length && form.errors.country" :message="form.errors.country"></input-error>
                    </div>
                    <div>
                        <label class="block text-gray-700">City</label>
                        <input v-model="form.city" type="text" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-gray-300" required>
                        <input-error v-if="Object.keys(form.errors).length && form.errors.city" :message="form.errors.city"></input-error>
                    </div>
                    <div>
                        <label class="block text-gray-700">Password</label>
                        <input v-model="form.password" type="password" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-gray-300" required>
                        <input-error v-if="Object.keys(form.errors).length && form.errors.password" :message="form.errors.password"></input-error>
                    </div>
                </div>

                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200 justify-self-end">
                    Add Student
                </button>
            </form>
        </div>
    </admin-layout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    countries: {
        type: Object,
        default: null,
    },
});

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    birthday: '',
    country: null,
    city: '',
    password: '',
});


const createStudent = () => {
    console.log(form)
    form.post(route('students.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {

        }
    })
};
</script>

<style scoped>
/* Add any additional custom styles here */
</style>
