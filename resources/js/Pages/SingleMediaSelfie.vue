<template>
    <Head title="Media"></Head>
    <PageTitle name="BHPL50 - Selfies" />
    <div class="w-full max-w-[1400px] mx-auto mt-5 md:mt-10 mb-10">
        <div class="px-4">
            <div
                class="columns-1 md:columns-2 xl:columns-3 gap-6 mt-5 space-y-6"
            >
                <img
                    v-for="image in images"
                    :key="image"
                    :src="`/${image}`"
                    class="w-full rounded-lg shadow-md hover:scale-105 transition"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import PageTitle from "../Layouts/Components/FrontEnd/PageTitle.vue";

defineProps({
    images: Array,
});
</script>

<style></style>
