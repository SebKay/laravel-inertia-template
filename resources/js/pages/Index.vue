<template>
    <Head :title="title" />

    <h1 v-text="title"></h1>
</template>

<script>
    import AppLayout from "@js/layouts/App.vue";

    export default {
        layout: AppLayout,

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
