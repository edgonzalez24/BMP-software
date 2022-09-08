import { describe, it, expect, beforeEach, vi } from 'vitest'
import { mount } from '@vue/test-utils'
import Modal from '@/Components/Modal.vue';

describe('Test suite Modal Components', () => {
  let wrapper;
  beforeEach(() => {
    wrapper = mount(Modal, {
      slots: {
        default: 'Main Content'
      },
      propsData: {
        show: true,
        closeable: true
      }
    })
  })
  it('should exist element defined', () => {
    expect(wrapper.element).toBeDefined();
  });
})