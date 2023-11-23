<template>
    <Head>
        <title></title>
    </Head>

    <!-- <Header /> -->

    <!-- <div class="guest-page">
        <Notice />

        <div class="guest-page__inner">
            <slot />
        </div>
    </div> -->

    <div class="min-h-full">
        <Header :menu="menu" />

        <main>
            <div class="mx-auto max-w-7xl lg:py-16 py-8 px-4 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<script>
    import Header from "@js/Components/Header.vue";

    export default {
        name: "Guest Layout",

        components: {
            Header,
        },

        data() {
            return {
                menu: [
                    {
                        label: "Login",
                        route: route("login"),
                        condition: true,
                        components: ['Login/Show'],
                    },
                    {
                        label: "Register",
                        route: route("register"),
                        condition: true,
                        components: ['Register/Show'],
                    },
                ],
            };
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
