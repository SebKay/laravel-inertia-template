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
            class="shrink-0 inline w-6 h-6 me-3"
        />
        <p v-text="message"></p>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import { router, usePage } from "@inertiajs/vue3";

    const page = usePage();

    const active = ref(false);
    const icon = ref("");
    const type = ref("");
    const message = ref("");

    onMounted(() => {
        router.on('finish', () => {
            let error = Object.values(page.props.errors)[0] || page.props.error;

            if (page.props.success) {
                icon.value = "CheckCircleIcon";
                type.value = "success";
                message.value = page.props.success;
            } else if (error) {
                icon.value = "XCircleIcon";
                type.value = "error";
                message.value = error;
            } else if (page.props.warning) {
                icon.value = "ExclamationCircleIcon";
                type.value = "warning";
                message.value = page.props.warning;
            }

            setActive();
        });
    });

    function reset() {
        icon.value = "";
        type.value = "";
        message.value = "";
    }

    function setActive() {
        if (!type && !message) {
            return;
        }

        active.value = true;

        setTimeout(() => {
            active.value = false;

            reset();
        }, 4000);
    };
</script>
