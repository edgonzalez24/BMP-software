<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import JetDropdownLink from '@/Components/DropdownLink.vue';
import { menuItems } from '@/Helpers/MenuItems';
import { usePermission } from '@/Composables/usePermission';

usePermission()
defineProps({
  statusMenu: Boolean
});

defineEmits(['changeStatus']);

const menu = menuItems;
const route = window.route;

const logout = () => {
  route && Inertia.post(route('logout'));
};

const active = (slug) => {
  return window.location.pathname.includes(slug);
}

</script>

<template>
  <transition name="slide">
    <div v-show="statusMenu" class="h-screen fixed bg-dark-blue-500 flex justify-between flex-col md:w-3/12	lg:w-1/6 w-full z-50">
      <div class="overflow-y-auto h-full sidebar">
        <div class="px-5 py-3 flex justify-center relative">
          <img src="@/Assets/images/logo-tito.png" alt="" class="w-auto sm:w-1/2">
          <div class="md:hidden block absolute right-0 top-0 mr-5 mt-5 text-xl text-gray-400">
            <font-awesome-icon icon="fa-solid fa-xmark" class="text-xl cursor-pointer icon-xmark"
              @click="$emit('changeStatus', !statusMenu)" />
          </div>
        </div>
        <div class="pb-2">
          <div v-for="(item, index) in menu" :key="index"
            class="pl-5 w-auto mr-10 py-3 flex items-center border-t border-gray-100 transition duration-300 ease-in-out"
            :class="route().current() === item.slug ? 'text-white font-bold' : 'text-gray-400 hover:text-white'">
            <Link v-if="item.slug && item.children.length === 0" :href="route && route(item.slug)"
              class="cursor-pointer block text-sm xl:text-base">
            <font-awesome-icon :icon="`fa-solid ${item.icon}`" class="mr-2" />
            {{ item.name }}
            </Link>
            <div v-else>
              <p class="uppercase text-white mb-2 text-sm xl:text-base font-extrabold">{{ item.name }}</p>
              <div v-for="child in item.children" class="mb-3 transition duration-300 ease-in-out"
                :class="child.slug && active(child.slug) ? 'text-white font-bold' : 'hover:text-white text-gray-400'">
                <Link :href="child.slug && route && route(child.slug)" class="cursor-pointer block text-sm xl:text-base">
                  <font-awesome-icon :icon="`fa-solid ${child.icon}`" class="mr-2" />
                  {{ child.name }}
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="p-5 border-t border-gray-100">
        <form @submit.prevent="logout" class="inline-flex items-center text-gray-400 cursor-pointer">
          <JetDropdownLink as="button" class="submit">
            <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" class="mr-2" />
            Cerrar Sesión
          </JetDropdownLink>
        </form>
      </div>
    </div>
  </transition>
</template>

