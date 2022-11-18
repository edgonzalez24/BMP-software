<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import Table from '@/Components/Table.vue';
  import { reactive, computed, ref, onMounted, getCurrentInstance } from 'vue';
  import Pagination from '@/Components/Shared/Pagination.vue';
  import moment from 'moment';
  import { Inertia } from '@inertiajs/inertia';
  import _ from 'lodash';
  import JetModal from '@/Components/Modal.vue';
  import DetailPresale from '@/Components/Presale/Detail.vue';
  import { POSITION } from 'vue-toastification';
  import Loading from 'vue3-loading-overlay';
  import { appendParams, getTotal } from "@/Helpers/Functions";
  import FilterPresale from '@/Components/Shared/FilterPresale.vue';
  import { usePage } from '@inertiajs/inertia-vue3';

  // Props
  const props = defineProps({
    clients: Array,
    presales: Object,
    history: Array | null
  });

  // PropsData
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
      name: 'Pendiente',
      showInMobile: true
    },
    {
      name: 'Abonado',
      showInMobile: true
    },
    {
      name: 'Total de la preventa',
      showInMobile: true
    }
  ]);
  const statusModalDetail = ref(false);
  const statusModalHistory = ref(false);
  const selectedPresale = ref({});
  const isLoading = ref(false);
  const presale = ref({});
  
  // Computed Props
  const totalPages = computed(() => Math.ceil(props.presales.meta.total / props.presales.meta.per_page));
  const toast = getCurrentInstance().appContext.config.globalProperties.$toast;
  

  // Methods
  const formatDate = date => {
    return moment(date).format("DD-MM-YYYY");
  };
  const formatRangeDate = date => {
    return moment(date).format("YYYY-MM-DD");
  };
  const handleFilter = (date, client) => {
    Inertia.get(route('pending-accounts', {
      from: date && date.length ? formatRangeDate(date[0]) : null,
      to: date && date.length ? formatRangeDate(date[1]) : null,
      client_id: client
    }, {
      preserveState: true
    }))
  }
  const detailPresale = (presale) => {
    selectedPresale.value = presale;
    statusModalDetail.value = true;
  }
  const getHistory = (id) => {
    isLoading.value = true;
    Inertia.get(route('pending-accounts', { ...appendParams(window.location.search, 'history'), history: id }, {
      preserveState: true,
      preserveScroll: true,
    }),{
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
    })
  }

  // Mounted
  onMounted(() => {
    if (props.history) {
      statusModalHistory.value = true;
      presale.value = props.presales.data.find(item => item.id === Number(new URLSearchParams(window.location.search).get('history')));
    }
  });
</script>
<template>
  <AppLayout>
    <Loading :active.sync="isLoading"></Loading>
    <JetModal 
      :show="statusModalDetail"
      maxWidth="lg"
      @close="statusModalDetail = false"
    >
      <DetailPresale 
        isPending
        :selectedPresale="selectedPresale"
        @close="statusModalDetail = false"
        @getHistory="getHistory"
      />
    </JetModal>
    <JetModal 
      :show="statusModalHistory" 
      maxWidth="lg" 
      @close="statusModalHistory = false"
    >
      <div class="px-5 py-8">
        <div class="flex justify-between items-center mb-5">
          <h3 
            class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight"
          >
            {{`Historial de abonos de la orden #${presale.id}` }}
          </h3>
          <a @click="statusModalHistory = false" class="cursor-pointer">
            <font-awesome-icon icon="fa-solid fa-xmark" class="text-2xl text-gray-300" />
          </a>
        </div>
        <Table :header="[{
          name: 'Monto Abonado',
          showInMobile: true
        }, {
          name: 'Fecha de Abono',
          showInMobile: true
        }]" :items="history.length">
          <tbody class="px-5">
            <tr
              v-if="history && history.length"
              v-for="item in history"
              class="mt-2 hover:bg-slate-50 transition duration-300 ease-in-out"
            >
              <td class="text-center p-2 lg:text-base text-xs">
                $ {{ Number(item.amount).toFixed(2) }}
              </td>
              <td class="text-center p-2 lg:text-base text-xs">
                {{ formatDate(item.created_at) }}
              </td>
            </tr>
            <tr v-else>
              <td :colspan="2">
                <div class="flex justify-center">
                  <div>
                    <p class="text-center">No se han encontrado resultados </p>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </Table>
      </div>
    </JetModal>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight animated zoomIn">
            Cuentas Pendientes
          </h2>
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
                class="mt-2 hover:bg-slate-50 transition duration-300 ease-in-out cursor-pointer"
                @click="detailPresale(item)"
              >
                <td class="text-center p-2 lg:text-base text-xs">
                  {{ formatDate(item.created_at) }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  Orden #{{ item.id }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  {{ item.client.name }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  ${{ Number(item.total_pending).toFixed(2) }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  ${{ item.added === 0 ? Number(getTotal(item.presale_detail) - item.total_pending).toFixed(2) : Number(item.total_pending).toFixed(2) }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  ${{ Number(getTotal(item.presale_detail)).toFixed(2) }}
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
            :perPage="presales.meta.per_page"
            page="presales"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>