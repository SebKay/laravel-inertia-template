<template>
    <Head>
        <title></title>
    </Head>

    <Header />

    <div class="guest-page">
        <Notice />

        <div class="guest-page__inner">
            <slot />
        </div>
    </div>
</template>

<script>
    import Header from "@js/Components/Header.vue";

    export default {
        name: "Guest Layout",

        components: {
            Header,
        },
    };
</script>

<style lang="scss">
    // body {
    //     background-color: color(bg-1);
    // }

    // .guest-page__inner {
    //     @extend %d-mv-120;
    //     @extend %m-mv-20;
    //     width: 94%;
    //     max-width: 600px;
    //     margin-right: auto;
    //     margin-left: auto;
    // }
</style>
