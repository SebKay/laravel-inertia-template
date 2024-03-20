<template>

    <Head :title="title" />

    <h1
        v-text="title"
        class="lg:text-4xl text-3xl font-medium text-slate-800 lg:mb-8 mb-4"
    ></h1>

    <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
        <form @submit.prevent="updateOrganisation">
            <div class="form-row">
                <div class="form-col">
                    <label
                        class="label"
                        for="name"
                    >
                        Name
                    </label>
                    <input
                        id="name"
                        type="text"
                        required
                        class="input"
                        v-model="organisationForm.name"
                    />
                </div>

                <div class="form-col">
                    <button
                        class="button"
                        :disabled="organisationForm.processing"
                    >
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    export default {
        props: {
            organisation: Object,
        },

        data() {
            return {
                title: "Organisation",
                organisationForm: useForm({
                    name: this.organisation.name,
                }),
            };
        },

        methods: {
            updateOrganisation() {
                this.organisationForm.patch(route("organisation.update"), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
