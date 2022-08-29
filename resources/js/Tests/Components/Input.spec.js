import { describe, it, expect } from 'vitest'
import { shallowMount } from '@vue/test-utils'
import Input from '@/Components/Input.vue';

describe('Test suite Input Components', () => {
  it('renders message when component is created', () => {
    // render the component
    const wrapper = shallowMount(Input, {
      propsData: {
        modelValue: 'Vue Project'
      }
    })
    expect(wrapper.element).toBeDefined();
  })
})