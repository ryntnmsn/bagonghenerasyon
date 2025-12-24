<template>
    <div>
        <button
            class="flex items-center gap-1 flex-wrap p-1 rounded-sm hover:bg-red group"
        >
            <span>
                <Trash class="w-5 h-5 text-slate-600 group-hover:text-white" />
            </span>
            <!-- <span>Delete</span> -->
        </button>
    </div>
</template>

<script setup>
import { Trash } from "lucide-vue-next";
</script>

<style></style>
