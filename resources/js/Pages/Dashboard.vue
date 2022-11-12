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

  const user = computed(() => usePage().props.value.user.name);
  const dummy = [
    {
      kind: 'orders',
      description: 'Ordenes',
      value: 20
    },
    {
      kind: 'completed',
      description: 'Ordenes completadas',
      value: 30
    },
    {
      kind: 'presales',
      description: 'Total de Ventas',
      value: 50
    }
  ]
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
      name: 'Proveedor',
      showInMobile: true
    },
    {
      name: 'Precio por Unidad',
      showInMobile: true
    },
  ]);
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
            <div v-for="item in dummy">
              <CardPreview  :value="item" />
            </div>
          </div>
        </div>
        <div class="w-full flex justify-between lg:flex-row flex-col lg:space-x-6 lg:space-y-0 space-y-4 mb-8">
          <div class="w-full lg:w-1/2 p-5 bg-white rounded-lg overflow-hidden shadow-card border border-gray-50 animated fadeIn">
            <h4 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight animated zoomIn">Resumen de clientes con más preventas en el mes</h4>
            <LineChart />
          </div>
          <div class="w-full lg:w-1/2 p-5 bg-white rounded-lg overflow-hidden shadow-card border border-gray-50 animated fadeIn">
            <h4 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight animated zoomIn">Reporte de ventas anual</h4>
            <BarChart />

          </div>
        </div>
        <div class="w-full bg-white rounded-lg overflow-hidden shadow-card min-h-table border border-gray-50 p-5 animated fadeIn">
          <h4 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight animated zoomIn">Productos más vendidos</h4>
          <Table :header="header">
            <tbody class="px-5">
              <tr class="mt-2">
              </tr>
            </tbody>
          </Table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>