<template>
    <Link
        :href="route(link.route)"
        :class="classes"
        :method="link?.method"
        :as="link?.method == 'post' ? 'button' : 'a'"
    >
    {{ link.label }}
    </Link>
</template>

<script>
    export default {
        props: {
            link: {
                type: Object,
                required: true,
            },
            classes: {
                type: Array,
            },
        },
    };
</script>
