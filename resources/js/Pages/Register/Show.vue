<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class=""
    ></h1>

    <div class="boxed">
        <form @submit.prevent="submitRegisterForm">
            <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                <div class="col-span-full">
                    <label
                        class="pb-2 block text-base font-medium leading-6 text-slate-800"
                        for="first-name"
                    >
                        First Name
                    </label>
                    <input
                        id="first-name"
                        type="text"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                        required
                        v-model="registerForm.first_name"
                    />
                </div>

                <div class="col-span-full">
                    <label
                        class="pb-2 block text-base font-medium leading-6 text-slate-800"
                        for="last-name"
                    >
                        Last Name
                    </label>
                    <input
                        id="last-name"
                        type="text"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                        required
                        v-model="registerForm.last_name"
                    />
                </div>

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
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                        required
                        v-model="registerForm.email"
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
                        v-model="registerForm.password"
                    />
                </div>

                <div class="col-span-full">
                    <label
                        class="pb-2 block text-base font-medium leading-6 text-slate-800"
                        for="org-name"
                    >
                        Organisation Name
                    </label>
                    <input
                        id="org-name"
                        type="text"
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                        required
                        v-model="registerForm.organisation_name"
                    />
                </div>

                <div class="col-span-full">
                    <Button
                        text="Register"
                        styles="full"
                        :disabled="registerForm.processing"
                    />
                </div>
            </div>
        </form>

        <div class="">
            <p>
                <Link :href="route('login')">Login</Link>
            </p>
        </div>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    import GuestLayout from "@js/Layouts/Guest.vue";

    export default {
        layout: GuestLayout,

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
