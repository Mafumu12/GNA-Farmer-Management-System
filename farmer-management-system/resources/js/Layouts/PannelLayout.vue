<script setup >
 
import SideBar from '@/Components/FarmerManagementSystem/SideBar/SideBar.vue';
</script>

<template>
    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen bg-[#F4F4F4] overflow-hidden">
      <!-- ===== Sidebar Start ===== -->
      <SideBar />
      <!-- ===== Sidebar End ===== -->
      
      <!-- ===== Content Area Start ===== -->
       
        <main>
          <div class="mx-auto max-w-screen-2xl  p-4 md:p-6 2xl:p-10">
            <slot></slot>
          </div>
        </main>
        <!-- ===== Main Content End ===== -->
       
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </template>