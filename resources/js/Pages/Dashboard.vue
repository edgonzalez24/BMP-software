<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';
import CardPreview from '@/Components/Dashboard/CardPreview.vue';

  const user = computed(() => usePage().props.value.user.name);
  const dummy = [
    {
      kind: 'orders',
      description: 'Total de Ordenes',
      value: 20
    },
    {
      kind: 'completed',
      description: 'Total de ordenes completadas',
      value: 30
    },
    {
      kind: 'presales',
      description: 'Total de Ventas',
      value: '$50.00'
    }
  ]
const date = ref(new Date());
</script>

<template>
  <AppLayout title="Dashboard">
    <div class="py-12">
      <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight my-5">
          Bienvenido {{ user }}
        </h2>
        <div class="w-full mb-8">
          <div class="grid md:grid-cols-3 xl:gap-x-24 gap-x-20 md:gap-y-0 gap-y-5">
            <div v-for="item in dummy">
              <CardPreview  :value="item" />
            </div>
          </div>
        </div>
        <div class="w-full flex justify-between md:flex-row space-x-6 mb-8">
          <div class="w-full md:w-1/3 p-5 bg-white rounded-lg overflow-hidden shadow-card flex justify-center border border-gray-50">
            <!-- <Datepicker 
              v-model="date" 
              inline
              autoApply 
              :enableTimePicker="false"
              locale="es"
            /> -->
          </div>
          <div class="w-full md:w-2/3 p-5 bg-white rounded-lg overflow-hidden shadow-card flex justify-center border border-gray-50">
            
          </div>
        </div>
        <div class="w-full bg-white rounded-lg overflow-hidden shadow-card min-h-table border border-gray-50">

        </div>
      </div>
    </div>
  </AppLayout>
</template>
