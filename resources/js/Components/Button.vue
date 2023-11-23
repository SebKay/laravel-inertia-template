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

<style lang="scss">
    // .btn {
    //     display: inline-flex;
    //     justify-content: center;
    //     cursor: pointer;
    //     border-radius: radius(buttons);
    //     background-color: color(1);
    //     // Type
    //     font-family: font(1);
    //     font-weight: font-weight(bold);
    //     text-align: center;
    //     color: #fff;
    // }

    // .btn--full {
    //     width: 100%;
    // }

    // .btn[disabled] {
    //     opacity: 0.5;
    //     cursor: not-allowed;
    // }

    // //---- Responsive ----//
    // @media (min-width: (breakpoint(mobile-1) + 1)) {
    //     .btn {
    //         @include rem(18px);
    //         padding: 17px 25px;
    //     }
    // }

    // @media (max-width: breakpoint(mobile-1)) {
    //     .btn {
    //         @include rem(16px);
    //         padding: 13px 20px;
    //     }
    // }
</style>
