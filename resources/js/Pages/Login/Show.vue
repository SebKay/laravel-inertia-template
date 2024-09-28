<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <h1
            v-text="title"
            class="xl:text-4xl text-3xl font-medium text-neutral-900 text-center xl:mb-8 mb-4"
        ></h1>

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
                            v-model="loginForm.email"
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
                            class="input"
                            type="password"
                            required
                            v-model="loginForm.password"
                        />
                    </div>

                    <div class="form-col">
                        <div class="inline-label">
                            <input
                                id="remember"
                                class="checkbox"
                                type="checkbox"
                                v-model="loginForm.remember"
                            />
                            <label
                                class="small-label"
                                for="remember"
                            >
                                Remember
                            </label>
                        </div>
                    </div>

                    <div class="form-col">
                        <button
                            class="button button-full"
                            :disabled="loginForm.processing"
                        >
                            Log In
                        </button>
                    </div>
                </div>
            </form>

            <div class="mt-6 xl:mt-10">
                <p class="text-center">
                    <Link
                        class="underline hover:no-underline"
                        :href="route('password')"
                        text="Forgot your password?"
                    />
                </p>

                <p class="text-center mt-3">
                    <Link
                        class="underline hover:no-underline"
                        :href="route('register')"
                        text="Register"
                    />
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from "vue";
    import { useForm } from "@inertiajs/vue3";

    const props = defineProps({
        email: String,
        password: String,
        remember: Boolean,
        redirect: String,
    });

    const title = ref("Log In");
    const loginForm = useForm({
        email: props.email,
        password: props.password,
        remember: props.remember,
        redirect: props.redirect,
    });

    const submitForm = () => {
        loginForm.post(route("login.store"));
    };
</script>
