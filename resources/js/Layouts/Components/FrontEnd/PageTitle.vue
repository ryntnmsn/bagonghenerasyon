<template>
    <div class="w-full p-5 bg-white shadow">
        <div class="w-full max-w-[1400px] mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-medium text-gray-700">
                {{ name }}
            </h1>
        </div>
    </div>
</template>

<script setup>
defineProps({
    name: String,
});
</script>

<style></style>
