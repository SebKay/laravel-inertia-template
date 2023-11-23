<template>
    <button class="rounded-md w-full bg-slate-800 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-slate-500">
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
            styles: String | Array,
        },

        computed: {
            classes() {
                let classes = ["btn"];

                if (this.styles) {
                    if (this.styles.constructor.name === "String") {
                        classes.push(`btn--${this.styles}`);
                    } else if (this.styles.constructor.name === "Array") {
                        this.styles.forEach((style) => {
                            classes.push(`btn--${style}`);
                        });
                    }
                }

                return classes.join(" ");
            },
        },
    };
</script>
