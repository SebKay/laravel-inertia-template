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
                            v-model="loginForm.email"
                        />
                    </div>

                    <div class="form-col">
                        <label
                            class="label flex justify-between"
                            for="password"
                        >
                            Password
                            <Link
                                class="underline hover:decoration-transparent transition-colors ease-in-out duration-200"
                                :href="route('password')"
                                text="Forgot password?"
                            />
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
                        <label class="inline-flex items-center gap-3 cursor-pointer">
                            <input
                                class="sr-only peer"
                                type="checkbox"
                                v-model="loginForm.remember"
                            />
                            <div
                                class="relative w-9 h-5 bg-neutral-200 peer-focus:outline-hidden rounded-full peer peer-checked:after:translate-x-full peer-checked:rtl:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:size-4 after:transition-all peer-checked:bg-brand-600">
                            </div>
                            <span class="text-sm font-medium">
                                Remember me
                            </span>
                        </label>
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
                <p class="text-center mt-3">
                    Don't have an account?
                    <Link
                        class="underline hover:decoration-transparent transition-colors ease-in-out duration-200"
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
