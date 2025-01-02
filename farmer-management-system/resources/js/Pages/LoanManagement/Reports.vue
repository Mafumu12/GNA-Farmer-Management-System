<template>
    <PannelLayout>
        <div class=" mt-10 lg:flex lg:items-center  lg:justify-center lg:gap-4">

            <div class="my-4">
                <LoanCount :loans="loans" />

            </div>
            <div class="my-4">
                <AmountDisbursed :loans="loans" />

            </div>




        </div>

        <div class="lg:flex lg:items-center  lg:justify-center lg:gap-4">

            <div class="my-4">

                <RejectedLoans :loans="loans" />
            </div>



            <div class="my-4">

                <PendingLoans :loans="loans" />
            </div>


        </div>



        <div class="lg:flex lg:items-center  lg:justify-center lg:gap-4">
            <div class="my-4">

                <RepaidLoans :loans="loans" />
            </div>
            <div class="my-4">

                <ApprovedLoans :loans="loans" />
            </div>
        </div>






    </PannelLayout>



</template>


<script setup>
import RepaidLoans from '@/Components/FarmerManagementSystem/RepaidLoans/RepaidLoans.vue';
import ApprovedLoans from '@/Components/FarmerManagementSystem/ApprovedLoans/ApprovedLoans.vue';
import PendingLoans from '@/Components/FarmerManagementSystem/PendingLoans/PendingLoans.vue';
import RejectedLoans from '@/Components/FarmerManagementSystem/RejectedLoans/RejectedLoans.vue';
import LoanCount from '@/Components/FarmerManagementSystem/LoanCount/LoanCount.vue';
import AmountDisbursed from '@/Components/FarmerManagementSystem/TotalLoansDisbursed/AmountDisbursed.vue';
import PannelLayout from '@/Layouts/PannelLayout.vue';
const props = defineProps({
    loans: Array
});

console.log('loans', props.loans);
</script>