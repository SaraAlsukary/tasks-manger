<template>
    <div>
        <!-- Login message -->
        <div v-if="!isLoggedIn" class="flex justify-center items-center p-4 bg-blue-50 rounded-lg mb-4">
            <span>There are no tasks. You should login. </span>
            <router-link to="/login" class="text-blue-600 font-medium ml-1">Please login first</router-link>
        </div>

        <!-- DataTable -->
        <div v-else class="card">
            <Button @click="Add" class="flex flex-row items-center justify-between w-60 gap-2 mb-2">
                <InputIcon class="pi pi-plus plus" />
                <div>Add</div>
            </Button>
            <DataTable v-model:filters="filters" v-model:selection="selectedRow" :value="Data" stateStorage="session"
                stateKey="dt-state-demo-session" paginator :rows="5" filterDisplay="menu" selectionMode="single"
                dataKey="id" :globalFilterFields="['name', 'description']" tableStyle="min-width: 50rem">
                <!-- Header with search -->
                <template #header>
                    <div class="flex justify-between items-center">
                        <IconField iconPosition="left" class="w-64">
                            <InputIcon class="pi pi-search" />
                            <InputText v-model="filters.global.value" placeholder="Global Search" />
                        </IconField>
                    </div>
                </template>

                <!-- Name Column -->
                <Column field="name" header="Name" sortable style="width: 25%">
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by name"
                            class="w-full" />
                    </template>
                </Column>

                <!-- Description Column -->
                <Column header="Description" sortable sortField="description" filterField="description"
                    style="width: 25%">
                    <template #body="{ data }">
                        <div class="flex items-center gap-2">
                            <span>{{ data.description }}</span>
                        </div>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by description"
                            class="w-full" />
                    </template>
                </Column>
                <!-- Actions Column -->
                <Column header="Actions" :exportable="false" style="width: 25%">
                    <template #body="{ data }">
                        <Button icon="pi pi-eye"
                            class="p-button-rounded p-button-text p-button-sm mr-2  p-button-success "
                            @click="Show(data.id)" />
                        <Button icon="pi pi-pencil"
                            class="p-button-rounded p-button-text p-button-sm mr-2  p-button-info"
                            @click="Edit(data.id)" />
                        <Button icon="pi pi-trash" class="p-button-rounded p-button-text p-button-sm p-button-danger"
                            @click="confirmPosition('top',data.id)" />
                    </template>
                </Column>
                <!-- Empty message -->
                <template #empty>
                    <div class="text-center py-4 text-gray-500">
                        No tasks found.
                    </div>
                </template>
            </DataTable>
            <AddDialog :visible="visibleAdd" :closeAdd="closeAdd" />
            <EditDialog :visible="visibleEdit" :closeEdit="closeEdit" :id="selectedId" />
            <ShowDialog :visible="visibleShow" :closeShow="closeShow" :id="selectedId" />
            <ConfirmDialog group="positioned"></ConfirmDialog>

        </div>
    </div>
</template>

<script setup>
import { useStore } from 'vuex';
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import { ref, onMounted, computed } from 'vue';
import AddDialog from './Add/Add.vue'
import EditDialog from './Edit/Edit.vue'
import ShowDialog from './Show/Show.vue'
import { Button, DataTable, Column, InputIcon, InputText, IconField,ConfirmDialog } from 'primevue';
const visibleAdd = ref(false);
const visibleShow = ref(false);
const visibleEdit = ref(false);
const selectedId = ref(0);
import Cookie from 'cookie-universal';

const FilterMatchMode = {
    STARTS_WITH: 'startsWith',
    CONTAINS: 'contains',
    NOT_CONTAINS: 'notContains',
    ENDS_WITH: 'endsWith',
    EQUALS: 'equals',
    NOT_EQUALS: 'notEquals',
    IN: 'in',
    LESS_THAN: 'lt',
    LESS_THAN_OR_EQUAL_TO: 'lte',
    GREATER_THAN: 'gt',
    GREATER_THAN_OR_EQUAL_TO: 'gte',
    BETWEEN: 'between',
    DATE_IS: 'dateIs',
    DATE_IS_NOT: 'dateIsNot',
    DATE_BEFORE: 'dateBefore',
    DATE_AFTER: 'dateAfter'
};

const FilterOperator = {
    AND: 'and',
    OR: 'or'
};
const closeAdd = () => {
    visibleAdd.value = false;


}
const closeEdit = () => {
    visibleEdit.value = false;


}
const closeShow = () => {
    visibleShow.value = false;


}
const Add = () => {
    visibleAdd.value = true;

}

const Delete = async (id) => {
try {
    await store.dispatch('task/deleteTask',id)
    toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Deleted Successfully!', life: 3000 });

} catch (error) {
    toast.add({ severity: 'error', summary: 'Failed', detail: error, life: 3000 });

}
}

const Edit = (id) => {
    selectedId.value = id
    visibleEdit.value = true;

}
const Show = (id) => {
    selectedId.value = id
    visibleShow.value = true;
}


const confirm = useConfirm();
const toast = useToast();

const confirmPosition = (position, id) => {
    confirm.require({
        group: 'positioned',
        message: 'Are you sure you want to delete?',
        header: 'Confirmation',
        icon: 'pi pi-info-circle',
        position: position,
        rejectProps: {
            label: 'Cancel',
            severity: 'secondary',
            text: true
        },
        acceptProps: {
            label: 'yes',
            text: true
        },
        accept: () => {
            Delete(id)
        },
        reject: () => {
            toast.add({ severity: 'error', summary: 'Rejected', detail: 'Process incomplete', life: 3000 });
        }
    });
};
// Cookie setup
const cookie = Cookie();

const selectedRow = ref(null);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
    description: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
});


// Computed
const isLoggedIn = computed(() => cookie.get('token'));

const Data = computed(() => store.state.task.tasks);
const store = useStore()
// Lifecycle
onMounted(async () => {
    try {
        await store.dispatch('task/fetchTasks');
    } catch (error) {
        console.log(error)
    }
});
</script>

<style scoped>
/* Add any custom styles here */
.card {
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    padding: 1rem;
    background: white;
}

.flag {
    border-radius: 3px;
}

.plus.p-inputicon {
    color: #000;
    margin: 0;
    position: initial;
    top: initial;
}
</style>
