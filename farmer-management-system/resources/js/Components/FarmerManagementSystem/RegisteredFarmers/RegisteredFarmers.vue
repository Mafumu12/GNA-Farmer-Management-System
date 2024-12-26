<template>
    <div class="shadow-md bg-white py-4 px-4 mx-auto">

        <p class="text-lg font-bold my-2 text-center"> Registered Farmers</p>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500  ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            First name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Last name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody>

                    <tr v-for="farmer in farmers" :key="farmer.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ farmer.first_name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ farmer.last_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ farmer.phone_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ farmer.location }}
                        </td>
                        <td class="px-6 py-4 flex items-center gap-2">
                            <a   @click="$emit('edit', farmer)" class="font-medium text-green-600   hover:underline">Edit</a>
                            <a href="#" @click="$emit('delete-farmer', farmer)" class="font-medium text-red-600   hover:underline">Delete</a>
                        </td>
                    </tr>

                </tbody>

            </table>




        </div>
    </div>



</template>

<script setup>

defineProps({
    farmers: Array,
});

const emit = defineEmits(['edit','delete-farmer']);

</script>