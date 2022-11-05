<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import JetLabel from '@/Components/Label.vue';
import Loading from 'vue3-loading-overlay';
import { ref, computed, reactive, onMounted } from 'vue';
import Pagination from '@/Components/Shared/Pagination.vue';
import moment from 'moment';
import { Inertia } from '@inertiajs/inertia';
import JetModal from '@/Components/Modal.vue';

// Props
const props = defineProps({
  stocks: Object,
})

// Setup State
const header = reactive([
  {
    name: 'Fecha',
    showInMobile: true
  },
  {
    name: 'Artículo',
    showInMobile: true
  },
  {
    name: 'Proveedor',
    showInMobile: true
  },
  {
    name: 'Unidades',
    showInMobile: true
  },
]);

const isLoading = ref(false);
const totalPages = computed(() => Math.ceil(props.stocks.meta.total / props.stocks.meta.per_page));
const formatDate = date => {
  return moment(date).format("DD-MM-YYYY");
}

const formatRangeDate = date => {
  return moment(date).format("YYYY-MM-DD");
}

const date = ref();
const datepicker = ref()
onMounted(() => {
  const startDate = new URLSearchParams(window.location.search).has('from') && moment(new URLSearchParams(window.location.search).get('from'));
  const endDate = new URLSearchParams(window.location.search).has('to') && moment(new URLSearchParams(window.location.search).get('to'));
  date.value = startDate && endDate ? [startDate, endDate] : null;
})
const handleFilter = () => {
  Inertia.get(route('stock.filter', { 
    from: date.value && date.value.length ? formatRangeDate(date.value[0]) : null,
    to: date.value && date.value.length ? formatRangeDate(date.value[1]) : null,
  }))
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
const redirectDetail = ({ article }) => {
  Inertia.get(`stocks/${article.id}/detail`);
}
</script>
<template>
  <AppLayout>
    <!-- Loading -->
    <Loading :active.sync="isLoading" ></Loading>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight my-5">
          Stock
        </h2>
        <div class="bg-white w-full shadow-xl rounded-lg p-4 mb-5 border border-gray-50">
          <div class="flex lg:flex-row flex-col space-x-4">
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
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto  shadow-xl rounded-lg min-h-base">
          <Table :header="header">
            <tbody class="px-5">
              <tr
                v-if="stocks.data.length"
                v-for="item in stocks.data"
                class="mt-2 cursor-pointer hover:bg-slate-50 transition duration-300 ease-in-out"
                @click="redirectDetail(item)"
              >
                <td class="text-center p-2 md:text-base text-xs">{{ formatDate(item.created_at) }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.article.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.supplier.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.units_for_unit }}</td>
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
        <div v-if="totalPages > 1" class="flex mt-8 justify-center">
          <Pagination
            :total="totalPages"
            :previous="stocks.links.prev"
            :next="stocks.links.next"
            page="stocks"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>