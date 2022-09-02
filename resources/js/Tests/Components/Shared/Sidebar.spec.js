import { describe, it, expect, beforeEach } from 'vitest'
import { shallowMount } from '@vue/test-utils'
import Sidebar from '@/Components/Shared/Sidebar.vue';

describe('Test suite Sidebar Components', () => {
  let wrapper;
  beforeEach(async() => {
    wrapper = shallowMount(Sidebar, {
      global: {
        stubs: ['FontAwesomeIcon'],
        $route: { path: '/some/path' }
      },
      propsData: {
        menu: [
          {
            name: 'Home',
            slug: 'dashboard',
            icon: 'fa-house',
            children: []
          },
          {
            name: 'Inventario',
            slug: '',
            icon: 'fa-house',
            children: []
          }
        ]
      }
    })
  })
  it('renders message when component is created', () => {
    expect(wrapper.element).toBeDefined();
  });

  it('should emit event to handle status menu mobile', () => {
    wrapper.find('.icon-xmark').trigger('click');
    expect(wrapper.emitted().changeStatus).toBeTruthy();
  });

  it('should emit a submit event', async() => {
    await wrapper.find('form').trigger('submit.prevent');
    expect(wrapper.emitted().submit).toBeTruthy();
  });
})