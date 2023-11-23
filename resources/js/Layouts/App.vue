<template>
    <Head>
        <title></title>
    </Head>

    <div class="min-h-full">
        <Header :menu="menu" />

        <main>
            <div class="mx-auto max-w-7xl lg:py-16 py-8 px-4 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>
    </div>

    <Notice />
</template>

<script>
    import { router } from "@inertiajs/core";

    import Header from "@js/Components/Header.vue";
    import Notice from "@js/Components/Notice.vue";

    export default {
        name: "App Layout",

        components: {
            Header,
            Notice,
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
