<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { computed, reactive, ref, getCurrentInstance } from 'vue';
  import Table from '@/Components/Table.vue';
  import JetButton from '@/Components/Button.vue';
  import JetModal from '@/Components/Modal.vue';
  import { useForm, usePage, Link } from '@inertiajs/inertia-vue3';
  import JetLabel from '@/Components/Label.vue';
  import JetInput from '@/Components/Input.vue';
  import InputCounter from '@/Components/Shared/InputCounter.vue';
  import { POSITION } from 'vue-toastification';
  import Loading from 'vue3-loading-overlay';
  import InputPrice from '@/Components/Shared/inputPrice.vue';
  import moment from 'moment';

  const props = defineProps({
    article: Object,
    suppliers: Array,
    measure_units: Array,
    stocks: Object
  });
  const header = reactive([
    {
      name: 'Fecha',
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
      name: 'Precio por Venta',
      showInMobile: true
    },
    {
      name: 'Cantidad',
      showInMobile: true
    },
    {
      name: 'Unidades',
      showInMobile: true
    },
  ]);
  const articleDetail = computed(() => props.article.data[0]);
  const toast = getCurrentInstance().appContext.config.globalProperties.$toast;
  const isLoading = ref(false);
  const getSupplier = id => {
    return props.suppliers.find(item => item.id === id).name;
  };
  const statusModalForm = ref(false);
  const isEdit = ref(false);
  const form = useForm({
    article_id: articleDetail.value.id,
    quantity_items: 0,
    units_for_unit: 0,
    buy_price: 0,
    sale_price: 0,
    supplier_id: null,
    measure_unit_id: null,
    comment: articleDetail.value.name
  })
  const toggleFormModal = () => {
    statusModalForm.value = !statusModalForm.value;
  };
  const submitForm = () => {
    isLoading.value = true;
    form.post(route('stock.save'), {
      onSuccess: () => {
        toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
        toggleFormModal()
        form.reset()
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
    });
  }
  const formatDate = date => {
    return moment.utc(date, "YYYY-MM-DD\THH:mm:ss\Z").format("DD-MM-YYYY");
  }
</script>
<template>
  <AppLayout>
    <Loading :active.sync="isLoading"></Loading>
    <JetModal :show="statusModalForm" maxWidth="lg" @close="toggleFormModal">
      <form class="py-8 px-5" @submit.prevent="submitForm">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          {{ isEdit ? 'Editar artículo' : 'Añadir' }}
        </h2>
        <div class="mb-5">
          <JetLabel for="buy_price" value="Precio de Compra" />
          <InputPrice  id="buy_price" v-model:value="form.buy_price" class="mt-1 block w-full"/>
        </div>
        <div class="mb-5">
          <JetLabel for="sale_price" value="Precio de Venta" />
          <InputPrice id="sale_price" v-model:value="form.sale_price" class="mt-1 block w-full" />
        </div>
        <div class="grid sm:grid-cols-2 gap-x-4">
          <div class="mb-5">
            <JetLabel for="name" value="Cantidad" />
            <InputCounter v-model:value="form.quantity_items" />
          </div>
          <div class="mb-5">
            <JetLabel for="units" value="Unidades" />
            <InputCounter v-model:value="form.units_for_unit" />
          </div>
        </div>
        <div class="mb-5">
          <div class="flex justify-between items-center">
            <JetLabel for="measure" value="Unidad de medida" />
            <Link href="/dashboard/measures" class="cursor-pointer block text-xs text-blue-600">
            + Agregar Unidad
            </Link>
          </div>
          <v-select v-model="form.measure_unit_id" :options="measure_units.length ? measure_units : []"
            :reduce="(option) => option.id" label="name" placeholder="Seleccionar unidad de medida"
            class="appearance-none capitalize">
            <template #open-indicator="{ attributes }">
              <svg v-bind="attributes" width="10" height="7" viewBox="0 0 10 7" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.95 6.3L0 1.3L1.283 0L4.95 3.706L8.617 0L9.9 1.3L4.95 6.3Z" fill="#A4AFB7" />
              </svg>
            </template>
            <template #option="{ name }">
              <span class="capitalize">{{ name }}</span>
            </template>
          </v-select>
        </div>
        <div class="mb-5">
          <div class="flex justify-between items-center">
            <JetLabel for="suppliers" value="Proveedor" />
            <Link href="/dashboard/suppliers" class="cursor-pointer block text-xs text-blue-600">
            + Agregar Proveedor
            </Link>
          </div>
          <v-select v-model="form.supplier_id" :options="suppliers.length ? suppliers : []"
            :reduce="(option) => option.id" label="name" placeholder="Seleccionar un proveedor"
            class="appearance-none capitalize">
            <template #open-indicator="{ attributes }">
              <svg v-bind="attributes" width="10" height="7" viewBox="0 0 10 7" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.95 6.3L0 1.3L1.283 0L4.95 3.706L8.617 0L9.9 1.3L4.95 6.3Z" fill="#A4AFB7" />
              </svg>
            </template>
            <template #option="{ name }">
              <span class="capitalize">{{ name }}</span>
            </template>
          </v-select>
        </div>
        <div class="flex justify-end mb-5">
          <div class="w-auto flex flex-row space-x-4 justify-between">
            <JetButton background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
              type="button" @click="toggleFormModal">
              Cancelar
            </JetButton>
            <JetButton type="submit">
              {{ isEdit ? 'Editar' : 'Añadir' }}
            </JetButton>
          </div>
        </div>
      </form>
    </JetModal>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            {{ articleDetail.name }}
          </h2>
          <JetButton @click="isEdit = false; form.reset(); toggleFormModal()">
            Nuevo
          </JetButton>
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base">
          <Table :header="header">
            <tbody class="px-5">
              <tr v-for="item in articleDetail.stocks" class="mt-2">
                <td class="text-center p-2 md:text-base text-xs">{{ formatDate(item.created_at) }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ getSupplier(item.supplier_id) }}</td>
                <td class="text-center p-2 md:text-base text-xs">${{ item.buy_price }}</td>
                <td class="text-center p-2 md:text-base text-xs">${{ item.sale_price }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.quantity_items }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.units_for_unit }}</td>
              </tr>
            </tbody>
          </Table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>