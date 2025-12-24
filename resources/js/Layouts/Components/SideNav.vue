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

                <li
                    @click="toggle('articles')"
                    :class="{
                        'active text-white font-medium bg-red':
                            page.url.startsWith('/admin/articles'),
                        'text-slate-600': page.url.startsWith('/articles'),
                    }"
                    class="px-5 py-2"
                >
                    <Link
                        :href="route('articles.index')"
                        class="flex gap-2 flex-row items-center"
                        ><Newspaper class="w-4" /><span>articles</span></Link
                    >
                </li>

                <li>
                    <ul
                        v-show="openMenu === 'articles'"
                        class="px-5 py-2 bg-red-50"
                    >
                        <li class="py-2 px-2">
                            <Link :href="route('articles.index')"
                                >All Articles</Link
                            >
                        </li>
                        <li class="py-2 px-2">
                            <Link :href="route('articles.create')"
                                >Create Articles</Link
                            >
                        </li>
                        <li class="py-2 px-2">
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
                        'text-slate-600': page.url.startsWith('/users'),
                    }"
                    class="px-5 py-2"
                >
                    <Link
                        :href="route('users.index')"
                        class="flex gap-2 flex-row items-center"
                        ><Tickets class="w-4" /><span>Tickets</span></Link
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
                        :href="route('users.index')"
                        class="flex gap-2 flex-row items-center"
                        ><Images class="w-4" /><span>Banners</span></Link
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
