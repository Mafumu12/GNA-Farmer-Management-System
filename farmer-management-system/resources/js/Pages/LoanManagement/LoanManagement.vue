<template>
    <PannelLayout>
      <h1>Loan Management</h1>
      <div class="my-4">
        <AddLoan @disburse="showDisburseModal = true" />
      </div>
  
      <div class="my-4">
        <ManageLoans
          :loans="loans"
          @approve="approveLoan"
          @reject="rejectLoan"
          @repaid="markAsRepaid"
        />
      </div>
  
      <DisburseLoan
        v-if="showDisburseModal"
        :isVisible="showDisburseModal"
        @close="showDisburseModal = false"
        :farmers="farmers"
        @loan-register="fetchData"  
      />
    </PannelLayout>
  </template>
  
  <script setup>
  import ManageLoans from '@/Components/FarmerManagementSystem/ManageLoans/ManageLoans.vue';
  import DisburseLoan from '@/Components/FarmerManagementSystem/DisburseLoan/DisburseLoan.vue';
  import AddLoan from '@/Components/FarmerManagementSystem/AddLoan/AddLoan.vue';
  import PannelLayout from '@/Layouts/PannelLayout.vue';
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const farmers = ref([]);
  const loans = ref([]);
  const errorMessage = ref('');
  const showDisburseModal = ref(false);
  
  const fetchData = async () => {
    try {
      const response = await axios.get('/LoanManagement');
      farmers.value = response.data.farmers;
      loans.value = response.data.loans;
    } catch (error) {
      errorMessage.value = 'Failed to load data. Please try again later.';
    }
  };
  
  const updateLoanStatus = (loanId, status) => {
    const loan = loans.value.find((loan) => loan.id === loanId);
    if (loan) loan.status = status;
  };
  
  const approveLoan = async (loanId) => {
    try {
      await axios.put(`/${loanId}/approve`);
      updateLoanStatus(loanId, 'approved');
    } catch (error) {
      alert('Error approving loan.');
    }
  };
  
  const rejectLoan = async (loanId) => {
    try {
      await axios.put(`/${loanId}/reject`);
      updateLoanStatus(loanId, 'rejected');
    } catch (error) {
      alert('Error rejecting loan.');
    }
  };
  
  const markAsRepaid = async (loanId) => {
    try {
      await axios.put(`/${loanId}/repaid`);
      updateLoanStatus(loanId, 'repaid');
    } catch (error) {
      alert('Error marking loan as repaid.');
    }
  };
  
  onMounted(() => {
    fetchData();
  });
  </script>
  