<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { reactive, computed, ref, getCurrentInstance } from 'vue';
  import Table from '@/Components/Table.vue';
  import Pagination from '@/Components/Shared/Pagination.vue';
  import moment from 'moment';
  import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
  import JetModal from '@/Components/Modal.vue';
  import JetButton from '@/Components/Button.vue';
  import Loading from 'vue3-loading-overlay';
  import { POSITION } from 'vue-toastification';

  const props = defineProps({
    presales: Object
  });
  const header = reactive([
    {
      name: 'Fecha',
      showInMobile: true
    },
    {
      name: 'ID',
      showInMobile: true
    },
    {
      name: 'Cliente',
      showInMobile: true
    },
    {
      name: 'Estado',
      showInMobile: true
    },
    {
      name: 'Tipo de Pago',
      showInMobile: true
    },
    {
      name: 'Acciones',
      showInMobile: true
    }
  ]);

  const totalPages = computed(() => Math.ceil(props.presales.meta.total / props.presales.meta.per_page));
  const toast = getCurrentInstance().appContext.config.globalProperties.$toast;
  const formDelete = useForm({
    id: 0
  });
  const statusModalForm = ref(false);
  const isLoading = ref(false);
  const formatDate = date => {
    return moment(date).format("DD-MM-YYYY");
  }
  const deletePresale = (id) => {
    formDelete.id = id;
    statusModalForm.value = true;
  }

  const submitDelete = () => {
    isLoading.value = true;
    formDelete.get(route('presale.delete', formDelete.id), {
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
  }
</script>
<template>
  <AppLayout>
    <Loading :active.sync="isLoading"></Loading>
    <JetModal :show="statusModalForm" maxWidth="lg" @close="statusModalForm = false">
      <form class="py-8 px-5" @submit.prevent="submitDelete">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          Eliminar Pedido
        </h2>
        <div class="px-5">
          <p class="mt-5 text-justify text-gray-400">
            Al eliminar a este Predido se borrará permanentemente del sistema,
            por favor confirmar la acción haciendo click en el botón de 'Eliminar'.
          </p>
          <div class="flex justify-end mt-5">
            <div class="w-auto flex flex-row space-x-4 justify-between">
              <JetButton background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
                type="button" @click="statusModalForm = false">
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
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Pedidos
          </h2>
          <Link :href="route('presales.create')" class="inline-flex items-center px-8 py-2 border border-transparent rounded-md font-semibold sm:text-base text-sm  tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition bg-dark-blue-500 focus:ring-gray-300 focus:border-gray-900 hover:bg-gray-700 active:bg-gray-900 text-white">
            Crear
          </Link>
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50">
          <Table :header="header">
            <tbody class="px-5">
              <tr 
                v-for="item in presales.data" 
                class="mt-2 cursor-pointer hover:bg-slate-50 transition duration-300 ease-in-out"
                @click="true"
              >
                <td class="text-center p-2 md:text-base text-xs">
                  {{ formatDate(item.created_at) }}
                </td>
                <td 
                  class="text-center p-2 md:text-base text-xs"
                >
                  Orden #{{ item.id }}
              </td>
                <td 
                  class="text-center p-2 md:text-base text-xs"
                >
                  {{ item.client.name }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  {{ item.dispatch.name }}
                </td>
                <td 
                  class="text-center p-2 md:text-base text-xs"
                >
                  {{  item.method_paid.name }}
                </td>
                <td class="text-center p-2 md:text-base text-xs" @click.stop>
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <Link 
                        :href="item.dispatch.id !== 5 && `/dashboard/presales/${item.id}/edit`" 
                        :class="item.dispatch.id === 5 ? 'text-gray-400 cursor-default' :  'text-blue-500 font-medium cursor-pointer'"
                      >
                        Editar
                      </Link>
                      <a 
                        @click="item.dispatch.id !== 5 && deletePresale(item.id)" 
                        :class="item.dispatch.id === 5 ? 'text-gray-400 cursor-default' :  'text-blue-500 font-medium cursor-pointer'"
                      >
                        Eliminar
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </Table>
        </div>
        <div 
          v-if="totalPages > 1" 
          class="flex mt-8 justify-center"
        >
          <Pagination
            :total="totalPages"
            :previous="presales.links.prev"
            :next="presales.links.next"
            page="presales"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>