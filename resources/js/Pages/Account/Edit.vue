<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mt-30 d-mb-40 m-mt-15 m-mb-20"
    ></h1>

    <form
        class="form"
        @submit.prevent="update"
    >
        <div class="form__section">
            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="first_name"
                    >First Name</label>
                    <input
                        id="first-name"
                        type="text"
                        v-model="form.first_name"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="last_name"
                    >Last Name</label>
                    <input
                        id="last-name"
                        type="text"
                        v-model="form.last_name"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="email"
                    >Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="password"
                    >Password</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__action">
                    <Button
                        text="Update"
                        :disabled="form.processing"
                    />
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    import AppLayout from "@js/Layouts/App.vue";

    export default {
        layout: AppLayout,

        props: {
            user: Object,
        },

        data() {
            return {
                title: "Update Account",
                form: useForm({
                    first_name: this.user.first_name,
                    last_name: this.user.last_name,
                    email: this.user.email,
                    password: "",
                }),
            };
        },

        methods: {
            update() {
                this.form.patch(route("account.update"), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
