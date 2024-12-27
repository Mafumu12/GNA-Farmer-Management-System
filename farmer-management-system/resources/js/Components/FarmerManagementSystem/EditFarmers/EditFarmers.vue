<template>
    <div v-if="isVisible"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">Edit Farmer</h3>
                    <button @click="emitClose" type="button"
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center">
                        <FaTimesCircle />
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <form @submit.prevent="submitForm" class="space-y-4">
                        <div>
                            <label for="firstName" class="block mb-2 text-sm font-medium text-gray-900">First
                                Name</label>
                            <input v-model="firstName" type="text" id="firstName"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="First Name" required />
                        </div>
                        <div>
                            <label for="lastName" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
                            <input v-model="lastName" type="text" id="lastName"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Last Name" required />
                        </div>
                        <div>
                            <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900">Phone
                                Number</label>
                            <input v-model="phoneNumber" type="text" id="phoneNumber"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Phone Number" required />
                        </div>
                        <div>
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Location</label>
                            <input v-model="location" type="text" id="location"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Location" required />
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import { FaTimesCircle } from 'vue3-icons/fa';

const props = defineProps({
    isVisible: Boolean,
    farmer: Object, // Accept the selected farmer's data
});

const emit = defineEmits(["close", "farmer-update"]);

const firstName = ref("");
const lastName = ref("");
const phoneNumber = ref("");
const location = ref("");

// Watch for changes in the farmer prop
watch(() => props.farmer, (newFarmer) => {
    if (newFarmer) {
        firstName.value = newFarmer.first_name;
        lastName.value = newFarmer.last_name;
        phoneNumber.value = newFarmer.phone_number;
        location.value = newFarmer.location;
    }
}, { immediate: true });

const submitForm = async () => {
    try {
        const response = await axios.put(`/farmers/${props.farmer.id}`, {
            first_name: firstName.value,
            last_name: lastName.value,
            phone_number: phoneNumber.value,
            location: location.value,
        });
        alert(response.data.message || "Farmer updated successfully");
        emit("farmer-update");
        emit("close");
    } catch (error) {
        alert("Error updating farmer");
    }

};

const emitClose = () => {
    emit("close");
};
</script>