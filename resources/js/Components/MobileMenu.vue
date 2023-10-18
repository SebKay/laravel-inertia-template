<template>
    <nav
        v-if="links.length > 0"
        class="mobile-menu"
    >
        <MenuLink
            v-for="link in links"
            :link="link"
            :classes="['mobile-menu__item', { 'mobile-menu__item--active': link.components.includes($page.component) }]"
        />
    </nav>
</template>

<script>
    import MenuLink from "@js/Components/MenuLink.vue";

    export default {
        components: {
            MenuLink,
        },

        props: {
            links: {
                type: Array,
                required: true,
            },
        },
    };
</script>

<style lang="scss">
    .mobile-menu {
        width: 100%;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        row-gap: 15px;
        background-color: color(bg-1);
    }

    .mobile-menu__item {
        @include rem(16px);
        // Type
        font-family: font(1);
        font-weight: font-weight(semi-bold);
        text-decoration: none;
        color: transparentize(color(2), 0.35);
    }

    .mobile-menu__item--active {
        // Type
        color: color(2);
    }
</style>
