export const menuItems = [
  {
    name: 'Home',
    slug: 'dashboard',
    icon: 'fa-house',
    children: []
  },
  {
    name: 'Inventario',
    slug: '',
    icon: '',
    children: [
      {
        name: 'Categoria',
        slug: 'inventario-categoria',
        icon: 'fa-tag'
      },
      {
        name: 'Producto',
        slug: 'inventario-categoria',
        icon: 'fa-box-open'
      }
    ]
  },
  {
    name: 'Cuentas por cobrar',
    slug: '',
    icon: '',
    children: [
      {
        name: 'Reportes',
        slug: 'inventario-categoria',
        icon: 'fa-chart-simple'
      },
    ]
  },
  {
    name: 'Logistica',
    slug: '',
    icon: '',
    children: [
      {
        name: 'Entregas',
        slug: 'inventario-categoria',
        icon: 'fa-route'
      },
    ]
  },
  {
    name: 'General',
    slug: '',
    icon: '',
    children: [
      {
        name: 'Personalizar',
        slug: 'inventario-categoria',
        icon: 'fa-wand-sparkles'
      },
      {
        name: 'Roles y Permisos',
        slug: 'inventario-categoria',
        icon: 'fa-lock'
      },
    ]
  }
];