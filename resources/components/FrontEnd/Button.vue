<template>
    <div class="mt-8">
        <Link
            class="fe-btn px-5 py-3 text-white font-medium text-[16px] uppercase inline-flex gap-1 tracking-wider"
        >
            <span> {{ name }}</span>
            <span><ChevronRight /></span
        ></Link>
    </div>
</template>

<script setup>
import { ChevronRight } from "lucide-vue-next";

defineProps({
    name: String,
});
</script>

<style></style>
