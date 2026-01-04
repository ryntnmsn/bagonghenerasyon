<template>
    <nav class="h-screen bg-white flex flex-col justify-between">
        <div>
            <div class="px-5 py-2">
                <small class="font-bold text-gray-400">MENU</small>
            </div>
            <ul
                class="sidenav flex flex-col uppercase text-[13px] font-medium text-slate-700"
            >
                <li
                    @click="closeMenu"
                    :class="{
                        'active text-white font-medium bg-red':
                            page.url.startsWith('/admin/dashboard'),
                        'text-slate-600': page.url.startsWith('/dashboard'),
                    }"
                    class="px-5 py-2"
                >
                    <Link
                        :href="route('dashboard.index')"
                        class="flex gap-2 flex-row items-center"
                        ><LayoutDashboard class="w-4" /><span
                            >Dashboard</span
                        ></Link
                    >
                </li>

                <li>
                    <!-- Toggle button -->
                    <button
                        :class="{
                            'active text-white font-medium bg-red':
                                page.url.startsWith('/admin/articles'),
                            'text-slate-600': page.url.startsWith('/articles'),
                        }"
                        @click="toggle('articles')"
                        class="flex w-full items-center gap-2 uppercase px-5 py-2 hover:text-red"
                        type="button"
                    >
                        <Newspaper class="w-4" />
                        <span>Articles</span>

                        <!-- Optional arrow -->
                        <svg
                            class="ml-auto h-4 w-4 transition-transform"
                            :class="{ 'rotate-180': openMenu === 'articles' }"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <ul
                        v-show="openMenu === 'articles'"
                        class="pt-2 ps-5 rounded-md bg-red-50"
                    >
                        <li class="py-2 px-4">
                            <Link :href="route('articles.index')"
                                >All Articles</Link
                            >
                        </li>

                        <li class="py-2 px-4">
                            <Link :href="route('articles.create')">
                                <div class="flex gap-1 items-center">
                                    <span> <Plus class="w-5" /></span>
                                    <span> Create Articles </span>
                                </div>
                            </Link>
                        </li>

                        <li class="py-2 px-4">
                            <Link :href="route('article_categories.index')"
                                >Categories</Link
                            >
                        </li>
                    </ul>
                </li>

                <li
                    @click="closeMenu"
                    :class="{
                        'active text-white font-medium bg-red':
                            page.url.startsWith('/admin/users'),
                        'text-slate-600': page.url.startsWith('/users'),
                    }"
                    class="px-5 py-2"
                >
                    <Link
                        :href="route('users.index')"
                        class="flex gap-2 flex-row items-center"
                        ><UsersRound class="w-4" /><span>Users</span></Link
                    >
                </li>
                <li
                    @click="closeMenu"
                    :class="{
                        'active text-white font-medium bg-red':
                            page.url.startsWith('/admin/pages'),
                        'text-slate-600 ': page.url.startsWith('/users'),
                    }"
                    class="px-5 py-2 bg-gray-200"
                >
                    <Link
                        class="flex gap-2 flex-row items-center hover:!text-gray-700"
                        ><Tickets class="w-4" /><span>Tickets</span></Link
                    >
                </li>

                <li
                    @click="closeMenu"
                    :class="{
                        'active text-white font-medium bg-red':
                            page.url.startsWith('/admin/media'),
                        'text-slate-600 bg-gray-200':
                            page.url.startsWith('/media'),
                    }"
                    class="px-5 py-2"
                >
                    <Link
                        :href="route('media.index')"
                        class="flex gap-2 flex-row items-center"
                        ><Images class="w-4" /><span>Media</span></Link
                    >
                </li>
                <li
                    @click="closeMenu"
                    :class="{
                        'active text-white font-medium bg-red':
                            page.url.startsWith('/admin/banners'),
                        'text-slate-600': page.url.startsWith('/users'),
                    }"
                    class="px-5 py-2"
                >
                    <Link
                        :href="route('banners.index')"
                        class="flex gap-2 flex-row items-center"
                        ><Image class="w-4" /><span>Banners</span></Link
                    >
                </li>
                <li
                    @click="closeMenu"
                    :class="{
                        'active text-white font-medium bg-red':
                            page.url.startsWith('/admin/subscriptions'),
                        'text-slate-600': page.url.startsWith('/subscriptions'),
                    }"
                    class="px-5 py-2"
                >
                    <Link
                        :href="route('subscriptions.index')"
                        class="flex gap-2 flex-row items-center"
                        ><UsersRound class="w-4" /><span
                            >Subscriptions</span
                        ></Link
                    >
                </li>
                <li
                    @click="closeMenu"
                    :class="{
                        'active text-white font-medium bg-red':
                            page.url.startsWith('/admin/pages'),
                        'text-slate-600': page.url.startsWith('/users'),
                    }"
                    class="px-5 py-2"
                >
                    <Link
                        :href="route('users.index')"
                        class="flex gap-2 flex-row items-center"
                        ><LayoutPanelTop class="w-4" /><span>Pages</span></Link
                    >
                </li>
                <li class="px-5 py-2">
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        type="button"
                        class="flex gap-2 flex-row items-center uppercase cursor-pointer hover:text-red"
                        ><LogOut class="w-4" /><span>Logout</span></Link
                    >
                </li>
            </ul>
        </div>
    </nav>
</template>

<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import {
    LayoutDashboard,
    Newspaper,
    UsersRound,
    LogOut,
    Images,
    LayoutPanelTop,
    Tickets,
    Plus,
    Image,
} from "lucide-vue-next";

const openMenu = ref(null);

const toggle = (menu) => {
    openMenu.value = openMenu.value === menu ? null : menu;
};

// close all when navigating to a page
const closeMenu = () => {
    openMenu.value = null;
};

const page = usePage();
</script>

<style></style>
