<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import App from "../Layouts/App.vue";

defineProps({
    tokens: Object,
});

const form = useForm({
    amount: 0,
});

function submit() {
    form.post("/token");
}
</script>

<template>
    <App title="Token">
        <div class="mx-3">
            <form @submit.prevent="submit()">
                <label for="amount" class="font-semibold mr-2"
                    >Jumlah Token</label
                >
                <input
                    v-model="form.amount"
                    type="number"
                    name="amount"
                    id="amount"
                    class="border rounded-md w-16 px-2 py-1 mr-2"
                />
                <button
                    type="submit"
                    class="px-4 py-2 bg-orange-400 hover:bg-orange-300 rounded-md font-semibold text-white"
                >
                    GENERATE
                </button>
                <Link
                    class="bg-red-500 px-4 py-2 rounded-md font-semibold text-white mx-2"
                    href="/token/reset"
                    method="post"
                    as="button"
                    >RESET</Link
                >
            </form>
            <div v-if="tokens.length > 0" class="mt-3">
                <div class="flex flex-wrap gap-8 justify-center">
                    <span
                        v-for="token in tokens"
                        class="border-2 border-black p-2 w-24 text-center"
                        >{{ token.token }}</span
                    >
                </div>
            </div>
            <p v-else class="my-3 bg-red-300 p-3 rounded-lg font-medium">
                Belum ada token
            </p>
        </div>
    </App>
</template>
