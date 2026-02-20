<template>
    <Head title="Media"></Head>
    <PageTitle name="BHPL50 - Selfies" />

    <div class="w-full max-w-[1400px] mx-auto mt-5 md:mt-10 mb-10">
        <div class="px-4">
            <div
                class="columns-1 md:columns-2 xl:columns-3 gap-6 mt-5 space-y-6"
            >
                <img
                    v-for="(image, index) in images"
                    :key="index"
                    :src="`/${image}`"
                    class="w-full rounded-lg shadow-md hover:scale-105 transition cursor-pointer"
                    @click="openLightbox(index)"
                />
            </div>
        </div>
    </div>

    <!-- LIGHTBOX -->
    <transition name="fade">
        <div
            v-if="currentIndex !== null"
            class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center"
            @click.self="closeLightbox"
        >
            <!-- Previous -->
            <button
                class="absolute left-5 text-white text-5xl p-2 hover:opacity-70"
                @click.stop="prevImage"
            >
                ‹
            </button>

            <!-- Image -->
            <img
                :src="`/${images[currentIndex]}`"
                class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg"
            />

            <!-- Next -->
            <button
                class="absolute right-5 text-white text-5xl p-2 hover:opacity-70"
                @click.stop="nextImage"
            >
                ›
            </button>

            <!-- Close -->
            <button
                class="absolute top-5 right-5 text-white text-4xl"
                @click="closeLightbox"
            >
                ×
            </button>
        </div>
    </transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import PageTitle from "../Layouts/Components/FrontEnd/PageTitle.vue";

const props = defineProps({
    images: Array,
});

const currentIndex = ref(null);

const openLightbox = (index) => {
    currentIndex.value = index;
    document.body.classList.add("overflow-hidden");
};

const closeLightbox = () => {
    currentIndex.value = null;
    document.body.classList.remove("overflow-hidden");
};

const nextImage = () => {
    currentIndex.value = (currentIndex.value + 1) % props.images.length;
};

const prevImage = () => {
    currentIndex.value =
        (currentIndex.value - 1 + props.images.length) % props.images.length;
};

const handleKey = (e) => {
    if (currentIndex.value === null) return;

    if (e.key === "Escape") closeLightbox();
    if (e.key === "ArrowRight") nextImage();
    if (e.key === "ArrowLeft") prevImage();
};

onMounted(() => window.addEventListener("keydown", handleKey));
onUnmounted(() => window.removeEventListener("keydown", handleKey));
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
