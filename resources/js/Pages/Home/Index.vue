<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30"
    ></h1>

    <p v-if="userCan($page.props, 'create-posts')">User can create posts.</p>
    <p v-else>User can't create posts.</p>
</template>

<script>
    import AppLayout from "@js/Layouts/App.vue";

    export default {
        layout: AppLayout,

        data() {
            return {
                title: "Home",
            };
        },
    };
</script>
