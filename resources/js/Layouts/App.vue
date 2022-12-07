<template>
    <Head>
        <title></title>
    </Head>

    <div class="app-page">
        <div class="app-page__inner">
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
