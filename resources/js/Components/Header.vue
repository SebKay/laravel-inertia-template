<template>
    <header class="bg-white border-b border-slate-200">
        <nav>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <Link :href="route('home')">
                        <SparklesIcon class="h-8 w-8 flex-shrink-0" />
                        </Link>
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
                                            'bg-slate-100 text-slate-800': link.components.includes($page.component),
                                            'text-slate-500 hover:text-slate-900': !link.components.includes($page.component),
                                        }"
                                    />
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="-mr-2 flex md:hidden">
                        <button
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            type="button"
                            class="relative inline-flex items-center justify-center rounded-md bg-slate-100 p-2 text-slate-900 hover:bg-slate-900 hover:text-white"
                        >
                            <span class="sr-only">Open main menu</span>
                            <XMarkIcon
                                v-if="mobileMenuOpen"
                                class="block h-6 w-6"
                            />
                            <Bars3Icon
                                v-else
                                class="block h-6 w-6"
                            />
                        </button>
                    </div>
                </div>
            </div>

            <div
                v-show="mobileMenuOpen"
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
                                'bg-slate-100 text-slate-800': link.components.includes($page.component),
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

        data() {
            return {
                mobileMenuOpen: false,
            };
        },
    };
</script>
