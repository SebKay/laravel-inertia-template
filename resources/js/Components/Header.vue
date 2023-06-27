<template>
    <header class="header">
        <div class="header__inner">
            <div class="header__section header__section--logo">
                <Link
                    :href="route('home')"
                    class="header__logo"
                    text="Logo"
                />
            </div>

            <div class="header__section header__section--menu">
                <slot name="menu" />
            </div>
        </div>
    </header>
</template>

<script>
    export default {
    };
</script>

<style lang="scss">
    .header {
        width: 100%;
        background-color: #fff;
    }

    .header__inner {
        @extend %d-pv-30;
        @extend %m-pv-15;
        width: 94%;
        max-width: 1280px;
        margin-right: auto;
        margin-left: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header__logo {
        // Type
        font-weight: font-weight(bold);
        text-transform: uppercase;
        text-decoration: none;
        color: #000;
    }

    //---- Responsive ----//
    @media (min-width: (breakpoint(tablet-1) + 1)) {
        .header__inner {
            column-gap: 40px;
        }

        .header__logo {
            @include rem(32px);
        }
    }

    @media (max-width: breakpoint(tablet-1)) and (min-width: (breakpoint(mobile-1) + 1)) {
        .header__inner {
            column-gap: 30px;
        }

        .header__logo {
            @include rem(28px);
        }
    }

    @media (max-width: breakpoint(mobile-1)) {
        .header__inner {
            column-gap: 20px;
        }

        .header__logo {
            @include rem(26px);
        }
    }
</style>
