<template>
    <Head>
        <title></title>
    </Head>

    <div class="app-page">
        <div class="app-page__inner">
            <Link :href="route('home')">Home</Link>
            <br />
            <Link :href="route('account.edit')">Account</Link>
            <br />
            <Link :href="route('logout')" method="post" as="button"
                >Logout</Link
            >

            <slot />
        </div>
    </div>
</template>

<script>
    export default {
        name: "App Layout",

        data() {
            return {};
        },
    };
</script>


<style lang="scss">
    body {
        background-color: #eee;
    }

    .app-page__inner {
        max-width: 900px;
        margin: 120px auto;
        padding: 60px;
        background-color: #fff;
    }
</style>
