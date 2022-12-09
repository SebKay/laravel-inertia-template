<template>
    <Head>
        <title></title>
    </Head>

    <div class="app-page">
        <div class="app-page__inner">
            <Link :href="route('account.edit')">Account</Link>
            <br>
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
