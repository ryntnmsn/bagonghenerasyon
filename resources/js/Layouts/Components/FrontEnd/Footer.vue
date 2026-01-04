<template>
    <div class="w-full">
        <div class="bg-white w-full">
            <div class="px-4 py-10 w-full max-w-[1400px] mx-auto">
                <div
                    class="grid grid-cols-1 md:grid-cols-4 md:gap-5 gap-8 text-center md:text-left"
                >
                    <div class="flex-1 flex justify-center md:justify-start">
                        <div>
                            <img
                                :src="`/storage/images/bh_icon.png`"
                                alt="Bagong Henerasyon Partylist"
                                class="w-24 text-center"
                            />
                        </div>
                    </div>

                    <div class="flex-1">
                        <h5 class="text-gray-700 font-bold text-base">
                            OUR CHANNELS
                        </h5>
                        <ul
                            class="flex flex-col md:mt-3 mt-0 md:justify-left justify-center"
                        >
                            <li
                                v-for="category in categories"
                                :key="category.id"
                                class="mt-2"
                            >
                                <Link
                                    :href="
                                        route(
                                            'single_article_category',
                                            category.slug
                                        )
                                    "
                                    class="text-gray-700 hover:text-red hover:underline"
                                    >{{ category.title }}</Link
                                >
                            </li>
                        </ul>
                    </div>

                    <div class="flex-1">
                        <h5 class="text-gray-700 font-bold text-base">
                            USEFUL LINKS
                        </h5>
                        <ul class="flex flex-col md:mt-3 mt-0">
                            <li class="mt-2">
                                <Link
                                    :href="route('home')"
                                    class="text-gray-700 hover:text-red hover:underline"
                                >
                                    Home
                                </Link>
                            </li>
                            <li class="mt-2">
                                <Link
                                    :href="route('articles')"
                                    class="text-gray-700 hover:text-red hover:underline"
                                >
                                    News
                                </Link>
                            </li>
                            <li class="mt-2">
                                <Link
                                    :href="route('media')"
                                    class="text-gray-700 hover:text-red hover:underline"
                                >
                                    Media
                                </Link>
                            </li>
                            <li class="mt-2">
                                <Link
                                    :href="route('about')"
                                    class="text-gray-700 hover:text-red hover:underline"
                                >
                                    About us
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <div class="flex-1">
                        <div>
                            <h5 class="text-gray-700 font-bold text-base">
                                SOCIALS
                            </h5>
                            <ul
                                class="flex flex-row md:mt-3 mt-0 gap-2 md:justify-start justify-center"
                            >
                                <li>
                                    <Link>
                                        <img
                                            :src="`/storage/images/fb_icon.svg`"
                                            alt="Bagong Henerasyon Partylist FB Page"
                                            class="w-6"
                                        />
                                    </Link>
                                </li>
                                <li>
                                    <Link>
                                        <img
                                            :src="`/storage/images/instagram_icon.svg`"
                                            alt="Bagong Henerasyon Partylist Instagram Page"
                                            class="w-6"
                                        />
                                    </Link>
                                </li>
                                <li>
                                    <Link>
                                        <img
                                            :src="`/storage/images/x_icon.svg`"
                                            alt="Bagong Henerasyon Partylist X Page"
                                            class="w-6"
                                        />
                                    </Link>
                                </li>
                                <li>
                                    <Link>
                                        <img
                                            :src="`/storage/images/tiktok_icon.svg`"
                                            alt="Bagong Henerasyon Partylist Tiktok Page"
                                            class="w-6"
                                        />
                                    </Link>
                                </li>
                                <li>
                                    <Link>
                                        <img
                                            :src="`/storage/images/youtube_icon.svg`"
                                            alt="Bagong Henerasyon Partylist Youtube Page"
                                            class="w-6"
                                        />
                                    </Link>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-8">
                            <h5 class="text-gray-700 font-bold text-base">
                                CONTACTS
                            </h5>
                            <ul
                                class="flex flex-col md:mt-3 mt-0 gap-2 text-gray-700"
                            >
                                <li>
                                    <p>Mobile: 0909 090 0909</p>
                                </li>
                                <li>
                                    <p>Tel: 02805056</p>
                                </li>
                                <li>
                                    <p>Email: mail@bagonghenerasyon.ph</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-red">
            <div class="w-full max-w-[1400px] mx-auto">
                <p class="px-4 text-white py-1 text-center">
                    <small>© Copyright 2025 bagonghenerasyon.ph</small>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";

const categories = usePage().props.articleCategories;
</script>

<style></style>
