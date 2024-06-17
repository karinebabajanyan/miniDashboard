<script setup>
import Modal from "@/Components/Modal.vue";
import {onMounted, onUpdated, ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const emit = defineEmits(['editStudentInfo', 'closeModal']);

const props = defineProps({
    isShow: {
        type: Boolean,
        default: false,
    },
    countries: {
        type: Object,
        default: null,
    },
    student: {
        type: Object,
        default: null,
    },
});

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    birthday: '',
    country: '',
    city: '',
    password: '',
});

onMounted(()=>{
    console.log(props.student)
    if (props.student){
        form.first_name = props.student.first_name
        form.last_name = props.student.last_name
        form.email = props.student.email
        form.birthday = props.student.birthday
        form.country = props.student.country
        form.city = props.student.city
    }
})

onUpdated(()=>{
    console.log(props.student)
    if (props.student){
        form.first_name = props.student.first_name
        form.last_name = props.student.last_name
        form.email = props.student.email
        form.birthday = props.student.birthday
        form.country = props.student.country
        form.city = props.student.city
    }
})
const closeModal = () => {
    emit('closeModal')
}

const editStudent = (student, id) => {
    emit('editStudentInfo', student, id)
}

</script>

<template>
    <Modal :show="isShow" @close="closeModal" :showBottom="false">
        <template #title>
            Edit Student
        </template>
        <form @submit.prevent="editStudent(form, student.id)" class="mb-4 grid">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-2">
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
                    <input v-model="form.password" type="password" class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-gray-300">
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200 justify-self-end">
                Edit
            </button>
        </form>
    </Modal>
</template>

<style scoped>

</style>
