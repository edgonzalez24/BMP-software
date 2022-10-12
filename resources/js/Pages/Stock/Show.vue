<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Components/Button.vue';
import Table from '@/Components/Table.vue';
import JetModal from '@/Components/Modal.vue'
import JetLabel from '@/Components/Label.vue';
import JetInput from '@/Components/Input.vue';
import Loading from 'vue3-loading-overlay';
import { ref, computed, reactive } from 'vue';
import Pagination from '@/Components/Shared/Pagination.vue';
import moment from 'moment';

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
    name: 'Precio de Compra',
    showInMobile: true
  },
  {
    name: 'Cantidad',
    showInMobile: true
  },
  {
    name: 'Precio de Venta',
    showInMobile: true
  },
]);

const isLoading = ref(false);
const totalPages = computed(() => Math.ceil(props.stocks.meta.total / props.stocks.meta.per_page));
const formatDate = date => {
  return moment.utc(date, "YYYY-MM-DD\THH:mm:ss\Z").format("DD-MM-YYYY");
}


</script>
<template>
  <AppLayout>
    <!-- Loading -->
    <Loading :active.sync="isLoading" ></Loading>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight my-5">
          Stock
        </h2>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto  shadow-xl rounded-lg min-h-base">
          <Table :header="header">
            <tbody class="px-5">
              <tr v-for="item in stocks.data" class="mt-2">
                <td class="text-center p-2 md:text-base text-xs">{{ formatDate(item.created_at) }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.article.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.supplier.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">${{ item.buy_price }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.quantity_items }}</td>
                <td class="text-center p-2 md:text-base text-xs">${{ item.sale_price }}</td>
              </tr>
            </tbody>
          </Table>
        </div>
        <div class="flex mt-8 justify-center">
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