<script setup>
import App from "../Layouts/App.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    candidates: Object,
    maxCount: Number,
});
</script>

<style>
meter::-webkit-meter-optimum-value {
    background: rgb(0, 157, 255);
}
</style>

<template>
    <App title="Dashboard">
        <h1 class="text-3xl font-bold mx-3 mb-4">Dashboard</h1>
        <Link
            class="bg-red-500 px-4 py-2 rounded-md font-semibold text-white m-2"
            href="/dashboard/reset"
            method="post"
            as="button"
            >RESET</Link
        >
        <table class="mx-3 mt-4">
            <tr v-for="candidate in candidates">
                <td>
                    <span>{{ candidate.name }}</span>
                </td>
                <td class="px-16">
                    <meter
                        :value="candidate.vote_count"
                        :max="maxCount"
                        class="h-6 w-96"
                    ></meter>
                </td>
                <td>{{ candidate.vote_count }}</td>
            </tr>
        </table>
    </App>
</template>
