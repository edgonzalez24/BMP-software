<script setup>
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import _ from 'lodash';

const props = defineProps({
  total: Number,
  page: String,
  perPage: Number
});

const numberPage = ref(1);
numberPage.value = new URLSearchParams(window.location.search).has('page') ? Number(new URLSearchParams(window.location.search).get('page')) : 1;

const appendParams = (url) => {
  const arrUrl = url.split(/[,.&=?\s]/).filter(e => e);
  const group = _.chunk(arrUrl, 2);
  const objParams = Object.fromEntries(group);
  return _.omit(objParams, 'page');
}
const handleAction = (value) => {
  Inertia.get(props.page, { page: value, ...appendParams(window.location.search)})
}
</script>

<template>
  <pagination 
    v-model="numberPage"
    :records="props.total"
    :per-page="props.perPage"
    @paginate="handleAction"
    :options="{
      chunksNavigation: 'scroll',
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
