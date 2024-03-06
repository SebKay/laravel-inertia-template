<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <h1
            v-text="title"
            class="lg:text-4xl text-3xl font-medium text-slate-800 text-center lg:mb-8 mb-4"
        ></h1>

        <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
            <form @submit.prevent="submitresetPasswordForm">
                <div class="grid grid-cols-1 gap-5 sm:gap-7 sm:grid-cols-6">
                    <div class="col-span-full">
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
                            v-model="resetPasswordForm.email"
                        />
                    </div>

                    <div class="col-span-full">
                        <Button
                            text="Email Password Reset Link"
                            class="w-full text-center justify-center"
                            :disabled="resetPasswordForm.processing"
                        />
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
        props: {
            email: String,
            password: String,
            remember: Boolean,
            redirect: String,
        },

        data() {
            return {
                title: "Forgot Password",
                resetPasswordForm: useForm({
                    email: this.email,
                }),
            };
        },

        methods: {
            submitresetPasswordForm() {
                this.resetPasswordForm.post(route("password.store"));
            },
        },
    };
</script>
