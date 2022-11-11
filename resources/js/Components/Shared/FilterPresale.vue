<script setup>
  import JetLabel from '@/Components/Label.vue';
  import { ref, onMounted } from 'vue';
  import moment from 'moment';

  const props = defineProps({
    clients: Array
  })

  const emit = defineEmits(['handleFilter'])

  const date = ref();
  const datepicker = ref();
  const client = ref({
    id: null,
    name: null
  });


  const alertDate = () => {
    datepicker.value.selectDate();
    datepicker.value.closeMenu();
    emit('handleFilter', date.value, client.value.id)
  }
  const alertFn = () => {
    datepicker.value.closeMenu();
    emit('handleFilter', date.value, client.value.id)
  }

  onMounted(() => {
    const startDate = new URLSearchParams(window.location.search).has('from') && moment(new URLSearchParams(window.location.search).get('from'));

    const endDate = new URLSearchParams(window.location.search).has('to') && moment(new URLSearchParams(window.location.search).get('to'));

    date.value = startDate && endDate ? [startDate, endDate] : null;
    if (new URLSearchParams(window.location.search).has('client_id')) {
      props.clients && props.clients.map(item => {
        if (item.id === Number(new URLSearchParams(window.location.search).get('client_id'))) {
          client.value = { id: item.id, name: item.name }
        }
      })
    }
  });
</script>

<template>
  <div class="bg-white w-full shadow-xl rounded-lg p-4 border border-gray-50 animated fadeIn">
    <div class="flex lg:flex-row flex-col lg:space-x-4 lg:justify-between">
      <div class="lg:w-1/2 w-full">
        <JetLabel value="Rango de fecha" />
        <div>
          <Datepicker 
            v-model="date"
            range 
            :maxDate="new Date()" 
            ignoreTimeValidation
            locale="es"
            cancelText="Cancelar"
            selectText="Seleccionar"
            :enableTimePicker="false"
            placeholder="Seleccionar fechas" 
            ref="datepicker"
            format="dd/MM/yyyy"
            @cleared="alertFn"
          >
            <template #action-select>
              <p class="cursor-pointer font-bold text-dark-blue-500 hover:text-opacity-70 transition duration-300 ease-in-out" @click="alertDate">Seleccionar</p>
            </template>
          </Datepicker>
        </div>
      </div>
      <div class="lg:w-1/3 w-full lg:mt-0 mt-2">
        <JetLabel value="Clientes" />
        <v-select
          v-model="client.id"
          :options="clients && clients.length ? [{ id: null, name: 'Todos' }, ...clients.filter(item => item.id !== 1)] : []"
          :reduce="(option) => option.id"
          label="name" 
          placeholder="Seleccionar cliente"
          @option:selected="emit('handleFilter', date, client.id)"
          :clearable="false"
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
      </div>
    </div>
  </div>
</template>