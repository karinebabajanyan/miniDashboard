<script setup>

const emit = defineEmits(['editItem', 'deleteItem']);

const props = defineProps({
    students: {
        type: Object,
        default: null,
    },
});

const editItem = (student) => {
    emit('editItem', student)
}

const deleteItem = (student) => {
    emit('deleteItem', student)
}
</script>

<template>
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden" v-if="students">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-6 text-left">First Name</th>
                <th class="py-3 px-6 text-left">Last Name</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Birthday</th>
                <th class="py-3 px-6 text-center"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200" v-for="student in students">
            <tr >
                <td class="py-4 px-6">{{student.first_name}}</td>
                <td class="py-4 px-6">{{student.last_name}}</td>
                <td class="py-4 px-6">{{student.email}}</td>
                <td class="py-4 px-6">{{student.birthday}}</td>
                <td class="py-4 px-6 text-center flex gap-2 justify-center">
                    <button @click="editItem(student)" class="bg-yellow-500 text-white py-1 px-3 rounded-lg hover:bg-yellow-400">Edit</button>
                    <button @click="deleteItem(student)" class="bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-400">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
