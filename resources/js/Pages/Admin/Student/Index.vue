<template>
    <admin-layout>
    <div class="grid">
        <h1 class="text-3xl font-bold text-gray-800 mb-5">Students</h1>
        <div class="flex mb-2 justify-between">
            <Link :href="route('students.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-fit">
                Add
            </Link>
            <input type="text" v-model="searchVal" @keydown.enter="search" @input="checkIsEmpty" placeholder="Press Enter For Search..." class="w-3/6">
        </div>


        <show-students-table :students="students.data" @edit-item="editStudent" @delete-item="deleteStudent"></show-students-table>
        <EditModal :is-show="isShowEdit" :student="selectedStudent" :countries="countries" @close-modal="closeModal('edit')" @edit-student-info="editData"></EditModal>
        <DeleteModal :is-show="isShowDelete" :student="selectedStudent" @close-modal="closeModal('delete')" @delete-student-info="deleteData"></DeleteModal>
        <pagination class="mt-6" :paginationLinks="students.links" />
    </div>
    </admin-layout>
</template>

<script setup>
import {onMounted, onUpdated, ref} from 'vue';
import {Link, router} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ShowStudentsTable from "@/Pages/Admin/Student/Components/ShowStudentsTable.vue";
import EditModal from "@/Pages/Admin/Student/Components/EditModal.vue";
import DeleteModal from "@/Pages/Admin/Student/Components/DeleteModal.vue";
import Pagination from "@/Components/Pagination.vue";


const props = defineProps({
    students: {
        type: Object,
        default: null,
    },
    countries: {
        type: Object,
        default: null,
    },
    query: {
        type: String,
        default: '',
    },
});

const isShowEdit = ref(false);
const isShowDelete = ref(false);
const selectedStudent = ref(null);
const searchVal = ref('');
const editStudent = (student) => {
    selectedStudent.value = student
    isShowEdit.value = true
};

const deleteStudent = (student) => {
    selectedStudent.value = student
    isShowDelete.value = true
};

const editData = (student, id) => {
    student.put(route('students.update', id), {
        onSuccess: () => {
            closeModal('edit')
        },
        onError: () => {

        },
    })
};

const deleteData = (id) => {
    router.delete(route('students.destroy', id), {
        onSuccess: () => {
            closeModal('delete')
        },
        onError: () => {

        },
    })
};


const closeModal = (action) => {
    if(action=='edit'){
        isShowEdit.value = false
    }
    if(action=='delete'){
        isShowDelete.value = false
    }
};

const search = () => {
    if (!searchVal.value.trim()) {
        return;
    }

    router.get(route('students.index'), {'query':searchVal.value}, {
        preserveState: true,
        replace: true,
        onSuccess: () => {

        },
        onError: () => {

        },
    })
};

const checkIsEmpty = () => {
    if (!searchVal.value.trim()) {
        router.get(route('students.index'), {}, {
            preserveState: true,
            replace: true,
            onSuccess: () => {

            },
            onError: () => {

            },
        })
    }


};

onUpdated(()=>{
    searchVal.value = props.query
})
onMounted(()=>{
    searchVal.value = props.query
})

</script>

<style scoped>
/* Add any additional custom styles here */
</style>
