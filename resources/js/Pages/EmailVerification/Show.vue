<template>
    <Head :title="title" />

    <div class="mx-auto max-w-2xl">
        <h1
            v-text="title"
            class="lg:text-4xl text-3xl font-medium text-slate-800 text-center lg:mb-8 mb-4"
        ></h1>

        <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
            <div class="text-center">
                <p>
                    Please verify your email address by clicking on the link we just emailed to you.
                </p>
                <Button
                    @click="resend"
                    class="mt-6"
                    text="Resend Verification Email"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import { router } from "@inertiajs/vue3";

    export default {
        data() {
            return {
                title: "Verify Your Email",
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
