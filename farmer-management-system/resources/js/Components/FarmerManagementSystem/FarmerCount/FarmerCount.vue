<template>
    <div class="shadow-md bg-white py-4 px-4 mx-auto  lg:w-[550px] lg:h-[150px]  ">
        <p class="text-lg font-bold my-2 lg:my-4 text-center">Registered Farmers</p>
        <div class="flex items-center justify-center gap-8">
            <div class="h-2.5 w-2.5 lg:w-[25px] lg:h-[25px] rounded-full bg-green-500 me-2"></div>
            <span class="text-lg font-bold my-2 lg:my-4 text-center">{{ total }}</span>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, toRefs } from 'vue';

const props = defineProps({
    farmers: Array,
});

const { farmers } = toRefs(props);
const total = ref(0);

const countFarmers = () => {
    total.value = farmers.value ? farmers.value.length : 0;
}

onMounted(() => {
    countFarmers();
});

watch(
    farmers,
    () => {
        countFarmers();
    }
);
</script>