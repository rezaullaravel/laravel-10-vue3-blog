import { createWebHistory, createRouter } from 'vue-router'


  import AdminDashboardComponent from '../admin/Dashboard.vue';

  //category
  import AdminCategory from '../admin/category/Category.vue';
  import AdminCategoryAdd from '../admin/category/Add.vue';
  import AdminCategoryEdit from '../admin/category/Edit.vue';

  //blog
  import AdminBlog from '../admin/blog/Blog.vue';
  import AdminBlogAdd from '../admin/blog/Add.vue';
  import AdminBlogEdit from '../admin/blog/Edit.vue';



const routes = [

  { path: '/admin/dashboard', component: AdminDashboardComponent },

  //category
  { path: '/admin/category', component: AdminCategory },
  { path: '/admin/add/category', component: AdminCategoryAdd },
  { path: '/admin/edit/category/:id',  component: AdminCategoryEdit, name:'editCategory', },

  //blog
  { path: '/admin/blog', component: AdminBlog },
  { path: '/admin/add/blog', component: AdminBlogAdd },
  { path: '/admin/edit/blog/:id',  component: AdminBlogEdit },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;
