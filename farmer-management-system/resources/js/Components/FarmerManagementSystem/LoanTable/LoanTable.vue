<template>
    <div class="shadow-md bg-white py-4 px-4 mx-auto">
      <p class="text-lg font-bold my-2 text-center">Loans</p>
  
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3">Farmer</th>
              <th scope="col" class="px-6 py-3">Amount</th>
              <th scope="col" class="px-6 py-3">Interest</th>
              <th scope="col" class="px-6 py-3">Duration</th>
              <th scope="col" class="px-6 py-3">Status</th>
              
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="loan in loans"
              :key="loan.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ loan.farmer.first_name }} {{ loan.farmer.last_name }}
              </th>
              <td class="px-6 py-4">K {{ loan.loan_amount }}</td>
              <td class="px-6 py-4">{{ loan.interest_rate }} %</td>
              <td class="px-6 py-4">{{ loan.repayment_duration }} months</td>
              <td class="px-6 py-4">{{ loan.status }}</td>
               
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    loans: Array,
  });
  
 
  </script>
  