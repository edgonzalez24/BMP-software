<script setup>
import JetLabel from '@/Components/Label.vue';
import JetInput from '@/Components/Input.vue';
import JetDropdown from '@/Components/Dropdown.vue'
</script>

<template>
  <div class="py-4 px-5">
    <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center">
      Invitar a usuario
    </h2>
    <div class="flex flex-row space-x-4 my-5">
      <div class="w-1/2">
        <JetLabel for="name" value="Nombres" />
        <JetInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
        />
      </div>
      <div class="w-1/2">
        <JetLabel for="lastname" value="Apellidos" />
        <JetInput
          id="lastname"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
        />
      </div>
    </div>
    <div class="mb-5">
      <JetLabel for="email" value="Correo Electrónico" />
      <JetInput
        id="email"
        type="email"
        class="mt-1 block w-full"
        required
        autofocus
      />
    </div>
    <div class="mb-5">
      <JetLabel for="rol" value="Rol" />
    </div>
  </div>
</template>