<script setup>
  import Toggle from '@/Components/Shared/Toggle.vue';
  import _ from 'lodash';
  import { useForm, usePage } from '@inertiajs/inertia-vue3';
  import { ref, watch, computed, getCurrentInstance } from 'vue';
  import { POSITION } from 'vue-toastification';
  import Loading from 'vue3-loading-overlay';

  const props = defineProps({
    selectedPresale: Object
  });
  const emit = defineEmits(['close'])
  const getTotal = (arr) => {
    return _.sumBy(arr, item => Number(item.total)).toFixed(2);
  }

  const form = useForm(props.selectedPresale)
  const paidStatus = ref(0);
  paidStatus.value = props.selectedPresale.paid;
  const isLoading = ref(false);

  const getTotalPending = computed(() => (getTotal(form.details) - form.paid).toFixed(2));
  const toast = getCurrentInstance().appContext.config.globalProperties.$toast;


  watch(paidStatus, value =>  {
    if(value) {
      isLoading.value = true;
      form.transform(data => {
        if (data.added === 1) {
          return {
            presale_id: data.id,
            total_paid: data.paid,
            total_pending: getTotalPending.value,
            dispatch_id: value ? 4 : data.dispatch.id,
            paid: value,
            added: data.added,
            client_id: data.client.id,
            user_presale_id: usePage().props.value.user.id,
            user_dispatch_id: usePage().props.value.user.id,
            method_paid_id: data.method_paid.id,
          }
        } else {
          return {
            presale_id: data.id,
            total_paid: data.paid,
            total_pending: getTotalPending.value,
            dispatch_id: value ? 4 : data.dispatch.id,
            paid: value,
            added: data.added,
            client_id: data.client.id,
            user_presale_id: usePage().props.value.user.id,
            user_dispatch_id: usePage().props.value.user.id,
            method_paid_id: data.method_paid.id,
            old_presale_detail: data.presale_detail.map(item =>  {
              return {
                ...item,
                id: item.article.id,
                id_detail: item.id,
                id_presale: data.id
              }
            }),
            new_presale_detail: []
          }
        }
      }).post(route('presale.change'), {
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
  })
</script>
<template>
  <div class="py-8 px-5">
    <Loading :active.sync="isLoading"></Loading>
    <div class="flex justify-between items-center">
      <h3 class="font-semibold md:text-2xl text-lg text-dark-blue-500 leading-tight text-left mb-2">
        {{ `Preventa #${selectedPresale.id}` }}
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
    <p class="mb-1 font-medium md:text-base text-sm">
      Estado:
      <span class="font-normal">{{ selectedPresale.dispatch.name }}</span>
    </p>
    <div class="mb-3 inline-flex items-center">
      <p class="font-medium md:text-base text-sm mr-2">
        Pagado:
      </p>
      <Toggle v-model:checked="paidStatus" label :activeControl="selectedPresale.paid === 1" />
    </div>
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
            <p class="md:text-sm text-xs py-2" v-html="detail.article.comment"></p>
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
            <span>${{ selectedPresale.total_paid.toFixed(2)}}</span>
          </div>
          <div class="flex justify-between mb-1 md:text-base text-sm">
            <p class="font-medium">Total Pendiente:</p>
            <span>${{ selectedPresale.total_pending.toFixed(2)}}</span>
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