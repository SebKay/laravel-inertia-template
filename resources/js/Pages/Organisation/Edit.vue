<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30"
    ></h1>

    <div class="boxed">
        <form
            class="form"
            @submit.prevent="updateOrganisation"
        >
            <div class="form__section">
                <div class="form__row">
                    <div class="form__item">
                        <label
                            class="form__label"
                            for="name"
                        >
                            Name
                        </label>
                        <input
                            id="name"
                            type="text"
                            v-model="organisationForm.name"
                            required
                        />
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__action">
                        <Button
                            text="Update"
                            :disabled="organisationForm.processing"
                        />
                    </div>
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
