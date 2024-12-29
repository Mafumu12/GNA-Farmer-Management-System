<script setup >
 
import SideBar from '@/Components/FarmerManagementSystem/SideBar/SideBar.vue';
import MobileSidebar from '@/Components/FarmerManagementSystem/SideBar/MobileSidebar.vue';
 
 
 
</script>

<template>
    <!-- ===== Page Wrapper Start ===== -->
    <div class="bg-gray-100   min-h-screen ">
      <!-- ===== Sidebar Start ===== -->
 
  
      <SideBar />
      <MobileSidebar />
      <!-- ===== Sidebar End ===== -->
      
      <!-- ===== Content Area Start ===== -->
       
        <main class=" lg:pl-[280px]  pt-4  md:pl-[264px] px-4">
           
            <slot></slot>
           
        </main>
        <!-- ===== Main Content End ===== -->
       
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </template>