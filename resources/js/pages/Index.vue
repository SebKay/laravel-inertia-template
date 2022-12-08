<template>
    <Head :title="title" />

    <h1 v-text="title"></h1>

    <p v-if="userCan($page.props, 'create-posts')">User can create posts.</p>

    <Link :href="route('logout')" method="post" as="button">Logout</Link>
</template>

<script>
    import AppLayout from "@js/Layouts/App.vue";

    import { userCan } from "@js/utilities/permissions.js";

    export default {
        layout: AppLayout,

        setup() {
            return {
                userCan,
            };
        },

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
