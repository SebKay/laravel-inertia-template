<template>
    <Head>
        <title></title>
    </Head>

    <div class="guest-page">
        <Notice />

        <div class="guest-page__inner">
            <slot />
        </div>
    </div>
</template>

<script>
    export default {
        name: "Guest Layout",
    };
</script>

<style lang="scss">
    body {
        background-color: #eee;
    }

    .guest-page__inner {
        @extend %d-mv-120;
        @extend %m-mv-20;
        @extend %d-p-60;
        @extend %m-p-30;
        width: 94%;
        max-width: 600px;
        margin-right: auto;
        margin-left: auto;
        background-color: #fff;
    }
</style>
