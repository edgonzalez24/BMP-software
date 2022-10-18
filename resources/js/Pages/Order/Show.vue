<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import JetButton from '@/Components/Button.vue';
  import { reactive, computed, ref, getCurrentInstance } from 'vue';

  const header = reactive([
    {
      name: 'ID',
      showInMobile: true
    },
    {
      name: 'Tipo de cliente',
      showInMobile: false
    },
    {
      name: 'Estado',
      showInMobile: true
    },
    {
      name: 'Télefono',
      showInMobile: true
    },
    {
      name: 'Acciones',
      showInMobile: true
    }
  ]);
</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Pedidos
          </h2>
          <JetButton @click="true">
            Crear
          </JetButton>
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base">
          <Table :header="header">
            <tbody class="px-5">
              <!-- <tr v-for="item in clients.data" class="mt-2 cursor-pointer hover:bg-slate-50 transition duration-300 ease-in-out"
                @click="selectDetail(item)">
                <td class="text-center p-2 md:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ getTypeClient(item.type_client_id) }}</td>
                <td class="text-center p-2 md:text-base text-xs">
                  <div class="flex justify-center">
                    <Status :status="item.active" class="sm:w-1/2 md:w-1/3 w-full" />
                  </div>
                </td>
                <td class="text-center p-2 md:text-base text-xs" @click.stop>
                  <a :href="`tel:${item.telephone}`">
                    {{ item.telephone || '-' }}
                  </a>
                </td>
                <td class="text-center p-2 md:text-base text-xs" @click.stop>
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a @click="selectItem(item)" class="text-blue-500 font-medium cursor-pointer">Editar</a>
                      <a @click="selectDeleteItem(item)" class="text-blue-500 font-medium cursor-pointer">Eliminar</a>
                    </div>
                  </div>
                </td>
              </tr> -->
            </tbody>
          </Table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>