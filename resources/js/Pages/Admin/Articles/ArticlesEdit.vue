<script setup>
import Title from "../../../Layouts/Components/Title.vue";
import InputText from "../../../../components/InputText.vue";
import Textarea from "../../../../components/Textarea.vue";
import TiptapEditor from "../../../../components/TiptapEditor.vue";
import { useForm } from "@inertiajs/vue3";
import SelectOption from "../../../../components/SelectOption.vue";

const props = defineProps({
    article: Object,
    articleCategories: Array,
    articleTypes: Array,
    articleStatus: {
        type: Array,
        default: () => [
            { id: 0, title: "Draft" },
            { id: 1, title: "Active" },
        ],
    },
});

const form = useForm({
    _method: "put",
    title: props.article.title,
    description: props.article.description,
    short_description: props.article.short_description,
    article_category_id: props.article.article_category_id,
    article_type_id: props.article.article_type_id,
    status: props.article.status,
    image: null,
    preview: props.article.image_url,
});

// Submit form
const submit = () => {
    form.post(route("articles.update", props.article.id), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset("image");
        },
    });
};

// Handle file selection
function handleImageChange(e) {
    form.image = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
}
</script>

<template>
    <Head title="Create articles"></Head>
    <Title>Edit article</Title>
    <div class="p-10 bg-white mt-4 rounded-md w-[1200px]">
        <div>
            <form @submit.prevent="submit">
                <InputText
                    v-model="form.title"
                    name="Title"
                    type="text"
                    :message="form.errors.title"
                />

                <TiptapEditor
                    v-model="form.description"
                    name="Description"
                    :message="form.errors.description"
                />

                <Textarea
                    v-model="form.short_description"
                    name="Short Description"
                    :message="form.errors.short_description"
                />

                <SelectOption
                    name="Category"
                    label="category"
                    v-model="form.article_category_id"
                    :options="articleCategories"
                    :message="form.errors.article_category_id"
                />

                <SelectOption
                    name="Type"
                    label="type"
                    v-model="form.article_type_id"
                    :options="articleTypes"
                    :message="form.errors.article_type_id"
                />

                <SelectOption
                    name="Status"
                    label="status"
                    v-model="form.status"
                    :options="articleStatus"
                    :message="form.errors.status"
                />

                <!-- Upload Image -->
                <div class="mb-6">
                    <label
                        class="text-gray-700 font-medium mb-1 group-focus-within:text-red duration-400 ease-in-out"
                        >Image</label
                    >
                    <div
                        class="relative w-[380px] h-[200px] rounded-md overflow-hidden border-2 border-gray-100 hover:bg-gray-100 ease-in-out duration-400"
                    >
                        <img
                            class="w-full h-full object-cover"
                            :src="form.preview ?? '/storage/images/default.jpg'"
                        />
                        <label
                            for="image"
                            class="absolute z-10 top-0 left-0 right-0 bottom-0 flex items-center justify-center cursor-pointer h-full w-full hover:bg-gray-50 ease-in-out duration-400"
                        >
                            <span
                                class="text-slate-500 font-medium p-3 bg-gray-200 hover:bg-gray-300 rounded-md"
                                >Click to upload</span
                            ></label
                        >
                        <input
                            id="image"
                            type="file"
                            @input="handleImageChange"
                            hidden
                        />
                    </div>

                    <small class="text-red mt-1 text-[12px]">
                        {{ form.errors.image }}</small
                    >
                </div>

                <div class="flex gap-2 mt-4">
                    <button
                        type="submit"
                        class="btn"
                        :disabled="form.processing"
                    >
                        Update
                    </button>
                    <Link class="btn-secondary" :href="route('articles.index')"
                        >Cancel</Link
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<style></style>
