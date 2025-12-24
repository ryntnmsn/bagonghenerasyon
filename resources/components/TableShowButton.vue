<template>
    <div>
        <Link
            :href="props.href"
            class="flex items-center gap-1 flex-wrap p-1 rounded-sm hover:bg-blue-500 group"
        >
            <span>
                <Eye class="w-5 h-5 text-slate-600 group-hover:text-white" />
            </span>
            <!-- <span>Edit</span> -->
        </Link>
    </div>
</template>

<script setup>
import { Eye } from "lucide-vue-next";

const props = defineProps({
    href: String,
});
</script>

<style></style>
