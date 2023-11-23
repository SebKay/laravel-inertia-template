<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="lg:text-4xl text-3xl font-medium text-slate-800 lg:mb-8 mb-4"
    ></h1>

    <div class="bg-white rounded-2xl lg:p-10 p-6 border border-slate-200">
        <form @submit.prevent="updateOrganisation">
            <div class="grid grid-cols-1 gap-5 sm:gap-7 sm:grid-cols-6">
                <div class="col-span-full">
                    <label
                        class="pb-2 block text-base font-medium leading-6 text-slate-800"
                        for="name"
                    >
                        Name
                    </label>
                    <input
                        id="name"
                        type="text"
                        required
                        class="block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                        v-model="organisationForm.name"
                    />
                </div>

                <div class="col-span-full">
                    <Button
                        text="Update"
                        :disabled="organisationForm.processing"
                    />
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    export default {
        props: {
            organisation: Object,
        },

        data() {
            return {
                title: "Organisation",
                organisationForm: useForm({
                    name: this.organisation.name,
                }),
            };
        },

        methods: {
            updateOrganisation() {
                this.organisationForm.patch(route("organisation.update"), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
