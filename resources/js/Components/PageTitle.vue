<template>
    <h1
        v-text="text"
        class="xl:text-4xl text-3xl font-medium text-neutral-900 text-center"
    ></h1>
</template>

<script setup>
    const props = defineProps({
        text: String,
    });
</script>
