<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="lg:text-4xl text-3xl font-medium text-slate-800 lg:mb-8 mb-4"
    ></h1>

    <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
        <p v-if="userCan($page.props, 'create-posts')">User can create posts.</p>
        <p v-else>User can't create posts.</p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: "Dashboard",
            };
        },
    };
</script>
