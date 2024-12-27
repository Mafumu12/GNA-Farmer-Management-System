<template>
    <div
      v-if="isVisible"
      class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50"
    >
      <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold text-gray-900">Create Module</h3>
            <button
            @click="emitClose" 
              type="button"
              class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center"
            >
              <FaTimesCircle />
            </button>
          </div>
          <div class="p-4 md:p-5">
            <form @submit.prevent="submitForm" class="space-y-4">
              <div>
                <label for="moduleName" class="block mb-2 text-sm font-medium text-gray-900">Module Name</label>
                <input
                  v-model="moduleName"
                  type="text"
                  id="moduleName"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                  placeholder="Module Name"
                  required
                />
              </div>
              <button
                type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              >
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import { FaTimesCircle } from 'vue3-icons/fa';
  
  const moduleName = ref("");

  
  defineProps({
    isVisible: Boolean,
  });
  
  const emit =defineEmits(["close", "module-created"]);
  
  const submitForm = async () => {
    try {
      const response = await axios.post("/create-Module", {
        name: moduleName.value,
      });
      alert(response.data.message);
      emit("module-created");
      emit("close"); // Close modal on success
    } catch (error) {
      console.error("Error during form submission:", error);
    }
  };
  const emitClose = () => {
  emit("close");
};

  </script>
  