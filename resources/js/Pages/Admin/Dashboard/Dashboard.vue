<script setup>
import Title from "../../../Layouts/Components/Title.vue";
import { onMounted } from "vue";
import { Chart } from "chart.js/auto";

const props = defineProps({
    totalUsers: Number,
    totalRegisteredUsersToday: Number,
    totalArticles: Number,
    usersPerMonth: Array,
    articlesPerMonth: Array,
});

onMounted(() => {
    // map props to labels and data
    const labels = props.usersPerMonth.map((item) => item.month);
    const data = props.usersPerMonth.map((item) => item.count);

    new Chart(document.getElementById("usersChart"), {
        type: "bar", // bar chart
        data: {
            labels,
            datasets: [
                {
                    label: "Users Registered",
                    data,
                    backgroundColor: "#ff7676",
                    borderColor: "#e82727",
                    borderWidth: 1,
                    borderRadius: 5,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } },
            },
        },
    });

    // ===== ARTICLES CHART =====
    const articleLabels = props.articlesPerMonth.map((item) => item.month);
    const articleData = props.articlesPerMonth.map((item) => item.count);

    new Chart(document.getElementById("articlesChart"), {
        type: "bar",
        data: {
            labels: articleLabels,
            datasets: [
                {
                    label: "Articles Published",
                    data: articleData,
                    backgroundColor: "#ff7676",
                    borderColor: "#e82727",
                    borderRadius: 5,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
        },
    });
});
</script>

<template>
    <Head title="Dashboard"></Head>
    <Title>Dashboard</Title>
    <div class="mt-4">
        <div class="flex gap-5">
            <div class="flex-1 p-10 bg-white mt-4 rounded-lg">
                <div>
                    <h2 class="text-lg font-medium text-slate-500">
                        Total Users
                    </h2>
                </div>
                <div>
                    <h1 class="text-4xl font-medium text-slate-600">
                        {{ totalUsers }}
                    </h1>
                </div>
            </div>

            <div class="flex-1 p-10 bg-white mt-4 rounded-lg">
                <div>
                    <h2 class="text-lg font-medium text-slate-500">
                        Total Registered Today
                    </h2>
                </div>
                <div>
                    <h1 class="text-4xl font-medium text-slate-600">
                        {{ totalRegisteredUsersToday }}
                    </h1>
                </div>
            </div>

            <div class="flex-1 p-10 bg-white mt-4 rounded-lg">
                <div>
                    <h2 class="text-lg font-medium text-slate-500">
                        Total Articles
                    </h2>
                </div>
                <div>
                    <h1 class="text-4xl font-medium text-slate-600">
                        {{ totalArticles }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="flex gap-5">
            <div class="bg-white p-10 mt-5 rounded-lg w-1/2">
                <h2 class="text-lg font-medium mb-4 text-slate-500">
                    User Growth
                </h2>
                <canvas id="usersChart"></canvas>
            </div>
            <div class="bg-white p-10 mt-5 rounded-lg w-1/2">
                <h2 class="text-lg font-medium mb-4 text-slate-500">
                    Articles Per Month
                </h2>
                <canvas id="articlesChart"></canvas>
            </div>
        </div>
    </div>
</template>

<style></style>
