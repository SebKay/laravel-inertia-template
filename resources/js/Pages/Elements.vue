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
