<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import JetLabel from '@/Components/Label.vue';
  import { reactive, computed, ref, getCurrentInstance } from 'vue';
  import Table from '@/Components/Table.vue';
  import { useForm } from '@inertiajs/inertia-vue3';
  import JetInput from '@/Components/Input.vue';

  defineProps({
    clients: Array,
    methods_payments: Array
  })
  const header = reactive([
    {
      name: 'Articulo',
      showInMobile: true
    },
    {
      name: 'Precio',
      showInMobile: false
    },
    {
      name: 'Stock',
      showInMobile: true
    },
    {
      name: 'Acciones',
      showInMobile: true
    }
  ]);
  const selectedItem = ref({});

  const form = useForm({
    client: null
  });
</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pb-8">
        <div class="my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Detalle del Pedido
          </h2>
        </div>

        <!-- Detalles del cliente -->
        <div class="bg-white w-full shadow-xl rounded-lg mb-5 border border-gray-50 p-5">
          <div class="grid grid-cols-3 gap-x-5 gap-y-2 items-center mb-2">
            <div>
              <JetLabel for="name" value="Seleccionar Cliente" />
              <v-select
                v-model="selectedItem"
                :options="clients.data.length ? clients.data : []"
                :reduce="(option) => option"
                label="name"
                placeholder="Seleccionar cliente"
                class="appearance-none capitalize mt-1"
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
            <div v-if="Object.keys(selectedItem).length">
              <JetLabel for="name" value="Tipo de Cliente" />
              <JetInput id="name" v-model="selectedItem.type_client.name" type="text" class="mt-1 block w-full" onlyRead />
            </div>
            <div v-if="Object.keys(selectedItem).length">
              <JetLabel for="method" value="Método de Pago" />
              <JetInput id="method" v-model="selectedItem.payment_method.name" type="text" class="mt-1 block w-full" onlyRead />
            </div>
          </div>
          <div v-if="Object.keys(selectedItem).length" class="grid grid-cols-3 gap-x-5 items-center">
            <div>
              <JetLabel for="name" value="Total Pagado" />
              <JetInput id="name" value="$10" type="text" class="mt-1 block w-full" onlyRead />
            </div>
            <div>
              <JetLabel for="name" value="Total Pendiente" />
              <JetInput id="name" value="$20" type="text" class="mt-1 block w-full" onlyRead />
            </div>
          </div>
        </div>
        <!-- Detalle de articulos -->
        <div class="bg-white w-full shadow-xl rounded-lg mb-5 border border-gray-50">
            <Table :header="header">
              <tbody class="px-5">
                <tr>
                  <td class="text-center p-2 md:text-base text-xs">
                    <v-select
                      v-model="form.role_id"
                      :options="clients.length ? clients : []"
                      :reduce="(option) => option.id"
                      label="name"
                      placeholder="Buscar"
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
                  </td>
                </tr>
              </tbody>
            </Table>
        </div>
        <div
          class="bg-white w-full sm:overflow-x-hidden overflow-x-auto shadow-xl rounded-lg min-h-base border border-gray-50">
          <Table :header="header">

          </Table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
