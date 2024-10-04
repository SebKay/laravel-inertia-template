<template>

    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <PageTitle class="mb-4 xl:mb-8" :text="title" />

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

<script setup>
    import { ref } from "vue";
    import { router } from "@inertiajs/vue3";

    const title = ref("Verify Your Email");

    const resend = () => {
        router.post(route('verification.send'), {
            preserveScroll: true,
            preserveState: true,
        });
    };
</script>
