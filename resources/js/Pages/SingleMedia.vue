<template>
    <Head title="Media"></Head>
    <PageTitle :name="`${media.title}`" />
    <div class="w-full max-w-[1400px] mx-auto mt-5 md:mt-10 mb-10">
        <div class="px-4">
            <div
                id="selfie"
                v-if="btnSelfie"
                class="py-20 bg-red rounded-xl text-white text-center font-medium text-xl relative"
            >
                <Link
                    :href="route('selfieCreate')"
                    class="absolute top-0 bottom-0 right-0 left-0 flex justify-center items-center"
                    >UPLOAD YOUR SELFIES</Link
                >
            </div>

            <div
                class="columns-1 md:columns-2 xl:columns-3 gap-6 mt-5 space-y-6"
            >
                <div
                    id="selfie"
                    v-if="showSelfie"
                    class="py-30 bg-red rounded-xl text-white text-center font-medium text-xl"
                >
                    <Link :href="route('selfie')" class="block"> SELFIES </Link>
                </div>

                <div
                    v-for="(image, index) in media.images"
                    :key="index"
                    class="break-inside-avoid bg-gray-800 rounded-xl shadow overflow-hidden transition-all duration-300 hover:-translate-y-2 cursor-pointer"
                    @click="openLightbox(index)"
                >
                    <img
                        :src="`/storage/${image}`"
                        class="w-full"
                        alt="Media thumbnail"
                    />
                </div>
            </div>
        </div>
    </div>

    <transition name="fade">
        <div
            v-if="currentIndex !== null"
            class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center"
            @click.self="closeLightbox"
        >
            <button
                class="absolute left-5 text-white text-5xl p-2 hover:opacity-70"
                @click.stop="prevImage"
            >
                ‹
            </button>

            <img
                :src="`/storage/${media.images[currentIndex]}`"
                class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg"
                alt="Full image"
            />

            <button
                class="absolute right-5 text-white text-5xl p-2 hover:opacity-70"
                @click.stop="nextImage"
            >
                ›
            </button>

            <button
                class="absolute top-5 right-5 text-white text-4xl"
                @click="closeLightbox"
            >
                &times;
            </button>
        </div>
    </transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import PageTitle from "../Layouts/Components/FrontEnd/PageTitle.vue";

const showSelfie = ref(false);
const btnSelfie = ref(false);

onMounted(() => {
    const path = window.location.pathname.replace(/\/$/, "");

    if (path === "/media/bh50") {
        showSelfie.value = true;
        btnSelfie.value = true;
    }

    window.addEventListener("keydown", handleKey);
});

const props = defineProps({
    media: Object,
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
    currentIndex.value = (currentIndex.value + 1) % props.media.images.length;
};

const prevImage = () => {
    currentIndex.value =
        (currentIndex.value - 1 + props.media.images.length) %
        props.media.images.length;
};

// Keyboard support
const handleKey = (e) => {
    if (currentIndex.value === null) return;

    if (e.key === "Escape") closeLightbox();
    if (e.key === "ArrowRight") nextImage();
    if (e.key === "ArrowLeft") prevImage();
};

onMounted(() => window.addEventListener("keydown", handleKey));
onUnmounted(() => window.removeEventListener("keydown", handleKey));
</script>

<style></style>
