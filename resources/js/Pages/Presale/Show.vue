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
  import DetailPresale from '@/Components/Presale/Detail.vue';
  import { hasPermission } from '@/Helpers/Functions';
  import { Inertia } from '@inertiajs/inertia';
  import FilterPresale from '@/Components/Shared/FilterPresale.vue';

  const props = defineProps({
    presales: Object,
    clients: Array
  });


  const header = reactive([
    {
      name: 'Fecha',
      showInMobile: true
    },
    {
      name: 'Orden',
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
      name: 'Acciones',
      showInMobile: true
    }
  ]);
  const formDelete = useForm({
    id: 0
  });
  const selectedPresale = ref({});
  const statusModalForm = ref(false);
  const statusModalDetail = ref(false);
  const isLoading = ref(false);


  const totalPages = computed(() => Math.ceil(props.presales.meta.total / props.presales.meta.per_page));
  const toast = getCurrentInstance().appContext.config.globalProperties.$toast;


  const formatDate = date => {
    return moment(date).format("DD-MM-YYYY");
  }
  const deletePresale = (id) => {
    formDelete.id = id;
    statusModalForm.value = true;
  }
  const detailPresale = (presale) => {
    selectedPresale.value = presale;
    statusModalDetail.value = true;
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
  };
  const formatRangeDate = date => {
    return moment(date).format("YYYY-MM-DD");
  };
  const handleFilter = (date, client) => {
    Inertia.get(route('presales', { 
      from: date && date.length ? formatRangeDate(date[0]) : null , 
      to: date && date.length ?  formatRangeDate(date[1]) : null,
      client_id: client
    }, {
      preserveState: true
    }))
  }
</script>
<template>
  <AppLayout>
    <Loading :active.sync="isLoading"></Loading>
    <JetModal :show="statusModalForm" maxWidth="lg" @close="statusModalForm = false">
      <form class="py-8 px-5" @submit.prevent="submitDelete">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          ??Deseas cancelar estea Preventa?
        </h2>
        <div class="px-5">
          <p class="mt-5 text-justify text-gray-400">
            Al cancelar a este Preventa, el detalle se borrar?? permanentemente del sistema, y los productos regresar??n al stock
            por favor confirmar la acci??n haciendo click en el bot??n de 'Confirmar'.
          </p>
          <div class="flex justify-end mt-5">
            <div class="w-auto flex flex-row space-x-4 justify-between">
              <JetButton background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
                type="button" @click="statusModalForm = false">
                Cancelar
              </JetButton>
              <JetButton background="bg-red-600 focus:ring-transparent focus:border-transparent" type="submit">
                Confirmar
              </JetButton>
            </div>
          </div>
        </div>
      </form>
    </JetModal>
    <JetModal :show="statusModalDetail" maxWidth="lg" @close="statusModalDetail = false">
      <DetailPresale :selectedPresale="selectedPresale" @close="statusModalDetail = false" />
    </JetModal>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight animated zoomIn">
            Preventa
          </h2>
          <Link v-if="hasPermission('presale_create')" :href="route('presales.create')" class="inline-flex items-center px-8 py-2 border border-transparent rounded-md font-semibold sm:text-base text-sm  tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition bg-dark-blue-500 focus:ring-gray-300 focus:border-gray-900 hover:bg-gray-700 active:bg-gray-900 text-white">
            Crear
          </Link>
        </div>
        <div class="mb-5">
          <FilterPresale 
            :clients="clients"
            @handleFilter="handleFilter"
          />
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50 animated fadeIn">
          <Table :header="header" :items="presales.data.length">
            <tbody class="px-5">
              <tr
                v-if="presales.data.length"
                v-for="item in presales.data" 
                class="mt-2 cursor-pointer hover:bg-slate-50 transition duration-300 ease-in-out"
                @click="detailPresale(item)"
              >
                <td class="text-center p-2 lg:text-base text-xs">
                  {{ formatDate(item.created_at) }}
                </td>
                <td 
                  class="text-center p-2 lg:text-base text-xs"
                >
                  Orden #{{ item.id }}
              </td>
                <td 
                  class="text-center p-2 lg:text-base text-xs"
                >
                  {{ item.client.name }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  {{ item.dispatch.name }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs" @click.stop>
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <Link
                        v-if="hasPermission('presale_edit')"
                        :href="item.paid === 0 && ![5].includes(item.dispatch.id) ? `/dashboard/presales/${item.id}/edit` : ''" 
                        :class="item.paid === 1 || [5].includes(item.dispatch.id) ? 'text-gray-400 cursor-default' :  'text-blue-500 font-medium cursor-pointer'"
                      >
                        Editar
                      </Link>
                      <a 
                        v-if="hasPermission('presale_destroy')" 
                        @click="![5].includes(item.dispatch.id) && item.paid === 0 && deletePresale(item.id)" 
                        :class="[5].includes(item.dispatch.id) || item.paid === 1 ? 'text-gray-400 cursor-default' :  'text-blue-500 font-medium cursor-pointer'"
                      >
                        Cancelar
                      </a>
                      <p v-if="!hasPermission('presale_destroy') && !hasPermission('presale_edit')"> - </p>
                    </div>
                  </div>
                </td>
              </tr>
              <tr v-else>
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
        <div 
          v-if="totalPages > 1" 
          class="flex mt-8 justify-center"
        >
          <Pagination
            :total="presales.meta.total"
            :perPage="presales.meta.per_page"
            page="presales"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>