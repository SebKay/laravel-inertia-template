<template>
    <Head :title="title" />

    <h1 v-text="title" class="mt-regular mb-regular"></h1>

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
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__action">
                    <AppButton
                        text="Update"
                        tabindex="5"
                        :disabled="form.processing"
                    />
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import AppLayout from "@js/Layouts/App.vue";
    import AppButton from "@js/Components/AppButton.vue";

    import { useForm } from "@inertiajs/inertia-vue3";

    export default {
        layout: AppLayout,

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
        },

        data() {
            return {
                title: "Update Account",
                form: useForm({
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    password: "",
                }),
            };
        },

        methods: {
            login() {
                let form = this.form;
                form.patch(route("account.update"), {
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
