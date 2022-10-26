<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { reactive, computed, ref, getCurrentInstance } from 'vue';
  import Table from '@/Components/Table.vue';
  import Pagination from '@/Components/Shared/Pagination.vue';
  import moment from 'moment';
  import { Link } from '@inertiajs/inertia-vue3';
  
  const props = defineProps({
    presales: Object
  });
  const header = reactive([
    {
      name: 'Fecha',
      showInMobile: true
    },
    {
      name: 'ID',
      showInMobile: true
    },
    {
      name: 'Cliente',
      showInMobile: true
    },
    {
      name: 'Estado',
      showInMobile: true
    },
    {
      name: 'Tipo de Pago',
      showInMobile: true
    },
    {
      name: 'Acciones',
      showInMobile: true
    }
  ]);

  const totalPages = computed(() => Math.ceil(props.presales.meta.total / props.presales.meta.per_page));
  const formatDate = date => {
    return moment(date).format("DD-MM-YYYY");
  }
</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Pedidos
          </h2>
          <Link :href="route('presales.create')" class="inline-flex items-center px-8 py-2 border border-transparent rounded-md font-semibold sm:text-base text-sm  tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition bg-dark-blue-500 focus:ring-gray-300 focus:border-gray-900 hover:bg-gray-700 active:bg-gray-900 text-white">
            Crear
          </Link>
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50">
          <Table :header="header">
            <tbody class="px-5">
              <tr 
                v-for="item in presales.data" 
                class="mt-2 cursor-pointer hover:bg-slate-50 transition duration-300 ease-in-out"
                @click="true"
              >
                <td class="text-center p-2 md:text-base text-xs">
                  {{ formatDate(item.created_at) }}
                </td>
                <td 
                  class="text-center p-2 md:text-base text-xs"
                >
                  Orden #{{ item.id }}
              </td>
                <td 
                  class="text-center p-2 md:text-base text-xs"
                >
                  {{ item.client.name }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  {{ item.dispatch.name }}
                </td>
                <td 
                  class="text-center p-2 md:text-base text-xs"
                >
                  {{  item.method_paid.name }}
                </td>
                <td class="text-center p-2 md:text-base text-xs" @click.stop>
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a @click="true" class="text-blue-500 font-medium cursor-pointer">Editar</a>
                      <a @click="true" class="text-blue-500 font-medium cursor-pointer">Eliminar</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </Table>
        </div>
        <div 
          v-if="totalPages > 1" 
          class="flex mt-8 justify-center"
        >
          <Pagination
            :total="totalPages"
            :previous="presales.links.prev"
            :next="presales.links.next"
            page="presales"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>