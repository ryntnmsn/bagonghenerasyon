<template>
    <div class="layout">
        <Header />
        <main>
            <slot> </slot>
        </main>
        <Footer />
    </div>
</template>

<script setup>
import Header from "./Components/FrontEnd/Header.vue";
import Footer from "./Components/FrontEnd/Footer.vue";
</script>

<style scoped>
.layout {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

main {
    flex: 1; /* fills remaining space when content is short */
}
</style>
