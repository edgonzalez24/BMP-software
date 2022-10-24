<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import JetLabel from '@/Components/Label.vue';
  import { reactive, computed, ref, getCurrentInstance, watch, watchEffect } from 'vue';
  import Table from '@/Components/Table.vue';
  import { useForm, usePage } from '@inertiajs/inertia-vue3';
  import JetInput from '@/Components/Input.vue';
  import { Inertia } from '@inertiajs/inertia';
  import InputCounter from '@/Components/Shared/InputCounter.vue';
  import JetButton from '@/Components/Button.vue';
  import InputPrice from '@/Components/Shared/inputPrice.vue';
  import _ from 'lodash';

  defineProps({
    clients: Object,
    payment_methods: Array,
    articles: Object | null
  })
  const header = reactive([
    {
      name: 'Articulo',
      showInMobile: true
    },
    {
      name: 'Total Precio',
      showInMobile: true
    },
    {
      name: 'Medida',
      showInMobile: true
    },
    {
      name: 'Cantidad',
      showInMobile: true
    },
    {
      name: 'Acciones',
      showInMobile: true
    }
  ]);
  const headerPreview = reactive([
    {
      name: 'Articulo',
      showInMobile: true
    },
    {
      name: 'Precio Unidad',
      showInMobile: true
    },
    {
      name: 'Medida',
      showInMobile: true
    },
    {
      name: 'Cantidad',
      showInMobile: true
    },
    {
      name: 'Total Stock',
      showInMobile: true
    },
    {
      name: 'Acciones',
      showInMobile: true
    }
  ]);
  const editUnit = ref(false)
  const form = useForm({
    client: {
      id: null,
      type_client: null,
      payment_method: null
    },
    details: [],
    paid: 0,
    pending: 0,
    total: 0
  });

  const search = ref('');
  const error = ref('');
  const selectedItem = ref({});
  const selectedArticleID = ref(0);
  const searchArticle = (search, loading) => {
    Inertia.get('/dashboard/presales/create', {
      search,
    }, {
      preserveState: true
    })
  }
  const handleSelected = (selected) => {
    selectedItem.value = { ...selected, unit: 0, total: 0, dischargued: 0};
    search.value = null;
  }
  const addToCart = (item) => {
    const findArticle = form.details.length && form.details.find(i => i.id === item.id);
    const full = findArticle && _.sum([item['unit'], findArticle['unit']]) > findArticle.stock;
    if (validateStock(item.stock, item.unit) || full) {
      error.value = 'La cantidad es mayor a las existencias';
    } else {
      if ( findArticle && Object.keys(findArticle).length) {
        findArticle.unit = findArticle.unit + item.unit;
        findArticle.total = getTotalPriceArticle(item);
      } else {
        form.details.push({ ...item, total: getTotalPriceArticle(item) })
      }
      selectedItem.value = {};
      if (error.value) {
        error.value = '';
      }
    }
  }

  const validateStock = (stock, unit) => {
    return stock === 0 || unit >= stock;
  }

  const editArticle = (article) => {
    editUnit.value = !editUnit.value; 
    selectedArticleID.value = article.id;
    form.details.find(item => item.id === article.id).total = getTotalPriceArticle(article);
  }

  const getTotal = (arr) => {
    return _.sumBy(arr, item => Number(item.total)).toFixed(2);
  }
  const getTotalPriceArticle = (article) => {
    return (article.price.sale_price * article.unit).toFixed(2);
  }

  const deleteArticle = (article) => {
    _.remove(form.details, item => item.id === article.id)
  }

  const savePresale = () => {
    form.transform(data => ({
      total_paid: data.paid,
      total_pending: data.pending,
      dispatch_id: 2,
      paid: 0,
      client_id: data.client.id,
      user_presale_id: usePage().props.value.user.id,
      user_dispatch_id: usePage().props.value.user.id,
      method_paid_id: data.client.payment_method.id,
      presale_detail: data.details
    })).post(route('presale.save'))
  }

</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="my-5 flex justify-between items-center">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Nuevo Pedido
          </h2>
          <JetButton @click="savePresale">
            Añadir
          </JetButton>
        </div>

        <h6 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight mb-2">Información del Cliente</h6>
        <!-- Detalles del cliente -->
        <div class="bg-white w-full shadow-xl rounded-lg mb-5 border border-gray-50 p-5">
          <div class="grid md:grid-cols-3 gap-x-5 gap-y-2 items-center mb-2">
            <div>
              <JetLabel for="name" value="Seleccionar Cliente" />
              <v-select
                v-model="form.client"
                :options="clients.data.length ? clients.data : []"
                :reduce="(option) => option"
                label="name"
                placeholder="Seleccionar cliente"
                class="appearance-none capitalize mt-1"
              >
                <template #open-indicator="{ attributes }">
                  <svg v-bind="attributes" width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.95 6.3L0 1.3L1.283 0L4.95 3.706L8.617 0L9.9 1.3L4.95 6.3Z" fill="#A4AFB7" />
                  </svg>
                </template>
                <template #option="{ name }">
                  <span class="capitalize">{{ name }}</span>
                </template>
              </v-select>
            </div>
            <div v-if="form.client.id">
              <JetLabel for="name" value="Tipo de Cliente" />
              <JetInput id="name" v-model="form.client.type_client.name" type="text" class="mt-1 block w-full" onlyRead />
            </div>
            <div v-if="form.client.id">
              <JetLabel for="method" value="Método de Pago" />
              <v-select
                v-model="form.client.payment_method"
                :options="payment_methods.length ? payment_methods : []"
                :reduce="(option) => option"
                label="name"
                placeholder="Seleccionar cliente"
                class="appearance-none capitalize mt-1"
              >
                <template #open-indicator="{ attributes }">
                  <svg v-bind="attributes" width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.95 6.3L0 1.3L1.283 0L4.95 3.706L8.617 0L9.9 1.3L4.95 6.3Z" fill="#A4AFB7" />
                  </svg>
                </template>
                <template #option="{ name }">
                  <span class="capitalize">{{ name }}</span>
                </template>
              </v-select>
            </div>
          </div>
          <div v-if="form.client.id" class="grid md:grid-cols-3 gap-x-5 items-center gap-y-2 ">
            <div>
              <JetLabel for="paid" value="Total Pagado" />
              <InputPrice id="paid" v-model:value="form.paid" class="mt-1 block w-full" />
            </div>
            <div>
              <JetLabel for="pending" value="Total Pendiente" />
              <JetInput id="pending" :value="`$ ${getTotal(form.details) - form.paid}`" type="text" class="mt-1 block w-full" onlyRead />
            </div>
          </div>
        </div>
        <h6 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight mb-2">Detalle del pedido</h6>
        <!-- Detalle de articulos -->
        <div class="bg-white w-full shadow-xl rounded-lg md:min-h-table border border-gray-50 mb-5">
          <div class="flex justify-between flex-wrap p-5 items-center">
            <div class="md:w-1/2 w-full md:order-first order-last">
              <JetLabel value="Seleccionar producto" class="mb-2" />
              <v-select 
                v-model="search"
                :options="articles && articles.data.length ? articles.data : []" 
                :reduce="(option) => option.id"
                label="name"
                placeholder="Buscar..."
                class="appearance-none capitalize"
                @search="searchArticle"
                @option:selected="handleSelected"
              >
                <template #no-options="{ search, searching, loading }">
                  Busqueda no encontrada
                </template>
                <template #open-indicator="{ attributes }">
                  <svg v-bind="attributes" width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.95 6.3L0 1.3L1.283 0L4.95 3.706L8.617 0L9.9 1.3L4.95 6.3Z" fill="#A4AFB7" />
                  </svg>
                </template>
                <template #option="{ name }">
                  <span class="capitalize">{{ name }}</span>
                </template>
              </v-select>
            </div>
            <div class="md:w-auto w-full md:order-last order-first mb-2 md:mb-0">
              <h6 class="text-dark-blue-500 font-semibold text-base md:text-xl">
                Total ${{ getTotal(form.details) }}
              </h6>
            </div>
          </div>
          <div :class="{ 'pb-10': Object.keys(selectedItem).length === 0}" class="sm:overflow-x-hidden overflow-x-auto ">
            <Table :header="headerPreview">
              <tbody v-if="Object.keys(selectedItem).length" class="px-5">
                <tr>
                  <td class="text-center p-2 md:text-base text-xs">
                    {{ selectedItem.name }}
                  </td>
                  <td class="text-center p-2 md:text-base text-xs">
                    $ {{ selectedItem.price ?  selectedItem.price.sale_price : 0 }}
                  </td>
                  <td class="text-center p-2 md:text-base text-xs">
                    {{ selectedItem.measure_unit.name }}
                  </td>
                  <td class="text-center p-2 md:text-base text-xs">
                    <div class="md:w-full w-28">
                      <InputCounter 
                        v-model:value="selectedItem.unit"
                        hasLimit
                        :limit="selectedItem.stock"
                      />
                    </div>
                  </td>
                  <td class="text-center p-2 md:text-base text-xs">
                    {{ selectedItem.stock }}
                  </td>
                  <td class="text-center p-2 md:text-base text-xs">
                    <JetButton @click="addToCart(selectedItem)">
                      Agregar
                    </JetButton>
                  </td>
                </tr>
              </tbody>
            </Table>
          </div>
          <div  v-if="error" class="w-full flex justify-center px-5 py-2">
            <span class="text-red-500 text-xs font-bold">
              {{ error }}
            </span>
          </div>
        </div>
        <div
          class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg border border-gray-5 min-h-table"
        >
          <Table :header="header">
            <tbody>
              <tr v-for="article in form.details">
                <td class="text-center p-2 md:text-base text-xs">
                  {{ article.name }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  $ {{ getTotalPriceArticle(article) }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  {{ article.measure_unit.name }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  <template v-if="editUnit && article.id === selectedArticleID">
                    <div class="md:w-full w-28">
                      <InputCounter 
                        v-model:value="article.unit"
                        hasLimit
                        :limit="article.stock"
                      />
                    </div>
                  </template>
                  <template v-else>
                    {{ article.unit }}
                  </template>
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a @click="editArticle(article)"
                        class="text-blue-500 font-medium cursor-pointer">
                        {{ editUnit ? 'Guardar' : 'Editar'}}
                      </a>
                      <a @click="deleteArticle(article)"
                        class="text-red-500 font-medium cursor-pointer">Eliminar</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </Table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
