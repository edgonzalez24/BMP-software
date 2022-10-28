<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import JetButton from '@/Components/Button.vue';
  import Table from '@/Components/Table.vue';
  import { reactive } from 'vue';

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
      name: 'Acciones',
      showInMobile: true
    }
  ])
</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Historial de Cuentas
          </h2>
          <JetButton @click="true">
            Agregar
          </JetButton>
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50">
          <Table :header="header"></Table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>