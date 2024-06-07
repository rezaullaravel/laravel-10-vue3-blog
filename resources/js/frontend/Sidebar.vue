<template>
    <div class="col-lg-4">
                        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                        <div class="sidebar-widget search  mb-3 ">
                            <h5>Search Here</h5>
                            <form action="#" class="search-form">
                                <input type="text" @keyup="search" v-model="string" class="form-control" placeholder="search">
                                <i class="ti-search"></i>
                            </form>
                        </div>
                        <div class="sidebar-widget latest-post mb-3">
                            <h5>Popular Posts</h5>

                            <div class="py-2" v-for="(popular,index) in popularBlog">
                                <span class="text-sm text-muted">03 Mar 2018</span>
                                <h6 class="my-2"><router-link :to="`/blog/single/${popular.id}`" >{{ popular.title }}</router-link></h6>
                            </div>

                        </div>
                        <div class="sidebar-widget category mb-3">
                            <h5 class="mb-4">Categories</h5>
                            <ul class="list-unstyled">
                                <li class="align-items-center" v-for="category in result">
                                    <router-link :to="`/catwise/blog/${category.id}`">{{ category.category_name }}({{ category.blogs.length }})</router-link>
                                    <span></span>
                                </li>
                            </ul>
                        </div>
                        </div>
                    </div>
</template>

<script>
export default{
    data(){
        return{
            result:[],
            popularBlog:[],
            string:'',
            searchResult:[],
        }
    },

    mounted(){
         //get all category
         axios.get(`/getAll/categories`)
        .then((response)=>{
            this.result = response.data;
            //console.log(response)
        }),

         //popular blog
      axios.get(`/get/all/blogs`)
        .then((response)=>{
            this.popularBlog = response.data;
            //console.log(response)
        })


    },

    methods:{
        search(){
            if(this.string.length>2){
                axios.get('/search/blog/'+this.string)
                .then((response)=>{
                    //console.log(response);
                    const searchResultString = encodeURIComponent(JSON.stringify(response.data));

                    this.$router.push('/search/result/'+searchResultString)
                })
            }
        }
    },



}
</script>
