<template>
    <div class="mb-6 flex flex-col group">
        <label
            class="text-gray-700 font-medium mb-1 group-focus-within:text-red duration-400 ease-in-out"
            >{{ name }}</label
        >
        <select
            :id="id"
            v-model="model"
            class="border-2 outline-none text-gray-800 border-gray-100 bg-gray-50 w-full py-2.5 px-2 text-base rounded-md duration-400 ease-in-out focus:border-red ring-0 focus:bg-white"
        >
            <option value="" disabled>Select {{ label }}</option>

            <option v-for="item in options" :key="item.id" :value="item.id">
                {{ item.title }}
            </option>
        </select>
        <div>
            <small class="text-red mt-1 text-[12px]" v-if="message">{{
                message
            }}</small>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    id: String,
    title: String,
    name: String,
    label: String,
    modelValue: [String, Number],
    options: Array,
    message: String,
});

const emit = defineEmits(["update:modelValue"]);

const model = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});
</script>
