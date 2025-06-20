<template>

    <button :disabled="disabled" @click="click"
        class="button border border-gray-400 rounded-lg hover:bg-blue-500 hover:text-white transition duration-200 ease-in-out focus:outline-none">
        {{ text }}
    </button>

</template>

<script setup>
defineProps({
    text: String,
    disabled: Boolean,
    click: Function
});

</script>
<style scoped>
.button {
    color: var(--main-color);
    padding: 5px 10px;
    border: 1px solid var(--main-color);
}

.button:hover {
    background-color: var(--main-color);
    color: #fff;
}
</style>
