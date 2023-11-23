<template>
    <Head>
        <title></title>
    </Head>

    <!-- <Header>
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
    </Header> -->

    <!-- <div class="app-page">
        <Notice />

        <div class="app-page__inner">
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
                        route: route("home"),
                        condition: true,
                        components: ['Home/Index'],
                    },
                    {
                        label: "Account",
                        route: route("account.edit"),
                        condition: true,
                        components: ['Account/Edit'],
                    },
                    {
                        label: "Organisation",
                        route: route("organisation.edit"),
                        condition: this.userCan(this.$page.props, 'edit-organisation'),
                        components: ['Organisation/Edit'],
                    },
                    {
                        label: "Logout",
                        route: route("logout"),
                        method: "post",
                        condition: true,
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
    // body {
    //     background-color: color(bg-1);
    // }

    // .app-page__inner {
    //     @extend %d-mv-120;
    //     @extend %m-mv-20;
    //     width: 94%;
    //     max-width: 900px;
    //     margin-right: auto;
    //     margin-left: auto;
    // }
</style>
