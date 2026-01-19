<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import App from "../Layouts/App.vue";

defineProps({
    candidates: Object,
});
</script>

<template>
    <App title="Calon Formatur">
        <Link
            class="text-white font-medium bg-green-700 hover:bg-green-600 p-3 m-3 rounded-md"
            href="/calon/create"
            >TAMBAH CALON</Link
        >
        <Link
            class="bg-red-500 p-2 rounded-md font-medium text-white"
            href="/calon/reset"
            method="post"
            as="button"
            >RESET</Link
        >
        <div
            v-if="candidates.length > 0"
            class="flex flex-wrap items-center gap-3 mt-8 justify-center"
        >
            <Link
                v-for="candidate in candidates"
                class="flex flex-col w-80 h-52 justify-center items-center p-4 border-2 border-orange-400 hover:bg-orange-400 text-center rounded-xl"
                :href="`/calon/${candidate.id}/edit`"
            >
                <img
                    :src="
                        candidate.photo
                            ? `/storage/${candidate.photo}`
                            : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'
                    "
                    alt="photo"
                    class="mb-2 rounded-full w-24 h-24"
                />
                <h1 class="font-semibold text-xl">{{ candidate.name }}</h1>
            </Link>
        </div>
        <p v-else class="m-3 bg-red-300 p-3 rounded-lg font-medium">
            Belum ada calon formatur
        </p>
    </App>
</template>
