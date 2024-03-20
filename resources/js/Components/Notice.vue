<template>
    <div
        v-if="active && type && message"
        class="flex items-center p-5 text-base fixed bottom-4 right-4 z-50 rounded-xl"
        :class='{
            "bg-green-50 border-green-200 text-green-800": type === "success",
            "bg-red-50 border-red-200 text-red-800": type === "error",
            "bg-yellow-50 border-yellow-200 text-yellow-800": type === "warning",
        }'
        role="alert"
    >
        <component
            v-if="icon"
            :is="icon"
            class="flex-shrink-0 inline w-6 h-6 me-3"
        />
        <p v-text="message"></p>
    </div>
</template>

<script>
    import { router } from "@inertiajs/vue3";

    export default {
        data() {
            return {
                active: false,
                icon: "",
                type: "",
                message: "",
            };
        },

        mounted() {
            router.on('finish', () => {
                let error = Object.values(router.page.props.errors)[0] || null;
                let type = null;
                let message = null;

                if (router.page.props.success) {
                    type = "success";
                    message = router.page.props.success;
                } else if (router.page.props.error) {
                    type = "error";
                    error = router.page.props.error;
                } else if (router.page.props.warning) {
                    type = "warning";
                    message = router.page.props.warning;
                }

                if (message) {
                    this.setNotice(message, type);
                } else if (error) {
                    this.setNotice(error, "error");
                }
            });
        },

        methods: {
            setNotice(message, type) {
                this.type = type;
                this.message = message;

                if (type === "success") {
                    this.icon = "CheckCircleIcon";
                } else if (type === "error") {
                    this.icon = "XCircleIcon";
                } else if (type === "warning") {
                    this.icon = "ExclamationCircleIcon";
                }

                this.setActive();
            },

            setActive() {
                this.active = true;

                setTimeout(() => {
                    this.active = false;
                }, 4000);
            },
        },
    };
</script>
