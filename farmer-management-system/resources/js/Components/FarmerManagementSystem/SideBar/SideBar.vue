<script setup>
import { FaChartPie, FaChevronDown, FaCubes, FaPiggyBank, FaSeedling } from 'vue3-icons/fa';
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';


const isDashboardDropdownOpen = ref(false);
const isModulesDropdownOpen = ref(false);
const isLoanDropdownOpen = ref(false);
const isLoanModuleActive = ref(false);


const fetchLoanModuleStatus = async () => {
    try {
       
        const response = await axios.get('/module-management/active');
         
        const loanModule = response.data.find(module => module.name === "LoanManagement");
        isLoanModuleActive.value = loanModule ? loanModule.is_active : false;
         
    } catch (error) {
        console.error('API Error:', error.message, error.response?.data);
        isLoanModuleActive.value = false;
    }
};



const toggleDropdown = (dropdown) => {
    if (dropdown === 'dashboard') {
        isDashboardDropdownOpen.value = !isDashboardDropdownOpen.value;
    } else if (dropdown === 'modules') {
        isModulesDropdownOpen.value = !isModulesDropdownOpen.value;
    }
    else if (dropdown === 'loanmanagement') {
        isLoanDropdownOpen.value = !isLoanDropdownOpen.value;
    }
};

onMounted(() => {
     
    fetchLoanModuleStatus();
 
});

</script>

<template>




    <div
        class="md:bg-[#17594A] md:h-screen  hidden  md:w-64 md:block md:fixed md:top-0 md:bottom-0 md:z-10 md:pt-4  ">
        <div class="flex items-center justify-between gap-1 px-6  lg:py-2">
            <Link href="/">
            <div class="flex items-center gap-2">
                <span class="text-[#D1CF4F] text-[36px]">
                    <FaSeedling />
                </span>
                <span class="text-[#EBE9EB] text-[30px] font-medium">AgroAdmin</span>
            </div>
            </Link>

        </div>

        <div class="no-scrollbar flex flex-col overflow-y-auto">
            <nav class="mt-5 py-4 px-4 lg:mt-9 lg:px-6">

                <h3 class="mb-4 ml-2  text-sm font-normal text-[#F4F4F4]">MENU</h3>
                <ul class="mb-6 flex flex-col gap-1.5">


                    <li>
                        <button @click="toggleDropdown('dashboard')" type="button"
                            class="flex items-center w-full p-2 text-base bg-[#467A6E] text-gray-900 transition duration-75 rounded-lg">
                            <span class="text-[#F4F4F4] text-[22px]  ">
                                <FaChartPie />
                            </span>
                            <span
                                class="flex-1 ms-3 text-left rtl:text-right text-[#EBE9EB] text-[16px]    whitespace-nowrap">Dashboard</span>
                            <span class="text-[#F4F4F4] ml-4 text-[14px] ">
                                <FaChevronDown />
                            </span>
                        </button>
                        <ul v-if="isDashboardDropdownOpen" class="py-2 space-y-2">
                            <li>
                                <Link href="/"
                                    class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:text-[#D3C11D] font-thin">
                                Overview</Link>
                            </li>
                        </ul>
                    </li>

                    <li class="my-2">
                        <button @click="toggleDropdown('modules')" type="button"
                            class="flex items-center  justify-between w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg hover:bg-[#467A6E]">
                            <span class="text-[#F4F4F4] text-[22px]  ">
                                <FaCubes />
                            </span>
                            <span
                                class="flex-1 ms-3 text-left rtl:text-right text-[#EBE9EB] text-[16px]   whitespace-nowrap">Modules</span>
                            <span class="text-[#F4F4F4] ml-4  text-[14px]  ">
                                <FaChevronDown />
                            </span>
                        </button>
                        <ul v-if="isModulesDropdownOpen" class="py-2 space-y-2">

                            <li>
                                <Link href="/module-management"
                                    class="flex items-center w-full p-2 text-white rounded-lg pl-11   hover:text-[#D3C11D] font-thin">
                                Module Mangement</Link>
                            </li>

                        </ul>
                    </li>
                    <li v-if="isLoanModuleActive" class="my-2">
                        <button @click="toggleDropdown('loanmanagement')" type="button"
                            class="flex items-center justify-between  w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg hover:bg-[#467A6E]">
                            <span class="text-[#F4F4F4] text-[22px] ">
                                <FaPiggyBank />
                            </span>
                            <span
                                class="flex-1 ms-3 text-left rtl:text-right text-[#EBE9EB] text-[16px] whitespace-nowrap">
                                Manage Loans
                            </span>
                            <span class="text-[#F4F4F4] ml-4 text-[14px]  ">
                                <FaChevronDown />
                            </span>
                        </button>
                        <ul v-if="isLoanDropdownOpen" class="py-2 space-y-2">
                            <li>
                                <Link href="/LoanManagement"
                                    class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:text-[#D3C11D] font-thin">
                                Loans
                                </Link>
                            </li>
                            <li>
                                <Link href="/loan-reports"
                                    class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:text-[#D3C11D] font-thin">
                                Reports
                                </Link>
                            </li>

                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>




</template>
