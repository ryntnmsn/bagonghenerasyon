<template>
    <header class="w-full p-5 bg-white flex items-center">
        <div class="w-[280px]">
            <h1 class="text-xl flex gap-2">
                <span class="font-bold text-red"> BHPL Admin</span>
            </h1>
        </div>
        <div class="w-1/2">
            <div class="relative flex items-center w-full">
                <div class="absolute ps-2">
                    <Search class="w-5 h-5 text-slate-500" />
                </div>
                <div class="w-full">
                    <input
                        type="search"
                        class="w-full border-2 outline-none text-gray-800 border-gray-100 bg-gray-50 p-2 ps-8 text-base rounded-md duration-400 ease-in-out focus:border-red ring-0 focus:bg-white"
                        placeholder="Global search"
                        v-model="search"
                    />
                </div>
            </div>
        </div>
        <div class="flex justify-end flex-1">
            <p class="flex flex-row gap-1">
                <span class="text-slate-500 text-sm">Welcome back</span>
                <span class="text-slate-500 text-sm font-medium">{{
                    props.auth.user.first_name
                }}</span>
            </p>
        </div>
    </header>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import InputText from "../../../../components/InputText.vue";
import { Search } from "lucide-vue-next";
const { props } = usePage();
</script>

<style></style>
