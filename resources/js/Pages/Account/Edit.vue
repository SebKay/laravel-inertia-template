<template>
    <Head :title="title" />

    <h1 v-text="title" class="mt-regular mb-regular"></h1>

    <form class="form" @submit.prevent="update">
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
