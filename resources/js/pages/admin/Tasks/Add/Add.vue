<template>
    <div class="card flex justify-center">
        <Dialog v-model:visible="localVisible" modal header="Add" :style="{ width: '25rem' }">
            <div class="items-center gap-4 mb-4">
                <label for="name" class="block font-semibold w-100">{{ $t('Name') }}</label>
                <InputText id="name" class="flex-auto w-full my-2" autocomplete="off" v-model="formName.en" />
            </div>
            <div class=" items-center gap-4 mb-4">
                <label for="name" class="block font-semibold w-100">{{ $t('NameArabic') }}</label>
                <InputText id="name" class="flex-auto w-full my-2" autocomplete="off" v-model="formName.ar" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="closeAdd"></Button>
                <Button type="button" label="Save" @click="handle"></Button>
            </div>
        </Dialog>
    </div>
</template>

<script setup>
const props = defineProps({
    closeAdd: Function,
    visible: Boolean
});

import { Dialog, Button, InputText } from 'primevue';
import { ref, watch } from 'vue';
import { useStore } from 'vuex';
import { useToast } from 'primevue';
import { reactive } from 'vue';
const toast = useToast()
const store = useStore()

const formName = reactive({
    en: '',
    ar: ""
})

const formData = reactive({
    name: formName,
});

const emit = defineEmits(['add:visible']);
const localVisible = ref(props.visible);

const $t = (key) => {
    return window.translations?.[key] || key;
}

watch(
    () => props.visible,
    (newVal) => {
        if (newVal !== localVisible.value) {
            localVisible.value = newVal;
        }
    },
    { immediate: true }
);

watch(
    localVisible,
    (newVal) => {
        if (newVal !== props.visible) {
            emit('add:visible', newVal);
        }
    }
);
const handle = async () => {

    try {
        // Ensure required fields are filled
        if (!formData.name) {
            toast.add({
                severity: 'error',
                summary: 'Validation Error',
                detail: 'Name is required',
                life: 3000
            });
            return;
        }
        formData.name = formName
        // Dispatch the action with the correct payload
        await store.dispatch('task/createTask', {
            name: formData.name,
            description: formData.description
        });

        toast.add({
            severity: 'success',
            summary: 'Success',
            detail: 'Task created successfully!',
            life: 3000
        });

        // Reset form and close dialog
        formData.name = {};
        formName.ar = ''
        formName.en = ''
        props.closeAdd()
    } catch (error) {
        toast.add({
            severity: 'error',
            summary: 'Error',
            detail: error.message || 'Failed to create task',
            life: 3000
        });
    }
};


</script>
