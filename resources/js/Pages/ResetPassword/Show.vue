<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <PageTitle
            class="mb-4 xl:mb-8"
            :text="title"
        />

        <div class="bg-white rounded-2xl xl:p-10 p-6 border border-brand-200">
            <form @submit.prevent="submitForm">
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
                            class="input"
                            type="email"
                            required
                            v-model="forgotPasswordForm.email"
                        />
                    </div>

                    <div class="form-col">
                        <button
                            class="button button-full"
                            :disabled="forgotPasswordForm.processing"
                        >
                            Email Reset Link
                        </button>
                    </div>
                </div>
            </form>

            <div class="mt-6 xl:mt-10">
                <p class="text-center">
                    Remembered your password?
                    <Link
                        class="underline hover:decoration-transparent transition-colors ease-in-out duration-200"
                        :href="route('login')"
                        text="Login"
                    />
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from "vue";
    import { useForm } from "@inertiajs/vue3";

    const title = ref("Forgot Password");
    const forgotPasswordForm = useForm({
        email: "",
    });

    const submitForm = () => {
        forgotPasswordForm.post(route("password.store"));
    };
</script>
