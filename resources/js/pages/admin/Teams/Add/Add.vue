<template>
    <div class="card flex justify-center">
        <Dialog v-model:visible="localVisible" modal header="Add" :style="{ width: '25rem' }">
            <div class="flex items-center gap-4 mb-4">
                <label for="name" class="font-semibold w-24">Name</label>
                <InputText id="name" class="flex-auto" autocomplete="off" v-model="formData.name" />
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="description" class="font-semibold w-24">Description</label>
                <InputText id="description" class="flex-auto" v-model="formData.description" autocomplete="off" />
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
    visible: Boolean,
    closeAdd: Function
});

import { Dialog, Button, InputText } from 'primevue';
import { ref, watch } from 'vue';
import { useStore } from 'vuex';
import { useToast } from 'primevue';
import { reactive } from 'vue';
const toast = useToast()
const store = useStore()

const formData = reactive({
    name: '',
    description: ''
});

const emit = defineEmits(['add:visible']);
const localVisible = ref(props.visible);

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
        if (!formData.name.trim()) {
            toast.add({
                severity: 'error',
                summary: 'Validation Error',
                detail: 'Name is required',
                life: 3000
            });
            return;
        }

        // Dispatch the action with the correct payload
        await store.dispatch('team/createTeam', {
            name: formData.name,
            description: formData.description
        });

        toast.add({
            severity: 'success',
            summary: 'Success',
            detail: 'Team created successfully!',
            life: 3000
        });

        // Reset form and close dialog
        formData.name = '';
        formData.description = '';
        props.closeAdd()
    } catch (error) {
        toast.add({
            severity: 'error',
            summary: 'Error',
            detail: error.message || 'Failed to create team',
            life: 3000
        });
    }
};


</script>
