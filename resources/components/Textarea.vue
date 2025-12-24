<template>
    <div class="mb-6 flex flex-col group">
        <label
            class="text-gray-700 font-medium mb-1 group-focus-within:text-red duration-400 ease-in-out"
            >{{ name }}</label
        >
        <textarea
            v-bind="$attrs"
            v-model="model"
            class="border-2 outline-none text-gray-800 border-gray-100 bg-gray-50 w-full p-2 text-base rounded-md duration-400 ease-in-out focus:border-red ring-0 focus:bg-white h-[100px]"
        ></textarea>
        <small class="text-red mt-1 text-[12px]" v-if="message">{{
            message
        }}</small>
    </div>
</template>

<script setup>
const model = defineModel({
    type: null,
    required: true,
});

defineProps({
    name: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    message: String,
});
</script>

<style></style>
