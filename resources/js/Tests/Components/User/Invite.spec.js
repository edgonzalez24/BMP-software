import { describe, it, expect, beforeEach, vi } from 'vitest'
import { shallowMount } from '@vue/test-utils'
import Invite from '@/Components/User/Invite.vue';

describe('Test suite Modal Components', () => {
  let wrapper;
  beforeEach(() => {
    wrapper = shallowMount(Invite)
  })
  it('should exist element defined', () => {
    expect(wrapper.element).toBeDefined();
  });
})