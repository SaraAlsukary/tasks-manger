<template>
    <div class="card flex justify-center">
        <Dialog v-model:visible="localVisible" modal header="Add" :style="{ width: '25rem' }">
            <div class="items-center gap-4 mb-4">
                <label for="name" class="block font-semibold w-100">{{ $t('Name') }}</label>
                <InputText v-model="formData.name" id="name" class="flex-auto w-full my-2" autocomplete="off"  />
            </div>
            <div class=" items-center gap-4 mb-4">
                <label for="email" class="block font-semibold w-100">{{ $t('Email') }}</label>
                <InputText v-model="formData.email" type="email" id="email" class="flex-auto w-full my-2" autocomplete="off"
                     />
            </div>
            <div class=" items-center gap-4 mb-4">
                <label for="password" class="block font-semibold w-100">{{ $t('Password') }}</label>
                <InputText v-model="formData.password" type="password" id="password" class="flex-auto w-full my-2" autocomplete="off"
                   />
            </div>
            <div class=" items-center gap-4 mb-8">
                <label for="team" class="block font-semibold w-100">{{ $t('Teams') }}</label>
                <Select v-model:selected="selected"  :multiple=true :options="options"  />
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
import Select from '../../../../components/Select/Select.vue'
import { useToast } from 'primevue';
import { reactive } from 'vue';
import { onMounted } from 'vue';
import { shallowRef } from 'vue';
const toast = useToast()
const store = useStore()
const options = shallowRef([])
const selected = ref([])

watch(
    () => store.state.team.teams,
    (teams) => {
        options.value = teams.map((t)=>({name:t.name, code:t.id}))
},{immediate:true})
const teams = reactive(Array.from(selected.value))

const formData = reactive({
    name: '',
    email: '',
    password: "",
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

        // Dispatch the action with the correct payload
        await store.dispatch('member/createMember', {
            name:formData.name,
            email: formData.email,
            password: formData.password,
            teams:Array.from(selected.value)
        });

        toast.add({
            severity: 'success',
            summary: 'Success',
            detail: 'Member created successfully!',
            life: 3000
        });

        // Reset form and close dialog
        formData.name = '';
        formData.email = '';
        formData.password = ''
        formData.teams = []

        props.closeAdd()
    } catch (error) {
        toast.add({
            severity: 'error',
            summary: 'Error',
            detail: error.message || 'Failed to create member',
            life: 3000
        });
    }
};
onMounted(async () => {
    try {
        await store.dispatch('team/fetchTeams');
    } catch (error) {
        console.log(error)
    }
});
</script>
