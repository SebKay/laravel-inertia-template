<template>
    <div class="notice" :class="cssClass" v-if="active && type && message">
        <p class="notice__description" v-text="message"></p>
    </div>
</template>

<script>
    import { router } from "@inertiajs/vue3";

    export default {
        data() {
            return {
                active: false,
                type: "",
                message: "",
                cssClass: "",
            };
        },

        watch: {
            "$page.props.notice": {
                handler() {
                    this.setNotice(router.page.props.notice, "success");
                },
            },
            "$page.props.errors": {
                handler() {
                    let errors = router.page.props.errors;

                    let firstError = errors[Object.keys(errors)[0]];

                    if (
                        !firstError ||
                        (Object.keys(errors).length === 0 &&
                            errors.constructor === Object)
                    ) {
                        return;
                    }

                    this.type = "error";
                    this.message = firstError;

                    this.setActive();

                    this.setClasses();
                },
            },
        },

        methods: {
            setNotice(notice, type) {
                if (type && notice.message != "") {
                    this.type = type;
                    this.message = notice.message;

                    this.setActive();
                }

                this.setClasses();
            },

            setActive() {
                this.active = true;

                setTimeout(() => {
                    this.active = false;
                }, 3000);
            },

            setClasses() {
                if (this.type == "error") {
                    this.cssClass = "notice--error";
                } else if (this.type == "success") {
                    this.cssClass = "notice--success";
                }
            },
        },
    };
</script>

<style lang="scss">
    .notice {
        max-width: 400px;
        padding: 20px;
        margin-bottom: 30px;
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 950;
        // Type
        background-color: #f8f9fa;
        color: #212529;

        &--error {
            background-color: #f8d7da;
            // Type
            color: #721c24;
        }

        &--success {
            background-color: #d4edda;
            // Type
            color: #155724;
        }
    }

    .notice__description {
        @include rem(16px);
    }
</style>
