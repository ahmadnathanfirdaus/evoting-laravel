<script setup>
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const links = [
    { text: "Dashboard", href: "/dashboard" },
    { text: "Calon Formatur", href: "/calon" },
    { text: "Token", href: "/token" },
    { text: "Settings", href: "/settings" },
];

defineProps({
    title: String,
});
</script>
<template>
    <Head :title="title" />
    <nav
        class="flex bg-gray-800 text-white items-center justify-between mb-5 px-3"
    >
        <div class="flex items-center">
            <Link href="/dashboard" class="py-3">
                <img src="../Assets/logo.png" alt="logo" width="36" />
            </Link>
            <Link
                v-for="link in links"
                :href="link.href"
                :class="`hover:bg-orange-400 p-3 ${
                    title == link.text ? 'bg-orange-400' : ''
                }`"
                >{{ link.text }}</Link
            >
        </div>
        <div>
            <span class="me-3"> Logged in as Admin</span>
            <a class="bg-red-600 rounded-md p-2" href="/logout">Logout</a>
        </div>
    </nav>
    <slot />
</template>
