<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import Table from '@/Components/Table.vue';
  import { reactive, computed, ref, onMounted, getCurrentInstance } from 'vue';
  import Pagination from '@/Components/Shared/Pagination.vue';
  import moment from 'moment';
  import JetLabel from '@/Components/Label.vue';
  import JetModal from '@/Components/Modal.vue';
  import DetailPresale from '@/Components/Presale/Detail.vue';
  import FilterPresale from '@/Components/Shared/FilterPresale.vue';

  const props = defineProps({
    clients: Array
  })

  const header = reactive([
    {
      name: 'Orden',
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
      name: 'Total de la preventa',
      showInMobile: true
    }
  ]);
</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight animated zoomIn">
            Historial de Ventas
          </h2>
        </div>
        <div class="mb-5">
          <FilterPresale
            :clients="clients"
            @handleFilter="true"
          />
        </div>
        <div
          class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50 animated fadeIn">
          <Table :header="header" :items="6">
            <tbody class="px-5">
        
            </tbody>
          </Table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>