<template>
    <Head :title="title" />

    <div class="mx-auto max-w-2xl bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
        <p class="text-center">
            Please verify your email address by clicking on the link we just emailed to you.
        </p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: "Welcome",
            };
        },
    };
</script>
