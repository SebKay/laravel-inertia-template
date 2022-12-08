<template>
    <Head :title="title" />

    <h1 v-text="title"></h1>

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
                <div class="form__item">
                    <AppButton
                        text="Login"
                        tabindex="4"
                        :disabled="form.processing"
                    />
                </div>
            </div>
        </div>
    </form>

    <Link :href="route('register')">Register</Link>
</template>

<script>
    import GuestLayout from "@js/Layouts/Guest.vue";
    import AppButton from "@js/Components/AppButton.vue";

    import { useForm } from "@inertiajs/inertia-vue3";

    export default {
        layout: GuestLayout,

        components: {
            AppButton,
        },

        props: {
            email: {
                type: String,
                default: "",
            },
            password: {
                type: String,
                default: "",
            },
            remember: {
                type: Boolean,
                default: false,
            },
            redirect: {
                type: String,
                default: "",
            },
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
                let form = this.form;
                form.post(route("login.store"), {
                    ...form,
                    ...{
                        onSuccess: () => {
                            form.clearErrors();
                        },
                    },
                });
            },
        },
    };
</script>
