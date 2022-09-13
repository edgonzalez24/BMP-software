<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Components/Button.vue';
import Table from '@/Components/Table.vue';
import { reactive, ref } from 'vue';

const header = ref(['ID', 'Nombre', 'Acciones']);
const categories = reactive([{
  id: 1,
  name: 'Lacteos'
}])

</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Categorias
          </h2>
          <JetButton
          >
            Crear
          </JetButton>
        </div>
        <div class="bg-white overflow-hidden shadow-xl rounded-lg min-h-base">
          <Table :header="header">
            <tbody class="px-5">
              <tr v-for="item in categories" class="mt-2">
                <td class="text-center p-2 md:text-base text-xs">{{ item.id }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">
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
      </div>
    </div>
  </AppLayout>
</template>