<template>
    <Header />
    <main>
        <slot> </slot>
    </main>
    <Footer />
</template>

<script setup>
import Header from "./Components/FrontEnd/Header.vue";
import Footer from "./Components/FrontEnd/Footer.vue";
</script>

<style></style>
