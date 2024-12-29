<template>

    <div class="shadow-md bg-white py-4 px-4 mx-auto lg:w-[265px]  ">




         


            <button type="button" @click="$emit('Upload')"
                class=" flex items-center justify-center gap-2 whitespace-nowrap   bg-[#D3C11D] w-full     text-[#F4F4F4]     font-medium  text-sm px-5 py-2.5 text-center   ">
                <FaFileUpload /> <span>Upload Module</span>
            </button>


        
    </div>

</template>

<script setup>
import { FaFileUpload  } from 'vue3-icons/fa';
const emit = defineEmits([  'Upload']);

</script>