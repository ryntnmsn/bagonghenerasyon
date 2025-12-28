<template>
    <header class="w-full">
        <div class="bg-red w-full">
            <div class="w-full max-w-[1400px] mx-auto px-4 py-1">
                <p class="text-white text-[10px]">
                    I-ANGAT LAHAT NG PAMILYA SOLO PARENTS AT IBA PA!
                </p>
            </div>
        </div>
        <div class="w-full bg-white">
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
                                    href="/"
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
                                    <CircleUserRound
                                        class="text-gray-700 w-6 h-6 cursor-pointer hover:text-red duration-600 ease-in-out"
                                    />
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
            <div v-if="mobileMenuOpen" class="md:hidden bg-white">
                <nav class="flex flex-col px-4 py-3 space-y-3">
                    <Link href="/" class="text-gray-700" @click="toggleMenu"
                        >Home</Link
                    >
                    <Link
                        href="/about"
                        class="text-gray-700"
                        @click="toggleMenu"
                        >About</Link
                    >
                    <Link
                        href="/services"
                        class="text-gray-700"
                        @click="toggleMenu"
                        >Services</Link
                    >
                    <Link
                        href="/contact"
                        class="text-gray-700"
                        @click="toggleMenu"
                        >Contact</Link
                    >
                </nav>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { Search, CircleUserRound } from "lucide-vue-next";

const mobileMenuOpen = ref(false);

const toggleMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value;
};
</script>

<style></style>
