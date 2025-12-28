<template>
    <Link
        class="text-gray-700 font-medium text-[13px] justify-center items-center rounded-md uppercase inline-flex gap-3 tracking-wider"
    >
        <span> {{ name }}</span>
        <span><MoveRight /></span
    ></Link>
</template>

<script setup>
import { MoveRight } from "lucide-vue-next";

defineProps({
    name: String,
});
</script>

<style></style>
