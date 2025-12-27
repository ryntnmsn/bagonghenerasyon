<script setup>
import SideNav from "./Components/Admin/SideNav.vue";
import Header from "./Components/Admin/Header.vue";
import FlashMessage from "./Components/Admin/FlashMessage.vue";
</script>

<template>
    <div>
        <FlashMessage />
        <div class="w-full">
            <Header></Header>
        </div>
        <div class="flex">
            <div class="min-w-[300px] max-w-[300px]">
                <SideNav></SideNav>
            </div>
            <div class="w-full bg-gray-100">
                <main class="p-10">
                    <slot></slot>
                </main>
            </div>
        </div>
    </div>
</template>

<style></style>
