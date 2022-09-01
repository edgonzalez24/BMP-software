<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import JetDropdownLink from '@/Components/DropdownLink.vue';
import { menuItems } from '@/Helpers/MenuItems';

defineProps({
  statusMenu: Boolean
});

defineEmits(['changeStatus']);

const menu = menuItems;
const route = window.route;

const logout = () => {
  Inertia.post(route('logout'));
};
</script>

<template>
  <transition name="slide">
    <div v-show="statusMenu" class="h-screen fixed bg-white flex justify-between flex-col md:w-2/6 lg:w-1/6 w-full">
      <div class="overflow-y-auto h-full">
        <div class="px-5 py-3 flex justify-center relative">
          <img src="@/Assets/images/logo-tito.png" alt="" class="md:w-2/3 w-40">
          <div class="md:hidden block absolute right-0 top-0 mr-5 mt-5 text-xl text-gray-400">
            <font-awesome-icon icon="fa-solid fa-xmark" class="text-xl cursor-pointer"
              @click="$emit('changeStatus', !statusMenu)" />
          </div>
        </div>
        <div class="pb-2">
          <div v-for="(item, index) in menu" :key="index"
            class="mb-3 pl-5 w-auto mr-10 py-3 flex items-center border-t border-gray-100"
            :class="item.slug && route && route().current() === item.slug ? 'bg-dark-blue-500 rounded-r-full text-white' : 'text-gray-200'">
            <Link v-if="item.slug && item.children.length === 0" :href="route && route(item.slug)"
              class="cursor-pointer block text-sm xl:text-base">
            <font-awesome-icon :icon="`fa-solid ${item.icon}`" class="mr-2" />
            {{ item.name }}
            </Link>
            <div v-else>
              <p class="uppercase text-black mb-2 text-sm xl:text-base">{{ item.name }}</p>
              <div v-for="child in item.children" class="mb-3"
                :class="child.slug && route && route().current() === child.slug ? 'bg-dark-blue-500 rounded-r-full text-white' : 'text-gray-400'">
                <Link class="cursor-pointer block text-sm xl:text-base">
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
          <JetDropdownLink as="button">
            <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" class="mr-2" />
            Cerrar Sesión
          </JetDropdownLink>
        </form>
      </div>
    </div>
  </transition>
</template>

