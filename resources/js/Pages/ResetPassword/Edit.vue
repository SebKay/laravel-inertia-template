<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <h1
            v-text="title"
            class="lg:text-4xl text-3xl font-medium text-slate-800 text-center lg:mb-8 mb-4"
        ></h1>

        <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
            <form @submit.prevent="submitForm">
                <div class="form-row">
                    <div class="form-col">
                        <label
                            class="label"
                            for="password"
                        >
                            Password
                        </label>
                        <input
                            id="password"
                            class="input"
                            type="password"
                            required
                            v-model="resetPasswordForm.password"
                        />
                    </div>

                    <div class="form-col">
                        <label
                            class="label"
                            for="password-confirmation"
                        >
                            Confirm Password
                        </label>
                        <input
                            id="password-confirmation"
                            class="input"
                            type="password"
                            required
                            v-model="resetPasswordForm.password_confirmation"
                        />
                    </div>

                    <div class="form-col">
                        <button
                            class="button button-full"
                            :disabled="resetPasswordForm.processing"
                        >
                            Reset Password
                        </Button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
    import { ref } from "vue";
    import { useForm } from "@inertiajs/vue3";

    const props = defineProps({
        email: String,
        token: String,
    })

    const title = ref("Reset Password");
    const resetPasswordForm = useForm({
        email: props.email,
        password: "",
        password_confirmation: "",
        token: props.token,
    });

    const submitForm = () => {
        resetPasswordForm.patch(route("password.update"));
    };
</script>
