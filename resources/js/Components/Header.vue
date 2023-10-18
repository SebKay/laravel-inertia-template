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

            <div class="header__section header__section--mobile-menu">
                <slot name="mobile-menu" />
            </div>
        </div>
    </header>
</template>

<style lang="scss">
    .header {
        width: 100%;
        box-shadow: shadow(1);
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
        flex-wrap: wrap;
    }

    .header__section {
        width: 50%;
        display: flex;
    }

    .header__logo {
        // Type
        font-weight: font-weight(bold);
        text-transform: uppercase;
        text-decoration: none;
        color: color(2);
    }

    .header__section--menu {
        justify-content: flex-end;
    }

    //---- Responsive ----//
    @media (min-width: (breakpoint(tablet-1) + 1)) {
        .header__logo {
            @include rem(32px);
        }
    }

    @media (max-width: breakpoint(tablet-1)) and (min-width: (breakpoint(mobile-1) + 1)) {
        .header__logo {
            @include rem(28px);
        }
    }

    @media (min-width: (breakpoint(mobile-1) + 1)) {

        .header__section--menu .hamburger,
        .header__section--mobile-menu {
            display: none;
        }
    }

    @media (max-width: breakpoint(mobile-1)) {
        .header__inner {
            .menu {
                display: none;
            }

            .mobile-menu {
                margin-top: 15px;
            }
        }

        .header__logo {
            @include rem(26px);
        }

        .header__section--mobile-menu {
            width: 100%;
        }
    }
</style>
