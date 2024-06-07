<template>
    <div>
        <section class="section blog-wrap">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="row">
                     <div class="col-lg-12 mb-5">
                        <div class="single-blog-item">
                           <img :src="'/upload/blog_images/'+result.image" alt="" class="img-fluid" width="600" height="300">
                           <div class="blog-item-content mt-5">
                              <div class="blog-item-meta mb-3">

                                 <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-2"></i> 28th January 2019</span>
                              </div>
                              <h2 class="mb-4 text-md"><a href="">{{ result.title }}</a></h2>

                              <p>{{ result.description }}</p>

                           </div>
                        </div>
                     </div>

                  </div>
               </div>
               <Sidebar/>
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
        }
    },

    components:{
        Sidebar
    },

    methods:{
        singleBlog(){
            let id = this.$route.params.id;
            axios.get(`/get/single/blog/`+id)
            .then((response)=>{
                this.result = response.data;
                //console.log(response)
            })
        }
    },
    mounted(){
      this.singleBlog();
    },

    watch:{
        $route(to,from){
            this.singleBlog();
        }
    }
}
</script>
