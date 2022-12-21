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

<style lang="scss">
    .btn {
        @include rem(16px);
        padding: 12px 20px;
        display: inline-flex;
        cursor: pointer;
        border-radius: border-radius(buttons);
        background-color: $ui-color-1;
        // Type
        font-weight: bold;
        color: #fff;
    }
</style>
