<template>
    <Head :title="title" />

    <div class="mx-auto max-w-2xl bg-white rounded-2xl lg:p-10 p-6 border border-slate-200 text-center">
        <p>
            Please verify your email address by clicking on the link we just emailed to you.
        </p>
        <Button
            @click="resend"
            class="mt-6"
            text="Resend Verification Email"
        />
    </div>
</template>

<script>
    import { router } from "@inertiajs/vue3";

    export default {
        data() {
            return {
                title: "Email Verification",
            };
        },

        methods: {
            resend() {
                router.post(route('verification.send'), {
                    preserveScroll: true,
                    preserveState: true,
                });
            },
        },
    };
</script>
