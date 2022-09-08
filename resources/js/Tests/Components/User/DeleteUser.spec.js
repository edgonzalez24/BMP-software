import { describe, it, expect, beforeEach } from 'vitest'
import { mount } from '@vue/test-utils'
import DeleteUser from '@/Components/User/DeleteUser.vue';
import JetButton from '@/Components/Button.vue';

describe('Test suite DeleteUser Component', () => {
  let wrapper;
  beforeEach(() => {
    wrapper = mount(DeleteUser, {
      propsData: {
        user: 2
      }
    });
  })
  it('should exist element defined', () => {
    expect(wrapper.element).toBeDefined();
  });

  it('should emit close event ', async() => {
    const buttons = wrapper.findAllComponents(JetButton);
    const cancelButton = buttons.at(0);
    await cancelButton.trigger('click');
    expect(wrapper.emitted().close).toBeTruthy();
  });
  it('should emit a submit event', async () => {
    await wrapper.find('form').trigger('submit.prevent');
    expect(wrapper.emitted().submit).toBeTruthy();
  });
})  