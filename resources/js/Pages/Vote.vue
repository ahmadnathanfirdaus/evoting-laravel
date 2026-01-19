<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    candidates: Object,
    token: Object,
});

const form = useForm({
    candidates: [],
});

function submit() {
    const url = `/vote/${props.token.token}`;
    if (form.candidates.length === 9) {
        if (confirm("Yakin dengan pilihan Anda?")) {
            form.post(url);
        }
    } else {
        alert("Calon formatur yang dipilih harus berjumlah 9 calon");
    }
}

onMounted(() => {
    form.candidates = [];
});
</script>

<style>
:checked + label {
    --tw-bg-opacity: 1;
    background-color: rgb(251 146 60 / var(--tw-bg-opacity));
}
</style>

<template>
    <Head title="Vote" />
    <form @submit.prevent="submit" class="text-center">
        <div class="flex flex-wrap items-center gap-3 mt-8 justify-center">
            <div v-for="candidate in candidates">
                <input
                    type="checkbox"
                    name="candidates[]"
                    :id="candidate.id"
                    class="hidden"
                    :value="candidate.id"
                    v-model="form.candidates"
                />
                <label
                    :for="candidate.id"
                    class="flex flex-col w-80 h-52 justify-center items-center p-4 border-2 border-orange-400 text-center rounded-xl"
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
                </label>
            </div>
        </div>
        <button
            type="submit"
            class="text-white font-medium bg-green-700 hover:bg-green-600 p-3 m-3 rounded-md"
        >
            VOTE
        </button>
    </form>
</template>
