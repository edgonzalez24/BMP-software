<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import Table from '@/Components/Table.vue';
  import { reactive, computed } from 'vue';
  import Pagination from '@/Components/Shared/Pagination.vue';
  import moment from 'moment';

  const props = defineProps({
    clients: Array,
    presales: Object
  });

  const header = reactive([
    {
      name: 'ID',
      showInMobile: true
    },
    {
      name: 'Fecha',
      showInMobile: true
    },
    {
      name: 'Cliente',
      showInMobile: true
    },
    {
      name: 'Pendiente',
      showInMobile: true
    },
    {
      name: 'Abonado',
      showInMobile: true
    }
  ]);
  const formatDate = date => {
    return moment(date).format("DD-MM-YYYY");
  };
  const totalPages = computed(() => Math.ceil(props.presales.meta.total / props.presales.meta.per_page));
</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Historial de Cuentas
          </h2>
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50">
          <Table :header="header">
            <tbody class="px-5">
              <tr
                v-if="presales.data.length"
                v-for="item in presales.data"
                class="mt-2 hover:bg-slate-50 transition duration-300 ease-in-out"
              >
                <td class="text-center p-2 md:text-base text-xs">
                  Orden #{{ item.id }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  {{ formatDate(item.created_at) }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  {{ item.client.name }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  ${{ item.total_pending }}
                </td>
                <td class="text-center p-2 md:text-base text-xs">
                  ${{ item.total_paid }}
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