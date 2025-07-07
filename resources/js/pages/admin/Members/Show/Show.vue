<template>
    <div class="card flex justify-center">
        <Dialog v-model:visible="localVisible" modal header="Show" :style="{ width: '25rem' }">
            <template v-if="data">
                <span class="text-surface-500 dark:text-surface-400 block mb-8"></span>
                <div class="flex items-center gap-4 mb-4">
                    <label for="name" class="font-semibold w-24">{{ $t('Name') }}:</label>
                    <span>{{ data.name }}</span>
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="description" class="font-semibold w-24">{{ $t("Email") }}:</label>
                    <span>{{ data.email }}</span>
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="description" class="font-semibold w-24">{{ $t("Teams") }}:</label>
                    <span v-for="team in data.teams" :key="team.id">{{ team.name }}</span>
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="description" class="font-semibold w-24">{{ $t("is_Manger") }}:</label>
               <Select :options="options" :eventChange="mangerHandler"/>
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
})
import { computed, ref, watch } from 'vue';
import { Dialog, Button } from 'primevue';
import { useStore } from 'vuex';
const store = useStore()
const $t = (key) => {
    return window.translations?.[key] || key;
}
const options = ref([
    { name: $t('yes'), code: 1 },
    { name: $t('no'), code: 0 }
])
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
const mangerHandler = () => {
    
}
watch(
    localVisible,
    (newVal) => {
        if (newVal !== props.visible) {
            emit('show:visible', newVal);
        }
    }
);
const data = computed(() => {
    const member = store.getters['member/getMemberById'](props.id)
    return member || null;
})

console.log(data.value)
</script>
