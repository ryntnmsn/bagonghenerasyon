<script setup>
import Title from "../../../Layouts/Components/Admin/Title.vue";
import InputText from "../../../../components/InputText.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, watch } from "vue";
import SelectOption from "../../../../components/SelectOption.vue";
import dayjs from "dayjs";

const gender = [
    { id: "male", title: "Male" },
    { id: "female", title: "Female" },
];

const user_type = [
    { id: "user", title: "User" },
    { id: "admin", title: "Admin" },
];

const change = (e) => {
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
};

const form = useForm({
    first_name: "",
    last_name: "",
    phone_number: "",
    email: "",
    birth_date: "",
    age: "",
    username: "",
    gender: "",
    user_type: "",
    password: "",
    password_confirmation: "",
    avatar: null,
    preview: null,
});

function submit() {
    form.post(route("users.store"), {
        onSuccess: () => form.reset(),
    });
}

const age = computed(() => {
    if (!form.birth_date) return "";
    const today = dayjs();
    const birth = dayjs(form.birth_date);
    return today.diff(birth, "year");
});

watch(age, (val) => {
    form.age = val;
});
</script>

<template>
    <Head title="Users"></Head>
    <Title>Create User</Title>
    <div class="p-10 bg-white mt-4 rounded-md w-[800px]">
        <div>
            <form @submit.prevent="submit">
                <!-- Upload Avatar -->
                <div
                    class="flex flex-col justify-center align-middle border-2 border-dashed border-gray-200 py-5 bg-gray-50 mb-6"
                >
                    <div class="flex justify-center align-middle">
                        <div
                            class="relative w-[260px] h-[260px] rounded-full overflow-hidden border-2 border-gray-100 hover:bg-gray-100 ease-in-out duration-400"
                        >
                            <img
                                class="w-full h-full object-cover"
                                :src="
                                    form.preview ||
                                    '/storage/images/default-user.jpg'
                                "
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
                                @input="change"
                                hidden
                            />
                        </div>
                    </div>
                    <div class="text-center">
                        <small class="text-red text-[12px]">
                            {{ form.errors.avatar }}</small
                        >
                    </div>
                </div>

                <div class="flex gap-3">
                    <InputText
                        v-model="form.first_name"
                        name="Firstname"
                        type="text"
                        class="w-full"
                        :message="form.errors.first_name"
                    />
                    <InputText
                        v-model="form.last_name"
                        name="Lastname"
                        type="text"
                        class="w-full"
                        :message="form.errors.last_name"
                    />
                </div>

                <InputText
                    v-model="form.email"
                    name="Email"
                    type="text"
                    class="w-full"
                    :message="form.errors.email"
                />

                <InputText
                    v-model="form.phone_number"
                    name="Phone number"
                    type="text"
                    class="w-full"
                    :message="form.errors.phone_number"
                />

                <InputText
                    v-model="form.birth_date"
                    name="Birth Date"
                    type="date"
                    class="w-full"
                    :message="form.errors.birth_date"
                    :max="dayjs().subtract(3, 'year').format('YYYY-MM-DD')"
                />

                <InputText
                    v-model="form.age"
                    name="age"
                    type="text"
                    class="w-full"
                    :message="form.errors.age"
                    readonly
                />

                <SelectOption
                    name="Gender"
                    label="gender"
                    v-model="form.gender"
                    :options="gender"
                    :message="form.errors.gender"
                />

                <SelectOption
                    name="User Type"
                    label="user type"
                    v-model="form.user_type"
                    :options="user_type"
                    :message="form.errors.user_type"
                />

                <InputText
                    v-model="form.username"
                    name="Username"
                    type="text"
                    class="w-full"
                    :message="form.errors.username"
                />

                <InputText
                    v-model="form.password"
                    name="Password"
                    type="password"
                    class="w-full"
                    :message="form.errors.password"
                />

                <InputText
                    v-model="form.password_confirmation"
                    name="Confirm Password"
                    type="password"
                    class="w-full"
                    :message="form.errors.password_confirmation"
                />

                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="btn"
                        :disabled="form.processing"
                    >
                        Create
                    </button>
                    <Link class="btn-secondary" :href="route('users.index')"
                        >Cancel</Link
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<style></style>
