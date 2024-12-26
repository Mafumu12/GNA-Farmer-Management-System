<template>
    <div class="shadow-md bg-white py-4 px-4 mx-auto">
        <p class="text-lg font-bold my-2 text-center">Registered Farmers</p>
        <div class="flex items-center justify-center gap-8">
            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
            <span>{{ total }}</span>
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