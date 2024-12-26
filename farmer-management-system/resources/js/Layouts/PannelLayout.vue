<script setup >
 
import SideBar from '@/Components/FarmerManagementSystem/SideBar/SideBar.vue';

</script>

<template>
    <!-- ===== Page Wrapper Start ===== -->
    <div class="bg-gray-100 flex justify-center h-screen ">
      <!-- ===== Sidebar Start ===== -->
      <SideBar />
      <!-- ===== Sidebar End ===== -->
      
      <!-- ===== Content Area Start ===== -->
       
        <main>
          <div class="mx-auto w-screen md:w-full   p-4  ">
            <slot></slot>
          </div>
        </main>
        <!-- ===== Main Content End ===== -->
       
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </template>