<template>
    <div class="shadow-md bg-white py-4 px-4 mx-auto lg:w-[550px] lg:h-[150px]">
        <p class="text-lg font-bold my-2 lg:my-4 text-center">Requested Loans</p>
        <div class="flex items-center justify-center gap-8">
            <div class="h-2.5 w-2.5 lg:w-[25px] lg:h-[25px] rounded-full bg-yellow-500 me-2"></div>
            <span class="text-lg font-bold my-2 lg:my-4 text-center">{{ total }}</span>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, toRefs } from 'vue';

const props = defineProps({
    loans: Array,
});
console.log('loans',props.loans);

const { loans } = toRefs(props);
const total = ref(0);

const countLoans = () => {
    total.value = loans.value ? loans.value.length : 0;
}

onMounted(() => {
    countLoans();
});

watch(
    loans,
    () => {
        countLoans();
    }
);
</script>