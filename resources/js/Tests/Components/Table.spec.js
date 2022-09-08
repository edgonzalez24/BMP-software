import { describe, it, expect, beforeEach } from 'vitest'
import { shallowMount } from '@vue/test-utils'
import Table from '@/Components/Table.vue';

describe('Test suite Table Components', () => {
  let wrapper;
  beforeEach(() => {
    wrapper = shallowMount(Table, {
      propsData: {
        header: ['name', 'email']
      }
    })
  })
  it('should exist element defined', () => {
    expect(wrapper.element).toBeDefined();
  });

  it('should show the correct data props', () => {
    expect(wrapper.props('header')).toEqual(['name', 'email']);
  });
})