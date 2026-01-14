<template>
    <Head :title="title">
        <meta name="description" :content="description" />
        <meta
            name="keywords"
            content="Poverty, Empowering Individuals, Healthy, Educated, Empowered Citizenry, Sustainable Programs, Advocacies, Sickness"
        />
        <meta name="author" content="Bagong Henerasyon Partylist" />
        <meta name="robots" content="index, follow" />

        <link rel="canonical" :href="url" />

        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:type" content="website" />
        <meta property="og:url" :content="url" />
        <meta property="og:image" :content="image" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="title" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="image" />
    </Head>
</template>

<script setup>
import { Head, usePage } from "@inertiajs/vue3";
defineProps({
    title: String,
    description: String,
    image: String,
});

const page = usePage();
const url = page.url
    ? `${window.location.origin}${page.url}`
    : window.location.href;
</script>

<style></style>
