<template>
    <select
    v-model="localSelected"
    :multiple="multiple" @change="eventChange" id="small"
        class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option v-for="option in options" :value="option.code" :selected="option.name === 'ar' ? true : false">
            {{ option.name }}
        </option>
    </select>
</template>

<script setup>
import { Dropdown } from 'primevue'
import { watch } from 'vue';
import { ref } from 'vue';
   const props = defineProps( {
        options: Object,
        eventChange: Function,
        multiple: Boolean,
        selected:Array

   });
const emit = defineEmits(['update:selected']);
const localSelected = ref([])
watch(localSelected, (newVal) => {
    emit('update:selected',newVal)
})
watch(()=>props.selected, (newVal) => {
    localSelected.value = newVal
})
</script>
<style scoped>
.p-select {
    background-color: #c7c7d9 !important;
}

.p-select-dropdown .p-select-overlay {
    background-color: #c7c7d9 !important;
}
</style>
