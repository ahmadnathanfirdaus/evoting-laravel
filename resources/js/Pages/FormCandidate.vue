<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import App from "../Layouts/App.vue";

const props = defineProps({
    candidate: Object,
});

const form = useForm({
    name: props.candidate?.name,
    photo: null,
});

const url = "/calon";

function submit() {
    form.post(url);
    console.log(form);
}

function update(id) {
    form.put(`${url}/${id}`);
}
</script>

<template>
    <App :title="candidate ? candidate.name : 'Tambah Calon'">
        <div class="mx-4">
            <h1 class="text-3xl font-bold">{{ candidate?.name }}</h1>
            <form
                @submit.prevent="candidate ? update(candidate?.id) : submit()"
                class="mt-4"
                enctype="multipart/form-data"
            >
                <div class="flex gap-8">
                    <img
                        :src="
                            candidate?.photo
                                ? `/storage/${candidate?.photo}`
                                : 'https://cdn-icons-png.flaticon.com/512/149/149071.png'
                        "
                        alt=""
                        class="rounded-full w-28 h-28"
                        id="photo"
                    />
                    <div>
                        <div class="mb-2">
                            <label for="name" class="block font-semibold"
                                >Nama</label
                            >
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="border rounded-md w-96 px-2 py-1"
                                v-model="form.name"
                                :disabled="candidate"
                            />
                        </div>
                        <div v-if="!candidate">
                            <label for="photo" class="block font-semibold"
                                >Foto</label
                            >
                            <input
                                type="file"
                                accept="image/*"
                                name="photo"
                                id="photo"
                                @input="form.photo = $event.target.files[0]"
                            />
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <Link
                        href="/calon"
                        as="button"
                        class="bg-sky-500 hover:bg-sky-400 px-4 py-2 rounded-md font-semibold text-white mr-2"
                        >KEMBALI</Link
                    >
                    <span v-if="candidate">
                        <!-- <button
                            type="submit"
                            class="bg-orange-400 hover:bg-orange-300 px-4 py-2 rounded-md font-semibold text-white"
                        >
                            UPDATE
                        </button> -->
                        <Link
                            :href="`/calon/${candidate.id}`"
                            method="delete"
                            as="button"
                            class="bg-red-500 hover:bg-red-400 px-4 py-2 rounded-md font-semibold text-white"
                            >HAPUS</Link
                        >
                    </span>
                    <button
                        v-else
                        type="submit"
                        class="bg-green-600 hover:bg-green-500 px-4 py-2 rounded-md font-semibold text-white"
                    >
                        TAMBAH
                    </button>
                </div>
            </form>
        </div>
    </App>
</template>
