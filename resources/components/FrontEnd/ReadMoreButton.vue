<template>
    <div>
        <Link
            class="text-gray-700 font-medium text-[12px] justify-center items-center rounded-md uppercase inline-flex gap-1 tracking-wider"
        >
            <span> {{ name }}</span>
            <span><ChevronsRight class="w-5" /></span
        ></Link>
    </div>
</template>

<script setup>
import { ChevronsRight } from "lucide-vue-next";

defineProps({
    name: String,
});
</script>

<style></style>
