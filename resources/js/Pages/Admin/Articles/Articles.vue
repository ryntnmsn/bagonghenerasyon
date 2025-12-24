<script setup>
import Title from "../../../Layouts/Components/Title.vue";
import PaginationLinks from "../../../../components/PaginationLinks.vue";
import TableEditButton from "../../../../components/TableEditButton.vue";
import TableDeleteButton from "../../../../components/TableDeleteButton.vue";
import { Search } from "lucide-vue-next";
import { router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { debounce } from "lodash";

const form = useForm({});

const props = defineProps({
    articles: Object,
    searchTerm: String,
});

const search = ref(props.searchTerm);

function destroy(id) {
    if (confirm("Are you sure you want to delete this record?")) {
        form.delete(route("articles.destroy", { id }), {
            preserveScroll: true,
        });
    }
}

watch(
    search,
    debounce(
        (q) =>
            router.get(
                "/admin/articles/",
                { search: q },
                { preserveState: true }
            ),
        100
    )
);

const truncate = (text, max = 50) => {
    if (!text) return "";
    return text.length > max ? text.substring(0, max) + "..." : text;
};
</script>

<template>
    <Head title="Articles"></Head>
    <Title>Articles</Title>
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
                <Link :href="route('articles.index')" class="btn-secondary"
                    >Refresh</Link
                >
                <Link :href="route('articles.create')" class="btn"
                    >Create new</Link
                >
            </div>
        </div>

        <div class="mt-4">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Created by</th>
                        <th>Date created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="article in articles.data" :key="article.id">
                        <td>{{ truncate(article.title, 70) }}</td>
                        <td>{{ article.category?.title }}</td>
                        <td>{{ article.type.title }}</td>
                        <td>
                            {{ article.user?.first_name }}
                            {{ article.user?.last_name }}
                        </td>
                        <td>
                            {{
                                new Date(
                                    article.created_at
                                ).toLocaleDateString()
                            }}
                        </td>
                        <td>
                            <div
                                :class="
                                    article.status === 1
                                        ? 'text-green-500 bg-green-50'
                                        : 'text-rose-500 bg-rose-50'
                                "
                                class="rounded-full text-sm font-medium text-center py-1 w-[68px]"
                            >
                                {{ article.status === 1 ? "Active" : "Draft" }}
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2 justify-end">
                                <TableEditButton
                                    :href="route('articles.edit', article.id)"
                                />

                                <TableDeleteButton
                                    @click="destroy(article.id)"
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <PaginationLinks :paginator="articles" />
            </div>
        </div>
    </div>
</template>

<style></style>
