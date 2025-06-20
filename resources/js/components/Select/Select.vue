<template>
        <select id="small"
            class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option v-for="option in options" :value="option.code">{{ option.name }}</option>
        </select>
</template>

<script>
import { Dropdown } from 'primevue';
export default {
    components: {
        Dropdown
    },
    props: {
        options: Object
    }
};
</script>
<style scoped>
.p-select {
    background-color: #c7c7d9 !important;
}

.p-select-dropdown .p-select-overlay {
    background-color: #c7c7d9 !important;
}
</style>
