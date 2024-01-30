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
                            class="pb-2 block text-base font-medium leading-6 text-slate-800"
                            for="email"
                        >
                            Email
                        </label>
                        <input
                            id="email"
                            type="email"
                            required
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                            v-model="loginForm.email"
                        />
                    </div>

                    <div class="col-span-full">
                        <label
                            class="pb-2 block text-base font-medium leading-6 text-slate-800"
                            for="password"
                        >
                            Password
                        </label>
                        <input
                            id="password"
                            type="password"
                            class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                            required
                            v-model="loginForm.password"
                        />
                    </div>

                    <div class="col-span-full">
                        <div class="flex items-center gap-x-2">
                            <input
                                id="remember"
                                type="checkbox"
                                class="h-5 w-5 rounded text-slate-800 border-slate-300 focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                                v-model="loginForm.remember"
                            />
                            <label
                                for="remember"
                                class="block text-sm font-medium leading-6 text-slate-800"
                            >
                                Remember
                            </label>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <Button
                            text="Log In"
                            class="w-full text-center justify-center"
                            :disabled="loginForm.processing"
                        />
                    </div>
                </div>
            </form>

            <div class="mt-5 sm:mt-7">
                <p class="text-center text-slate-800">
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
