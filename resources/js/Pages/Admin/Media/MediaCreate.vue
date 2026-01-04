<script setup>
import Title from "../../../Layouts/Components/Admin/Title.vue";
import InputText from "../../../../components/InputText.vue";
import Textarea from "../../../../components/Textarea.vue";
import SelectOption from "../../../../components/SelectOption.vue";
import { useForm } from "@inertiajs/vue3";
import Compressor from "compressorjs";
import { ref } from "vue";

const previews = ref([]);

defineProps({
    status: {
        type: Array,
        default: () => [
            { id: 0, title: "Draft" },
            { id: 1, title: "Active" },
        ],
    },
});

const form = useForm({
    title: "",
    description: "",
    status: 0,
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

function submit() {
    form.post(route("media.store"), {
        onSuccess: () => form.reset("title", "description", "status", "images"),
    });
}
</script>

<template>
    <Head title="Media"></Head>
    <Title>Create media</Title>
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

                <input
                    id="images"
                    type="file"
                    multiple
                    accept="image/*"
                    @change="handleImages"
                    class="border px-4 py-2 rounded-md border-gray-300 mb-2"
                />

                <div class="grid grid-cols-3 gap-4 mt-4">
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

                <div class="flex gap-2 mt-6">
                    <button
                        type="submit"
                        class="btn"
                        :disabled="form.processing"
                    >
                        Create
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
