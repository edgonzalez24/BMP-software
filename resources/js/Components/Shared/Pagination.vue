<script setup>
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import { appendParams } from "@/Helpers/Functions";

const props = defineProps({
  total: Number,
  page: String,
  perPage: Number
});

const numberPage = ref(1);
numberPage.value = new URLSearchParams(window.location.search).has('page') ? Number(new URLSearchParams(window.location.search).get('page')) : 1;


const handleAction = (value) => {
  Inertia.get(props.page, { page: value, ...appendParams(window.location.search, 'page')})
}
</script>

<template>
  <pagination 
    v-model="numberPage"
    :records="props.total"
    :per-page="props.perPage"
    @paginate="handleAction"
    :options="{
      chunksNavigation: 'fixed',
      chunk: 5,
      edgeNavigation: true,
      texts: {
        count: 'Mostrando página {page} de {pages}',
        first: 'Inicio',
        last: 'Final'
      }
    }"
  />
</template>
