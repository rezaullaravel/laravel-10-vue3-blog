import { createWebHistory, createRouter } from 'vue-router'


  import AdminDashboardComponent from '../admin/Dashboard.vue';
  import AdminCategory from '../admin/category/Category.vue';
  import AdminCategoryAdd from '../admin/category/Add.vue';
  import AdminCategoryEdit from '../admin/category/Edit.vue';


const routes = [

  { path: '/admin/dashboard', component: AdminDashboardComponent },

  //category
  { path: '/admin/category', component: AdminCategory },
  { path: '/admin/add/category', component: AdminCategoryAdd },
  { path: '/admin/edit/category/:id',  component: AdminCategoryEdit, name:'editCategory', },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;
