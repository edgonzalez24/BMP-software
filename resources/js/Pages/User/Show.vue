<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import Table from '@/Components/Table.vue';
  import JetButton from '@/Components/Button.vue';
  import JetModal from '@/Components/Modal.vue';
  import DeleteUser from '@/Components/User/DeleteUser.vue';
  import FormUser from '@/Components/User/FormUser.vue';
  import { reactive, ref } from 'vue';

  defineProps({
    users: Object,
    roles: Array
  })


  const header = reactive([
    {
      name: 'Nombre',
      showInMobile: true
    },
    {
      name: 'Correo Electrónico',
      showInMobile: false
    },
    {
      name: 'Teléfono',
      showInMobile: true
    },
    {
      name: 'Rol',
      showInMobile: true
    },
    {
      name: 'Acciones',
      showInMobile: true
    }
  ]);
  const statusModalDelete = ref(false);
  const selectedUID = ref(0)
  const isEdit = ref(false);
  const selectedUser = reactive({
    user_id: null,
    name: null,
    email: null,
    user_role: null
  })
  const statusModalForm = ref(false);


  const toggleFormModal = () => {
    statusModalForm.value = !statusModalForm.value;
  };
  const toggleDeleteModal = () => {
    statusModalDelete.value = !statusModalDelete.value;
  };
  const selectItem = (item) => {
    selectedUser.user_id = item.id
    selectedUser.name = item.name
    selectedUser.email = item.email
    selectedUser.user_role = item.user_role
    isEdit.value = true
    toggleFormModal()
  }

</script>

<template>
  <AppLayout title="Dashboard">
    <JetModal :show="statusModalForm" maxWidth="lg" @close="toggleFormModal" >
      <FormUser :isEdit="isEdit" :user="selectedUser" @close="toggleFormModal" />
    </JetModal>
    <JetModal :show="statusModalDelete" maxWidth="lg" @close="toggleDeleteModal" >
      <DeleteUser :user="selectedUID" @close="toggleDeleteModal" />
    </JetModal>
    <div class="py-12 min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="flex justify-between items-center mb-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight animated zoomIn">
            Usuarios
          </h2>
          <JetButton
            @click="toggleFormModal(); isEdit = false"
          >
            Invitar
          </JetButton>
        </div>
        <div class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50 animated fadeIn">
          <Table :header="header" :items="users.data.length">
            <tbody class="px-5">
              <tr v-for="item in users.data" class="mt-2">
                <td class="text-center p-2 lg:text-base text-xs">{{ item.name }}</td>
                <td class="text-center p-2 lg:text-base text-xs hidden lg:block break-words">{{ item.email }}</td>
                <td class="text-center p-2 lg:text-base text-xs">
                  <a :href="`tel:${item.telephone}`">
                    {{ item.telephone }}
                  </a>
                </td>
                <td class="text-center p-2 lg:text-base text-xs capitalize">{{ item.user_role[0] }}</td>
                <td class="text-center p-2 lg:text-base text-xs">
                  <div class="flex justify-center">
                    <div class="flex flex-row space-x-4">
                      <a @click="selectItem(item)" class="text-blue-500 font-medium cursor-pointer">Editar</a>
                      <a @click="toggleDeleteModal(); selectedUID = item.id;" class="text-blue-500 font-medium cursor-pointer">Eliminar</a>
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
