<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <h1
            v-text="title"
            class="lg:text-4xl text-3xl font-medium text-slate-800 text-center lg:mb-8 mb-4"
        ></h1>

        <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
            <form @submit.prevent="submitForgotPasswordForm">
                <div class="form-row">
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
                            v-model="forgotPasswordForm.email"
                        />
                    </div>

                    <div class="form-col">
                        <button
                            class="button button-full"
                            :disabled="forgotPasswordForm.processing"
                        >
                            Email Password Reset Link
                        </button>
                    </div>
                </div>
            </form>

            <div class="mt-6 lg:mt-10">
                <p class="text-center text-slate-800">
                    <Link
                        class="underline hover:no-underline"
                        :href="route('login')"
                    >
                    Login
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    export default {
        data() {
            return {
                title: "Forgot Password",
                forgotPasswordForm: useForm({
                    email: "",
                }),
            };
        },

        methods: {
            submitForgotPasswordForm() {
                this.forgotPasswordForm.post(route("password.store"));
            },
        },
    };
</script>
