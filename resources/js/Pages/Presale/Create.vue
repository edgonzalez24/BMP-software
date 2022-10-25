<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import PresaleForm from '@/Components/Presale/PresaleForm.vue';

  defineProps({
    clients: Object,
    payment_methods: Array,
    articles: Object | null,
    dispatches: Array
  })

</script>
<template>
  <AppLayout>
    <PresaleForm 
      :clients="clients" 
      :payment_methods="payment_methods"
      :articles="articles"
      :dispatches="dispatches"
    />
  </AppLayout>
</template>
