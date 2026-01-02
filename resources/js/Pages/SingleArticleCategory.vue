<template>
    <Head :title="category.title"></Head>
    <PageTitle :name="`Category: ${category.title}`" />
    <div class="w-full max-w-[1400px] mx-auto px-4 mt-4 xl:mt-10 mb-10">
        <div>
            <div class="grid grid-cols-4 gap-6 mt-6">
                <div
                    v-for="article in articles.data"
                    :key="article.id"
                    class="bg-white overflow-hidden relative shadow rounded-xl hover:-translate-y-2 ease-in-out duration-300"
                >
                    <Link
                        :href="route('single_article', article.slug)"
                        class="absolute inset-0 z-30"
                    />
                    <div class="relative">
                        <p
                            class="absolute bottom-0 bg-white px-3 py-1 text-gray-800 m-5 rounded-md"
                        >
                            {{ article.category?.title }}
                        </p>
                        <img
                            :src="`/storage/${article.image}`"
                            class="w-full object-cover"
                        />
                    </div>

                    <div class="mt-4 flex flex-col gap-3 px-5 pb-5">
                        <p
                            class="text-sm text-gray-400 flex items-center gap-1"
                        >
                            <Clock class="w-3.5" />
                            {{
                                dayjs(article.created_at).format("MMMM D, YYYY")
                            }}
                        </p>

                        <h2 class="font-medium text-xl text-gray-800">
                            {{ article.title }}
                        </h2>

                        <p class="text-gray-500 text-base">
                            {{ article.short_description }}
                        </p>

                        <div class="border-t border-gray-300 pt-2">
                            <ReadMoreButton name="Read more" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More -->
            <div
                v-if="articles.next_page_url"
                class="flex justify-center mt-10"
            >
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
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import dayjs from "dayjs";
import ReadMoreButton from "../../components/FrontEnd/ReadMoreButton.vue";
import SectionTitle from "../../components/FrontEnd/SectionTitle.vue";
import { Clock } from "lucide-vue-next";
import PageTitle from "../Layouts/Components/FrontEnd/PageTitle.vue";

const props = defineProps({
    articles: Object,
    category: Object,
});

const articles = ref(props.articles);
const loading = ref(false);

const loadMore = () => {
    if (!articles.value.next_page_url) return;

    loading.value = true;

    router.get(
        articles.value.next_page_url,
        {},
        {
            preserveScroll: true,
            preserveState: true,
            only: ["articles"],
            onSuccess: (page) => {
                articles.value = {
                    ...page.props.articles,
                    data: [...articles.value.data, ...page.props.articles.data],
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
