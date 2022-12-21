<template>
    <Head :title="title" />

    <h1 v-text="title"></h1>

    <form class="form" @submit.prevent="login">
        <div class="form__section">
            <div class="form__row">
                <div class="form__item">
                    <label class="form__label" for="first_name"
                        >First Name</label
                    >
                    <input
                        id="first-name"
                        type="text"
                        v-model="form.first_name"
                        tabindex="1"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label class="form__label" for="last_name">Last Name</label>
                    <input
                        id="last-name"
                        type="text"
                        v-model="form.last_name"
                        tabindex="2"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label class="form__label" for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        tabindex="3"
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
                        tabindex="4"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__action">
                    <AppButton
                        text="Register"
                        tabindex="5"
                        :disabled="form.processing"
                    />
                </div>
            </div>
        </div>
    </form>

    <Link :href="route('login')">Login</Link>
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
            first_name: {
                type: String,
                default: "",
            },
            last_name: {
                type: String,
                default: "",
            },
            email: {
                type: String,
                default: "",
            },
            password: {
                type: String,
                default: "",
            },
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
            login() {
                let form = this.form;
                form.post(route("register.store"), {
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
