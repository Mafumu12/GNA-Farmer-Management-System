<template>
    <PannelLayout>
        <h1 class="text-2xl font-bold my-16">Module Management</h1>

        <div class=" ">
            <ModuleNav @install="showInstallModal = true" @upload="showUploadModal = true" />
        </div>

        <h1 class="text-2xl font-bold my-8">Modules</h1>

        <!-- List of modules -->
        <Module :modules="modules" @toggle-module="toggleModule" @delete-module="deleteModule" />
        <InstallModal v-if="showInstallModal" :isVisible="showInstallModal" @close="showInstallModal = false" @module-created="fetchModules"/>
        <UploadModal v-if="showUploadModal" :isVisible="showUploadModal" @close="showUploadModal = false" @module-upload="fetchModules" />

        
    </PannelLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import PannelLayout from '@/Layouts/PannelLayout.vue';
import ModuleNav from '@/Components/FarmerManagementSystem/ModuleNav/ModuleNav.vue';
import Module from '@/Components/FarmerManagementSystem/Modules/Module.vue';
import InstallModal from '@/Components/FarmerManagementSystem/Install/InstallModal.vue';
import UploadModal from '@/Components/FarmerManagementSystem/Upload/UploadModal.vue';

const modules = ref([]);
const errorMessage = ref('');
const showInstallModal = ref(false);
const showUploadModal = ref(false);

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