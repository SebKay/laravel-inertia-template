<template>
    <Head>
        <title></title>
    </Head>

    <div class="app-page">
        <Notice />

        <div class="app-page__inner">
            <Link :href="route('home')">Home</Link>
            <br />
            <Link :href="route('account.edit')">Account</Link>
            <br />
            <Link
                :href="route('logout')"
                method="post"
                as="button"
            >
            Logout
            </Link>
            <slot />
        </div>
    </div>
</template>

<script>
    export default {
        name: "App Layout",
    };
</script>

<style lang="scss">
    body {
        background-color: #eee;
    }

    .app-page__inner {
        @extend %d-mv-120;
        @extend %m-mv-20;
        @extend %d-p-60;
        @extend %m-p-30;
        width: 94%;
        max-width: 900px;
        margin-right: auto;
        margin-left: auto;
        background-color: #fff;
    }
</style>
