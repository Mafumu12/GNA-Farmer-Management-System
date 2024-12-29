<script setup>
 import { ref } from 'vue';

const isMobileNavOpen = ref(false);
const toggleMobileNav = () => {
    isMobileNavOpen.value = !isMobileNavOpen.value;
};

 
</script>

<template>

 

        <nav class="bg-white   fixed w-full z-20 top-0 start-0 border-b border-gray-200  ">
        <button @click="toggleMobileNav" type="button"
            class="inline-flex items-center justify-center p-2 w-10 h-10 text-sm text-[#EBE9EB] rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-hamburger" :aria-expanded="isMobileNavOpen.toString()">

            <svg v-if="!isMobileNavOpen" class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>


        </button>

    </nav>

         


</template>
