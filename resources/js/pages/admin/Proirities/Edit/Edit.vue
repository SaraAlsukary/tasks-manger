 <template>
    <div class="card flex justify-center">
        <Dialog v-model:visible="localVisible" modal header="Edit" :style="{ width: '25rem' }">
            <div class="items-center gap-4 mb-4">
                <label for="name" class="block font-semibold w-100">{{ $t('Name') }}</label>
                <InputText id="name" class="flex-auto w-full my-2" :value="formName.en" autocomplete="off"
                    v-model="formName.en" />
            </div>
            <div class=" items-center gap-4 mb-4">
                <label for="name" class="block font-semibold w-100">{{ $t('NameArabic') }}</label>
                <InputText id="name" class="flex-auto w-full my-2" autocomplete="off" :value="formName.ar"
                    v-model="formName.ar" />
            </div>

            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="props.closeEdit"></Button>
                <Button type="button" label="Save" @click="handle"></Button>
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
import { onMounted } from 'vue';
const $t = (key) => {
    return window.translations?.[key] || key;
}

const toast = useToast()
const store = useStore()
const data = computed(() => {
    const proirities = store.state.proirity.proirities
    return proirities || null;
});
const formName = reactive({
    en: '',
    ar: ""
})

const formData = reactive({
    id: props.id,
    name: formName,

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
        formData.name = formName

        if (!formData.name) {

            toast.add({
                severity: 'error',
                summary: 'Validation Error',
                detail: 'Name is required',
                life: 3000
            });
            return;
        }


        await store.dispatch('proirity/updateProirity', {
            data: formData,
            id: props.id
        })

        toast.add({ severity: 'success', summary: 'Success Message', detail: 'Edited Successfully!', life: 3000 });
        formData.name = {};

        formName.ar = ''
        formName.en = ''

        props.closeEdit()
        localVisible.value = false
    } catch (error) {
        toast.add({
            severity: 'error',
            summary: 'Error',
            detail: error.message || 'Failed to update proirity',
            life: 3000
        });
    }
}



onMounted(async () => {
    try {
        if (props.id) {

            await store.dispatch('proirity/showProirity', props.id);

        }
    } catch (error) {
        console.log(error)
    }
});
// Initialize form when team data changes

watch(data, (newTeam) => {
    if (newTeam) {
        formData.id = props.id
        formData.name = newTeam.name

        formName.en = newTeam.name?.en
        formName.ar = newTeam.name?.ar

    };
}, { immediate: true });

</script>



