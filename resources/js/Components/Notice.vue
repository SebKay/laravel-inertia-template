<template>
    <div
        v-if="active && type && message"
        class="flex items-center p-5 text-base fixed bottom-4 right-4 z-50"
        :class='{
            "bg-green-50 border-green-200 text-green-800": type === "success",
            "bg-red-50 border-red-200 text-red-800": type === "error",
        }'
        role="alert"
    >
        <CheckCircleIcon
            v-if="type == 'success'"
            class="flex-shrink-0 inline w-6 h-6 me-3"
        />
        <XCircleIcon
            v-if="type == 'error'"
            class="flex-shrink-0 inline w-6 h-6 me-3"
        />
        <div>
            <span v-text="message"></span>
        </div>
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
            };
        },

        mounted() {
            router.on('finish', () => {
                let message = router.page.props.message;
                let error = Object.values(router.page.props.errors)[0] || null;

                if (message) {
                    this.setNotice(router.page.props.message, "success");
                } else if (error) {
                    this.setNotice(error, "error");
                }
            });
        },

        methods: {
            setNotice(message, type) {
                this.type = type;
                this.message = message;

                this.setActive();
            },

            setActive() {
                this.active = true;

                setTimeout(() => {
                    this.active = false;
                }, 3000);
            },
        },
    };
</script>
