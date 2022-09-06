<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import { ref } from 'vue';


const header = ref(['Nombre', 'Correo Electronico', 'Telefono', 'Rol', 'Acciones']);
const users = ref([
  {
    name: 'John Doe',
    email: 'abc@gmail.com',
    phone: '0000000000',
    rol: 'Preventa'
  }
])

</script>

<template>
  <AppLayout title="Dashboard">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight mb-5">
          Listado de usuarios
        </h2>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-base">
          <Table :header="header">
            <tbody>
              <tr v-for="item in users" class="mt-2">
                <td class="text-center py-3">{{ item.name }}</td>
                <td class="text-center py-3">{{ item.email }}</td>
                <td class="text-center py-3">{{ item.phone }}</td>
                <td class="text-center py-3">{{ item.rol }}</td>
                <td class="text-center py-3">
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a @click="true" class="text-blue-500 font-medium">Editar</a>
                      <a @click="true" class="text-blue-500 font-medium">Eliminar</a>
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
