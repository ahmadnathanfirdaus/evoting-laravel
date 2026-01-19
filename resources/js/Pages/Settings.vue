<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import App from "../Layouts/App.vue";

const form = useForm({
    oldPassword: "",
    newPassword: "",
    confirmPassword: "",
});

const page = usePage();

function submit() {
    form.put("/settings/change-password");
    emptyForm();
}

function emptyForm() {
    form.oldPassword = "";
    form.newPassword = "";
    form.confirmPassword = "";
}
</script>

<template>
    <App title="Settings">
        <div class="mx-3">
            <p
                v-if="page.props.errors.invalidPassword"
                class="my-3 bg-red-300 p-3 rounded-lg font-medium"
            >
                {{ page.props.errors.invalidPassword }}
            </p>
            <p
                v-if="page.props.success"
                class="my-3 bg-green-300 p-3 rounded-lg font-medium"
            >
                {{ page.props.success }}
            </p>
            <form @submit.prevent="submit()" class="flex flex-col gap-3">
                <!-- Create a change password form -->
                <div class="flex flex-col gap-1">
                    <label for="oldPassword" class="font-semibold"
                        >Old Password</label
                    >
                    <input
                        type="password"
                        name="oldPassword"
                        id="oldPassword"
                        class="px-2 py-1 border-2 border-slate-400 rounded-md"
                        v-model="form.oldPassword"
                    />
                </div>
                <div class="flex flex-col gap-1">
                    <label for="newPassword" class="font-semibold"
                        >New Password</label
                    >
                    <input
                        type="password"
                        name="newPassword"
                        id="newPassword"
                        class="px-2 py-1 border-2 border-slate-400 rounded-md"
                        v-model="form.newPassword"
                    />
                </div>
                <div class="flex flex-col gap-1">
                    <label for="confirmPassword" class="font-semibold"
                        >Confirm Password</label
                    >
                    <input
                        type="password"
                        name="confirmPassword"
                        id="confirmPassword"
                        class="px-2 py-1 border-2 border-slate-400 rounded-md"
                        v-model="form.confirmPassword"
                    />
                </div>
                <button
                    type="submit"
                    class="px-4 py-2 bg-orange-400 hover:bg-orange-300 rounded-md font-semibold text-white"
                >
                    CHANGE PASSWORD
                </button>
            </form>
        </div>
    </App>
</template>
