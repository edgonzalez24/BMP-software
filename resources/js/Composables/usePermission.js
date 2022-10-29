import { usePage } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";

export const usePermission = () => {
  const hasPermission = ref(false);
  const getUser = computed(() => usePage().props.value.user).value;
  console.log(getUser)


  return {
    hasPermission
  }
}