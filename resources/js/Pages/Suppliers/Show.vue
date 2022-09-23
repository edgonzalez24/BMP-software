<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Components/Button.vue';
import Loading from 'vue3-loading-overlay';
import JetModal from '@/Components/Modal.vue';
import JetLabel from '@/Components/Label.vue';
import JetInput from '@/Components/Input.vue';
import Toggle from '@/Components/Shared/Toggle.vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, reactive, computed, getCurrentInstance } from 'vue';
import Table from '@/Components/Table.vue';
import Status from '@/Components/Shared/Status.vue';
import Pagination from '@/Components/Shared/Pagination.vue';
import { POSITION } from 'vue-toastification';

const props = defineProps({
  suppliers: Object
});
const header = reactive([
  {
    name: 'Nombre',
    showInMobile: true
  },
  {
    name: 'Teléfono',
    showInMobile: true
  },
  {
    name: 'Estado',
    showInMobile: true
  },
  {
    name: 'Correo Electrónico',
    showInMobile: false
  },
  {
    name: 'Acciones',
    showInMobile: true
  }
]);
const isLoading = ref(false);
const isEdit = ref(false);
const statusModalForm = ref(false);
const statusModalDelete = ref(false);
const formInitial = useForm({
  name: null,
  telephone: null,
  email: null,
  active: 1
});
console.log(window.Echo)
const formDelete = useForm({
  id: null
});
const toggleFormModal = () => {
  statusModalForm.value = !statusModalForm.value;
};
const toggleDeleteModal = () => {
  statusModalDelete.value = !statusModalDelete.value;
};
const selectDeleteItem = item => {
  formDelete.id = item.id;
  toggleDeleteModal();
};
const toast = getCurrentInstance().appContext.config.globalProperties.$toast;
const totalPages = computed(() => Math.ceil(props.suppliers.total / props.suppliers.per_page));

const submitForm = () => {
  formInitial.post(route('supplier.save'), {
      onSuccess: () => {
        toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
        toggleFormModal()
        formInitial.reset();
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
}
</script>

<template>
  <AppLayout>
    <!-- Loading -->
    <Loading :active.sync="isLoading" ></Loading>
    <JetModal :show="statusModalForm" maxWidth="lg" @close="toggleFormModal" >
      <form class="py-8 px-5" @submit.prevent="submitForm">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          {{ isEdit ? 'Editar proveedor' : 'Añadir proveedor' }}
        </h2>
        <div class="mb-5">
          <JetLabel for="name" value="Status" />
          <Toggle v-model:checked="formInitial.active" />
        </div>
        <div class="mb-5">
          <JetLabel for="name" value="Nombre" />
          <JetInput
            id="name"
            v-model="formInitial.name"
            type="text"
            class="mt-1 block w-full"
            required
            autofocus
          />
        </div>
        <div class="mb-5">
          <JetLabel for="name" value="Télefono" />
          <JetInput
            id="name"
            v-model="formInitial.telephone"
            type="text"
            class="mt-1 block w-full"
            autofocus
          />
        </div>
        <div class="mb-5">
          <JetLabel for="name" value="Correo Electrónico" />
          <JetInput
            id="name"
            v-model="formInitial.email"
            type="email"
            class="mt-1 block w-full"
            autofocus
          />
        </div>
        <div class="flex justify-end mb-5">
          <div class="w-auto flex flex-row space-x-4 justify-between">
            <JetButton
              background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
              type="button"
              @click="toggleFormModal"
            >
              Cancelar
            </JetButton>
            <JetButton
              type="submit"
            >
              {{ isEdit ? 'Editar' : 'Añadir' }}
            </JetButton>
          </div>
        </div>
      </form>
    </JetModal>
    <JetModal :show="statusModalDelete" maxWidth="lg" @close="toggleDeleteModal" >
      <form class="py-8 px-5" @submit.prevent="submitDelete">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          Eliminar Proveedor
        </h2>
        <div class="px-5">
          <p class="mt-5 text-justify text-gray-400">
            Al  eliminar a este proveedor se borrará permanentemente del sistema,
            por favor confirmar la acción haciendo click en el botón de 'Eliminar'.
          </p>
          <div class="flex justify-end mt-5">
            <div class="w-auto flex flex-row space-x-4 justify-between">
              <JetButton
                background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
                type="button"
                @click="toggleDeleteModal"
              >
                Cancelar
              </JetButton>
              <JetButton
                background="bg-red-600 focus:ring-transparent focus:border-transparent"
                type="submit"
              >
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
            Proveedores
          </h2>
          <JetButton
            @click="toggleFormModal"
          >
            Añadir
          </JetButton>
        </div>
        <div class="bg-white overflow-hidden shadow-xl rounded-lg min-h-base">
          <Table :header="header">
            <tbody class="px-5">
              <tr v-for="item in suppliers.data" class="mt-2">
                <td class="text-center p-2 md:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">
                  <a :href="`tel:${item.telephone}`">
                    {{ item.telephone }}
                  </a>
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  <div class="flex justify-center">
                    <Status :status="item.active" class="sm:w-1/2 md:w-1/3 w-full" />
                  </div>
                </td>
                <td class="text-center p-2 md:text-base text-xs hidden lg:block">{{ item.email }}</td>
                <td class="text-center p-2 md:text-base text-xs">
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a @click="true" class="text-blue-500 font-medium cursor-pointer">Editar</a>
                      <a @click="selectDeleteItem(item)" class="text-blue-500 font-medium cursor-pointer">Eliminar</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </Table>
        </div>
        <div class="flex mt-8 justify-center">
          <Pagination
            :total="totalPages"
            :previous="suppliers.prev_page_url"
            :next="suppliers.next_page_url"
            page="suppliers"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>