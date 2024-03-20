<template>

    <Head :title="title" />

    <h1
        v-text="title"
        class="lg:text-4xl text-3xl font-medium text-slate-800 lg:mb-8 mb-4"
    ></h1>

    <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
        <form @submit.prevent="submitAccountForm">
            <div class="form-row">
                <div class="form-col">
                    <label
                        class="label"
                        for="first-name"
                    >
                        First Name
                    </label>
                    <input
                        id="first-name"
                        type="text"
                        required
                        class="input"
                        v-model="accountForm.first_name"
                    />
                </div>

                <div class="form-col">
                    <label
                        class="label"
                        for="last-name"
                    >
                        Last Name
                    </label>
                    <input
                        id="last-name"
                        type="text"
                        required
                        class="input"
                        v-model="accountForm.last_name"
                    />
                </div>

                <div class="form-col">
                    <label
                        class="label"
                        for="email"
                    >
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        required
                        class="input"
                        v-model="accountForm.email"
                    />
                </div>

                <div class="form-col">
                    <label
                        class="label"
                        for="password"
                    >
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        class="input"
                        v-model="accountForm.password"
                    />
                </div>

                <div class="form-col">
                    <button
                        class="button"
                        :disabled="accountForm.processing"
                    >
                        Update
                    </button>
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
