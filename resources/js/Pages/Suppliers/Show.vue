<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Components/Button.vue';
import Loading from 'vue3-loading-overlay';
import JetModal from '@/Components/Modal.vue';
import JetLabel from '@/Components/Label.vue';
import JetInput from '@/Components/Input.vue';
import Toggle from '@/Components/Shared/Toggle.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const isLoading = ref(false);
const isEdit = ref(false);
const statusModalForm = ref(false);
const formInitial = useForm({
  name: null,
  telephone: null,
  email: null,
  active: true
});

const toggleFormModal = () => {
  statusModalForm.value = !statusModalForm.value;
};
</script>

<template>
  <AppLayout>
    <!-- Loading -->
    <Loading :active.sync="isLoading" ></Loading>
    <JetModal :show="statusModalForm" maxWidth="lg" @close="toggleFormModal" >
      <form class="py-8 px-5" @submit.prevent="true">
        <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
          {{ isEdit ? 'Editar proveedor' : 'Añadir proveedor' }}
        </h2>
        <div class="mb-5">
          <JetLabel for="name" value="Status" />
          <Toggle v-model:checked="formInitial.active" />
        </div>
        <div class="mb-5">
          <JetLabel for="name" value="Nombre" />
          <JetInput
            id="name"
            v-model="formInitial.name"
            type="text"
            class="mt-1 block w-full"
            required
            autofocus
          />
        </div>
        <div class="mb-5">
          <JetLabel for="name" value="Télefono" />
          <JetInput
            id="name"
            v-model="formInitial.telephone"
            type="text"
            class="mt-1 block w-full"
            autofocus
          />
        </div>
        <div class="mb-5">
          <JetLabel for="name" value="Correo Electrónico" />
          <JetInput
            id="name"
            v-model="formInitial.email"
            type="email"
            class="mt-1 block w-full"
            autofocus
          />
        </div>
        <div class="flex justify-end mb-5">
          <div class="w-auto flex flex-row space-x-4 justify-between">
            <JetButton
              background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
              type="button"
              @click="toggleFormModal"
            >
              Cancelar
            </JetButton>
            <JetButton
              type="submit"
            >
              {{ isEdit ? 'Editar' : 'Añadir' }}
            </JetButton>
          </div>
        </div>
      </form>
    </JetModal>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Proveedores
          </h2>
          <JetButton
            @click="toggleFormModal"
          >
            Añadir
          </JetButton>
        </div>
        <div class="bg-white overflow-hidden shadow-xl rounded-lg min-h-base">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus culpa soluta placeat molestias exercitationem commodi voluptatem id, possimus inventore qui reprehenderit ad repudiandae officia ea aut, voluptates alias quos. Sapiente.
        </div>
      </div>
    </div>
  </AppLayout>
</template>