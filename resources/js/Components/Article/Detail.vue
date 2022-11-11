<script  setup>
  import JetButton from '@/Components/Button.vue';

  const props = defineProps({
    article: {
      type: Object,
      required: true
    }
  });
  const emit = defineEmits(['close']);
</script>
<template>
  <div class="py-8 px-5">
    <h3 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">{{ article.name }}</h3>
    <div class="grid grid-cols-2 gap-x-4 sm:gap-x-8 gap-y-2">
      <div class="text-center">
        <p class="text-dark-blue-500 font-bold sm:text-lg">
          {{ article.measure_unit.name }}
        </p>
        <p class="border-t border-gray-300">
          Unidad de Medida
        </p>
      </div>
      <div class="text-center">
        <p class="font-bold sm:text-lg" :class="article.stock > 10 ? 'text-dark-blue-500' : 'text-red-500'">
          {{ article.stock }}
        </p>
        <p class="border-t border-gray-300"  :class="article.stock > 10 ? 'text-black' : 'text-red-500'">
          Total de Stock
        </p>
      </div>
      <div class="text-center">
        <p class="text-dark-blue-500 font-bold sm:text-lg">
          ${{ article.price ? Number(article.price.sale_price).toFixed(2) : 0 }}
        </p>
        <p class="border-t border-gray-300">
          Precio
        </p>
      </div>
      <div class="text-center">
        <p class="text-dark-blue-500 font-bold sm:text-lg">
          {{ article.category.name}}
        </p>
        <p class="border-t border-gray-300">
          Categoría
        </p>
      </div>
    </div>
    <div class="mt-5">
      <h6 class="font-semibold text-lg text-dark-blue-500 leading-tight text-center mb-3">Descripción del artículo</h6>
      <p v-if="article.comment" v-html="article.comment"></p>
      <p v-else>Sin Comentarios</p>
    </div>
    <div class="flex justify-end mt-5">
      <div class="w-auto">
        <JetButton type="button" @click="emit('close')">
          Entendido!
        </JetButton>
      </div>
    </div>
  </div>
</template>