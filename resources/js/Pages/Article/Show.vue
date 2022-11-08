<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import Pagination from '@/Components/Shared/Pagination.vue';
import JetButton from '@/Components/Button.vue';
import Status from '@/Components/Shared/Status.vue';
import JetModal from '@/Components/Modal.vue';
import JetLabel from '@/Components/Label.vue';
import JetInput from '@/Components/Input.vue';
import { reactive, computed, ref, getCurrentInstance, watch } from 'vue';
import Loading from 'vue3-loading-overlay';
import { useForm, usePage, Link } from '@inertiajs/inertia-vue3';
import Toggle from '@/Components/Shared/Toggle.vue';
import QuillEditor from '@/Components/Shared/QuillEditor.vue';
import { POSITION } from 'vue-toastification';
import DetailArticle from '@/Components/Article/Detail.vue';
import { Inertia } from '@inertiajs/inertia';
import { hasPermission } from '@/Helpers/Functions';
import InputPrice from '@/Components/Shared/inputPrice.vue';

const props =  defineProps({
  articles: Object,
  categories: Array,
  measures_units: Array,
  suppliers: Array
});


// Setup State
const header = reactive([
  {
    name: 'Nombre',
    showInMobile: true
  },
  {
    name: 'Categoria',
    showInMobile: false
  },
  {
    name: 'Estado',
    showInMobile: true
  },
  {
    name: 'Unidad de medidad',
    showInMobile: true
  },
  {
    name: 'Acciones',
    showInMobile: true
  }
]);
const article = reactive({});
const isLoading = ref(false);
const statusModalForm = ref(false);
const statusModalDelete = ref(false);
const statusModalDetail = ref(false);
const isEdit = ref(false);
const toast = getCurrentInstance().appContext.config.globalProperties.$toast;
const totalPages = computed(() => Math.ceil(props.articles.meta.total / props.articles.meta.per_page));
const toggleFormModal = () => {
  statusModalForm.value = !statusModalForm.value;
};
const toggleDeleteModal = () => {
  statusModalDelete.value = !statusModalDelete.value;
};
const toggleDetailModal = () => {
  statusModalDetail.value = !statusModalDetail.value;
}
const formInitial = useForm({
  article_id: null,
  name: null,
  comment: null,
  measure_unit_id: null,
  category_id: null,
  active: 1,
  global_price: null
});
const formDelete = useForm({
  id: null
});
const formFilter = useForm({
  search: new URLSearchParams(window.location.search).get('search') || null,
  category_id: Number(new URLSearchParams(window.location.search).get('category_id')) || null,
  measure_unit_id: Number(new URLSearchParams(window.location.search).get('measure_unit_id')) || null,
});

const selectDeleteItem = item => {
  formDelete.id = item.id;
  toggleDeleteModal();
};
const selectItem = item => {
  formInitial.article_id = item.id;
  formInitial.name = item.name;
  formInitial.comment = item.comment;
  formInitial.active = item.active;
  formInitial.measure_unit_id = item.measure_unit.id;
  formInitial.category_id = item.category.id;
  formInitial.global_price = item.price ? item.price.sale_price: 0
  isEdit.value = true;
  toggleFormModal();
};
const selectDetailItem = item => {
  article.value = item;
  toggleDetailModal();
};
const submitForm = () => {
  isLoading.value = true;
  const request = isEdit.value ? 'article.change' : 'article.save';
  formInitial.post(route(request), {
    onSuccess: () => {
      toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
      toggleFormModal()
      formInitial.reset();
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
      isLoading.value = false
    }
  })
}
const submitDelete = () => {
  isLoading.value = true;
  formDelete.get(route('article.delete', formDelete.id), {
    onSuccess: () => {
      toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
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
};
watch(formFilter, value => {
  Inertia.get('/dashboard/articles/filter', {
      search: value.search,
      category_id: value.category_id,
      measure_unit_id: value.measure_unit_id
    }, {
    preserveState: true
  })
})

</script>

<template>
  <AppLayout>
    <Loading :active.sync="isLoading"></Loading>
    <JetModal :show="statusModalForm" maxWidth="lg" @close="toggleFormModal">
      <form class="py-8 px-5" @submit.prevent="submitForm">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          {{ isEdit ? 'Editar artículo' : 'Añadir artículo' }}
        </h2>
        <div class="mb-5">
          <JetLabel value="Estado" />
          <Toggle v-model:checked="formInitial.active" />
        </div>
        <div class="mb-5">
          <JetLabel for="name" value="Nombre" />
          <JetInput id="name" v-model="formInitial.name" type="text" class="mt-1 block w-full" required autofocus />
        </div>
        <div v-if="isEdit" class="mb-5">
          <JetLabel for="price" value="Precio" />
          <p class="text-xs">
            <font-awesome-icon icon="fa-solid fa-triangle-exclamation" class="text-yellow-500 mr-1" />
            El precio será actualizado si hay registro en stock
          </p>
          <InputPrice id="price" v-model:value="formInitial.global_price" type="text" class="mt-1 block w-full" />
        </div>
        <div class="mb-5">
          <JetLabel for="comment" value="Comentario" />
          <QuillEditor v-model="formInitial.comment" />
        </div>
        <div class="mb-5">
          <div class="flex justify-between items-center">
            <JetLabel for="measure" value="Unidad de medida" />
            <Link href="measures" class="cursor-pointer block text-xs text-blue-600">
            + Agregar Unidad
            </Link>
          </div>
          <v-select 
            v-model="formInitial.measure_unit_id"
            :options="measures_units.length ? measures_units : []"
            :reduce="(option) => option.id" label="name" placeholder="Seleccionar unidad de medida"
            class="appearance-none capitalize"
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
        <div class="mb-5">
          <div class="flex justify-between items-center">
            <JetLabel for="category" value="Categoria" />
            <Link 
              href="categories" 
              class="cursor-pointer block text-xs text-blue-600"
            >
            + Agregar Categoria
            </Link>
          </div>
          <v-select 
            v-model="formInitial.category_id"
            :options="categories.length ? categories : []" 
            :reduce="(option) => option.id" 
            label="name"
            placeholder="Seleccionar una categoria" class="appearance-none capitalize"
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
        <div v-if="isEdit" class="mb-5">
          <Link :href="`stocks/${formInitial.article_id}/detail`" class="cursor-pointer inline-flex items-center text-base text-blue-600">
            Explorar Stock 
            <font-awesome-icon icon="fa-solid fa-right-long" class="text-blue-600 cursor-pointer pl-2" />
          </Link>
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
    <JetModal :show="statusModalDelete" maxWidth="lg" @close="toggleDeleteModal">
      <form class="py-8 px-5" @submit.prevent="submitDelete">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          ¿Deseas eliminar este artículo?
        </h2>
        <div class="px-5">
          <p class="mt-5 text-justify text-gray-400">
            Al eliminar a este artículo se borrará permanentemente del sistema,
            por favor confirmar la acción haciendo click en el botón de 'Eliminar'.
          </p>
          <div class="flex justify-end mt-5">
            <div class="w-auto flex flex-row space-x-4 justify-between">
              <JetButton 
                background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
                type="button" 
                @click="toggleDeleteModal"
              >
                Cancelar
              </JetButton>
              <JetButton background="bg-red-600 focus:ring-transparent focus:border-transparent" type="submit">
                Eliminar
              </JetButton>
            </div>
          </div>
        </div>
      </form>
    </JetModal>
    <JetModal :show="statusModalDetail" maxWidth="2xl" @close="toggleDetailModal">
      <DetailArticle
        :article="article.value"
        @close="toggleDetailModal"
      />
    </JetModal>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight animated zoomIn">
            Artículos
          </h2>
          <JetButton 
            v-if="hasPermission('article_create')" 
            @click="isEdit = false; formInitial.reset();toggleFormModal();"
          >
            Añadir
          </JetButton>
        </div>
        <div class="bg-white w-full shadow-xl rounded-lg p-4 mb-5 border border-gray-50 animated fadeIn">
          <div class="flex lg:flex-row flex-col space-x-4 items-end">
            <div class="lg:w-1/2 w-full">
              <JetLabel value="Búsqueda" />
              <JetInput 
                id="search" 
                v-model="formFilter.search" 
                placeholder="Buscar artículo..."
                type="text"
                class="mt-1 block w-full"
              />
            </div>
            <div class="w-full lg:w-1/2 flex flex-row space-x-4 lg:mt-0 mt-5">
              <div class="w-1/2">
                <JetLabel value="Categorías" />
                <v-select
                  v-model="formFilter.category_id"
                  :options="categories.length ? [{ id: null, name: 'Todas' }, ...categories] : []"
                  :reduce="(option) => option.id"
                  label="name" 
                  placeholder="Seleccionar una categoria"
                  :clearable="false"
                  class="appearance-none capitalize"
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
              <div class="w-1/2">
                <JetLabel value="Unidades de medidas" />
                <v-select
                  v-model="formFilter.measure_unit_id"
                  :options="measures_units.length ? [{ id: null, name: 'Todas' }, ...measures_units] : []"
                  :reduce="(option) => option.id"
                  label="name"
                  placeholder="Seleccionar medida" 
                  :clearable="false"
                  class="appearance-none capitalize"
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
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50 animated fadeIn">
          <Table :header="header">
            <tbody class="px-5">
              <tr 
                v-if="articles.data.length"
                v-for="item in articles.data"
                class="mt-2 cursor-pointer hover:bg-slate-50 transition duration-300 ease-in-out"
                @click="selectDetailItem(item)"
              >
                <td class="text-center p-2 md:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 md:text-base text-xs md:block hidden">{{ item.category.name}}</td>
                <td class="text-center p-2 md:text-base text-xs">
                  <div class="flex justify-center">
                    <Status :status="item.active" class="sm:w-1/2 md:w-1/3 w-full" />
                  </div>
                </td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.measure_unit.name }}</td>
                <td class="text-center p-2 md:text-base text-xs" @click.stop>
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a v-if="hasPermission('article_edit')" @click="selectItem(item)" class="text-blue-500 font-medium cursor-pointer">Editar</a>
                      <a v-if="hasPermission('article_destroy')" @click="selectDeleteItem(item)" class="text-blue-500 font-medium cursor-pointer">Eliminar</a>
                      <p v-if="!hasPermission('article_edit') && !hasPermission('article_destroy')"> - </p>
                    </div>
                  </div>
                </td>
              </tr>
              <tr v-else >
                <td :colspan="header.length">
                  <div class="flex justify-center">
                    <div>
                      <img src="@/Assets/gifs/empty.gif" alt="" class="mx-auto">
                      <p class="text-center">No se han encontrado resultados </p>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </Table>
        </div>
        <div v-if="totalPages > 1" class="flex mt-8 justify-center">
          <Pagination
            :previous="articles.meta.per_page"
            page="articles" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>