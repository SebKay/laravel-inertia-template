<template>

    <Head :title="title" />

    <h1
        v-text="title"
        class="xl:text-4xl text-3xl font-medium text-neutral-900 xl:mb-8 mb-4"
    ></h1>

    <div class="bg-white rounded-2xl xl:p-10 p-6 border border-brand-200">
        <form @submit.prevent="submitForm">
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
                        class="input"
                        type="text"
                        required
                        v-model="accountForm.first_name"
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
                        class="input"
                        type="text"
                        required
                        v-model="accountForm.last_name"
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
                        class="input"
                        type="email"
                        required
                        v-model="accountForm.email"
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
                        v-model="accountForm.password"
                    />
                </div>

                <div class="form-col">
                    <button
                        class="button"
                        :disabled="accountForm.processing"
                    >
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
    import { ref } from "vue";
    import { useForm } from "@inertiajs/vue3";

    import { update } from "@js/actions/App/Http/Controllers/AccountController";

    const title = ref("Update Account");
    const props = defineProps({
        user: Object,
    });

    const accountForm = useForm({
        first_name: props.user.first_name,
        last_name: props.user.last_name,
        email: props.user.email,
        password: "",
    });

    const submitForm = () => {
        accountForm.submit(update(), {
            preserveScroll: true,
            preserveState: 'errors',
        });
    };
</script>
