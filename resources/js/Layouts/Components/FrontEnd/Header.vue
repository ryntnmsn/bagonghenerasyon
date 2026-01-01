<template>
    <header class="w-full">
        <div class="bg-red w-full">
            <div
                class="w-full max-w-[1400px] mx-auto px-4 py-1 flex text-center md:text-left"
            >
                <p class="text-white text-[10px] flex-1">
                    I-ANGAT LAHAT NG PAMILYA SOLO PARENTS AT IBA PA!
                </p>
                <p
                    class="text-white text-[10px] flex-1 hidden md:flex justify-end"
                >
                    Current Date: {{ formattedDate }}
                </p>
            </div>
        </div>
        <div class="w-full bg-white border-b border-gray-200 shadow">
            <div class="max-w-[1400px] mx-auto px-4 py-4">
                <div class="flex justify-between items-center h-auto">
                    <!-- Logo -->
                    <Link href="/">
                        <img
                            :src="'/storage/images/BHPL_Logo.png'"
                            alt="Bagong Henerasyon PartyList Logo"
                            class="w-[200px]"
                        />
                    </Link>

                    <!-- Desktop Menu -->
                    <nav class="hidden md:flex h-full gap-8">
                        <ul class="flex items-center space-x-8">
                            <li>
                                <Link
                                    href="/"
                                    class="text-gray-700 font-medium uppercase text-[14px] tracking-[0.5px] hover:text-red duration-600 ease-in-out"
                                    >Home</Link
                                >
                            </li>
                            <li>
                                <Link
                                    :href="route('articles')"
                                    class="text-gray-700 font-medium uppercase text-[14px] tracking-[0.5px] hover:text-red duration-600 ease-in-out"
                                    >NEWS</Link
                                >
                            </li>
                            <li>
                                <Link
                                    href="/"
                                    class="text-gray-700 font-medium uppercase text-[14px] tracking-[0.5px] hover:text-red duration-600 ease-in-out"
                                    >MEDIA</Link
                                >
                            </li>
                            <li>
                                <Link
                                    :href="route('about')"
                                    class="text-gray-700 font-medium uppercase text-[14px] tracking-[0.5px] hover:text-red duration-600 ease-in-out"
                                    >ABOUT</Link
                                >
                            </li>
                        </ul>
                        <div class="border-s-2 border-gray-300 ps-8">
                            <ul class="flex space-x-5">
                                <li>
                                    <Search
                                        class="text-gray-700 w-6 h-6 cursor-pointer hover:text-red duration-600 ease-in-out"
                                    />
                                </li>
                                <li>
                                    <Link :href="route('login')">
                                        <CircleUserRound
                                            class="text-gray-700 w-6 h-6 cursor-pointer hover:text-red duration-600 ease-in-out"
                                    /></Link>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <!-- Mobile Button -->
                    <button
                        @click="toggleMenu"
                        class="md:hidden text-gray-700 focus:outline-none"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Dropdown -->
            <div
                v-if="mobileMenuOpen"
                class="md:hidden bg-white border-t border-gray-300"
            >
                <nav class="flex flex-col px-4 py-5 space-y-5">
                    <Link
                        :href="route('home')"
                        class="text-gray-700"
                        @click="toggleMenu"
                        >Home</Link
                    >
                    <Link
                        :href="route('articles')"
                        class="text-gray-700"
                        @click="toggleMenu"
                        >Articles</Link
                    >
                    <Link href="#" class="text-gray-700" @click="toggleMenu"
                        >Media</Link
                    >
                    <Link
                        :href="route('about')"
                        class="text-gray-700"
                        @click="toggleMenu"
                        >About</Link
                    >
                </nav>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { Search, CircleUserRound } from "lucide-vue-next";

const mobileMenuOpen = ref(false);

const toggleMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
};

const formattedDate = computed(() => {
    const today = new Date();
    return new Intl.DateTimeFormat("en-GB", {
        dateStyle: "full",
        timeStyle: "long",
    }).format(today);
});
</script>

<style></style>
