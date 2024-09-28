<template>

    <Head>
        <title></title>
    </Head>

    <div class="min-h-full">
        <Header :menu="menu" />

        <main>
            <div class="mx-auto max-w-7xl xl:py-16 py-8 px-4 sm:px-6 xl:px-8">
                <slot />
            </div>
        </main>
    </div>

    <Notice />
</template>

<script setup>
    import { ref, computed, onMounted } from "vue";
    import { usePage, router } from '@inertiajs/vue3'

    import Header from "@js/Components/Header.vue";
    import Notice from "@js/Components/Notice.vue";

    const page = usePage();

    const mobileMenuOpen = ref(false);

    const menu = computed(() => {
        if (page.props.auth.loggedIn) {
            return [
                {
                    label: "Dashboard",
                    route: route("home"),
                    condition: true,
                    components: ['Dashboard/Index'],
                },
                {
                    label: "Account",
                    route: route("account.edit"),
                    condition: true,
                    components: ['Account/Edit', 'EmailVerification/Show'],
                },
                {
                    label: "Logout",
                    route: route("logout"),
                    method: "post",
                    condition: true,
                    components: [],
                },
            ];
        }

        return [
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
        ];
    });

    onMounted(() => {
        router.on("success", () => {
            mobileMenuOpen.value = false;
        });
    });
</script>
