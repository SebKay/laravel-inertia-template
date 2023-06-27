<template>
    <nav class="menu">
        <Link
            class="menu__item"
            :href="route('home')"
            :class="{ 'menu__item--active': $page.component.includes('Home/Index') }"
        >Home</Link>
        <Link
            class="menu__item"
            :class="{ 'menu__item--active': $page.component.includes('Account/Edit') }"
            :href="route('account.edit')"
        >Account</Link>
        <Link
            :href="route('logout')"
            class="menu__item"
            method="post"
            as="button"
        >Logout</Link>
    </nav>
</template>

<script>
    export default {
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
