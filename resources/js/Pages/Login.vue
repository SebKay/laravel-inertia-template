<template>
    <Head :title="title" />

    <h1 v-text="title"></h1>
</template>

<script>
    import GuestLayout from "@js/layouts/Guest.vue";

    export default {
        layout: GuestLayout,

        components: {
            //
        },

        props: {
            //
        },

        data() {
            return {
                title: "Home",
            };
        },
    };
</script>
