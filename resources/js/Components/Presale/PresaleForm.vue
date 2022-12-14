<script setup>
  import JetLabel from '@/Components/Label.vue';
  import { reactive, computed, ref, getCurrentInstance, watch } from 'vue';
  import Table from '@/Components/Table.vue';
  import { useForm, usePage, Link } from '@inertiajs/inertia-vue3';
  import JetInput from '@/Components/Input.vue';
  import { Inertia } from '@inertiajs/inertia';
  import InputCounter from '@/Components/Shared/InputCounter.vue';
  import JetButton from '@/Components/Button.vue';
  import InputPrice from '@/Components/Shared/inputPrice.vue';
  import _ from 'lodash';
  import { POSITION } from 'vue-toastification';
  import Loading from 'vue3-loading-overlay';
  import Toggle from '@/Components/Shared/Toggle.vue';
  import { getTotal } from '@/Helpers/Functions';

  const props = defineProps({
    clients: Object,
    payment_methods: Array,
    articles: Object | null,
    dispatches: Array,
    isEdit: Boolean,
    presale: Object
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
  const editUnit = ref(false);
  const form = useForm({
    presale_id: props.isEdit ? props.presale.id : null,
    client: {
      id: props.isEdit ? props.presale.client.id : null,
      name: props.isEdit ? props.presale.client.name : null,
      type_client: props.isEdit ? props.presale.client.type_client : null,
      payment_method: props.isEdit ? props.presale.method_paid : null,
      zone: props.isEdit ? props.presale.client.zone : null,
    },
    details: props.isEdit ? props.presale.presale_detail.map(item => ({ ...item, ...item.article, id_detail: item.id, id_presale: props.presale.id,  kind: 'old'}))  : [],
    paid: props.isEdit ? props.presale.paid : 0,
    pending: props.isEdit ? props.presale.total_pending : 0,
    total: 0,
    dispatch_id: props.isEdit ? props.presale.dispatch : { "id": 4, "name": "Entregado", "created_at": null, "updated_at": null },
    added: props.isEdit ? props.presale.added :0,
    total_paid: props.isEdit ? props.presale.total_paid : 0,
    total_detail: props.isEdit ? props.presale.total_detail : 0
  });
  const isLoading = ref(false)
  const search = ref('');
  const error = ref('');
  const selectedItem = ref({});
  const selectedArticleID = ref(0);
  const formDelete = useForm({
    id: null
  });
  const defaultDispatch = { "id": 4, "name": "Entregado", "created_at": null, "updated_at": null };


  const getTotalPending = computed(() => (getTotal(form.details) - form.total_paid).toFixed(2));
  const toast = getCurrentInstance().appContext.config.globalProperties.$toast;
  const isCanceled = computed(() => props.presale && [5].includes(props.presale.dispatch.id));
  const isPaid = computed(() => props.presale && props.presale.paid === 1)


  const searchArticle = (search, loading) => {
    const EP = props.isEdit ? `/dashboard/presales/${props.presale.id}/edit` : '/dashboard/presales/create'
    Inertia.get(EP, {
      search,
    }, {
      preserveState: true
    })
  }
  const handleSelected = (selected) => {
    selectedItem.value = { ...selected, total_articles: 0, total: 0, dischargued: 0 , kind: 'new'};
    search.value = null;
    error.value = '';
  }
  const addToCart = (item) => {
    const findArticle = form.details.length && form.details.find(i => i.id === item.id);
    const full = findArticle && _.sum([item['total_articles'], findArticle['total_articles']]) > findArticle.stock;
    if (validateStock(item.stock, item.total_articles) || full) {
      error.value = 'La cantidad es mayor a las existencias';
    } else {
      if (findArticle && Object.keys(findArticle).length) {
        findArticle.total_articles = findArticle.total_articles + item.total_articles;
        findArticle.total = getTotalPriceArticle(findArticle);
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
    return stock === 0 || unit > stock;
  }
  const editArticle = (article) => {
    editUnit.value = !editUnit.value;
    selectedArticleID.value = article.id;
    form.details.find(item => item.id === article.id).total = getTotalPriceArticle(article);
  }
  const getTotalPriceArticle = (article) => {
    return (article.price.sale_price * article.total_articles).toFixed(2);
  }
  const deleteArticle = (article) => {
    if(props.isEdit && article.kind === 'old') {
      formDelete.id = article.id
      formDelete.get(route('presale.delete_uniq', formDelete.id))
    } else {
      _.remove(form.details, item => item.id === article.id && item.kind === 'new')
    }
  }
  const savePresale = () => {
    const EP = props.isEdit ? 'presale.change' : 'presale.save';
    if (form.total_paid > getTotalPending.value) {
      toast.error('El total pagado no debe ser mayor al total del pedido', { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
    } else if(form.client.id) {
      isLoading.value = true;
      form.transform(data => {
        if(props.isEdit) {
          return {
            presale_id: data.presale_id,
            total_paid: data.paid === 1 ? data.added ? data.pending : getTotalPending.value : data.total_paid,
            total_pending: data.paid === 0 ? data.added ? data.pending : getTotalPending.value : 0,
            dispatch_id: data.paid === 1 ? 4 : data.dispatch_id.id,
            paid: data.paid,
            added: data.added,
            client_id: data.client.id,
            user_presale_id: usePage().props.value.user.id,
            user_dispatch_id: usePage().props.value.user.id,
            method_paid_id: data.client.payment_method.id,
            new_presale_detail: _.filter(data.details, { kind: 'new'}),
            old_presale_detail: _.filter(data.details, { kind: 'old' }),
            total_detail: data.paid === 0 ? data.added === 1 ? data.pending : getTotal(data.details) : getTotal(data.details)
          }
        } else {
          return {
            presale_id: data.presale_id,
            total_paid: data.paid === 1 ? data.added === 1 ? data.pending : getTotalPending.value : data.total_paid,
            total_pending: data.paid === 0 ? data.added === 1 ? data.pending : getTotalPending.value: 0,
            dispatch_id: data.paid === 1 ? 4 :data.dispatch_id.id,
            paid: data.paid,
            added: data.added,
            client_id: data.client.id,
            user_presale_id: usePage().props.value.user.id,
            user_dispatch_id: usePage().props.value.user.id,
            method_paid_id: data.client.payment_method.id,
            presale_detail: data.details,
            total_detail: data.paid === 0 ? data.added === 1 ? data.pending : getTotal(data.details) : getTotal(data.details),
          }
        }
      }).post(route(EP), {
        onSuccess: () => {
          toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
          if(form.paid === 0 && form.dispatch_id.id !== 4) {
            Inertia.get('/dashboard/presales');
          } else if (form.paid === 0 && form.dispatch_id.id === 4) {
            Inertia.get('/dashboard/pending-accounts');
          } else {
            Inertia.get('/dashboard/sales');
          }
          
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
    } else {
      toast.error('Informaci??n no ha sido completada', { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
    }
  }
  
  watch(() =>_.cloneDeep(form), (newVal, oldVal) => {
    if (newVal.added === 1) {
      form.dispatch_id = defaultDispatch;
    }
    if ( newVal.paid === 1) {
      form.total_paid = 0;
    }
  })
</script>
<template>
  <Loading :active.sync="isLoading"></Loading>
  <div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
      <div class="my-5 flex justify-between items-center">
        <div>
          <Link href="/dashboard/presales"
            class="inline-flex text-dark-blue-500 items-center font-bold transition hover:opacity-80">
          <font-awesome-icon icon="fa-solid fa-arrow-left-long" class="text-base mr-2" />
          Regresar
          </Link>
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight animated zoomIn">
            {{ isEdit ? 'Editar Preventa' : 'Nueva Preventa' }}
          </h2>
        </div>
        <JetButton v-if="!isPaid && !isCanceled" @click="savePresale">
          {{ isEdit ? 'Editar' : 'Crear' }}
        </JetButton>
      </div>
      <h6 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight mb-2 animated fadeIn">Informaci??n del Cliente
      </h6>
      <!-- Detalles del cliente -->
      <div class="bg-white w-full shadow-xl rounded-lg mb-5 border border-gray-50 p-5 animated fadeIn">
        <div class="flex justify-between items-center mb-2">
          <div class="">
            <JetLabel value="Agregar monto directo" />
            <Toggle v-model:checked="form.added" label :activeControl="isEdit" />
          </div>
          <div class="">
            <JetLabel value="Pagado" />
            <Toggle v-model:checked="form.paid" label :activeControl="presale && isPaid"  />
          </div>
        </div>
        <div class="grid lg:grid-cols-3 gap-x-5 gap-y-2 items-center mb-2">
          <div>
            <JetLabel for="name" value="Seleccionar Cliente" />
            <v-select 
              v-model="form.client" 
              :options="clients.data.length ? clients.data.filter(item => item.id !== 1) : []"
              :reduce="(option) => option"
              :disabled="isEdit"
              label="name" 
              placeholder="Seleccionar cliente"
              class="appearance-none capitalize mt-1"
            >
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
          <div v-if="form.client.id">
            <JetLabel for="name" value="Tipo de Cliente" />
            <JetInput id="name" 
              :value="form.client.type_client.id === 2 ?
              `${form.client.type_client.name}(${form.client.zone.name})` : form.client.type_client.name" 
              type="text"
              class="mt-1 block w-full"
              onlyRead />
          </div>
          <div v-if="form.client.id">
            <JetLabel for="method" value="M??todo de Pago" />
            <v-select 
              v-model="form.client.payment_method"
              :options="payment_methods.length ? payment_methods : []"
              :reduce="(option) => option"
              :disabled="isPaid || isCanceled"
              label="name"
              placeholder="Seleccionar cliente"
              class="appearance-none capitalize mt-1"
            >
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
        </div>
        <div v-if="form.client.id" class="grid lg:grid-cols-3 gap-x-5 items-center gap-y-2 ">
          <div>
            <JetLabel for="paid" value="Total Pagado" />
            <InputPrice id="paid" v-model:value="form.total_paid" class="mt-1 block w-full" :disabled="isPaid || isCanceled || form.added === 1 || form.paid === 1" />
          </div>
          <div>
            <JetLabel for="pending" value="Total Pendiente" />
            <InputPrice  v-if="form.added === 1" id="pending" v-model:value="form.pending" class="mt-1 block w-full" :disabled="isPaid"  />
            <JetInput v-else id="pending" :value="`$ ${getTotalPending}`" type="text" class="mt-1 block w-full" onlyRead />
          </div>
          <div>
            <JetLabel value="Estado" />
            <v-select 
              v-model="form.dispatch_id" :options="dispatches.length ? dispatches.filter(item => item.id !== 5) : []"
              :reduce="(option) => option"
              :disabled="isPaid || isCanceled || form.added === 1"
              label="name"
              placeholder="Seleccionar estado"
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
      </div>
      <template v-if="form.added === 0">
        <h6 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight mb-2 animated fadeIn">Detalle de la preventa
        </h6>
        <!-- Detalle de articulos -->
        <div class="bg-white w-full shadow-xl rounded-lg md:min-h-table border border-gray-50 mb-5 animated fadeIn">
          <div class="flex justify-between flex-wrap p-5 items-center">
            <div class="md:w-1/2 w-full md:order-first order-last">
              <JetLabel value="Seleccionar producto" class="mb-2" />
              <v-select v-model="search" :options="articles && articles.data.length ? articles.data : []"
                :reduce="(option) => option.id" :disabled="isPaid || isCanceled" label="name" placeholder="Buscar..."
                class="appearance-none capitalize" @search="searchArticle" @option:selected="handleSelected">
                <template #no-options="{ search, searching, loading }">
                  Busqueda no encontrada
                </template>
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
                  <td class="text-center p-2 lg:text-base text-xs">
                    {{ selectedItem.name }}
                  </td>
                  <td class="text-center p-2 lg:text-base text-xs">
                    $ {{ selectedItem.price ? selectedItem.price.sale_price : 0 }}
                  </td>
                  <td class="text-center p-2 lg:text-base text-xs">
                    {{ selectedItem.measure_unit.name }}
                  </td>
                  <td class="text-center p-2 lg:text-base text-xs">
                    <div class="md:w-full w-28">
                      <InputCounter v-model:value="selectedItem.total_articles" hasLimit :limit="selectedItem.stock" />
                    </div>
                  </td>
                  <td class="text-center p-2 lg:text-base text-xs"  :class="selectedItem.stock > 10 ? 'text-black' : 'text-red-500 font-bold'">
                    {{ selectedItem.stock }}
                  </td>
                  <td class="text-center p-2 lg:text-base text-xs">
                    <JetButton @click="addToCart(selectedItem)">
                      Agregar
                    </JetButton>
                  </td>
                </tr>
              </tbody>
            </Table>
          </div>
          <div v-if="error" class="w-full flex justify-center px-5 py-2">
            <span class="text-red-500 text-xs font-bold">
              {{ error }}
            </span>
          </div>
        </div>
        <div
          class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg border border-gray-5 min-h-table animated fadeIn">
          <Table :header="header" :items="form.details.length">
            <tbody>
              <tr v-for="article in form.details">
                <td class="text-center p-2 lg:text-base text-xs">
                  {{ article.name }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  $ {{ getTotalPriceArticle(article) }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  {{ article.measure_unit.name }}
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  <template v-if="editUnit && article.id === selectedArticleID">
                    <div class="md:w-full w-28">
                      <InputCounter v-model:value="article.total_articles" hasLimit :limit="article.stock" />
                    </div>
                  </template>
                  <template v-else>
                    {{ article.total_articles }}
                  </template>
                </td>
                <td class="text-center p-2 lg:text-base text-xs">
                  <div class="flex justify-center">
                    <div v-if="isPaid || (presale && [4, 5].includes(presale.dispatch.id))">-</div>
                    <div v-else class="flex flex-row space-x-4">
                      <a @click="editArticle(article)" class="text-blue-500 font-medium cursor-pointer">
                        {{ editUnit && article.id === selectedArticleID ? 'Guardar' : 'Editar'}}
                      </a>
                      <a @click="deleteArticle(article)" class="text-red-500 font-medium cursor-pointer">Eliminar</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </Table>
        </div>
      </template>
    </div>
  </div>
</template>
