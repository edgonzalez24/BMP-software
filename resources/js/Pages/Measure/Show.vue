<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Components/Button.vue';
import Table from '@/Components/Table.vue';
import JetModal from '@/Components/Modal.vue'
import JetLabel from '@/Components/Label.vue';
import JetInput from '@/Components/Input.vue';
import Loading from 'vue3-loading-overlay';
import { ref, getCurrentInstance } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { POSITION } from 'vue-toastification';
import Pagination from '@/Components/Shared/Pagination.vue';

// Props
const props = defineProps({
  measureUnits: Object
});

// Setup State
const header = ref(['ID', 'Nombre', 'Acciones']);
const toast = getCurrentInstance().appContext.config.globalProperties.$toast
const isEdit = ref(false);
const statusModalForm = ref(false);
const isLoading = ref(false);
const currentPage = ref(1);
const totalPages = Math.ceil(props.measureUnits.total / props.measureUnits.per_page);
const formCreateOrEdit = useForm({
  name: null
});

// Methods
const toggleFormModal = () => {
  statusModalForm.value = !statusModalForm.value;
};

const submitCreateOrEdit = () => {
  isLoading.value = true;
  if(isEdit.value) {

  } else {
    formCreateOrEdit.post(route('measureUnits.save'), {
      onSuccess: () => {
        toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
        toggleFormModal()
        formCreateOrEdit.reset();
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
}

</script>
<template>
  <AppLayout>
    <!-- Loading -->
    <Loading :active.sync="isLoading" ></Loading>
    <!-- Modal Create / Edit -->
    <JetModal :show="statusModalForm" maxWidth="lg" @close="toggleFormModal" >
      <form class="py-8 px-5" @submit.prevent="submitCreateOrEdit">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          {{ isEdit ? 'Editar Unidad de Medida' : 'Nueva Unidad de Medida' }}
        </h2>
        <div class="mb-5">
          <JetLabel for="name" value="Nombre" />
          <JetInput
            id="name"
            v-model="formCreateOrEdit.name"
            type="text"
            class="mt-1 block w-full"
            required
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
              {{ isEdit ? 'Editar' : 'Crear' }}
            </JetButton>
          </div>
        </div>
      </form>
    </JetModal>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Unidades de Medidas
          </h2>
          <JetButton
            @click="toggleFormModal(); isEdit = false"
          >
            Crear
          </JetButton>
        </div>
        <div class="bg-white overflow-hidden shadow-xl rounded-lg min-h-base">
          <Table :header="header">
            <tbody class="px-5">
              <tr v-for="item in measureUnits.data" class="mt-2">
                <td class="text-center p-2 md:text-base text-xs">{{ item.id }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a @click="true" class="text-blue-500 font-medium cursor-pointer">Editar</a>
                      <a @click="true" class="text-blue-500 font-medium cursor-pointer">Eliminar</a>
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
            :previous="measureUnits.prev_page_url"
            :next="measureUnits.next_page_url"
            page="categories"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>