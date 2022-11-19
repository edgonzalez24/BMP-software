<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { useForm, usePage, Link } from '@inertiajs/inertia-vue3';
  import JetButton from '@/Components/Button.vue';
  import { ref, reactive, getCurrentInstance, computed } from 'vue';
  import InputCounter from '@/Components/Shared/InputCounter.vue';
  import _ from 'lodash';
  import { Inertia } from '@inertiajs/inertia';
  import Table from '@/Components/Table.vue';
  import { POSITION } from 'vue-toastification';
  import Loading from 'vue3-loading-overlay';
  import { getTotal } from '@/Helpers/Functions';
  import JetLabel from '@/Components/Label.vue';

  const props = defineProps({
    articles: Object | null,
  });


  const form = useForm({
    details: [],
    paid: 0,
    pending: 0,
    total: 0,
    added:0,
    total_paid: 0,
  });
  const search = ref('');
  const selectedItem = ref({});
  const error = ref('');
  const selectedArticleID = ref(0);
  const editUnit = ref(false);
  const isLoading = ref(false);
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


  const toast = getCurrentInstance().appContext.config.globalProperties.$toast;
  const getTotalPending = computed(() => (getTotal(form.details) - form.total_paid).toFixed(2));


  const searchArticle = (search, loading) => {
    const EP = '/dashboard/express/create'
    Inertia.get(EP, {
      search,
    }, {
      preserveState: true
    })
  };
  const handleSelected = (selected) => {
    selectedItem.value = { ...selected, total_articles: 0, total: 0, dischargued: 0 };
    search.value = null;
    error.value = '';
  }
  const validateStock = (stock, unit) => {
    return stock === 0 || unit > stock;
  }
  const getTotalPriceArticle = (article) => {
    return (article.price.sale_price * article.total_articles).toFixed(2);
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
  const editArticle = (article) => {
    editUnit.value = !editUnit.value;
    selectedArticleID.value = article.id;
    form.details.find(item => item.id === article.id).total = getTotalPriceArticle(article);
  }
  const deleteArticle = (article) => {
    _.remove(form.details, item => item.id === article.id)
  }
  const savePresale = () => {
    const EP = 'express.save';
    if (form.details.length) {
      isLoading.value = true;
      form.transform(data => {
        return {
          total_paid:  getTotalPending.value,
          total_detail: getTotalPending.value,
          user_presale_id: usePage().props.value.user.id,
          user_dispatch_id: usePage().props.value.user.id,
          presale_detail: data.details
        }
      }).post(route(EP), {
        onSuccess: () => {
          toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
          Inertia.get('/dashboard/express');
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
      toast.error('Información no ha sido completada', { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
    }
  }
</script>
<template>
  <AppLayout>
    <Loading :active.sync="isLoading"></Loading>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="my-5 flex justify-between items-center">
          <div>
            <Link href="/dashboard/express"
              class="inline-flex text-dark-blue-500 items-center font-bold transition hover:opacity-80">
            <font-awesome-icon icon="fa-solid fa-arrow-left-long" class="text-base mr-2" />
            Regresar
            </Link>
            <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight animated zoomIn">
              Nueva Venta
            </h2>
          </div>
          <JetButton @click="savePresale">
            Crear
          </JetButton>
        </div>
        <h6 class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight mb-2 animated fadeIn">Detalle de la
          Venta
        </h6>
        <div class="bg-white w-full shadow-xl rounded-lg md:min-h-table border border-gray-50 mb-5 animated fadeIn">
          <div class="flex justify-between flex-wrap p-5 items-center">
            <div class="md:w-1/2 w-full md:order-first order-last">
              <JetLabel value="Seleccionar producto" class="mb-2" />
              <v-select v-model="search" :options="articles && articles.data.length ? articles.data : []"
                :reduce="(option) => option.id" label="name" placeholder="Buscar..."
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
                  <td class="text-center p-2 lg:text-base text-xs">
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
                    <div class="flex flex-row space-x-4">
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
      </div>
    </div>
  </AppLayout>
</template>