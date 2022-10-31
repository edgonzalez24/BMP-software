export const menuItems = [
  {
    name: 'Home',
    slug: 'dashboard',
    icon: 'fa-house',
    children: [],
    rol: '', 
  },
  {
    name: 'Inventario',
    slug: '',
    icon: '',
    rol: '', 
    children: [
      {
        name: 'Artículos',
        slug: 'articles',
        icon: 'fa-box-open',
        rol: 'article_index', 
      },
      {
        name: 'Categorias',
        slug: 'categories',
        icon: 'fa-network-wired',
        rol: 'category_article_index', 
      },
      {
        name: 'Unidades de medida',
        slug: 'measures',
        icon: 'fa-tag',
        rol: 'measure_units_index', 
      },
      {
        name: 'Proveedores',
        slug: 'suppliers',
        icon: 'fa-truck-field-un',
        rol: 'supplier_index', 
      },
      {
        name: 'Stock',
        slug: 'stocks',
        icon: 'fa-cart-flatbed',
        rol: 'stock_index', 
      },
    ]
  },
  {
    name: 'Cuentas por cobrar',
    slug: '',
    icon: '',
    rol: '', 
    children: [
      {
        name: 'Clientes',
        slug: 'clients',
        icon: 'fa-users',
        rol: 'client_index', 
      },
      {
        name: 'Historial de Cuentas',
        slug: 'account-history',
        icon: 'fa-chart-simple',
        rol:'acountHistory_index', 
      },
    ]
  },
  {
    name: 'Logistica',
    slug: '',
    icon: '',
    rol: '', 
    children: [
      {
        name: 'Pedidos',
        slug: 'presales',
        icon: 'fa-cart-shopping',
        rol: 'presale_index'
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
        icon: 'fa-lock',
        rol: 'user_list'
      },
    ]
  },
  {
    name: 'Centro de Ayuda',
    slug: '',
    icon: '',
    rol: '',
    children: [
      {
        name: 'Manual de Ayuda',
        slug: '',
        icon: 'fa-circle-info',
        rol: ''
      },
    ]
  }
];