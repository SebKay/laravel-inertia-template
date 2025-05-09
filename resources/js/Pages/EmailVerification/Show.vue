<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <PageTitle
            class="mb-4 xl:mb-8"
            :text="title"
        />

        <div class="bg-white rounded-2xl xl:p-10 p-6 border border-brand-200">
            <div class="text-center">
                <p>
                    Please verify your email address by clicking on the link we just emailed to you.
                </p>
                <button
                    class="button mt-6"
                    @click="resend"
                >
                    Resend Verification Email
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@js/Layouts/Guest.vue';

    export default {
        layout: Layout,
    }
</script>

<script setup>
    import { ref } from "vue";
    import { router } from "@inertiajs/vue3";

    import { update } from "@js/actions/App/Http/Controllers/EmailVerificationController";

    const title = ref("Verify Your Email");

    const resend = () => {
        router.post(update().url, {
            preserveScroll: true,
        });
    };
</script>
