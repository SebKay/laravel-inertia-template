<template>

    <Head :title="title" />

    <h1
        v-text="title"
        class="xl:text-4xl text-3xl font-medium text-neutral-900 xl:mb-8 mb-4"
    ></h1>

    <div class="bg-white rounded-2xl xl:p-10 p-6 border border-brand-200">
        <div>
            <div class="space-y-6">
                <h4 class="heading h4">
                    Forms
                </h4>

                <form>
                    <div class="form-row">
                        <div class="form-col">
                            <label
                                class="label"
                                for="text"
                            >
                                Text
                            </label>
                            <input
                                id="text"
                                class="input"
                                type="text"
                                required
                            />
                        </div>

                        <div class="form-col">
                            <label
                                class="label"
                                for="email"
                            >
                                Email
                            </label>
                            <input
                                id="email"
                                class="input"
                                type="email"
                                required
                            />
                        </div>

                        <div class="form-col">
                            <label
                                class="label"
                                for="textarea"
                            >
                                Textarea
                            </label>
                            <textarea
                                id="textarea"
                                class="textarea"
                                required
                            ></textarea>
                        </div>

                        <div class="form-col">
                            <label
                                class="inline-label"
                                for="checkbox"
                            >
                                <input
                                    id="checkbox"
                                    class="checkbox"
                                    type="checkbox"
                                    required
                                />
                                Checkbox
                            </label>
                        </div>

                        <div class="form-col">
                            <label
                                class="inline-label"
                                for="radio"
                            >
                                <input
                                    id="radio"
                                    class="radio"
                                    type="radio"
                                    required
                                />
                                Radio
                            </label>
                        </div>

                        <div class="form-col">
                            <label class="inline-flex items-center gap-3 cursor-pointer">
                                <input
                                    class="sr-only peer"
                                    type="checkbox"
                                />
                                <div
                                    class="relative w-9 h-5 bg-neutral-200 peer-focus:outline-hidden rounded-full peer peer-checked:after:translate-x-full peer-checked:rtl:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:size-4 after:transition-all peer-checked:bg-brand-600">
                                </div>
                                <span class="text-sm font-medium">
                                    Toggle
                                </span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from "vue";

    const title = ref("Elements");
</script>
