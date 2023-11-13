<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30"
    ></h1>

    <div class="boxed">
        <form
            class="form"
            @submit.prevent="submitAccountForm"
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
                            required
                            v-model="accountForm.first_name"
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
                            required
                            v-model="accountForm.last_name"
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
                            required
                            v-model="accountForm.email"
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
                            v-model="accountForm.password"
                        />
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__action">
                        <Button
                            text="Update"
                            :disabled="accountForm.processing"
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
            user: Object,
        },

        data() {
            return {
                title: "Update Account",
                accountForm: useForm({
                    first_name: this.user.first_name,
                    last_name: this.user.last_name,
                    email: this.user.email,
                    password: "",
                }),
            };
        },

        methods: {
            submitAccountForm() {
                this.accountForm.patch(route("account.update"), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
