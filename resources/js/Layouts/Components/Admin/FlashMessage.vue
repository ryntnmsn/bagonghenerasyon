<!-- resources/js/Components/FlashMessage.vue -->
<template>
    <div v-if="show" :class="['flash-message', typeClass]">
        {{ message }}
        <button @click="hideMessage" class="close-btn">&times;</button>
    </div>
</template>

<script setup>
import { ref, watch, computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const show = ref(false);
const message = ref("");
const type = ref("success");
let timeoutId = null;

watch(
    () => page.props.flash,
    (newFlash) => {
        if (newFlash.success || newFlash.error) {
            message.value = newFlash.success || newFlash.error;
            type.value = newFlash.success ? "success" : "error";
            show.value = true;

            if (timeoutId) {
                clearTimeout(timeoutId);
            }

            timeoutId = setTimeout(() => {
                hideMessage();
            }, 5000);
        }
    },
    { deep: true }
);

const hideMessage = () => {
    show.value = false;
};

const typeClass = computed(() => {
    if (type.value === "success")
        return "bg-green-100 text-green-700 border border-green-200 rounded-md";
    if (type.value === "error") return "bg-rose-100 text-rose-700";
    return "bg-blue-500 text-white"; // Default
});
</script>

<style scoped>
.flash-message {
    padding: 1rem;
    position: fixed;
    bottom: 1rem;
    right: 1rem;
    z-index: 9999;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.close-btn {
    margin-left: 1rem;
    cursor: pointer;
    background: none;
    border: none;
    color: inherit;
    font-size: 1.5rem;
}
</style>
