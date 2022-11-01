<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { reactive, computed, ref, getCurrentInstance , onMounted } from 'vue';
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
  import JetLabel from '@/Components/Label.vue';
  import { Inertia } from '@inertiajs/inertia';

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
  const selectedPresale = ref({});
  const statusModalForm = ref(false);
  const statusModalDetail = ref(false);
  const isLoading = ref(false);
  const formatDate = date => {
    return moment(date).format("DD-MM-YYYY");
  }
  const deletePresale = (id) => {
    formDelete.id = id;
    statusModalForm.value = true;
  }
  const detailPresale = (article) => {
    selectedPresale.value = article;
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
  const client = ref();
  const date = ref();
  const datepicker = ref();

  const formatRangeDate = date => {
    return moment(date).format("YYYY-MM-DD");
  };


  const handleFilter = () => {
    Inertia.get(route('presales', { 
      from: formatRangeDate(date.value[0]), 
      to: formatRangeDate(date.value[1]),
      client_id: client.value
    }, {
      preserveState: true
    }))
  }

  const alertDate = () => {
    datepicker.value.selectDate();
    datepicker.value.closeMenu();
    handleFilter();
  }
  onMounted(() => {
    const startDate = new URLSearchParams(window.location.search).has('from') ? moment(new URLSearchParams(window.location.search).get('from')) : new Date();
    const endDate = new URLSearchParams(window.location.search).has('to') ? moment(new URLSearchParams(window.location.search).get('to')) : new Date();
    date.value = [startDate, endDate];
    client.value = new URLSearchParams(window.location.search).has('client_id') ? props.clients.filter(item => item.id === Number(new URLSearchParams(window.location.search).get('client_id'))) : null;
  })
</script>
<template>
  <AppLayout>
    <Loading :active.sync="isLoading"></Loading>
    <JetModal :show="statusModalForm" maxWidth="lg" @close="statusModalForm = false">
      <form class="py-8 px-5" @submit.prevent="submitDelete">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          Cancelar Pedido
        </h2>
        <div class="px-5">
          <p class="mt-5 text-justify text-gray-400">
            Al cancelar a este Predido, el detalle se borrará permanentemente del sistema,
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
    <JetModal :show="statusModalDetail" maxWidth="lg" @close="statusModalDetail = false">
      <DetailPresale :selectedPresale="selectedPresale" @close="statusModalDetail = false" />
    </JetModal>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Pedidos
          </h2>
          <Link v-if="hasPermission('presale_create')" :href="route('presales.create')" class="inline-flex items-center px-8 py-2 border border-transparent rounded-md font-semibold sm:text-base text-sm  tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition bg-dark-blue-500 focus:ring-gray-300 focus:border-gray-900 hover:bg-gray-700 active:bg-gray-900 text-white">
            Crear
          </Link>
        </div>
        <div class="bg-white w-full shadow-xl rounded-lg p-4 mb-5 border border-gray-50">
          <div class="flex lg:flex-row flex-col lg:space-x-4 lg:justify-between">
            <div class="lg:w-1/2 w-full">
              <JetLabel value="Rango de fecha" />
              <div>
                <Datepicker 
                  v-model="date"
                  range 
                  :maxDate="new Date()" 
                  ignoreTimeValidation
                  locale="es"
                  cancelText="Cancelar"
                  selectText="Seleccionar"
                  :enableTimePicker="false"
                  ref="datepicker"
                  utc
                >
                  <template #action-select>
                    <p class="cursor-pointer font-bold text-dark-blue-500 hover:text-opacity-70 transition duration-300 ease-in-out" @click="alertDate">Seleccionar</p>
                  </template>
                </Datepicker>
              </div>
            </div>
            <div class="lg:w-1/3 w-full lg:mt-0 mt-2">
              <JetLabel value="Clientes" />
              <v-select
                v-model="client"
                :options="clients.length ? [{ id: null, name: 'Todos' }, ...clients] : []"
                :reduce="(option) => option.id"
                label="name" 
                placeholder="Seleccionar cliente"
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
                v-if="presales.data.length"
                v-for="item in presales.data" 
                class="mt-2 cursor-pointer hover:bg-slate-50 transition duration-300 ease-in-out"
                @click="detailPresale(item)"
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
                        v-if="hasPermission('presale_edit')"
                        :href="item.dispatch.id !== 5 ? `/dashboard/presales/${item.id}/edit` : ''" 
                        :class="item.dispatch.id === 5 ? 'text-gray-400 cursor-default' :  'text-blue-500 font-medium cursor-pointer'"
                      >
                        Editar
                      </Link>
                      <a 
                        v-if="hasPermission('presale_destroy')" 
                        @click="item.dispatch.id !== 5 && deletePresale(item.id)" 
                        :class="item.dispatch.id === 5 ? 'text-gray-400 cursor-default' :  'text-blue-500 font-medium cursor-pointer'"
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