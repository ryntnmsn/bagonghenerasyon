<script setup>
import Title from "../../../Layouts/Components/Title.vue";
import InputText from "../../../../components/InputText.vue";
import Textarea from "../../../../components/Textarea.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    articleCategories: Object,
});

const form = useForm({
    title: props.articleCategories.title,
    description: props.articleCategories.description,
});

function submit() {
    form.put(route("article_categories.update", props.articleCategories.id), {
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <Head title="Articles"></Head>
    <Title>Edit article category</Title>
    <div class="p-10 bg-white mt-4 rounded-md w-[600px]">
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
                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="btn"
                        :disabled="form.processing"
                    >
                        Update
                    </button>
                    <Link
                        class="btn-secondary"
                        :href="route('article_categories.index')"
                        >Cancel</Link
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<style></style>
