<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <h1
            v-text="title"
            class="lg:text-4xl text-3xl font-medium text-slate-800 text-center lg:mb-8 mb-4"
        ></h1>

        <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
            <form @submit.prevent="submitRegisterForm">
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
                            class="input"
                            required
                            v-model="registerForm.first_name"
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
                            class="input"
                            required
                            v-model="registerForm.last_name"
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
                            class="input"
                            required
                            v-model="registerForm.email"
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
                            required
                            v-model="registerForm.password"
                        />
                    </div>

                    <div class="form-col">
                        <label
                            class="label"
                            for="org-name"
                        >
                            Organisation Name
                        </label>
                        <input
                            id="org-name"
                            type="text"
                            class="input"
                            required
                            v-model="registerForm.organisation_name"
                        />
                    </div>

                    <div class="form-col">
                        <button
                            class="button button-full"
                            :disabled="registerForm.processing"
                        >
                            Register
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
                    Log In
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
            first_name: String,
            last_name: String,
            email: String,
            password: String,
            organisation_name: String,
        },

        data() {
            return {
                title: "Register",
                registerForm: useForm({
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    password: this.password,
                    organisation_name: this.organisation_name,
                }),
            };
        },

        methods: {
            submitRegisterForm() {
                this.registerForm.post(route("register.store"));
            },
        },
    };
</script>
