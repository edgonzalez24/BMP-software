<script setup>
  import _ from 'lodash';
  defineProps({
    selectedPresale: Object
  });
  const emit = defineEmits(['close'])
  const getTotal = (arr) => {
  return _.sumBy(arr, item => Number(item.total)).toFixed(2);
}
</script>
<template>
  <div class="py-8 px-5">
    <div class="flex justify-between items-center">
      <h3 class="font-semibold md:text-2xl text-lg text-dark-blue-500 leading-tight text-left mb-2">
        {{ `Pedido #${selectedPresale.id}` }}
      </h3>
      <a @click="emit('close')" class="cursor-pointer">
        <font-awesome-icon icon="fa-solid fa-xmark" class="text-2xl text-gray-300" />
      </a>
    </div>
    <p class="mb-1 font-medium md:text-base text-sm">
      Cliente:
      <span class="font-normal">{{ selectedPresale.client.name }}</span>
    </p>
    <p v-if="selectedPresale.client.type_client.id === 2" class="mb-1 font-medium md:text-base text-sm">
      Zona:
      <span class="font-normal">{{ selectedPresale.client.zone.name }}</span>
    </p>
    <p class="mb-1 font-medium md:text-base text-sm">
      Método de pago:
      <span class="font-normal">{{ selectedPresale.method_paid.name }}</span>
    </p>
    <p class="mb-3 font-medium md:text-base text-sm">
      Estado:
      <span class="font-normal">{{ selectedPresale.dispatch.name }}</span>
    </p>
    <div>
      <div v-for="detail in selectedPresale.presale_detail" class="border-t border-gray-300 min-h-list flex items-center">
        <div class="flex flex-row md:space-x-5 space-x-3 py-3 w-full items-center">
          <div class="md:h-10 h-8 md:w-10 w-8 ">
            <div class="md:h-10 h-8 md:w-10 w-8 bg-gray-400 flex justify-center items-center md:rounded-lg rounded-md">
              <font-awesome-icon icon="fa-solid fa-box-open" class="md:text-base text-sm text-white" />
            </div>
          </div>
          <div>
            <h6 class="text-dark-blue-500 font-semibold md:text-base text-sm">{{ detail.article.name }}</h6>
            <p class="md:text-sm text-xs py-2">{{ detail.article.comment }}</p>
            <div class="flex flex-row space-x-5 items-center">
              <p class="md:text-sm text-xs">Cantidad: {{ detail.total_articles }}</p>
              <span class="h-5 w-0.5 bg-gray-300"></span>
              <p class="md:text-sm text-xs">Precio: ${{ detail.total }}</p>
              <span class="h-5 w-0.5 bg-gray-300"></span>
              <p class="md:text-sm text-xs">Unidad: {{ detail.article.measure_unit.name }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="border-t border-gray-300 flex justify-end">
        <div class="pt-3 md:w-3/6 w-full">
          <div class="flex justify-between mb-1 md:text-base text-sm">
            <p class="font-medium">Total Pagado:</p>
            <span>${{ selectedPresale.total_paid}}</span>
          </div>
          <div class="flex justify-between mb-1 md:text-base text-sm">
            <p class="font-medium">Total Pendiente:</p>
            <span>${{ selectedPresale.total_pending}}</span>
          </div>
          <div class="flex justify-between mb-1 md:text-base text-sm">
            <p class="font-medium">Total de la venta:</p>
            <span>${{ getTotal(selectedPresale.presale_detail) }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>