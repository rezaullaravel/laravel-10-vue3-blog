<template>
    <div>
        <div class="container pt-3">
            <div class="row">
                <div class="col-sm-10 offset-sm-1">
                    <div class="card">
                        <div class="card-header">
                            <h4>Blog List
                                <router-link to="/admin/add/blog" class="btn btn-info" style="float: right;">Add Blog</router-link>
                            </h4>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(blog,index) in result.data" :key="blog.id" class="text-center">
                                       <td>{{ index+1 }}</td>
                                       <td>{{ blog.category.category_name }}</td>
                                       <td>{{ blog.title }}</td>
                                       <td>{{ blog.author }}</td>
                                       <td>{{ limitString(blog.description,20) }}</td>
                                       <td>
                                         <img :src="'/upload/blog_images/'+blog.image" alt="" width="80" height="80">
                                       </td>
                                       <td>
                                         <router-link :to="`/admin/edit/blog/${blog.id}`" class="btn btn-info">Edit</router-link>

                                         <button @click.prevent="deleteBlog(blog)" class="btn btn-danger">Delete</button>
                                       </td>
                                    </tr>
                                </tbody>
                            </table>

                            <Bootstrap4Pagination align="center" style="margin-top: 5px;"
                                :data="result"
                                @pagination-change-page="list"
                            />

                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

 <script>
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

export default{
    components: {
        Bootstrap4Pagination
    },
    data() {
        return {
            result: [],
        }
    },



    mounted(){
      this.list();
    },



    methods:{
        async deleteBlog (blog) {

        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
               axios.get('/blog/delete/'+blog.id)
                this.$router.push('/admin/blog')
                this.$toast.success(`Blog Deleted Successfully`);
                setTimeout(this.$toast.clear, 3000);

            this.list();
        }
        });



    },//end function

    //short the blog description
    limitString(str, limit) {
      if (str.length > limit) {
        return str.substring(0, limit) + '...';
      }
      return str;
    },


    //get all blog with pagination
    async list(page=1){
        axios.get(`/a-dmin/blogs?page=${page}`)
        .then((response)=>{
            this.result = response.data;
            //console.log(response)
        })
    }//end function
    }//methods


}
</script>


