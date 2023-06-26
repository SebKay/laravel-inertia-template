<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mt-30 d-mb-40 m-mt-15 m-mb-20"
    ></h1>

    <p v-if="userCan($page.props, 'create-posts')">User can create posts.</p>
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
