<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <h1
            v-text="title"
            class="lg:text-4xl text-3xl font-medium text-slate-800 text-center lg:mb-8 mb-4"
        ></h1>

        <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
            <form @submit.prevent="submitLoginForm">
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
                            v-model="loginForm.email"
                        />
                    </div>

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
                            v-model="loginForm.password"
                        />
                    </div>

                    <div class="col-span-full">
                        <div class="inline-label">
                            <input
                                id="remember"
                                type="checkbox"
                                class="checkbox"
                                v-model="loginForm.remember"
                            />
                            <label
                                for="remember"
                                class="small-label"
                            >
                                Remember
                            </label>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <button
                            class="button button-full"
                            :disabled="loginForm.processing"
                        >
                            Log In
                        </button>
                    </div>
                </div>
            </form>

            <div class="mt-6 lg:mt-10">
                <p class="text-center text-slate-800">
                    <Link
                        class="underline hover:no-underline"
                        :href="route('password')"
                    >
                    Forgot your password?
                    </Link>
                </p>

                <p class="text-center text-slate-800 mt-3">
                    <Link
                        class="underline hover:no-underline"
                        :href="route('register')"
                    >
                    Register
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
                title: "Log In",
                loginForm: useForm({
                    email: this.email,
                    password: this.password,
                    remember: this.remember,
                    redirect: this.redirect,
                }),
            };
        },

        methods: {
            submitLoginForm() {
                this.loginForm.post(route("login.store"));
            },
        },
    };
</script>
