<template>
    <div v-for="module in modules" :key="module.id" class="shadow-md bg-white py-4 px-4 my-4 mx-auto lg:w-[550px] lg:h-[150px]">
      
       <div class="my-2 text-center">

        <span class="text-medium  font-bold">{{ module.name }}</span>
       </div>
        

     
       
      <div class="flex justify-center gap-2  items-center">
        <div class="flex justify-center gap-2">
          <!-- Toggle Button -->
          <button
            @click="$emit('toggle-module', module)"
            :class="{
              'bg-green-400 hover:bg-green-600': module.is_active,
              'bg-gray-500 hover:bg-gray-600': !module.is_active,
            }"
            class="flex justify-between items-center w-full whitespace-nowrap gap-2 px-4 py-2 text-[#F4F4F4] font-medium text-sm px-5 py-2.5 text-center me-2 mb-2"
          >
            
          <div>
            <component :is="module.is_active ? FaPlus : FaMinus" />
          </div>
            <span>{{ module.is_active ? 'Deactivate' : 'Activate' }}</span>
          </button>
    
          <!-- Delete Button -->
          <button
            @click="$emit('delete-module', module)"
            class="flex whitespace-nowrap justify-between w-full gap-2 items-center bg-red-500 hover:bg-red-600 text-[#F4F4F4] font-medium text-sm px-5 py-2.5 text-center me-2 mb-2"
          >
          <FaTrash />

          <span>
            Delete

          </span>
            
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>

import {  FaMinus, FaPlus, FaTrash } from 'vue3-icons/fa';
  defineProps({
    modules: Array,
  });
  defineEmits(['toggle-module', 'delete-module']);
  </script>
  