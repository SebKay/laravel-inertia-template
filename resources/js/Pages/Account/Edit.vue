<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="lg:text-4xl text-3xl font-medium text-slate-800 lg:mb-8 mb-4"
    ></h1>

    <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
        <form @submit.prevent="submitAccountForm">
            <div class="grid grid-cols-1 gap-5 sm:gap-7 sm:grid-cols-6">
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
                        required
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                        v-model="accountForm.first_name"
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
                        required
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                        v-model="accountForm.last_name"
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
                        required
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                        v-model="accountForm.email"
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
                        v-model="accountForm.password"
                    />
                </div>

                <div class="col-span-full">
                    <Button
                        text="Update"
                        :disabled="accountForm.processing"
                    />
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    export default {
        props: {
            user: Object,
        },

        data() {
            return {
                title: "Update Account",
                accountForm: useForm({
                    first_name: this.user.first_name,
                    last_name: this.user.last_name,
                    email: this.user.email,
                    password: "",
                }),
            };
        },

        methods: {
            submitAccountForm() {
                this.accountForm.patch(route("account.update"), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
