<template>
    <Head :title="title" />

    <h1 v-text="title"></h1>
</template>

<script>
    export default {
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
