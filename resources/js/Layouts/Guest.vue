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
