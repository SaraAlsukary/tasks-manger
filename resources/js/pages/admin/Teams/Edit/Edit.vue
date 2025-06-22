<template>
    <div class="card flex justify-center">
        <Dialog v-model:visible="localVisible" modal header="Edit Profile" :style="{ width: '25rem' }">
            <template v-if="data">
                <span class="text-surface-500 dark:text-surface-400 block mb-8">Update</span>
                <div class="flex items-center gap-4 mb-4">
                    <label for="name" class="font-semibold w-24">Name:</label>
                    <InputText id="name" class="flex-auto" autocomplete="off" v-model="formData.name"
                        :value="formData.name" />
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="description" class="font-semibold w-24">Description:</label>
                    <InputText id="description" class="flex-auto" v-model="formData.description" autocomplete="off"
                        :value="formData.description" />
                </div>
                <div class="flex justify-end gap-2">
                    <Button type="button" label="Cancel" severity="secondary" @click="closeEdit"></Button>
                    <Button type="button" label="Save" @click="handle"></Button>
                </div>
            </template>
            <div v-else class="text-center py-4">
                Loading team data...
                <Button type="button" label="Cancel" severity="secondary" @click="closeEdit"></Button>

            </div>
        </Dialog>
    </div>
</template>

<script setup>
const props = defineProps({
    closeEdit: Function,
    visible: Boolean,
    id: Number,
})
import { computed, reactive } from 'vue';
import { Dialog, Button, InputText } from 'primevue';
import { ref } from 'vue';
import { useStore } from 'vuex';
import { useToast } from 'primevue';
import { watch } from 'vue';

const toast = useToast()
const store = useStore()
const data = computed(() => {
    const team = store.getters['team/getTeamyById'](props.id)
    return team || null;
});

const formData = reactive({
    id: null,
    name: '',
    description: ''
});
const emit = defineEmits(['update:visible']);
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
            emit('update:visible', newVal);
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
        await store.dispatch('team/updateTeam', {
            data: formData,
            id: props.id
        })

        toast.add({ severity: 'success', summary: 'Success Message', detail: 'Edited Successfully!', life: 3000 });

        // Reset form and close dialog
        formData.name = '';
        formData.description = '';
        props.closeEdit()
        localVisible.value = false
    } catch (error) {
        toast.add({
            severity: 'error',
            summary: 'Error',
            detail: error.message || 'Failed to update team',
            life: 3000
        });
    }
}


// Initialize form when team data changes
watch(data, (newTeam) => {
    if (newTeam) {
        formData.id = props.id
        formData.name = newTeam.name
        formData.description = newTeam.description
    };
}
    , { immediate: true });


</script>
