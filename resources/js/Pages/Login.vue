<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";

const form = useForm({
    username: "",
    password: "",
});

const page = usePage();

function submit() {
    form.post("/login");
}
</script>

<template>
    <Head title="Login" />
    <div class="flex h-screen items-center justify-center text-center">
        <form class="flex flex-col gap-3" @submit.prevent="submit">
            <div class="flex flex-col gap-1">
                <label for="username" class="font-semibold">Username</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    class="px-2 py-1 border-2 border-slate-400 rounded-md text-center"
                    v-model="form.username"
                />
            </div>
            <div class="flex flex-col gap-1">
                <label for="password" class="font-semibold">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="px-2 py-1 border-2 border-slate-400 rounded-md text-center"
                    v-model="form.password"
                />
            </div>
            <span v-if="page.props.errors" class="text-red-400 mb-2">{{
                page.props.errors.invalidLogin
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
