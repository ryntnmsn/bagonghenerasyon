<script setup>
import Title from "../../../Layouts/Components/Admin/Title.vue";
import PaginationLinks from "../../../../components/PaginationLinks.vue";
import TableEditButton from "../../../../components/TableEditButton.vue";
import TableDeleteButton from "../../../../components/TableDeleteButton.vue";
import { Search } from "lucide-vue-next";
import { router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { debounce } from "lodash";

const form = useForm({});

const props = defineProps({
    subscriptions: Object,
    searchTerm: String,
});

const search = ref(props.searchTerm);

watch(
    search,
    debounce(
        (q) =>
            router.get(
                "/admin/subscriptions",
                { search: q },
                { preserveState: true }
            ),
        100
    )
);
</script>

<template>
    <Head title="Subscriptions"></Head>
    <Title>Subscriptions</Title>
    <div class="p-10 bg-white mt-4 rounded-md w-[1000px]">
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
        </div>

        <div class="mt-4">
            <table>
                <thead>
                    <tr>
                        <th class="!text-left">Email</th>
                        <th>Date registered</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="subscription in subscriptions.data"
                        :key="subscription.id"
                    >
                        <td class="!text-left">{{ subscription.email }}</td>
                        <td>
                            {{
                                new Date(
                                    subscription.created_at
                                ).toLocaleDateString()
                            }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <PaginationLinks :paginator="subscriptions" />
            </div>
        </div>
    </div>
</template>

<style></style>
