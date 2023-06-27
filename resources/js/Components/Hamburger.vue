<template>
    <button
        class="hamburger"
        :class="{ active }"
    >
        <span class="hamburger__line"></span>
        <span class="hamburger__line"></span>
        <span class="hamburger__line"></span>
    </button>
</template>

<script>
    export default {
        props: {
            active: {
                type: Boolean,
                required: true,
                default: false,
            },
        },
    };
</script>

<style lang="scss">
    .hamburger {
        width: 35px;
        height: 20px;
        position: relative;
    }

    .hamburger__line {
        width: 100%;
        height: 2px;
        background-color: #000;
        position: absolute;
        left: 0;

        &:nth-child(1) {
            top: 0px;
        }

        &:nth-child(2) {
            top: 9px;
        }

        &:nth-child(3) {
            top: 18px;
        }
    }

    .hamburger.active {
        .hamburger__line {
            &:nth-child(1) {
                top: 9px;
                transform: rotate(45deg);
            }

            &:nth-child(2) {
                opacity: 0;
            }

            &:nth-child(3) {
                top: 9px;
                transform: rotate(-45deg);
            }
        }
    }
</style>
