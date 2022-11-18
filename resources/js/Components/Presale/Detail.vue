<script setup>
  import _ from 'lodash';
  import { useForm, usePage } from '@inertiajs/inertia-vue3';
  import { ref, getCurrentInstance } from 'vue';
  import { POSITION } from 'vue-toastification';
  import Loading from 'vue3-loading-overlay';
  import InputPrice from '@/Components/Shared/inputPrice.vue';
  import JetButton from '@/Components/Button.vue';
  import { getTotal } from '@/Helpers/Functions';
import { computed } from '@vue/reactivity';

  const props = defineProps({
    selectedPresale: Object,
    isExpress: {
      type: Boolean,
      default: false
    },
    isPending: {
      type: Boolean,
      default: false
    },
  });


  const emit = defineEmits(['close', 'getHistory'])


  const form = useForm({
    amount: 0,
    presale_id: props.selectedPresale.id,
    total_paid: getTotal(props.selectedPresale.presale_detail)
  })
  const isLoading = ref(false);


  const toast = getCurrentInstance().appContext.config.globalProperties.$toast;


  const updatePresale = () => {
    if (form.amount > props.selectedPresale.total_pending ) {
      toast.error('El abono no puede ser mayor al total pendiente', { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
    } else if (form.amount === 0 ) {
      toast.error('El abono no puede ser 0', { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
    } else {
      isLoading.value = true;
      form.post(route('debit.save'), {
        onSuccess: () => {
          toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
          emit('close')
        },
        onError: () => {
          const errors = usePage().props.value.errors;
          for (const key in errors) {
            if (Object.hasOwnProperty.call(errors, key)) {
              toast.error(errors[key], { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
            }
          }
        },
        onFinish: () => {
          isLoading.value = false;
        }
      })
    }
  }
</script>
<template>
  <div class="py-4 px-5">
    <Loading :active.sync="isLoading"></Loading>
    <div class="flex justify-between items-center mb-2">
      <h3 class="font-semibold md:text-2xl text-lg text-dark-blue-500 leading-tight text-left">
        {{ isExpress ? `Venta #${selectedPresale.id}` : `Orden #${selectedPresale.id}`}}
      </h3>
      <a @click="emit('close')" class="cursor-pointer">
        <font-awesome-icon icon="fa-solid fa-xmark" class="text-2xl text-gray-300" />
      </a>
    </div>
    <template v-if="!isExpress">
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
      <p class="mb-1 font-medium md:text-base text-sm">
        Estado:
        <span class="font-normal">{{ selectedPresale.dispatch.name }}</span>
      </p>
      <template v-if="isPending">
        <div class="mb-3">
          <p class="font-medium md:text-base text-sm">Abono a Cuenta</p>
          <InputPrice v-model:value="form.amount" class="mt-1 block w-full"/>
        </div>
      </template>
    </template>
    <div class="overflow-y-auto scroll-container" :class="selectedPresale.presale_detail.length > 5 ? 'h-96' : 'h-auto'">
      <div v-for="detail in selectedPresale.presale_detail" class="min-h-list flex items-center"
        :class="{'border-t border-gray-300': !isExpress}">
        <div class="flex flex-row md:space-x-5 space-x-3 py-3 w-full items-center">
          <div class="md:h-10 h-8 md:w-10 w-8 ">
            <div class="md:h-10 h-8 md:w-10 w-8 bg-gray-400 flex justify-center items-center md:rounded-lg rounded-md">
              <font-awesome-icon icon="fa-solid fa-box-open" class="md:text-base text-sm text-white" />
            </div>
          </div>
          <div class="w-full">
            <h6 class="text-dark-blue-500 font-semibold md:text-base text-sm">{{ detail.article.name }}</h6>
            <div class="flex items-center w-full">
              <p class="md:text-sm text-xs w-1/3">Cantidad: {{ detail.total_articles }}</p>
              <p class="md:text-sm text-xs w-1/3">Precio: ${{ Number(detail.total).toFixed(2) }}</p>
              <p class="md:text-sm text-xs w-1/3">Medida: {{ detail.article.measure_unit.name }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="border-t border-gray-300 flex justify-end">
        <div class="pt-3 md:w-3/6 w-full">
          <div v-if="selectedPresale.paid === 0" class="flex justify-between mb-1 md:text-base text-sm">
            <p class="font-medium">Total pagado:</p>
            <span>${{ selectedPresale.added == 0 ? (Number(getTotal(selectedPresale.presale_detail)) - Number(selectedPresale.total_pending)).toFixed(2) : Number(selectedPresale.total_pending).toFixed(2) }}</span>
          </div>
          <div v-if="selectedPresale.paid === 0" class="flex justify-between mb-1 md:text-base text-sm">
            <p class="font-medium">Total pendiente:</p>
            <span>${{ Number(selectedPresale.total_pending).toFixed(2) }}</span>
          </div>
          <div class="flex justify-between mb-1 md:text-base text-sm">
            <p class="font-medium">Total de la venta:</p>
            <span>${{ Number(getTotal(selectedPresale.presale_detail)).toFixed(2) }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-between mt-5">
      <div v-if="selectedPresale.dispatch.id === 4 && !isExpress" class="mb-1 cursor-pointer inline-flex items-center md:text-base text-sm text-blue-600 font-bold" @click="emit('getHistory', selectedPresale.id)">
        Ver historial de abono
      </div>
      <JetButton  v-if="isPending" type="button" @click="updatePresale">
        Agregar
      </JetButton>
    </div>
  </div>
</template>