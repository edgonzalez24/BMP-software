
import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import _ from 'lodash';

export const getInitials = (name) => {
  if (name) {
    const names = name.split(' ')
    let initials = names[0].substring(0, 1).toUpperCase();
    if (names.length > 1) {
      initials += names[names.length - 1].substring(0, 1).toUpperCase();
    }
    return initials;
  }
};


export const hasPermission = (value) => {
  const arrRoles = computed(() => usePage().props.value && usePage().props.value.user_role);
  const roles = [..._.map(arrRoles.value, 'name'), ''];
  return roles && roles.includes(value)
}

export const appendParams = (url, props) => {
  const arrUrl = url.split(/[,.&=?\s]/).filter(e => e);
  const group = _.chunk(arrUrl, 2);
  const objParams = Object.fromEntries(group);
  return _.omit(objParams, props);
}

export const getTotal = (arr) => {
  return _.sumBy(arr, item => Number(item.total)).toFixed(2);
}