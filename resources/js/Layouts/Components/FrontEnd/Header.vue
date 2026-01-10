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
                            class="w-[180px] md:w-[200px]"
                        />
                    </Link>

                    <!-- Desktop Menu -->
                    <nav class="hidden md:flex h-full gap-8">
                        <ul class="flex items-center space-x-8">
                            <li>
                                <Link
                                    :href="route('home')"
                                    class="text-gray-700 font-medium uppercase text-[14px] tracking-[0.5px] hover:text-red duration-200 ease-in-out hover:underline hover:underline-offset-5"
                                    >Home</Link
                                >
                            </li>
                            <li>
                                <Link
                                    :href="route('articles')"
                                    class="text-gray-700 font-medium uppercase text-[14px] tracking-[0.5px] hover:text-red duration-200 ease-in-out hover:underline hover:underline-offset-5"
                                    >NEWS</Link
                                >
                            </li>
                            <li>
                                <Link
                                    :href="route('media')"
                                    class="text-gray-700 font-medium uppercase text-[14px] tracking-[0.5px] hover:text-red duration-200 ease-in-out hover:underline hover:underline-offset-5"
                                    >MEDIA</Link
                                >
                            </li>
                            <li>
                                <Link
                                    :href="route('about')"
                                    class="text-gray-700 font-medium uppercase text-[14px] tracking-[0.5px] hover:text-red duration-200 ease-in-out hover:underline hover:underline-offset-5"
                                    >ABOUT</Link
                                >
                            </li>
                        </ul>
                        <div class="border-s-2 border-gray-300 ps-8">
                            <ul class="flex space-x-5">
                                <li>
                                    <Search
                                        @click.stop="toggleSearch"
                                        class="text-gray-700 w-6 h-6 cursor-pointer hover:text-red duration-200 ease-in-out"
                                    />

                                    <Transition
                                        enter-active-class="transition-all duration-300 ease-out"
                                        enter-from-class="opacity-0 -translate-y-4"
                                        enter-to-class="opacity-100 translate-y-0"
                                        leave-active-class="transition-all duration-200 ease-in"
                                        leave-from-class="opacity-100 translate-y-0"
                                        leave-to-class="opacity-0 -translate-y-4"
                                    >
                                        <div
                                            v-if="showSearch"
                                            ref="searchRef"
                                            class="w-full shadow-lg absolute right-0 mt-7 bg-white py-6 z-50 border border-gray-300 duration-400 ease-in-out"
                                        >
                                            <div
                                                class="w-full max-w-[1400px] mx-auto"
                                            >
                                                <div class="px-4">
                                                    <div class="relative">
                                                        <form
                                                            @submit.prevent="
                                                                submit
                                                            "
                                                        >
                                                            <input
                                                                v-model="form.q"
                                                                type="text"
                                                                placeholder="Search..."
                                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red"
                                                            />
                                                            <button
                                                                type="submit"
                                                                class="bg-red text-white absolute right-0 z-10 hover:cursor-pointer"
                                                            >
                                                                Search
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </Transition>
                                </li>
                                <!-- <li>
                                    <Link :href="route('login')">
                                        <CircleUserRound
                                            class="text-gray-700 w-6 h-6 cursor-pointer hover:text-red duration-200 ease-in-out"
                                    /></Link>
                                </li> -->
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
                        class="text-gray-700 hover:text-red duration-200 ease-in-out hover:underline text-[16px]"
                        @click="toggleMenu"
                        >Home</Link
                    >
                    <Link
                        :href="route('articles')"
                        class="text-gray-700 hover:text-red duration-200 ease-in-out hover:underline text-[16px]"
                        @click="toggleMenu"
                        >Articles</Link
                    >
                    <Link
                        :href="route('media')"
                        class="text-gray-700 hover:text-red duration-200 ease-in-out hover:underline text-[16px]"
                        @click="toggleMenu"
                        >Media</Link
                    >
                    <Link
                        :href="route('about')"
                        class="text-gray-700 hover:text-red duration-200 ease-in-out hover:underline text-[16px]"
                        @click="toggleMenu"
                        >About</Link
                    >
                </nav>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import { Search, CircleUserRound } from "lucide-vue-next";

const showSearch = ref(false);
const searchRef = ref(null);

const toggleSearch = () => {
    showSearch.value = !showSearch.value;
};

const handleClickOutside = (event) => {
    if (searchRef.value && !searchRef.value.contains(event.target)) {
        showSearch.value = false;
    }
};

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
});

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

const form = useForm({
    q: "",
});

function submit() {
    if (!form.q) return;

    form.get(route("search"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            showSearch.value = false;
        },
    });
}
</script>

<style></style>
