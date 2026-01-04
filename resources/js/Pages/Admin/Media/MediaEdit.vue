<script setup>
import Title from "../../../Layouts/Components/Admin/Title.vue";
import InputText from "../../../../components/InputText.vue";
import Textarea from "../../../../components/Textarea.vue";
import SelectOption from "../../../../components/SelectOption.vue";
import { useForm } from "@inertiajs/vue3";
import Compressor from "compressorjs";
import { ref } from "vue";

const props = defineProps({
    media: Object,
    status: {
        type: Array,
        default: () => [
            { id: 0, title: "Draft" },
            { id: 1, title: "Active" },
        ],
    },
});

const existingImages = ref([...props.media.images]);
const previews = ref([]);

const form = useForm({
    _method: "put",
    title: props.media.title,
    description: props.media.description,
    status: props.media.status,
    images: [],
    removed_images: [],
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

const removeExisting = (index) => {
    form.removed_images.push(existingImages.value[index]);
    existingImages.value.splice(index, 1);
};

const removeNew = (index) => {
    previews.value.splice(index, 1);
    form.images.splice(index, 1);
};

function submit() {
    form.post(route("media.update", props.media.id), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset("image");
        },
    });
}
</script>

<template>
    <Head title="Media"></Head>
    <Title>Update media</Title>
    <div class="p-10 bg-white mt-4 rounded-md w-[1080px]">
        <div>
            <form @submit.prevent="submit">
                <InputText
                    v-model="form.title"
                    name="Title"
                    type="text"
                    :message="form.errors.title"
                />

                <Textarea
                    v-model="form.description"
                    name="Description (Optional)"
                    :message="form.errors.description"
                />

                <SelectOption
                    name="Status"
                    label="status"
                    v-model="form.status"
                    :options="status"
                    :message="form.errors.status"
                />

                <!-- <input
                    id="images"
                    type="file"
                    multiple
                    accept="image/*"
                    @change="handleImages"
                    class="border px-4 py-2 rounded-md border-gray-300 mb-2"
                /> -->

                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div
                        v-for="(img, i) in existingImages"
                        :key="i"
                        class="relative group duration-400 hover:-translate-y-2"
                    >
                        <img
                            :src="`/storage/${img}`"
                            class="rounded-md shadow w-full min-w-[300px] h-[300px] object-cover group-hover:opacity-[.5]"
                        />

                        <!-- Remove button -->
                        <button
                            type="button"
                            @click="removeExisting(i)"
                            class="cursor-pointer absolute top-1 right-1 bg-red-600 text-white text-xs px-2 py-1 rounded-full group-hover:bg-rose-700"
                        >
                            ✕
                        </button>
                    </div>
                </div>

                <!-- New Images -->
                <h3 class="font-semibold mt-6 mb-2">New Images</h3>
                <input
                    type="file"
                    multiple
                    accept="image/*"
                    @change="handleImages"
                    class="border px-4 py-2 rounded-md border-gray-300 mb-2"
                />

                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div
                        v-for="(img, i) in previews"
                        :key="i"
                        class="relative group duration-400 hover:-translate-y-2"
                    >
                        <img
                            :src="img"
                            class="rounded-md shadow w-full min-w-[300px] h-[300px] object-cover group-hover:opacity-[.5]"
                        />
                        <button
                            @click="removeNew(i)"
                            class="cursor-pointer absolute top-1 right-1 bg-red-600 text-white text-xs px-2 py-1 rounded-full group-hover:bg-rose-700"
                        >
                            ✕
                        </button>
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <button
                        @click="submit"
                        type="submit"
                        class="btn"
                        :disabled="form.processing"
                    >
                        Update
                    </button>
                    <Link class="btn-secondary" :href="route('media.index')"
                        >Cancel</Link
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<style></style>
