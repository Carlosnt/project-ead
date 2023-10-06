<template>
    <Head title="Gráficos" />

    <AuthenticatedLayout>
        <template #header>
            Gráficos
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <Bar :data="chartData" :options="chartOptions"></Bar>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3';
import { ref} from 'vue';
import { Bar} from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, 
    ArcElement } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement);

const props = defineProps({
    data: {type:Object}
});

const departments = ref([]);
const employees = ref([]);
const chartData = ref([]);
const chartOptions = ref([]);
const colors = ref([]);

const random = () => {
    return Math.floor(Math.random() * 256);
}

props.data.map( (row) => (
    departments.value.push(row.name),
    employees.value.push(row.count),
    colors.value.push("rgb("+random()+","+random()+","+random()+")")
))

chartOptions.value = { responsive:true }
chartData.value = {
    labels:departments.value,
    datasets:[
        {label: 'Funcionários', data:employees.value, backgroundColor:colors}
    ]
}
</script>
