<template>
    <Head title="Search"></Head>
    <PageTitle :name="`Search results for ${query}`" />
    <div class="w-full max-w-[1400px] mx-auto mt-5 md:mt-10 mb-10">
        <div class="px-4">
            <div v-if="results.length">
                <div v-for="result in results" :key="result.id">
                    <div
                        class="flex flex-col border-b border-gray-300 p-4 relative hover:bg-white rounded-md hover:-translate-y-2 duration-400 ease-in-out"
                    >
                        <Link
                            :href="route('single_article', result.slug)"
                            class="absolute top-0 right-0 left-0 bottom-0 z-10"
                        ></Link>
                        <div class="flex gap-4 items-center">
                            <div>
                                <img
                                    :src="`/storage/${result.image}`"
                                    alt="Bagong Henerasyon Article Image"
                                    class="w-42 rounded-md"
                                />
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-700 text-lg">
                                    {{ result.title }}
                                </h5>
                                <p class="text-gray-500">
                                    {{ result.short_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p v-else class="text-gray-500">No results found.</p>
        </div>
    </div>
</template>

<script setup>
import PageTitle from "../Layouts/Components/FrontEnd/PageTitle.vue";
defineProps({
    query: String,
    results: Array,
});
</script>

<style></style>
