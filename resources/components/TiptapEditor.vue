<script setup>
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";

import {
    Bold,
    Italic,
    Strikethrough,
    Pilcrow,
    Heading1,
    Heading2,
    Heading3,
    CircleSmall,
    ListOrdered,
    MessageSquareQuote,
    Undo,
    Redo,
} from "lucide-vue-next";

const props = defineProps({
    modelValue: String,
    name: {
        type: String,
    },
    message: String,
});

const emit = defineEmits(["update:modelValue"]);

const editor = useEditor({
    content: props.modelValue,
    onUpdate: ({ editor }) => {
        // console.log(editor.getHTML());
        emit("update:modelValue", editor.getHTML());
    },
    extensions: [StarterKit],
    editorProps: {
        attributes: {
            class: "border-2 bg-gray-50 border-gray-100 p-2 rounded-b-md min-h-[300px] max-h-[300px] overflow-y-scroll focus:border-red focus:border-2 focus:outline-red prose  max-w-none duration-400 ease-in-out",
        },
    },
});
</script>

<template>
    <div class="mb-6 flex flex-col group">
        <label
            class="text-gray-700 font-medium mb-1 group-focus-within:text-red duration-400 ease-in-out"
            >{{ name }}</label
        >
        <section
            v-if="editor"
            class="rounded-t-md flex items-center flex-wrap gap-x-4 border-2 border-gray-100 p-4 bg-gray-100 group-focus-within:ring-red group-focus-within:ring-0 group-focus-within:bg-rose-50 mb-1"
        >
            <button
                type="button"
                @mousedown.prevent
                @click="editor.chain().focus().toggleBold().run()"
                :disabled="!editor.can().toggleBold()"
                :class="{ 'bg-rose-200 rounded-md': editor.isActive('bold') }"
            >
                <Bold class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="editor.chain().focus().toggleItalic().run()"
                :disabled="!editor.can().toggleItalic()"
                :class="{ 'bg-rose-200 rounded-md': editor.isActive('italic') }"
            >
                <Italic class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="editor.chain().focus().toggleStrike().run()"
                :disabled="!editor.can().toggleStrike()"
                :class="{ 'bg-rose-200 rounded-md': editor.isActive('strike') }"
            >
                <Strikethrough class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="editor.chain().focus().setParagraph().run()"
                :class="{
                    'bg-rose-200 rounded-md': editor.isActive('paragraph'),
                }"
            >
                <Pilcrow class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="
                    editor.chain().focus().toggleHeading({ level: 1 }).run()
                "
                :class="{
                    'bg-rose-200 rounded-md': editor.isActive('heading', {
                        level: 1,
                    }),
                }"
            >
                <Heading1 class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="
                    editor.chain().focus().toggleHeading({ level: 2 }).run()
                "
                :class="{
                    'bg-rose-200 rounded-md': editor.isActive('heading', {
                        level: 2,
                    }),
                }"
            >
                <Heading2 class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="
                    editor.chain().focus().toggleHeading({ level: 3 }).run()
                "
                :class="{
                    'bg-rose-200 rounded-md': editor.isActive('heading', {
                        level: 3,
                    }),
                }"
            >
                <Heading3 class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{
                    'bg-rose-200 rounded-md': editor.isActive('bulletList'),
                }"
            >
                <CircleSmall class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="editor.chain().focus().toggleOrderedList().run()"
                :class="{
                    'bg-rose-200 rounded-md': editor.isActive('orderedList'),
                }"
            >
                <ListOrdered class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="editor.chain().focus().toggleBlockquote().run()"
                :class="{
                    'bg-rose-200 rounded-md': editor.isActive('blockquote'),
                }"
            >
                <MessageSquareQuote class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="editor.chain().focus().undo().run()"
                :disabled="!editor.can().chain().focus().undo().run()"
            >
                <Undo class="w-9 h-9 p-2" />
            </button>
            <button
                type="button"
                @mousedown.prevent
                @click="editor.chain().focus().redo().run()"
                :disabled="!editor.can().chain().focus().redo().run()"
            >
                <Redo class="w-9 h-9 p-2" />
            </button>
        </section>
        <EditorContent :editor="editor" />
        <div>
            <small class="text-red mt-1 text-[12px]" v-if="message">{{
                message
            }}</small>
        </div>
    </div>
</template>

<style></style>
