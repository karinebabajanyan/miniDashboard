<script setup>
import Modal from "@/Components/Modal.vue";

const emit = defineEmits(['deleteStudentInfo', 'closeModal']);

const props = defineProps({
    isShow: {
        type: Boolean,
        default: false,
    },
    student: {
        type: Object,
        default: null,
    },
});
const closeModal = () => {
    emit('closeModal')
}

const deleteStudent = (id) => {
    emit('deleteStudentInfo', id)
}

</script>

<template>
    <Modal :show="isShow" @close="closeModal" :showBottom="false">
        <template #title>
            Delete Student
        </template>
        <form @submit.prevent="deleteStudent(student.id)" class="mb-4 grid">
            <p>Are You sure?</p>
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200 justify-self-end">
                Delete
            </button>
        </form>
    </Modal>
</template>

<style scoped>

</style>
