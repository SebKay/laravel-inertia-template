<template>
    <Head>
        <title></title>
    </Head>

    <Header>
        <template #menu>
            <Menu :links="menu" />
            <Hamburger
                :active="mobileMenuOpen"
                @click.prevent="mobileMenuOpen = !mobileMenuOpen"
            />
        </template>

        <template #mobile-menu>
            <MobileMenu
                :links="menu"
                v-show="mobileMenuOpen"
            />
        </template>
    </Header>

    <div class="app-page">
        <Notice />

        <div class="app-page__inner">
            <slot />
        </div>
    </div>
</template>

<script>
    import { router } from "@inertiajs/core";

    import Header from "@js/Components/Header.vue";
    import Menu from "@js/Components/Menu.vue";
    import Hamburger from "@js/Components/Hamburger.vue";
    import MobileMenu from "@js/Components/MobileMenu.vue";

    export default {
        name: "App Layout",

        components: {
            Header,
            Menu,
            Hamburger,
            MobileMenu,
        },

        data() {
            return {
                menu: [
                    {
                        label: "Home",
                        route: "home",
                        components: ['Home/Index'],
                    },
                    {
                        label: "Account",
                        route: "account.edit",
                        components: ['Account/Edit'],
                    },
                    {
                        label: "Logout",
                        route: "logout",
                        method: "post",
                        components: [],
                    },
                ],

                mobileMenuOpen: false,
            };
        },

        mounted() {
            router.on("success", () => {
                this.mobileMenuOpen = false;
            });
        },
    };
</script>

<style lang="scss">
    body {
        background-color: color(bg-1);
    }

    .app-page__inner {
        @extend %d-mv-120;
        @extend %m-mv-20;
        width: 94%;
        max-width: 900px;
        margin-right: auto;
        margin-left: auto;
    }
</style>
