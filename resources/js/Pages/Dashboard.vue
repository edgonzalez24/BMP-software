<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { usePage } from '@inertiajs/inertia-vue3';
  import { computed, reactive } from 'vue';
  import CardPreview from '@/Components/Dashboard/CardPreview.vue';
  import BarChart from '@/Components/Charts/BarChart.vue';
  import LineChart from '@/Components/Charts/LineChart.vue';
  import moment from 'moment';
  import 'moment/dist/locale/es';
  import Table from '@/Components/Table.vue';
  import _ from 'lodash';



  const props = defineProps({
    order_total: Number,
    orders_complete: Number,
    total_sale: Number,
    top_articles: Array,
    top_clients: Array
  });

  const date = moment().locale("es").format('dddd, D [de] MMMM [del] YYYY');
  const header = reactive([
    {
      name: 'ID',
      showInMobile: true
    },
    {
      name: 'Nombre',
      showInMobile: true
    },
    {
      name: 'Categoria',
      showInMobile: true
    },
    {
      name: 'Proveedor',
      showInMobile: true
    },
    {
      name: 'Precio',
      showInMobile: true
    },
  ]);
  const cardsInfo = reactive([
    {
      kind: 'orders',
      description: 'Ordenes',
      value: props.order_total
    },
    {
      kind: 'completed',
      description: 'Ventas',
      value: props.orders_complete
    },
    {
      kind: 'presales',
      description: 'Total de Ventas',
      value: `$ ${Number(props.total_sale).toFixed(2) }`
    }
  ])


  const user = computed(() => usePage().props.value.user.name);
  const top = computed(() => {
    const values =  _(props.top_articles)
      .groupBy('id')
      .map((item,  index) => ({
        id: item[index].id,
        article: item[index].article,
        sale_price: item[index].sale_price,
        category: item[index].category,
        suppliers: item[index].suppliers,
        total: _.sumBy(item, 'total')
      }))
      .value()
    const order = _.orderBy(values, ['total'], ['desc', 'asc']);

    return _.take(order, 5);
  })
  
</script>

<template>
  <AppLayout title="Dashboard">
    <div class="pt-6 pb-12">
      <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight mt-5 animated zoomIn">
          Bienvenido {{ user }}!
        </h2>
        <p class="mb-5">{{ date }}</p>
        <div class="w-full mb-8">
          <div class="grid md:grid-cols-3 xl:gap-x-24 lg:gap-x-20 gap-x-5 md:gap-y-0 gap-y-5">
            <div v-for="item in cardsInfo">
              <CardPreview  :value="item" />
            </div>
          </div>
        </div>
        <div class="w-full flex justify-between lg:flex-row flex-col lg:space-x-6 lg:space-y-0 space-y-4 mb-8">
          <div class="w-full lg:w-1/2 p-5 bg-white rounded-lg overflow-hidden shadow-card border border-gray-50 animated fadeIn">
            <h4 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight animated zoomIn">Reporte de clientes con más pedidos en el mes</h4>
            <LineChart :value="top_clients" />
          </div>
          <div class="w-full lg:w-1/2 p-5 bg-white rounded-lg overflow-hidden shadow-card border border-gray-50 animated fadeIn">
            <h4 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight animated zoomIn">Reporte de ventas anual</h4>
            <BarChart />

          </div>
        </div>
        <div class="w-full bg-white rounded-lg overflow-hidden shadow-card min-h-table border border-gray-50 p-5 animated fadeIn">
          <h4 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight animated zoomIn">Productos más vendidos en el mes</h4>
          <Table :header="header" :items="top.length">
            <tbody class="px-5">
              <tr 
                class="mt-2"
                v-for="item in top"
              >
                <td class="text-center p-2 lg:text-base text-xs">#{{ item.id }}</td>
                <td class="text-center p-2 lg:text-base text-xs">{{ item.article }}</td>
                <td class="text-center p-2 lg:text-base text-xs">{{ item.category }}</td>
                <td class="text-center p-2 lg:text-base text-xs">{{ item.suppliers }}</td>
                <td class="text-center p-2 lg:text-base text-xs">${{ Number(item.sale_price).toFixed(2) }}</td>
              </tr>
            </tbody>
          </Table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>