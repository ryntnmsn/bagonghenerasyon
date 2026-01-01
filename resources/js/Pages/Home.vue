<script setup>
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
import Button from "../../components/FrontEnd/Button.vue";
import InputText from "../../components/InputText.vue";
import SectionTitle from "../../components/FrontEnd/SectionTitle.vue";
import SeeAllButton from "../../components/FrontEnd/SeeAllButton.vue";
import ReadMoreButton from "../../components/FrontEnd/ReadMoreButton.vue";
import "vue3-carousel/dist/carousel.css";
import { Clock } from "lucide-vue-next";
import dayjs from "dayjs";
import { defineProps, ref } from "vue";

const props = defineProps({
    banners: Object,
    latestArticles: Object,
    featuredArticles: Object,
    articleCategories: Object,
});
</script>

<template>
    <div v-if="banners && banners.length" class="banner-slider">
        <Carousel :autoplay="6000" :wrap-around="true">
            <Slide v-for="banner in props.banners" :key="banner.id">
                <div class="carousel__item w-full relative">
                    <div class="absolute top-0 bottom-0 left-0 right-0">
                        <div
                            class="flex flex-col w-full max-w-[1400px] z-10 mx-auto px-4 h-full justify-center"
                        >
                            <div class="w-full md:w-1/2">
                                <h1
                                    class="text-4xl md:text-6xl text-white font-medium leading-10 md:leading-18 text-center md:text-left"
                                >
                                    {{ banner.title }}
                                </h1>
                            </div>
                            <div
                                v-if="banner.link != null"
                                class="text-center md:text-left"
                            >
                                <Button name="Learn More" />
                            </div>
                        </div>
                    </div>
                    <img
                        :src="`/storage/${banner.image}`"
                        class="slider-image object-right"
                    />
                </div>
            </Slide>

            <template #addons>
                <Navigation />
                <Pagination />
            </template>
        </Carousel>
    </div>

    <div
        v-if="latestArticles && latestArticles.length"
        class="w-full max-w-[1400px] mx-auto"
    >
        <!-- Latest news -->
        <div class="mt-10 md:mt-20 px-4">
            <div class="flex">
                <div class="flex-auto">
                    <SectionTitle name="Latest News" />
                </div>
                <div class="flex-end flex justify-center">
                    <SeeAllButton name="See All" />
                </div>
            </div>
            <div
                class="mt-4 flex gap-6 overflow-x-auto snap-x snap-mandatory md:grid md:grid-cols-3 md:overflow-visible"
            >
                <div
                    v-for="article in props.latestArticles"
                    :key="article.id"
                    class="bg-white overflow-hidden relative shadow rounded-xl snap-start min-w-[48%] md:min-w-0"
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
                            alt=""
                            class="w-full object-cover"
                        />
                    </div>

                    <div class="mt-4 flex flex-col gap-3 px-5 pb-5">
                        <div>
                            <p
                                class="text-sm text-gray-400 mb-1 flex items-center gap-1"
                            >
                                <Clock class="w-3.5" />
                                <span>
                                    {{
                                        dayjs(article.created_at).format(
                                            "MMMM D, YYYY"
                                        )
                                    }}
                                </span>
                            </p>

                            <h2
                                class="font-medium text-lg md:text-xl text-gray-800"
                            >
                                {{ article.title }}
                            </h2>
                        </div>

                        <p class="text-gray-500 text-base">
                            {{ article.short_description }}
                        </p>

                        <div class="border-t border-gray-200 pt-2">
                            <ReadMoreButton name="Read more" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top categories -->
        <div
            v-if="articleCategories && articleCategories.length"
            class="mt-10 md:mt-20 px-4"
        >
            <div class="flex">
                <div class="flex-auto">
                    <SectionTitle name="Top Categories" />
                </div>
                <div class="flex-end flex justify-center">
                    <SeeAllButton name="See All" />
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mt-4">
                <div
                    v-for="articleCategory in props.articleCategories"
                    :key="articleCategory.id"
                    class="bg-white shadow rounded-xl"
                >
                    <Link
                        :href="
                            route(
                                'single_article_category',
                                articleCategory.slug
                            )
                        "
                        class="text-gray-800 font-medium text-lg text-center block p-5"
                        >{{ articleCategory.title }} ({{
                            articleCategory.articles.length
                        }})
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission Vision Values -->
    <div class="mt-10 md:mt-20 px-4 w-full max-w-[1400px] mx-auto">
        <div
            class="relative rounded-3xl bg-cover bg-center"
            :style="`background-image: url('/storage/images/Hero_bg_image.jpg')`"
        >
            <div
                class="grid grid-cols-1 md:grid-cols-2 w-full xl:w-1/2 gap-6 p-10"
            >
                <div class="bg-[#af000042] p-5 flex flex-col gap-2 rounded-xl">
                    <h2 class="text-amber-500 font-bold text-4xl">Mission</h2>
                    <p class="text-[#ffe0e1]">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.
                    </p>
                </div>
                <div class="bg-[#af000042] p-5 flex flex-col gap-2 rounded-xl">
                    <h2 class="text-amber-500 font-bold text-4xl">Vision</h2>
                    <p class="text-[#ffe0e1]">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.
                    </p>
                </div>
                <div class="bg-[#af000042] p-5 flex flex-col gap-2 rounded-xl">
                    <h2 class="text-amber-500 font-bold text-4xl">Values</h2>
                    <p class="text-[#ffe0e1]">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div
        v-if="featuredArticles && featuredArticles.length"
        class="w-full max-w-[1400px] mx-auto px-4 mt-10 md:mt-20"
    >
        <div class="flex">
            <div class="flex-auto">
                <SectionTitle name="Featured News" />
            </div>
            <div class="flex-end flex justify-center">
                <SeeAllButton name="See All" />
            </div>
        </div>
        <!-- Featured Articles -->
        <div
            class="mt-4 flex gap-6 overflow-x-auto snap-x snap-mandatory lg:grid lg:grid-cols-4 lg:overflow-visible"
        >
            <div
                v-for="article in props.featuredArticles"
                :key="article.id"
                class="bg-white overflow-hidden relative shadow rounded-xl snap-start min-w-[48%] sm:min-w-[32%] lg:min-w-0"
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
                        alt=""
                        class="w-full object-cover"
                    />
                </div>

                <div class="mt-4 flex flex-col gap-3 px-5 pb-5">
                    <div>
                        <p
                            class="text-sm text-gray-400 mb-1 flex items-center gap-1"
                        >
                            <Clock class="w-3.5" />
                            <span>
                                {{
                                    dayjs(article.created_at).format(
                                        "MMMM D, YYYY"
                                    )
                                }}
                            </span>
                        </p>

                        <h2
                            class="font-medium text-lg md:text-xl text-gray-800"
                        >
                            {{ article.title }}
                        </h2>
                    </div>

                    <p class="text-gray-500 text-base">
                        {{ article.short_description }}
                    </p>

                    <div class="border-t border-gray-200 pt-2">
                        <ReadMoreButton name="Read more" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border-b border-gray-200 mt-20 px-4 py-15">
        <div class="flex items-center justify-center flex-col gap-4">
            <img
                :src="`/storage/images/email_image.png`"
                alt="Bagong Henerasyon Partylist"
                class="w-15"
            />
            <div class="flex justify-center flex-col text-center">
                <h2 class="text-2xl md:text-3xl text-gray-700 font-medium">
                    Subscribe to our newsletter
                </h2>
                <p class="text-slate-500">
                    Stay in the loop! Subscribe to our newsletter for updates,
                    tips, and announcements.
                </p>
            </div>
            <div class="mt-3">
                <form action="">
                    <div class="flex">
                        <input
                            placeholder="Enter email here"
                            class="border-2 outline-none text-gray-800 border-gray-100 bg-gray-50 p-2 text-base rounded-l-md duration-400 ease-in-out focus:border-red ring-0 focus:bg-white w-full md:w-lg"
                        /><button class="btn !rounded-l-none !border-0">
                            SUBSCRIBE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.slider-image {
    width: 100%;
    height: 800px;
    object-fit: cover;
}
</style>
