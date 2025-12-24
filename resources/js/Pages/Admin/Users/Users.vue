<script setup>
import Title from "../../../Layouts/Components/Title.vue";
import PaginationLinks from "../../../../components/PaginationLinks.vue";
import TableDeleteButton from "../../../../components/TableDeleteButton.vue";
import TableEditButton from "../../../../components/TableEditButton.vue";
import TableShowButton from "../../../../components/TableShowButton.vue";
import { Search } from "lucide-vue-next";
import { router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { debounce } from "lodash";

const form = useForm({});

const props = defineProps({
    users: Object,
    searchTerm: String,
});

const search = ref(props.searchTerm);

watch(
    search,
    debounce(
        (q) =>
            router.get("/admin/users/", { search: q }, { preserveState: true }),
        100
    )
);
</script>

<template>
    <Head title="Users"></Head>
    <Title>Users</Title>
    <div class="p-10 bg-white mt-4 rounded-md w-full">
        <div class="flex items-center justify-between gap-20">
            <div class="flex-1">
                <div class="relative flex items-center w-full">
                    <div class="absolute ps-2">
                        <Search class="w-5 h-5 text-slate-500" />
                    </div>
                    <div class="w-full">
                        <input
                            type="search"
                            class="w-full border-2 outline-none text-gray-800 border-gray-100 bg-gray-50 p-2 ps-8 text-base rounded-md duration-400 ease-in-out focus:border-red ring-0 focus:bg-white"
                            placeholder="Search"
                            v-model="search"
                        />
                    </div>
                </div>
            </div>
            <div class="flex flex-1 justify-end gap-3">
                <Link :href="route('users.index')" class="btn-secondary"
                    >Refresh</Link
                >
                <Link :href="route('users.create')" class="btn"
                    >Create new</Link
                >
            </div>
        </div>

        <div class="mt-4">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>User type</th>
                        <th>Date registered</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                        <td class="capitalize">
                            <div class="flex gap-2">
                                <span
                                    class="border border-gray-200 rounded-full p-1"
                                >
                                    <img
                                        :src="
                                            user.avatar
                                                ? `/storage/${user.avatar}`
                                                : '/storage/images/default-user.jpg'
                                        "
                                        alt=""
                                        class="w-[18px] h-[18px] rounded-full"
                                    />
                                </span>
                                <span>
                                    {{ user.last_name }}, {{ user.first_name }}
                                </span>
                            </div>
                        </td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.phone_number }}</td>
                        <td class="capitalize">{{ user.gender }}</td>
                        <td class="capitalize">{{ user.user_type }}</td>
                        <td>
                            {{ new Date(user.created_at).toLocaleDateString() }}
                        </td>
                        <td>
                            <div class="flex gap-2 justify-end">
                                <TableShowButton
                                    :href="route('users.show', user.id)"
                                />
                                <TableEditButton
                                    :href="route('users.edit', user.id)"
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <PaginationLinks :paginator="users" />
            </div>
        </div>
    </div>
</template>

<style></style>
