<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";

const form = useForm({
    token: null,
});

const page = usePage();

function submit() {
    form.post("/");
}
</script>

<template>
    <Head title="Login" />
    <div class="flex h-screen items-center justify-center text-center">
        <form class="flex flex-col" @submit.prevent="submit">
            <label for="token" class="font-medium mb-2">Token</label>
            <input
                type="text"
                name="token"
                id="token"
                class="px-2 py-1 border-2 border-slate-400 rounded-md text-center mb-3"
                v-model="form.token"
            />
            <span v-if="page.props.invalidToken" class="text-red-400 mb-2">{{
                page.props.invalidToken
            }}</span>
            <div>
                <button
                    type="submit"
                    class="px-3 py-2 text-white bg-green-600 rounded-md font-semibold"
                >
                    MASUK
                </button>
            </div>
        </form>
    </div>
</template>
