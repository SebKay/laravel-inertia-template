<template>

    <Head :title="title" />

    <h1
        v-text="title"
        class="lg:text-4xl text-3xl font-medium text-brand-800 lg:mb-8 mb-4"
    ></h1>

    <div class="bg-white rounded-2xl lg:p-10 p-6 border border-brand-200">
        <p v-if="userCan($page.props, 'create-posts')">User can create posts.</p>
        <p v-else>User can't create posts.</p>
    </div>
</template>

<script setup>
    import { ref } from "vue";

    const title = ref("Dashboard");
</script>
