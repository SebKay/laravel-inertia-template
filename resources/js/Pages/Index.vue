<template>
    <Head :title="title" />

    <h1 v-text="title" class="mt-regular mb-regular"></h1>

    <p v-if="userCan($page.props, 'create-posts')">User can create posts.</p>
</template>

<script>
    import AppLayout from "@js/Layouts/App.vue";

    import { userCan } from "@js/utilities/permissions.js";

    export default {
        layout: AppLayout,

        components: {
            //
        },

        props: {
            //
        },

        setup() {
            return {
                userCan,
            };
        },

        data() {
            return {
                title: "Home",
            };
        },
    };
</script>
