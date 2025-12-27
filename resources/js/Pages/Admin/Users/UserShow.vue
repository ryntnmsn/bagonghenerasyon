<script setup>
import Title from "../../../Layouts/Components/Admin/Title.vue";
import dayjs from "dayjs";

const props = defineProps({
    user: Object,
});
</script>

<template>
    <Head title="Users"></Head>
    <Title>View User</Title>
    <div class="p-10 bg-white mt-4 rounded-md w-[1080px]">
        <div class="flex gap-5">
            <div>
                <img
                    :src="
                        user.avatar
                            ? `/storage/${user.avatar}`
                            : '/storage/images/default-user.jpg'
                    "
                    class="w-[260px] rounded-md border border-gray-200 p-2"
                    alt="Default Avatar"
                />
            </div>
            <div>
                <table>
                    <tr>
                        <td>
                            <span class="font-medium uppercase text-sm"
                                >Name:</span
                            >
                        </td>
                        <td>{{ user.first_name }}, {{ user.last_name }}</td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-medium uppercase text-sm"
                                >Phone:</span
                            >
                        </td>
                        <td>{{ user.phone_number }}</td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-medium uppercase text-sm"
                                >Email:</span
                            >
                        </td>
                        <td>{{ user.email }}</td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-medium uppercase text-sm"
                                >Gender:</span
                            >
                        </td>
                        <td>{{ user.gender }}</td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-medium uppercase text-sm"
                                >Birthdate:</span
                            >
                        </td>
                        <td>
                            {{ dayjs(user.birth_date).format("MMMM D, YYYY") }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-medium uppercase text-sm"
                                >Username:</span
                            >
                        </td>
                        <td>
                            {{ user.username }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-medium uppercase text-sm"
                                >Registered IP address:</span
                            >
                        </td>
                        <td>
                            {{ user.ip }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<style></style>
