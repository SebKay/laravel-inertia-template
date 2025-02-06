<template>
    <header class="bg-white border-b border-brand-200 px-4 sm:px-6 xl:px-8">
        <nav>
            <div class="mx-auto max-w-7xl">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <Link :href="route('home')">
                        <SparklesIcon class="h-8 w-8 shrink-0 text-brand-800" />
                        </Link>
                    </div>

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
                                    class="rounded-xl px-3 py-2 text-sm font-medium transition-colors ease-in-out duration-200"
                                    :class="{
                                        'bg-brand-100 text-brand-950': link.components.includes($page.component),
                                        'text-brand-600 hover:text-brand-950 focus:text-brand-950': !link.components.includes($page.component),
                                    }"
                                />
                            </template>
                        </div>
                    </div>

                    <div class="-mr-2 flex md:hidden">
                        <button
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            type="button"
                            class="relative inline-flex items-center justify-center rounded-md bg-brand-100 p-2 text-brand-900 hover:bg-brand-900 hover:text-white"
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
                                'bg-brand-100 text-brand-950': link.components.includes($page.component),
                                'text-brand-600 focus:text-brand-950': !link.components.includes($page.component),
                            }"
                            aria-current="page"
                        />
                    </template>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup>
    import { ref, onMounted } from "vue";
    import { router } from '@inertiajs/vue3'

    const props = defineProps({
        menu: Array,
    });

    const mobileMenuOpen = ref(false);

    onMounted(() => {
        router.on("success", () => {
            mobileMenuOpen.value = false;
        });
    });
</script>
