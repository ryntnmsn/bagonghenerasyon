<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import Compressor from "compressorjs";
import PageTitle from "../Layouts/Components/FrontEnd/PageTitle.vue";

const fileInput = ref(null);

const previews = ref([]);

const form = useForm({
    images: [],
});

const handleImages = (event) => {
    const files = Array.from(event.target.files);

    files.forEach((file) => {
        new Compressor(file, {
            quality: 0.6,
            maxWidth: 1920,
            success(result) {
                form.images.push(result);

                // Preview
                const reader = new FileReader();
                reader.onload = (e) => previews.value.push(e.target.result);
                reader.readAsDataURL(result);
            },
        });
    });

    event.target.value = null;
};

const removeImage = (index) => {
    previews.value.splice(index, 1);
    form.images.splice(index, 1);
};

const submit = () => {
    form.post(route("selfieStore"), {
        forceFormData: true,
        onSuccess: () => {
            alert("Images uploaded successfully!");
            form.reset();
            previews.value = [];
        },
    });
};
</script>
<style>
#selectBtn,
#uploadBtn {
    padding: 20px 40px;
}

#uploadBtn {
}
</style>

<template>
    <Head title="Media"></Head>
    <PageTitle name="Upload Your Selfies" />
    <div class="w-full max-w-[1400px] mx-auto mt-5 md:mt-10 mb-10">
        <div class="px-4">
            <div
                class="p-10 bg-white mt-4 rounded-md w-full mx-auto text-center"
            >
                <div>
                    <form
                        @submit.prevent="submit"
                        class="mx-auto flex flex-col"
                    >
                        <!-- Hidden file input -->
                        <input
                            ref="fileInput"
                            type="file"
                            multiple
                            accept="image/*"
                            @change="handleImages"
                            class="hidden"
                        />

                        <!-- Custom button to trigger file input -->
                        <button
                            id="selectBtn"
                            type="button"
                            @click="fileInput.click()"
                            class="hover:bg-red-500 hover:text-white hover:border-red-200 ease-in-out duration-500 cursor-pointer border border-red text-center text-red bg-red-50 font-medium px-4 py-4 rounded-md flex justify-center text-lg"
                        >
                            SELECT IMAGES
                        </button>

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4"
                        >
                            <div
                                v-for="(preview, index) in previews"
                                :key="index"
                                class="relative group duration-400 hover:-translate-y-2"
                            >
                                <img
                                    :src="preview"
                                    class="rounded-md shadow w-full min-w-[300px] h-[300px] object-cover group-hover:opacity-[.5]"
                                />

                                <!-- Remove button -->
                                <button
                                    type="button"
                                    @click="removeImage(index)"
                                    class="cursor-pointer absolute top-1 right-1 bg-red-600 text-white text-xs px-2 py-1 rounded-full group-hover:bg-rose-700"
                                >
                                    ✕
                                </button>
                            </div>
                        </div>

                        <div
                            v-if="previews.length > 0"
                            class="flex gap-2 mt-6 w-full justify-center"
                        >
                            <button
                                id="uploadBtn"
                                type="submit"
                                class="btn w-full text-center text-white rounded flex justify-center"
                                :disabled="form.processing"
                            >
                                UPLOAD
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style></style>
