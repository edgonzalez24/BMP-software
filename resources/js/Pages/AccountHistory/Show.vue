<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import Table from '@/Components/Table.vue';
  import { reactive, computed, ref, onMounted } from 'vue';
  import Pagination from '@/Components/Shared/Pagination.vue';
  import moment from 'moment';
  import { Inertia } from '@inertiajs/inertia';
  import JetLabel from '@/Components/Label.vue';
  import _ from 'lodash';

  const props = defineProps({
    clients: Array,
    presales: Object
  });

  const header = reactive([
    {
      name: 'ID',
      showInMobile: true
    },
    {
      name: 'Fecha',
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
      name: 'Total del Pedido',
      showInMobile: true
    }
  ]);
  const formatDate = date => {
    return moment(date).format("DD-MM-YYYY");
  };
  const formatRangeDate = date => {
    return moment(date).format("YYYY-MM-DD");
  };
  const client = ref({
    id: null,
    name: null
  });
  const date = ref();
  const datepicker = ref();
  const alertDate = () => {
    datepicker.value.selectDate();
    datepicker.value.closeMenu();
    handleFilter();
  }
  const alertFn = () => {
    datepicker.value.closeMenu();
    handleFilter();
  }
  const totalPages = computed(() => Math.ceil(props.presales.meta.total / props.presales.meta.per_page));

  const handleFilter = () => {
    Inertia.get(route('account-history', {
      from: date.value && date.value.length ? formatRangeDate(date.value[0]) : null,
      to: date.value && date.value.length ? formatRangeDate(date.value[1]) : null,
      client_id: client.value.id
    }, {
      preserveState: true
    }))
  }

  const getTotal = (arr) => {
    return _.sumBy(arr, item => Number(item.total)).toFixed(2);
  }
  onMounted(() => {
    const startDate = new URLSearchParams(window.location.search).has('from') && moment(new URLSearchParams(window.location.search).get('from'));

    const endDate = new URLSearchParams(window.location.search).has('to') && moment(new URLSearchParams(window.location.search).get('to'));

    date.value = startDate && endDate ? [startDate, endDate] : null;
    if (new URLSearchParams(window.location.search).has('client_id')) {
      props.clients.map(item => {
        if (item.id === Number(new URLSearchParams(window.location.search).get('client_id'))) {
          client.value = { id: item.id, name: item.name }
        }
      })
    }
  })
</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight animated zoomIn">
            Historial de Cuentas
          </h2>
        </div>
        <div class="bg-white w-full shadow-xl rounded-lg p-4 mb-5 border border-gray-50 animated fadeIn">
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
                  placeholder="Seleccionar fechas" 
                  ref="datepicker"
                  utc
                  @cleared="alertFn"
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
                v-model="client.id"
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
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50 animated fadeIn">
          <Table :header="header">
            <tbody class="px-5">
              <tr
                v-if="presales.data.length"
                v-for="item in presales.data"
                class="mt-2 hover:bg-slate-50 transition duration-300 ease-in-out"
              >
                <td class="text-center p-2 md:text-base text-xs">
                  Orden #{{ item.id }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  {{ formatDate(item.created_at) }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  {{ item.client.name }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  ${{ item.total_pending }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  ${{ item.total_paid }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  ${{ getTotal(item.presale_detail) }}
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