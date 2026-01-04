<template>
    <div class="w-full pt-4 pb-4 bg-white shadow">
        <div class="w-full max-w-[1400px] mx-auto">
            <h1 class="text-3xl md:text-4xl font-medium text-gray-700 px-4">
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
