<template>
    <div>
        <section class="section blog-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">

                        <div class="col-lg-12 col-md-12 mb-5" v-for="blog in result">
                            <div class="blog-item">
                                <div class="blog-thumb">
                                    <img :src="'/upload/blog_images/'+blog.image" alt="" class="" width="600" height="300">
                                </div>
                                <div class="blog-item-content">
                                    <div class="blog-item-meta mb-3 mt-4">
                                    <!-- <span class="text-muted text-capitalize mr-3"><i class="icofont-comment mr-2"></i></span> -->
                                    <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i>{{ blog.created_at }} </span>
                                    </div>
                                    <h2 class="mt-3 mb-3"><router-link :to="`/blog/single/${blog.id}`">{{ blog.title }}</router-link></h2>
                                    <p class="mb-4">{{ blog.description }}</p>
                                    <router-link :to="`/blog/single/${blog.id}`"  class="btn btn-main btn-icon btn-round-full">Read More <i class="icofont-simple-right ml-2  "></i></router-link>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                    <Sidebar/>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-8">
                        <nav class="pagination py-2 d-inline-block">
                        <div class="nav-links">
                            <span aria-current="page" class="page-numbers current">1</span>
                            <a class="page-numbers" href="#">2</a>
                            <a class="page-numbers" href="#">3</a>
                            <a class="page-numbers" href="#"><i class="icofont-thin-double-right"></i></a>
                        </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Sidebar from './Sidebar.vue';
export default{
    data(){
        return{
          result:[],
          popularBlog:[]
        }
    },

    components:{
        Sidebar
    },
    methods:{
        categorywiseBlog(){
            let id = this.$route.params.id;
            axios.get(`/catWise/blog/`+id)
            .then((response)=>{
                this.result = response.data;
                //console.log(response)
            })
        }
    },
    mounted(){
      this.categorywiseBlog();

    },

    watch:{
        $route(to,from){
            this.categorywiseBlog();
        }
    }
}
</script>

