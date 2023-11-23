<template>
    <header class="bg-white border-b border-slate-200">
        <nav>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <SparklesIcon class="h-8 w-8" />
                        </div>
                    </div>

                    <div class="hidden md:block">
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <template
                                    v-for="link in menu"
                                    :key="link.label"
                                >
                                    <Link
                                        v-if="link.condition"
                                        :href="link.route"
                                        :method="link?.method"
                                        :as="link?.method == 'post' ? 'button' : 'a'"
                                        v-text="link.label"
                                        class="rounded-xl px-3 py-2 text-sm font-medium"
                                        :class="{
                                            'bg-slate-100': link.components.includes($page.component),
                                            'text-slate-500 hover:text-slate-900': !link.components.includes($page.component),
                                        }"
                                    />
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="-mr-2 flex md:hidden">
                        <button
                            type="button"
                            class="relative inline-flex items-center justify-center rounded-md bg-slate-100 p-2 text-slate-900 hover:bg-slate-900 hover:text-white"
                        >
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon class="block h-6 w-6" />
                            <XMarkIcon class="hidden h-6 w-6" />
                        </button>
                    </div>
                </div>
            </div>

            <div
                id="mobile-menu"
                class="md:hidden"
            >
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <template
                        v-for="link in menu"
                        :key="link.label"
                    >
                        <Link
                            v-if="link.condition"
                            :href="link.route"
                            v-text="link.label"
                            class="rounded-xl px-3 py-2 text-base font-medium block"
                            :class="{
                                'bg-slate-100': link.components.includes($page.component),
                                'text-slate-500 hover:text-slate-900': !link.components.includes($page.component),
                            }"
                            aria-current="page"
                        />
                    </template>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
    export default {
        props: {
            menu: Array,
        },
    };
</script>

<style lang="scss">
    // .header {
    //     width: 100%;
    //     box-shadow: shadow(1);
    //     background-color: #fff;
    // }

    // .header__inner {
    //     @extend %d-pv-30;
    //     @extend %m-pv-15;
    //     width: 94%;
    //     max-width: 1280px;
    //     margin-right: auto;
    //     margin-left: auto;
    //     display: flex;
    //     align-items: center;
    //     justify-content: space-between;
    //     flex-wrap: wrap;
    // }

    // .header__section {
    //     width: 50%;
    //     display: flex;
    // }

    // .header__logo {
    //     // Type
    //     font-weight: font-weight(bold);
    //     text-transform: uppercase;
    //     text-decoration: none;
    //     color: color(2);
    // }

    // .header__section--menu {
    //     justify-content: flex-end;
    // }

    // //---- Responsive ----//
    // @media (min-width: (breakpoint(tablet-1) + 1)) {
    //     .header__logo {
    //         @include rem(32px);
    //     }
    // }

    // @media (max-width: breakpoint(tablet-1)) and (min-width: (breakpoint(mobile-1) + 1)) {
    //     .header__logo {
    //         @include rem(28px);
    //     }
    // }

    // @media (min-width: (breakpoint(mobile-1) + 1)) {

    //     .header__section--menu .hamburger,
    //     .header__section--mobile-menu {
    //         display: none;
    //     }
    // }

    // @media (max-width: breakpoint(mobile-1)) {
    //     .header__inner {
    //         .menu {
    //             display: none;
    //         }

    //         .mobile-menu {
    //             margin-top: 15px;
    //         }
    //     }

    //     .header__logo {
    //         @include rem(26px);
    //     }

    //     .header__section--mobile-menu {
    //         width: 100%;
    //     }
    // }
</style>
