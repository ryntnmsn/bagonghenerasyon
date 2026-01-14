<script setup>
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
import SectionTitle from "../../components/FrontEnd/SectionTitle.vue";
import SeeAllButton from "../../components/FrontEnd/SeeAllButton.vue";
import ReadMoreButton from "../../components/FrontEnd/ReadMoreButton.vue";
import SeoHead from "../../components/FrontEnd/SeoHead.vue";
import "vue3-carousel/dist/carousel.css";
import { Clock } from "lucide-vue-next";
import dayjs from "dayjs";
import { defineProps, ref } from "vue";
import { useForm, Head } from "@inertiajs/vue3";

const props = defineProps({
    banners: Object,
    latestArticles: Object,
    featuredArticles: Object,
    articleCategories: Object,
    subscriptionMessage: {
        type: String,
        default: "",
    },
});

const form = useForm({
    email: "",
});

const subscriptionMessage = ref("");

function submit() {
    subscriptionMessage.value = "";

    form.post(route("subscription"), {
        onSuccess: (page) => {
            form.reset("email");

            if (page.props.subscriptionMessage) {
                subscriptionMessage.value = page.props.subscriptionMessage;
            }
        },
        preserveScroll: true,
    });
}
</script>

<template>
    <SeoHead
        title="Home"
        description="Lead the fight against sickness, ignorance, poverty, and indifference by
empowering individuals with knowledge and skills. Achieve a healthy, educated, prosperous and empowered citizenry and out goals is to comprehensively implement continuous and sustainable programs through its H.E.L.P.S. advocacies."
        image="/storage/images/og-image.jpg"
    />
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
                                    class="text-4xl md:text-6xl text-white font-bold leading-10 md:leading-18 text-center md:text-left"
                                >
                                    {{ banner.title }}
                                </h1>
                            </div>
                            <div
                                v-if="banner.link != null"
                                class="text-center md:text-left mt-6"
                            >
                                <a
                                    :href="banner.link"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    external
                                    class="bg-red text-white px-6 py-3 font-medium text-lg rounded-md hover:bg-redHover duration-400 ease-in-out"
                                    >Learn More</a
                                >
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
            <div class="flex justify-between items-center">
                <SectionTitle name="Latest News" />
                <SeeAllButton :href="route('articles')" name="See All" />
            </div>

            <!-- Articles container -->
            <div class="mt-4 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div
                    v-for="article in props.latestArticles"
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
    </div>

    <!-- Top categories -->
    <div
        v-if="articleCategories && articleCategories.length"
        class="mt-10 md:mt-20 px-4 w-full max-w-[1400px] mx-auto"
    >
        <div class="flex">
            <div class="flex-auto">
                <SectionTitle name="Top Categories" />
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 mt-4">
            <div
                v-for="articleCategory in props.articleCategories"
                :key="articleCategory.id"
                class="bg-white shadow rounded-xl hover:-translate-y-2 ease-in-out duration-300"
            >
                <Link
                    :href="
                        route('single_article_category', articleCategory.slug)
                    "
                    class="text-gray-800 font-medium text-lg text-center block p-5"
                    >{{ articleCategory.title }} ({{
                        articleCategory.articles.length
                    }})
                </Link>
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
                        To achieve a healthy, educated, prosperous and empowered
                        citizenry.
                    </p>
                </div>
                <div class="bg-[#af000042] p-5 flex flex-col gap-2 rounded-xl">
                    <h2 class="text-amber-500 font-bold text-4xl">Vision</h2>
                    <p class="text-[#ffe0e1]">
                        To lead the fight against sickness, ignorance, poverty,
                        and indifference by empowering individuals with
                        knowledge and skills.
                    </p>
                </div>
                <div class="bg-[#af000042] p-5 flex flex-col gap-2 rounded-xl">
                    <h2 class="text-amber-500 font-bold text-4xl">Values</h2>
                    <p class="text-[#ffe0e1]">
                        To comprehensively implement continuous and sustainable
                        programs through its H.E.L.P.S. advocacies: <br />
                        <b>HEALTH</b><br />
                        <b>EDUCATION</b><br />
                        <b>LIVELIHOOD</b><br />
                        <b>PEOPLE EMPOWERMENT</b><br />
                        <b>SUSTAINABLE DEVELOPMENT</b>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div
        v-if="featuredArticles && featuredArticles.length"
        class="w-full max-w-[1400px] mx-auto px-4 mt-10 md:mt-20"
    >
        <div class="flex justify-between items-center">
            <SectionTitle name="Featured News" />
            <SeeAllButton :href="route('articles')" name="See All" />
        </div>

        <!-- Featured Articles -->
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                v-for="article in props.featuredArticles"
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
                            <span>{{
                                dayjs(article.created_at).format("MMMM D, YYYY")
                            }}</span>
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
            <div class="mt-3 w-full max-w-lg">
                <form @submit.prevent="submit" class="w-full">
                    <div
                        class="w-full flex md:flex-row flex-col md:gap-0 gap-3"
                    >
                        <input
                            v-model="form.email"
                            placeholder="Enter email here"
                            class="text-center md:text-left border-2 outline-none text-gray-800 border-gray-100 bg-gray-50 p-2 text-base rounded-l-md duration-400 ease-in-out focus:border-red ring-0 focus:bg-white w-full md:w-lg"
                        /><button
                            :disabled="form.processing"
                            type="submit"
                            class="btn md:!rounded-l-none !border-0 flex justify-center"
                        >
                            SUBSCRIBE
                        </button>
                    </div>
                    <div class="mt-3">
                        <small class="text-red text-[12px]">
                            {{ form.errors.email }}</small
                        >
                    </div>
                    <div v-if="subscriptionMessage" class="mt-3">
                        <small class="text-green-600 text-[12px]">
                            {{ subscriptionMessage }}
                        </small>
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
