<template>
    <PannelLayout>
      <h1 class="text-2xl font-bold mb-4">Manage Modules</h1>
  
      <!-- List of modules -->
      <div v-for="module in modules" :key="module.id" class="mb-4 p-4 border rounded shadow-sm bg-white">
        <div class="flex justify-between items-center">
          <!-- Module Name -->
          <span class="text-lg font-medium">{{ module.name }}</span>
  
          <div>
            <!-- Toggle Button -->
            <button
              @click="toggleModule(module)"
              :class="{
                'bg-green-500 hover:bg-green-600': module.is_active,
                'bg-gray-500 hover:bg-gray-600': !module.is_active,
              }"
              class="px-4 py-2 text-white rounded mr-2"
            >
              {{ module.is_active ? 'Deactivate' : 'Activate' }}
            </button>
  
            <!-- Delete Button -->
            <button
              @click="deleteModule(module)"
              class="bg-red-500 hover:bg-red-600 px-4 py-2 text-white rounded"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
  
      <!-- Error Message -->
      <div v-if="errorMessage" class="mt-4 text-red-500">
        {{ errorMessage }}
      </div>
    </PannelLayout>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import PannelLayout from '@/Layouts/PannelLayout.vue';
  
  const modules = ref([]);
  const errorMessage = ref('');
  
  const fetchModules = async () => {
    try {
      const response = await axios.get('/module-management');
      modules.value = response.data;
    } catch (error) {
      errorMessage.value = 'Failed to load modules. Please try again later.';
    }
  };
  
  const toggleModule = async (module) => {
    try {
      const response = await axios.post(`/module/${module.name}/toggle`);
      module.is_active = !module.is_active; // Update state in the UI
      alert(response.data.message); // Display success message
    } catch (error) {
      alert('Failed to toggle module status. Please try again.');
    }
  };
  
  const deleteModule = async (module) => {
    if (confirm(`Are you sure you want to delete the module "${module.name}"?`)) {
      try {
        const response = await axios.delete(`/module/${module.name}`);
        modules.value = modules.value.filter(m => m.id !== module.id); // Remove module from the UI
        alert(response.data.message);
      } catch (error) {
        alert('Failed to delete module. Please try again.');
      }
    }
  };
  
  onMounted(() => {
    fetchModules();
  });
  </script>
  