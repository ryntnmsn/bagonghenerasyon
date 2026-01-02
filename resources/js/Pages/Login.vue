<template>
    <Head title="Login" />
    <PageTitle name="Login" />
    <div
        class="w-full max-w-[650px] mx-auto my-20 px-15 py-10 bg-white rounded-lg"
    >
        <div class="flex flex-col justify-center">
            <h2 class="font-bold text-3xl text-red mb-2">Login</h2>
            <SecondaryText
                >Enter your credentials to login to your account.</SecondaryText
            >

            <form @submit.prevent="submit" class="mt-6">
                <InputText
                    name="Username"
                    type="text"
                    v-model="form.username"
                    :message="form.errors.username"
                />

                <InputText
                    name="Password"
                    type="password"
                    v-model="form.password"
                    :message="form.errors.password"
                />
                <div class="mb-6">
                    <div class="flex gap-2 items-center">
                        <input
                            type="checkbox"
                            name="remember"
                            v-model="form.remember"
                            class="border appearance-none rounded-sm h-4 w-4 cursor-pointer border-gray-300 text-red outline-none focus:ring-1 ring-red checked:bg-red transition duration-300 ease-in-out"
                        />
                        <label for="remember_me" class="text-gray-800"
                            >Remember me</label
                        >
                    </div>
                </div>
                <button class="btn" :disabled="form.processing">Submit</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthLayout from "../Layouts/AuthLayout.vue";
import SecondaryText from "../../components/SecondaryText.vue";
import InputText from "../../components/InputText.vue";
import ButtonPrimary from "../../components/ButtonPrimary.vue";
import PageTitle from "../Layouts/Components/FrontEnd/PageTitle.vue";

// defineOptions({ layout: AuthLayout });

const form = useForm({
    username: null,
    password: null,
    remember: null,
});

const submit = () => {
    form.post(route("auth.login"), {
        onError: () => form.reset("password", "remember"),
    });
};
</script>

<style></style>
