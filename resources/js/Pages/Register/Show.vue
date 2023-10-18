<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30 text-center"
    ></h1>

    <form
        class="form"
        @submit.prevent="register"
    >
        <div class="form__section">
            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="first-name"
                    >
                        First Name
                    </label>
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
                        for="last-name"
                    >
                        Last Name
                    </label>
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
                    >
                        Email
                    </label>
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
                    >
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="org-name"
                    >
                        Organisation Name
                    </label>
                    <input
                        id="org-name"
                        type="text"
                        v-model="form.organisation_name"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__action">
                    <Button
                        text="Register"
                        styles="full"
                        :disabled="form.processing"
                    />
                </div>
            </div>
        </div>
    </form>

    <div class="d-mt-30 m-mt-15 text-center">
        <p>
            <Link :href="route('login')">Login</Link>
        </p>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    import GuestLayout from "@js/Layouts/Guest.vue";

    export default {
        layout: GuestLayout,

        props: {
            first_name: String,
            last_name: String,
            email: String,
            password: String,
            organisation_name: String,
        },

        data() {
            return {
                title: "Register",
                form: useForm({
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    password: this.password,
                    organisation_name: this.organisation_name,
                }),
            };
        },

        methods: {
            register() {
                this.form.post(route("register.store"));
            },
        },
    };
</script>
