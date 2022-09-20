import { describe, it, expect, beforeEach, afterEach } from 'vitest'
import { mount } from '@vue/test-utils'
import FormUser from '@/Components/User/FormUser.vue';

describe('Test suite Modal Components', () => {
  let wrapper;
  beforeEach(() => {
    wrapper = mount(FormUser)
  })
  it('should exist element defined', () => {
    wrapper.vm.$.setupState.roles = [
      { "id": 1, "name": "encargado", "guard_name": "web", "created_at": "2022-09-13T13:02:19.000000Z", "updated_at": "2022-09-13T13:02:19.000000Z" }
    ];
    expect(wrapper.element).toBeDefined();
  });
})