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
        name: 'Stock',
        slug: '',
        icon: 'fa-box-open'
      },
      {
        name: 'Artículos',
        slug: 'articles',
        icon: 'fa-box-open'
      },
      {
        name: 'Categorias',
        slug: 'categories',
        icon: 'fa-network-wired'
      },
      {
        name: 'Unidades de medida',
        slug: 'measures',
        icon: 'fa-tag'
      },
      {
        name: 'Proveedores',
        slug: 'suppliers',
        icon: 'fa-truck-field-un'
      },
    ]
  },
  {
    name: 'Cuentas por cobrar',
    slug: '',
    icon: '',
    children: [
      {
        name: 'Reportes',
        slug: '',
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
        slug: '',
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
        slug: '',
        icon: 'fa-wand-sparkles'
      },
      {
        name: 'Roles y Permisos',
        slug: 'users',
        icon: 'fa-lock'
      },
    ]
  }
];