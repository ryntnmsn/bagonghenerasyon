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
    articleCategories: Object,
    searchTerm: String,
});

const search = ref(props.searchTerm);

function destroy(id) {
    if (confirm("Are you sure you want to delete this record?")) {
        form.delete(route("article_categories.destroy", { id }), {
            preserveScroll: true,
        });
    }
}

watch(
    search,
    debounce(
        (q) =>
            router.get(
                "/admin/articles/categories",
                { search: q },
                { preserveState: true }
            ),
        100
    )
);
</script>

<template>
    <Head title="Articles"></Head>
    <Title>Article Categories</Title>
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
            <div class="flex flex-1 justify-end gap-3">
                <Link
                    :href="route('article_categories.index')"
                    class="btn-secondary"
                    >Refresh</Link
                >
                <Link :href="route('article_categories.create')" class="btn"
                    >Create new</Link
                >
            </div>
        </div>

        <div class="mt-4">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="category in articleCategories.data"
                        :key="category.id"
                    >
                        <td>{{ category.title }}</td>
                        <td>
                            <div class="flex gap-2 justify-end">
                                <TableEditButton
                                    :href="
                                        route(
                                            'article_categories.edit',
                                            category.id
                                        )
                                    "
                                />

                                <TableDeleteButton
                                    @click="destroy(category.id)"
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <PaginationLinks :paginator="articleCategories" />
            </div>
        </div>
    </div>
</template>

<style></style>
