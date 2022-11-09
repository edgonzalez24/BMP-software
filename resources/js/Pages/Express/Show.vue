<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import Table from '@/Components/Table.vue';
  import { reactive, ref, onMounted } from 'vue';
  import { Link } from '@inertiajs/inertia-vue3';
  import { hasPermission } from '@/Helpers/Functions';
  import moment from 'moment';
  import JetModal from '@/Components/Modal.vue';
  import DetailPresale from '@/Components/Presale/Detail.vue';
  import Pagination from '@/Components/Shared/Pagination.vue';
  import { Inertia } from '@inertiajs/inertia';

  const props = defineProps({
    presales: Object
  });

  const selectedPresale = ref({});
  const statusModalDetail = ref(false);
  const date = ref();
  const datepicker = ref();
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
      name: 'Estado',
      showInMobile: true
    },
    {
      name: 'Total de la venta',
      showInMobile: true
    }
  ]);

  const formatDate = date => {
    return moment(date).format("DD-MM-YYYY");
  }
  const formatRangeDate = date => {
    return moment(date).format("YYYY-MM-DD");
  };
  const detailPresale = (presale) => {
    selectedPresale.value = presale;
    statusModalDetail.value = true;
  }
  const alertDate = () => {
    datepicker.value.selectDate();
    datepicker.value.closeMenu();
    handleFilter();
  }
  const alertFn = () => {
    datepicker.value.closeMenu();
    handleFilter();
  }

  const handleFilter = () => {
    Inertia.get(route('express', { 
      from: date.value && date.value.length ? formatRangeDate(date.value[0]) : null , 
      to: date.value && date.value.length ?  formatRangeDate(date.value[1]) : null,
    }, {
      preserveState: true
    }))
  }

  onMounted(() => {
    const startDate = new URLSearchParams(window.location.search).has('from') && moment(new URLSearchParams(window.location.search).get('from'));

    const endDate = new URLSearchParams(window.location.search).has('to') && moment(new URLSearchParams(window.location.search).get('to'));

    date.value = startDate && endDate ? [startDate, endDate] : null;
  })
  
</script>
<template>
  <AppLayout>
    <JetModal :show="statusModalDetail" maxWidth="lg" @close="statusModalDetail = false">
      <DetailPresale 
        :selectedPresale="selectedPresale"
        isExpress
        @close="statusModalDetail = false"
      />
    </JetModal>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight animated zoomIn">
            Ventas Express
          </h2>
          <Link v-if="hasPermission('presale_create')" :href="route('express.create')"
            class="inline-flex items-center px-8 py-2 border border-transparent rounded-md font-semibold sm:text-base text-sm  tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition bg-dark-blue-500 focus:ring-gray-300 focus:border-gray-900 hover:bg-gray-700 active:bg-gray-900 text-white">
          Crear
          </Link>
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
          </div>
        </div>
        <div
          class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50 animated fadeIn">
          <Table :header="header" :items="presales.data.length">
            <tbody class="px-5">
              <tr v-if="presales.data.length" v-for="item in presales.data"
                class="mt-2 cursor-pointer hover:bg-slate-50 transition duration-300 ease-in-out" @click="detailPresale(item)">
                <td class="text-center p-2 md:text-base text-xs">
                  {{ formatDate(item.created_at) }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  Venta #{{ item.id }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  {{ item.dispatch.name }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  ${{ item.total_paid.toFixed(2) }}
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
            page="express"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>