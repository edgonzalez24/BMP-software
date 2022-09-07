<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import JetButton from '@/Components/Button.vue';
import JetModal from '@/Components/Modal.vue';
import { ref } from 'vue';

defineProps({
  users: Array,
  roles: Array
})

const header = ref(['Nombre', 'Correo Electronico', 'Telefono', 'Rol', 'Acciones']);

// Modal Invite
const statusModalInvite = ref(false);
const toggleInviteModal = () => {
  statusModalInvite.value = !statusModalInvite.value;
};

</script>

<template>
  <AppLayout title="Dashboard">
    <JetModal :show="statusModalInvite" @close="toggleInviteModal" >
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima autem, perspiciatis suscipit fuga nulla quasi ut nesciunt distinctio sed molestias animi totam repudiandae quas reprehenderit earum omnis, esse ad porro.
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
              <tr v-for="item in users.data" class="mt-2">
                <td class="text-center p-2 md:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 md:text-base text-xs hidden md:block">{{ item.email }}</td>
                <td class="text-center p-2 md:text-base text-xs">
                  <a :href="`tel:${item.telephone}`">
                    {{ item.telephone }}
                  </a>
                </td>
                <td class="text-center p-2 md:text-base text-xs capitalize">{{ item.user_role[0] }}</td>
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
