<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import JetButton from '@/Components/Button.vue';
import { reactive, computed, ref, getCurrentInstance } from 'vue';
import Pagination from '@/Components/Shared/Pagination.vue';

const header = reactive([
  {
    name: 'Nombre',
    showInMobile: true
  },
  {
    name: 'Tipo de cliente',
    showInMobile: false
  },
  {
    name: 'Estado',
    showInMobile: true
  },
  {
    name: 'Télefono',
    showInMobile: true
  },
  {
    name: 'Dirección',
    showInMobile: true
  },
  {
    name: 'Acciones',
    showInMobile: true
  }
]);
// const totalPages = computed(() => Math.ceil(props.articles.meta.total / props.articles.meta.per_page));
</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Clientes
          </h2>
          <JetButton @click="true">
            Añadir
          </JetButton>
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base">
          <Table :header="header">
          </Table>
        </div>
        <div class="flex mt-8 justify-center">
          <!-- <Pagination 
            :total="totalPages"
            :previous="clients.links.prev" 
            :next="clients.links.next" 
            page="clients"
          /> -->
        </div>
      </div>
    </div>
  </AppLayout>
</template>