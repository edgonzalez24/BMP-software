<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import Pagination from '@/Components/Shared/Pagination.vue';
import JetButton from '@/Components/Button.vue';
import { reactive, computed } from 'vue';

const props =  defineProps({
  articles: Object
});


// Setup State
const header = reactive([
  {
    name: 'ID',
    showInMobile: true
  },
  {
    name: 'Nombre',
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
const totalPages = computed(() => Math.ceil(props.articles.meta.total / props.articles.meta.per_page));
</script>

<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Artículos
          </h2>
          <JetButton @click="true">
            Añadir
          </JetButton>
        </div>
        <div class="bg-white overflow-hidden shadow-xl rounded-lg min-h-base">
          <Table :header="header">
            <tbody class="px-5">
              <tr v-for="item in articles.data" class="mt-2">
                <td class="text-center p-2 md:text-base text-xs">{{ item.id }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.measure_unit }}</td>
                <td class="text-center p-2 md:text-base text-xs">
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a @click="selectItem(item)" class="text-blue-500 font-medium cursor-pointer">Editar</a>
                      <a @click="selectDeleteItem(item)" class="text-blue-500 font-medium cursor-pointer">Eliminar</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </Table>
        </div>
        <div class="flex mt-8 justify-center">
          <Pagination
            :total="totalPages" 
            :previous="articles.links.prev"
            :next="articles.links.next"
            page="articles" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>