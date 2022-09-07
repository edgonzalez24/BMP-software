<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import JetButton from '@/Components/Button.vue';
import JetModal from '@/Components/Modal.vue';
import Invite from '@/Components/User/Invite.vue';
import { ref } from 'vue';


const header = ref(['Nombre', 'Correo Electronico', 'Telefono', 'Rol', 'Acciones']);
const users = ref([
  {
    name: 'Edwin Ernesto González Castillo',
    email: 'abc@gmail.com',
    phone: '0000000000',
    rol: 'Preventa'
  },
  {
    name: 'John Doe',
    email: 'abc@gmail.com',
    phone: '0000000000',
    rol: 'Preventa'
  }
]);

// Modal Invite
const statusModalInvite = ref(false);
const toggleInviteModal = () => {
  statusModalInvite.value = !statusModalInvite.value;
};

</script>

<template>
  <AppLayout title="Dashboard">
    <JetModal :show="statusModalInvite" @close="toggleInviteModal" maxWidth="lg" >
      <Invite />
    </JetModal>
    <div class="py-12">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Listado de usuarios
          </h2>
          <JetButton
            @click="toggleInviteModal"
          >
            Invitar
          </JetButton>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-base">
          <Table :header="header">
            <tbody class="px-5">
              <tr v-for="item in users" class="mt-2">
                <td class="text-center p-2 md:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 md:text-base text-xs hidden md:block">{{ item.email }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.phone }}</td>
                <td class="text-center p-2 md:text-base text-xs">{{ item.rol }}</td>
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
