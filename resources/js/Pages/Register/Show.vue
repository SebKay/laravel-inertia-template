<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="mb-40 text-center"
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

    <div class="mt-30 text-center">
        <Link :href="route('login')">Login</Link>
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
        },

        data() {
            return {
                title: "Register",
                form: useForm({
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    password: this.password,
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
