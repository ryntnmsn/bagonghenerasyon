<script setup>
import Title from "../../../Layouts/Components/Title.vue";
import InputText from "../../../../components/InputText.vue";
import Textarea from "../../../../components/Textarea.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    title: null,
    description: null,
});

function submit() {
    form.post(route("article_categories.store"), {
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <Head title="Articles"></Head>
    <Title>Create article category</Title>
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
                        Create
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
