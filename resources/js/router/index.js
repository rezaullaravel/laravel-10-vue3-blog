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

  //frontend
  import FrontHome from '../frontend/FrontHome.vue';
  import CatwiseBlog from '../frontend/CatwiseBlog.vue';
  import SingleBlog from '../frontend/SingleBlog.vue';
  import SearchBlog from '../frontend/SearchBlog.vue';



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


  //frontend
  { path: '/',  component: FrontHome },
  { path: '/catwise/blog/:id',  component: CatwiseBlog },
  { path: '/blog/single/:id',  component: SingleBlog },
  { path: '/search/result/:searchResult',  component: SearchBlog },


]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;
