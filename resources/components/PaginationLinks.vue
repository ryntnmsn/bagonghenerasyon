<!--eslint-disable vue/no-v-text-v-html-on-component-->
<script setup>
// import { ChevronsRight, ChevronsLeft } from "lucide-vue-next";

defineProps({
    paginator: {
        type: Object,
        required: true,
    },
});

const makeLabel = (label) => {
    if (label.includes("Previous")) {
        return "Prev";
    } else if (label.includes("Next")) {
        return "Next";
    } else {
        return label;
    }
};
</script>

<template>
    <div
        class="flex justify-between items-center border-t border-gray-200 pt-4"
    >
        <div class="flex items-center rounded-md overflow-hidden">
            <div v-for="(link, i) in paginator.links" :key="`${link.url}-${i}`">
                <component
                    :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    v-html="makeLabel(link.label)"
                    class="border-x border-gray-50 w-10 h-8 grid place-items-center text-slate-500"
                    :class="{
                        ' hover:bg-red hover:text-white rounded-md': link.url,
                        'text-zinc-300': !link.url,
                        'font-bold text-white bg-red': link.active,
                    }"
                />
            </div>
        </div>

        <p class="text-slate-600 text-sm">
            Showing {{ paginator.from }} to {{ paginator.to }} of
            {{ paginator.total }} results
        </p>
    </div>
</template>
