<template>
    <Head title="Media"></Head>
    <PageTitle name="Media" />
    <div class="w-full max-w-[1400px] mx-auto mt-5 md:mt-10 mb-10">
        <div class="px-4">
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6 mt-5"
            >
                <div
                    v-for="media in medias.data"
                    :key="media.id"
                    class="bg-gray-800 rounded-xl shadow overflow-hidden duration-400 ease-in-out hover:-translate-y-2 cursor-pointer relative group"
                >
                    <Link
                        :href="route('single_media', media.slug)"
                        class="absolute bottom-0 top-0 left-0 right-0 z-30 group"
                    />
                    <div>
                        <img
                            v-if="media.images && media.images.length"
                            :src="`/storage/${media.images[0]}`"
                            class="object-cover h-[300px] w-full opacity-60 group-hover:opacity-100"
                            alt="Bagong Henerasyon Media Thumbnail"
                        />
                    </div>
                    <div class="absolute top-0 p-4">
                        <Images class="text-white w-[20px]" />
                    </div>
                    <div
                        class="absolute z-10 bottom-0 group-hover:bg-white w-full duration-400 ease-in-out"
                    >
                        <h1
                            class="text-white group-hover:text-gray-700 font-medium text-xl p-3"
                        >
                            {{ media.title }}
                        </h1>
                    </div>
                </div>
            </div>

            <!-- Load More -->
            <div v-if="medias.next_page_url" class="flex justify-center mt-10">
                <button
                    @click="loadMore"
                    class="px-6 py-3 bg-red text-white rounded-lg hover:bg-red-600 transition"
                    :disabled="loading"
                >
                    {{ loading ? "Loading..." : "Load More" }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import PageTitle from "../Layouts/Components/FrontEnd/PageTitle.vue";
import { Images } from "lucide-vue-next";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    medias: Object,
});

const medias = ref(props.medias);
const loading = ref(false);

const loadMore = () => {
    if (!medias.value.next_page_url) return;

    loading.value = true;

    router.get(
        medias.value.next_page_url,
        {},
        {
            preserveScroll: true,
            preserveState: true,
            only: ["medias"],
            onSuccess: (page) => {
                medias.value = {
                    ...page.props.medias,
                    data: [...medias.value.data, ...page.props.medias.data],
                };
            },
            onFinish: () => {
                loading.value = false;
            },
        }
    );
};
</script>

<style></style>
