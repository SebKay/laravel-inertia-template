<template>
    <Head :title="title" />

    <h1 v-text="title" class="mt-regular mb-regular"></h1>

    <p v-if="userCan($page.props, 'create-posts')">User can create posts.</p>
</template>

<script>
    import AppLayout from "@js/Layouts/App.vue";

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
