<template>
    <Head :title="title" />

    <h1 v-text="title" class="mb-40 text-center"></h1>

    <form class="form" @submit.prevent="login">
        <div class="form__section">
            <div class="form__row">
                <div class="form__item">
                    <label class="form__label" for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        tabindex="1"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label class="form__label" for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        tabindex="2"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label form__label--inline"
                        for="remember"
                    >
                        <input
                            id="remember"
                            type="checkbox"
                            v-model="form.remember"
                            tabindex="3"
                        />
                        Remember
                    </label>
                </div>
            </div>

            <div class="form__row">
                <div class="form__action">
                    <AppButton
                        text="Login"
                        tabindex="4"
                        type="full"
                        :disabled="form.processing"
                    />
                </div>
            </div>
        </div>
    </form>

    <div class="mt-30 text-center">
        <Link :href="route('register')">Register</Link>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    import GuestLayout from "@js/Layouts/Guest.vue";

    export default {
        layout: GuestLayout,

        props: {
            email: String,
            password: String,
            remember: Boolean,
            redirect: String,
        },

        data() {
            return {
                title: "Login",
                form: useForm({
                    email: this.email,
                    password: this.password,
                    remember: this.remember,
                    redirect: this.redirect,
                }),
            };
        },

        methods: {
            login() {
                this.form.post(route("login.store"));
            },
        },
    };
</script>
