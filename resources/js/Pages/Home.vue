<script setup>
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
import Button from "../../components/FrontEnd/Button.vue";
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
                            <div class="w-1/2">
                                <h1
                                    class="text-6xl text-white font-medium leading-18"
                                >
                                    {{ banner.title }}
                                </h1>
                            </div>
                            <div v-if="banner.link != null">
                                <Button name="Learn More" />
                            </div>
                        </div>
                    </div>
                    <img
                        :src="`/storage/${banner.image}`"
                        class="slider-image"
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
        <div class="mt-20">
            <div class="flex">
                <div class="flex-auto">
                    <SectionTitle name="Latest News" />
                </div>
                <div class="flex-end flex justify-center">
                    <SeeAllButton name="See All" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 mt-6">
                <div
                    v-for="article in props.latestArticles"
                    :key="article.id"
                    class="bg-white overflow-hidden p-5 relative shadow"
                >
                    <Link
                        href="#"
                        class="absolute top-0 left-0 right-0 bottom-0 z-30"
                    />
                    <div class="relative">
                        <p
                            class="absolute bottom-0 bg-white px-3 py-1 text-gray-800 m-3"
                        >
                            {{ article.category?.title }}
                        </p>
                        <img
                            :src="`/storage/${article.image}`"
                            alt=""
                            class="w-full object-cover"
                        />
                    </div>
                    <div class="mt-4 flex flex-col gap-3">
                        <div>
                            <p
                                class="text-sm text-gray-400 mb-1 flex items-center gap-1"
                            >
                                <span> <Clock class="w-3.5" /> </span>
                                <span>
                                    {{
                                        dayjs(article.created_at).format(
                                            "MMMM D, YYYY"
                                        )
                                    }}
                                </span>
                            </p>
                            <h2 class="font-medium text-xl text-gray-800">
                                {{ article.title }}
                            </h2>
                        </div>
                        <div>
                            <p class="text-gray-500 text-base">
                                {{ article.short_description }}
                            </p>
                        </div>
                        <div class="border-t border-gray-200 pt-2">
                            <ReadMoreButton name="Read more" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top categories -->
        <div v-if="articleCategories && articleCategories.length" class="mt-20">
            <div class="flex">
                <div class="flex-auto">
                    <SectionTitle name="Top Categories" />
                </div>
                <div class="flex-end flex justify-center">
                    <SeeAllButton name="See All" />
                </div>
            </div>
            <div class="grid grid-cols-5 gap-6 mt-6">
                <div
                    v-for="articleCategory in props.articleCategories"
                    :key="articleCategory.id"
                    class="bg-white shadow"
                >
                    <Link
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
    <div class="mt-20">
        <div class="w-full max-w-[1400px] mx-auto overflow-hidden relative">
            <img
                :src="'/storage/images/Hero_bg_image.jpg'"
                alt=""
                class="object-cover"
            />
            <div
                class="absolute left-0 top-0 m-14 grid grid-cols-2 w-1/2 gap-6"
            >
                <div class="bg-[#af000042] p-5 flex flex-col gap-2">
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
                <div class="bg-[#af000042] p-5 flex flex-col gap-2">
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
                <div class="bg-[#af000042] p-5 flex flex-col gap-2">
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
        class="w-full max-w-[1400px] mx-auto"
    >
        <!-- Featured Articles -->
        <div class="mt-20">
            <div class="flex">
                <div class="flex-auto">
                    <SectionTitle name="Featured Articles" />
                </div>
                <div class="flex-end flex justify-center">
                    <SeeAllButton name="See All" />
                </div>
            </div>
            <div class="grid grid-cols-4 gap-6 mt-6">
                <div
                    v-for="article in props.featuredArticles"
                    :key="article.id"
                    class="bg-white overflow-hidden p-5 relative shadow"
                >
                    <Link
                        href="#"
                        class="absolute top-0 left-0 right-0 bottom-0 z-30"
                    />
                    <div class="relative">
                        <p
                            class="absolute bottom-0 bg-white px-3 py-1 text-gray-800 m-3"
                        >
                            {{ article.category?.title }}
                        </p>
                        <img
                            :src="`/storage/${article.image}`"
                            alt=""
                            class="w-full object-cover"
                        />
                    </div>
                    <div class="mt-4 flex flex-col gap-3">
                        <div>
                            <p
                                class="text-sm text-gray-400 mb-1 flex items-center gap-1"
                            >
                                <span> <Clock class="w-3.5" /> </span>
                                <span>
                                    {{
                                        dayjs(article.created_at).format(
                                            "MMMM D, YYYY"
                                        )
                                    }}
                                </span>
                            </p>
                            <h2 class="font-medium text-xl text-gray-800">
                                {{ article.title }}
                            </h2>
                        </div>
                        <div>
                            <p class="text-gray-500 text-base">
                                {{ article.short_description }}
                            </p>
                        </div>
                        <div class="border-t border-gray-200 pt-2">
                            <ReadMoreButton name="Read more" />
                        </div>
                    </div>
                </div>
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
