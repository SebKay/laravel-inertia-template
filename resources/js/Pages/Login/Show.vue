<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30 text-center"
    ></h1>

    <div class="boxed">
        <form
            class="form"
            @submit.prevent="submitLoginForm"
        >
            <div class="form__section">
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
                            required
                            v-model="loginForm.email"
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
                            required
                            v-model="loginForm.password"
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
                                v-model="loginForm.remember"
                            />
                            Remember
                        </label>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__action">
                        <Button
                            text="Log In"
                            styles="full"
                            :disabled="loginForm.processing"
                        />
                    </div>
                </div>
            </div>
        </form>

        <div class="d-mt-30 m-mt-15 text-center">
            <p>
                <Link :href="route('register')">Register</Link>
            </p>
        </div>
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
                title: "Log In",
                loginForm: useForm({
                    email: this.email,
                    password: this.password,
                    remember: this.remember,
                    redirect: this.redirect,
                }),
            };
        },

        methods: {
            submitLoginForm() {
                this.loginForm.post(route("login.store"));
            },
        },
    };
</script>
