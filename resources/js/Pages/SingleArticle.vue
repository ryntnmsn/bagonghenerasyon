<script setup>
import dayjs from "dayjs";
import ReadMoreButton from "../../components/FrontEnd/ReadMoreButton.vue";
import { Clock } from "lucide-vue-next";

const props = defineProps({
    article: Object,
    latestArticles: Object,
    relatedArticles: Object,
});

const articleUrl = window.location.href; // current page URL
const articleTitle = props.article.title;
</script>

<template>
    <div class="w-full max-w-[1400px] mx-auto px-4 mt-10">
        <div class="flex gap-8">
            <div class="w-full flex flex-col gap-5">
                <div>
                    <img
                        :src="`/storage/${article.image}`"
                        :alt="article.title"
                        class="rounded-xl border border-gray-300 shadow"
                    />
                </div>
                <div class="flex gap-3 flex-col">
                    <p class="text-gray-500">
                        <span
                            class="bg-red px-4 text-white font-medium py-2 rounded-md shadow"
                        >
                            Category:
                            {{ article.category?.title || "Uncategorized" }}
                        </span>
                    </p>
                    <h1
                        class="text-[36px] leading-[46px] font-medium text-gray-800"
                    >
                        {{ article.title }}
                    </h1>
                    <div class="flex items-center gap-4">
                        <div>
                            <p class="flex gap-1 items-center text-gray-500">
                                <span><Clock class="w-4" /></span>
                                <span>{{
                                    dayjs(article.created_at).format(
                                        "MMMM D, YYYY"
                                    )
                                }}</span>
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Posted by: BHPL</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div
                            class="text-gray-700 prose-lg max-w-full"
                            v-html="article.description"
                        ></div>
                    </div>
                    <div class="mt-4">
                        <div>
                            <p class="text-gray-700">Share</p>
                        </div>
                        <div class="flex gap-3 mt-1">
                            <!-- Facebook -->
                            <a
                                :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
                                    articleUrl
                                )}`"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="px-3 py-1 bg-blue-600 text-white rounded shadow hover:bg-blue-700"
                            >
                                Facebook
                            </a>

                            <!-- Twitter -->
                            <a
                                :href="`https://twitter.com/intent/tweet?url=${encodeURIComponent(
                                    articleUrl
                                )}&text=${encodeURIComponent(articleTitle)}`"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="px-3 py-1 bg-blue-400 text-white rounded shadow hover:bg-blue-500"
                            >
                                Twitter
                            </a>

                            <!-- LinkedIn -->
                            <a
                                :href="`https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(
                                    articleUrl
                                )}&title=${encodeURIComponent(articleTitle)}`"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="px-3 py-1 bg-blue-800 text-white rounded shadow hover:bg-blue-900"
                            >
                                LinkedIn
                            </a>
                        </div>
                    </div>

                    <div
                        v-if="relatedArticles && relatedArticles.length"
                        class="border-t border-gray-700 mt-10"
                    >
                        <!-- Related Articles -->
                        <div class="mt-10">
                            <div>
                                <h1 class="text-gray-700 text-2xl font-medium">
                                    Related articles
                                </h1>
                            </div>
                            <div class="grid grid-cols-3 gap-6 mt-6">
                                <div
                                    v-for="article in props.relatedArticles"
                                    :key="article.id"
                                    class="bg-white overflow-hidden relative shadow rounded-xl"
                                >
                                    <Link
                                        href="#"
                                        class="absolute top-0 left-0 right-0 bottom-0 z-30"
                                    />
                                    <div class="relative">
                                        <p
                                            class="absolute bottom-0 bg-white px-3 py-1 text-gray-800 m-5 rounded-md"
                                        >
                                            {{ article.category?.title }}
                                        </p>
                                        <img
                                            :src="`/storage/${article.image}`"
                                            alt=""
                                            class="w-full object-cover"
                                        />
                                    </div>
                                    <div
                                        class="mt-4 flex flex-col gap-3 px-5 pb-5"
                                    >
                                        <div>
                                            <p
                                                class="text-sm text-gray-400 mb-1 flex items-center gap-1"
                                            >
                                                <span>
                                                    <Clock class="w-3.5" />
                                                </span>
                                                <span>
                                                    {{
                                                        dayjs(
                                                            article.created_at
                                                        ).format("MMMM D, YYYY")
                                                    }}
                                                </span>
                                            </p>
                                            <h2
                                                class="font-medium text-xl text-gray-800"
                                            >
                                                {{ article.title }}
                                            </h2>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 text-base">
                                                {{ article.short_description }}
                                            </p>
                                        </div>
                                        <div
                                            class="border-t border-gray-200 pt-2"
                                        >
                                            <ReadMoreButton name="Read more" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-[400px]">
                <div class="p-5 bg-white shadow rounded-lg">
                    <h1 class="text-gray-700 text-xl font-medium">
                        Latest articles
                    </h1>
                    <div class="mt-3">
                        <div
                            v-for="article in props.latestArticles"
                            :key="article.id"
                            class="mb-5 pb-5 border-b border-gray-300"
                        >
                            <Link
                                :href="route('single_article', article.slug)"
                                class="flex gap-3 items-center group"
                            >
                                <img
                                    :src="`/storage/${article.image}`"
                                    :alt="article.title"
                                    class="w-[140px] rounded-md border border-gray-300 group"
                                />

                                <h2
                                    class="text-gray-700 group-hover:text-red group-hover:underline"
                                >
                                    {{ article.title }}
                                </h2>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
