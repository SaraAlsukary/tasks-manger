<template>
    <div class="card flex justify-center">
        <Dialog v-model:visible="localVisible" modal header="Show" :style="{ width: '25rem' }">
            <template v-if="data">
                <span class="text-surface-500 dark:text-surface-400 block mb-8"></span>
                <div class="flex items-center gap-4 mb-4">
                    <label for="name" class="font-semibold w-24">Name:</label>
                    <span>{{ data.name }}</span>
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="description" class="font-semibold w-24">Description:</label>
                    <span>{{ data.description }}</span>
                </div>
                <div class="flex justify-end gap-2">
                    <Button type="button" label="Close" @click="closeShow"></Button>
                </div>
            </template>
            <div v-else class="text-center py-4">
                Loading team data...
            </div>
        </Dialog>
    </div>
</template>

<script setup>
const props = defineProps({
    closeShow: Function,
    visible: Boolean,
    id: Number,

    // id: {
    //     type: Number,
    //     required: true,
    //     validator: value => value > 0
    // }
})
import { computed, ref, watch } from 'vue';
import { Dialog, Button } from 'primevue';
import { useStore } from 'vuex';
const store = useStore()

const emit = defineEmits(['show:visible','refresh']);
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
            emit('show:visible', newVal);
        }
    }
);
const data = computed(() => {
    const team = store.getters['team/getTeamyById'](props.id)
    return team || null;
})


</script>
