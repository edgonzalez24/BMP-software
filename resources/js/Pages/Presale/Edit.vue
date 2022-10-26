<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PresaleForm from '@/Components/Presale/PresaleForm.vue';

defineProps({
  payment_methods: Array,
  articles: Object | null,
  dispatches: Array,
  presale: Object,
  clients: Object
})

</script>
<template>
  <AppLayout>
    <PresaleForm 
      :clients="clients" 
      :payment_methods="payment_methods"
      :articles="articles"
      :dispatches="dispatches"
      :presale="presale.data[0]"
      isEdit
    />
  </AppLayout>
</template>
