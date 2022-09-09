import { describe, it, expect, beforeEach, vi } from 'vitest'
import { shallowMount } from '@vue/test-utils'
import FormUser from '@/Components/User/FormUser.vue';

describe('Test suite Modal Components', () => {
  let wrapper;
  beforeEach(() => {
    wrapper = shallowMount(FormUser)
  })
  it('should exist element defined', () => {
    expect(wrapper.element).toBeDefined();
  });
})