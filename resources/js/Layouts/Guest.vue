<template>
    <Head>
        <title></title>
    </Head>

    <div class="guest-page">
        <div class="guest-page__inner">
            <slot />
        </div>
    </div>
</template>

<script>
    export default {
        name: "Guest Layout",

        data() {
            return {};
        },
    };
</script>

<style lang="scss">
    body {
        background-color: #eee;
    }

    .guest-page__inner {
        max-width: 600px;
        margin: 120px auto;
        padding: 60px;
        background-color: #fff;
    }
</style>
