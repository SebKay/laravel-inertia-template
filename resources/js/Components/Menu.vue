<template>
    <nav
        v-if="links.length > 0"
        class="menu"
    >
        <MenuLink
            v-for="link in links"
            :link="link"
            :classes="['menu__item', { 'menu__item--active': link.components.includes($page.component) }]"
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
    .menu {
        display: flex;
    }

    .menu__item {
        // Type
        font-family: font(1);
        font-weight: font-weight(semi-bold);
        text-decoration: none;
        color: #000;
    }

    .menu__item--active {
        border-bottom: 1px solid #000;
    }

    //---- Responsive ----//
    @media (min-width: (breakpoint(tablet-1) + 1)) {
        .menu {
            column-gap: 40px;
        }

        .menu__item {
            @include rem(18px);
        }
    }

    @media (max-width: breakpoint(tablet-1)) {
        .menu {
            column-gap: 30px;
        }

        .menu__item {
            @include rem(16px);
        }
    }
</style>
