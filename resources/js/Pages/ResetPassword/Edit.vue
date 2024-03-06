<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <h1
            v-text="title"
            class="lg:text-4xl text-3xl font-medium text-slate-800 text-center lg:mb-8 mb-4"
        ></h1>

        <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
            <form @submit.prevent="submitResetPasswordForm">
                <div class="grid grid-cols-1 gap-5 sm:gap-7 sm:grid-cols-6">
                    <div class="col-span-full">
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
                            required
                            v-model="resetPasswordForm.password"
                        />
                    </div>

                    <div class="col-span-full">
                        <label
                            class="label"
                            for="password-confirmation"
                        >
                            Confirm Password
                        </label>
                        <input
                            id="password-confirmation"
                            type="password"
                            class="input"
                            required
                            v-model="resetPasswordForm.password_confirmation"
                        />
                    </div>

                    <div class="col-span-full">
                        <Button
                            text="Reset Password"
                            class="w-full text-center justify-center"
                            :disabled="resetPasswordForm.processing"
                        />
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    export default {
        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                title: "Reset Password",
                resetPasswordForm: useForm({
                    email: this.email,
                    password: "",
                    password_confirmation: "",
                    token: this.token,
                }),
            };
        },

        methods: {
            submitResetPasswordForm() {
                this.resetPasswordForm.patch(route("password.update"));
            },
        },
    };
</script>
