<template>
    <Head>
        <title></title>
    </Head>

    <div class="min-h-full">
        <Header :menu="menu" />

        <main>
            <div class="mx-auto max-w-2xl lg:py-16 py-8 px-4 sm:px-6 lg:px-8">
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
