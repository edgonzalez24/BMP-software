<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import JetButton from '@/Components/Button.vue';
import { reactive, computed, ref, getCurrentInstance } from 'vue';
import Pagination from '@/Components/Shared/Pagination.vue';
import Status from '@/Components/Shared/Status.vue';
import JetModal from '@/Components/Modal.vue';
import Loading from 'vue3-loading-overlay';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import Toggle from '@/Components/Shared/Toggle.vue';
import JetLabel from '@/Components/Label.vue';
import JetInput from '@/Components/Input.vue';
import QuillEditor from '@/Components/Shared/QuillEditor.vue';
import { POSITION } from 'vue-toastification';
import DetailClient from '@/Components/Client/Detail.vue'
import { hasPermission } from '@/Helpers/Functions';

const props = defineProps({
  clients: Object,
  typeClient: Array
})
const header = reactive([
  {
    name: 'Nombre',
    showInMobile: true
  },
  {
    name: 'Tipo de cliente',
    showInMobile: false
  },
  {
    name: 'Estado',
    showInMobile: true
  },
  {
    name: 'Télefono',
    showInMobile: true
  },
  {
    name: 'Acciones',
    showInMobile: true
  }
]);
const form = useForm({
  client_id : null,
  name: null,
  type_client_id: null,
  telephone: null,
  active: 1,
  comment: null,
});
const formDelete = useForm({
  client_id: null,
});
const isLoading = ref(false);
const isEdit = ref(false);
const statusModalForm = ref(false);
const statusModalDetail = ref(false);
const statusModalDelete = ref(false);
const selectedClient = reactive({});
const totalPages = computed(() => Math.ceil(props.clients.total / props.clients.per_page));
const toast = getCurrentInstance().appContext.config.globalProperties.$toast;
const getTypeClient = id => {
  return props.typeClient.find(item => item.id === id).name
}
const formFilter = useForm({
  search: new URLSearchParams(window.location.search).get('search') || null,
  type_client_id: Number(new URLSearchParams(window.location.search).get('type_client_id')) || null,
});
const handleFilter = () => {
  formFilter.get(route('client.filter', formFilter))
}
const toggleFormModal = () => {
  statusModalForm.value = !statusModalForm.value
}
const toggleDetailModal = () => {
  statusModalDetail.value = !statusModalDetail.value;
}
const toggleDeleteModal = () => {
  statusModalDelete.value = !statusModalDelete.value;
}
const selectClientItem = item => {
  clients.value = item;
  toggleDetailModal();
};
const selectDetail = item => {
  selectedClient.value = item;
  toggleDetailModal();
}
const selectDeleteItem = item => {
  formDelete.client_id = item.id;
  toggleDeleteModal();
};
const selectItem = item => {
  formInitial.client_id = item.id;
  formInitial.name = item.name;
  formInitial.type_client_id = item.type_client_id,
  formInitial.telephone = item.telephone,
  formInitial.active = item.active,
  formInitial.comment = item.comment,
  formInitial.comment = item.search,
  isEdit.value = true;
  toggleFormModal();
};
const submitForm = () => {
  isLoading.value = true;
  const request = isEdit.value ? 'client.change' : 'client.save';
  form.post(route(request), {
    onSuccess: () => {
      toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
      toggleFormModal()
      form.reset();
    },
    onError: () => {
      const errors = usePage().props.value.errors;
      for (const key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
          toast.error(errors[key], { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
        }
      }
    },
    onFinish: () => {
      isLoading.value = false
    }
  })
};
const submitDelete = () => {
  isLoading.value = true;
  formDelete.get(route('client.delete', formDelete.client_id), {
    onSuccess: () => {
      toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
    },
    onError: () => {
      const errors = usePage().props.value.errors;
      for (const key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
          toast.error(errors[key], { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
        }
      }
    },
    onFinish: () => {
      isLoading.value = false;
    }
  });
};
</script>
<template>
  <AppLayout>
    <Loading :active.sync="isLoading"></Loading>
    <JetModal :show="statusModalForm" maxWidth="lg" @close="toggleFormModal">
      <form class="py-8 px-5" @submit.prevent="submitForm">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          {{ isEdit ? 'Editar Cliente' : 'Añadir Cliente' }}
        </h2>
        <div class="mb-5">
          <JetLabel value="Estado" />
          <Toggle v-model:checked="form.active" />
        </div>
        <div class="mb-5">
          <JetLabel for="name" value="Nombre" />
          <JetInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus />
        </div>
        <div class="mb-5">
          <JetLabel for="phone" value="Teléfono" />
          <JetInput id="phone" v-model="form.telephone" type="text" class="mt-1 block w-full" phoneNumber autofocus />
        </div>
        <div class="mb-5">
          <JetLabel for="comment" value="Comentario" />
          <QuillEditor v-model="form.comment" />
        </div>
        <div class="mb-5">
          <JetLabel for="measure" value="Tipo de clientes" />
          <v-select v-model="form.type_client_id" :options="typeClient.length ? typeClient : []"
            :reduce="(option) => option.id" label="name" placeholder="Seleccionar tipo de cliente"
            class="appearance-none capitalize">
            <template #open-indicator="{ attributes }">
              <svg v-bind="attributes" width="10" height="7" viewBox="0 0 10 7" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.95 6.3L0 1.3L1.283 0L4.95 3.706L8.617 0L9.9 1.3L4.95 6.3Z" fill="#A4AFB7" />
              </svg>
            </template>
            <template #option="{ name }">
              <span class="capitalize">{{ name }}</span>
            </template>
          </v-select>
        </div>
        <div class="flex justify-end mb-5">
          <div class="w-auto flex flex-row space-x-4 justify-between">
            <JetButton background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
              type="button" @click="toggleFormModal">
              Cancelar
            </JetButton>
            <JetButton type="submit">
              {{ isEdit ? 'Editar' : 'Añadir' }}
            </JetButton>
          </div>
        </div>
      </form>
    </JetModal>
    <JetModal :show="statusModalDetail" maxWidth="2xl" @close="toggleDetailModal">
      <DetailClient
        :client="selectedClient.value"
        :typeClient="typeClient"
        @close="toggleDetailModal"
      />
    </JetModal>
    <JetModal :show="statusModalDelete" maxWidth="lg" @close="toggleDeleteModal">
      <form class="py-8 px-5" @submit.prevent="submitDelete">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          Eliminar Cliente
        </h2>
        <div class="px-5">
          <p class="mt-5 text-justify text-gray-400">
            Al eliminar a este cliente se borrará permanentemente del sistema,
            por favor confirmar la acción haciendo click en el botón de 'Eliminar'.
          </p>
          <div class="flex justify-end mt-5">
            <div class="w-auto flex flex-row space-x-4 justify-between">
              <JetButton background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
                type="button" @click="toggleDeleteModal">
                Cancelar
              </JetButton>
              <JetButton background="bg-red-600 focus:ring-transparent focus:border-transparent" type="submit">
                Eliminar
              </JetButton>
            </div>
          </div>
        </div>
      </form>
    </JetModal>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Clientes
          </h2>
          <JetButton
            v-if="hasPermission('client_create')"
            @click="isEdit = false; form.reset(); toggleFormModal()"
          >
            Añadir
          </JetButton>
        </div>

        <div class="bg-white w-full shadow-xl rounded-lg p-4 mb-5">
          <div class="flex lg:flex-row flex-col space-x-4 items-end justify-between">
            <div class="md:w-1/2 w-full">
              <JetLabel value="Búsqueda" />
              <JetInput 
                id="search" 
                v-model="formFilter.search" 
                placeholder="Buscar cliente..."
                type="text"
                class="mt-1 block w-full"
                @input="handleFilter" 
              />
            </div>
            <div class="md:w-1/4 w-full md:mt-0 mt-5">
              <JetLabel value="Tipo de Cliente" />
              <v-select
                v-model="formFilter.type_client_id"
                :options="typeClient.length ? [{ id: null, name: 'Todas' }, ...typeClient] : []"
                :reduce="(option) => option.id"
                label="name" 
                placeholder="Seleccionar un tipo de cliente"
                @option:selected="handleFilter"
                :clearable="false"
                class="appearance-none capitalize"
              >
                <template #open-indicator="{ attributes }">
                  <svg v-bind="attributes" width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.95 6.3L0 1.3L1.283 0L4.95 3.706L8.617 0L9.9 1.3L4.95 6.3Z" fill="#A4AFB7" />
                  </svg>
                </template>
                <template #option="{ name }">
                  <span class="capitalize">{{ name }}</span>
                </template>
              </v-select>
            </div>
          </div>
        </div>


        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50">
          <Table :header="header">
            <tbody class="px-5">
              <tr 
                v-if="clients.data.length"
                v-for="item in clients.data"
                class="mt-2 cursor-pointer hover:bg-slate-50 transition duration-300 ease-in-out"
                @click="selectClientItem(item)"
              >
                <td class="text-center p-2 md:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ getTypeClient(item.type_client_id) }}</td>
                <td class="text-center p-2 md:text-base text-xs">
                  <div class="flex justify-center">
                    <Status :status="item.active" class="sm:w-1/2 md:w-1/3 w-full" />
                  </div>
                </td>
                <td class="text-center p-2 md:text-base text-xs" @click.stop>
                  <a :href="`tel:${item.telephone}`">
                    {{ item.telephone || '-' }}
                  </a>
                </td>
                <td class="text-center p-2 md:text-base text-xs" @click.stop>
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a v-if="hasPermission('client_edit')" @click="selectItem(item)" class="text-blue-500 font-medium cursor-pointer">Editar</a>
                      <a v-if="hasPermission('client_destroy')" @click="selectDeleteItem(item)" class="text-blue-500 font-medium cursor-pointer">Eliminar</a>
                      <p v-if="!hasPermission('client_edit') && !hasPermission('client_destroy')"> - </p>
                    </div>
                  </div>
                </td>
              </tr>
              <tr v-else >
                <td :colspan="header.length">
                  <div class="flex justify-center">
                    <div>
                      <img src="@/Assets/gifs/empty.gif" alt="" class="mx-auto">
                      <p class="text-center">No se han encontrado resultados </p>
                    </div>
                  </div>
                </td>
              </tr>
              
            </tbody>
          </Table>
        </div>
        <div v-if="totalPages > 1" class="flex mt-8 justify-center">
          <Pagination 
            :total="totalPages"
            :previous="clients.prev_page_url" 
            :next="clients.next_page_url" 
            page="clients"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>