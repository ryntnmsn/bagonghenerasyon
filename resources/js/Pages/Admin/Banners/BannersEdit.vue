<script setup>
import Title from "../../../Layouts/Components/Admin/Title.vue";
import InputText from "../../../../components/InputText.vue";
import { useForm } from "@inertiajs/vue3";
import SelectOption from "../../../../components/SelectOption.vue";

const props = defineProps({
    banner: Object,
    status: {
        type: Array,
        default: () => [
            { id: 0, title: "Inactive" },
            { id: 1, title: "Active" },
        ],
    },
});

const form = useForm({
    _method: "put",
    title: props.banner.title,
    start_date: props.banner.start_date,
    end_date: props.banner.end_date,
    status: props.banner.status,
    image: null,
    preview: props.banner.image_url,
});

const submit = () => {
    form.post(route("banners.update", props.banner.id), {
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
    <Title>Edit banner</Title>
    <div class="p-10 bg-white mt-4 rounded-md w-[1200px]">
        <div>
            <form @submit.prevent="submit">
                <InputText
                    v-model="form.title"
                    name="Title"
                    type="text"
                    :message="form.errors.title"
                />

                <div class="flex gap-5">
                    <InputText
                        v-model="form.start_date"
                        name="Start date"
                        type="date"
                        :message="form.errors.start_date"
                        class="flex-1"
                    />

                    <InputText
                        v-model="form.end_date"
                        name="End date"
                        type="date"
                        :message="form.errors.end_date"
                        class="flex-1"
                    />
                </div>

                <SelectOption
                    name="Status"
                    label="status"
                    v-model="form.status"
                    :options="status"
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
                            :src="form.preview || '/storage/images/default.jpg'"
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
                    <Link class="btn-secondary" :href="route('banners.index')"
                        >Cancel</Link
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<style></style>
