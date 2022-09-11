import { describe, it, expect, beforeEach } from 'vitest'
import { shallowMount } from '@vue/test-utils'
import UserList from '@/Pages/User/UserList.vue';

describe('Test suite UserList Page', () => {
  let wrapper;
  beforeEach(() => {
    wrapper = shallowMount(UserList);
  })
  it('should exist element defined', () => {
    expect(wrapper.element).toBeDefined();
  });

  it('should show the correct data props', async() => {
    const valHeader = ['name', 'phone', 'email']
    wrapper.vm.$.setupState.header = valHeader;
    await wrapper.vm.$nextTick();
    expect(wrapper.vm.header).toEqual(valHeader);
  });
})  