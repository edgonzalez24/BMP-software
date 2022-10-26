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
      {
        name: 'Stock',
        slug: 'stocks',
        icon: 'fa-cart-flatbed'
      },
    ]
  },
  {
    name: 'Cuentas por cobrar',
    slug: '',
    icon: '',
    children: [
      {
        name: 'Clientes',
        slug: 'clients',
        icon: 'fa-users'
      },
      {
        name: 'Reportes',
        slug: 'location',
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
        name: 'Pedidos',
        slug: 'presales',
        icon: 'fa-cart-shopping'
      },
    ]
  },
  {
    name: 'General',
    slug: '',
    icon: '',
    children: [
      {
        name: 'Roles y Permisos',
        slug: 'users',
        icon: 'fa-lock'
      },
    ]
  },
  {
    name: 'Centro de Ayuda',
    slug: '',
    icon: '',
    children: [
      {
        name: 'Manual de Ayuda',
        slug: '',
        icon: 'fa-circle-info'
      },
    ]
  }
];