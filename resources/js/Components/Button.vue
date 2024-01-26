<template>
    <button
        class="rounded-md bg-slate-800 px-6 py-3 text-sm font-semibold text-white inline-flex shadow-sm hover:bg-slate-500"
    >
        <span v-text="text"></span>
    </button>
</template>

<script>
    export default {
        props: {
            text: {
                type: String,
                default: "Submit",
            },
        },
    };
</script>
