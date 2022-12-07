<template>
    <button :class="getCssClasses()" @click="$emit('activated', true)">
        <span class="btn__text" v-text="text"></span>
    </button>
</template>

<script>
    export default {
        emits: ["activated"],

        props: {
            text: {
                type: String,
                default: "Submit",
            },
        },

        data() {
            return {
                cssClasses: ["btn"],
            };
        },

        methods: {
            getCssClasses() {
                return this.cssClasses.join(" ");
            },
        },
    };
</script>
