<template>
    <div>
        <div class="container pt-3">
            <div class="row">
                <div class="col-sm-10 offset-sm-1">
                    <div class="card">
                        <div class="card-header">
                            <h4>Category List
                                <router-link to="/admin/add/category" class="btn btn-info" style="float: right;">Add Category</router-link>
                            </h4>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(category,index) in result.data" :key="category.id" class="text-center">
                                       <td>{{ index+1 }}</td>
                                       <td>{{ category.category_name }}</td>
                                       <td>
                                         <router-link :to="{name:'editCategory',params:{id:category.id}}" class="btn btn-info">Edit</router-link>

                                         <button @click.prevent="deleteCategory(category)" class="btn btn-danger">Delete</button>
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
        async deleteCategory (category) {

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
               axios.get('/category/delete/'+category.id)
                this.$router.push('/admin/category')
                this.$toast.success(`Category Deleted Successfully`);
                setTimeout(this.$toast.clear, 3000);

            //     let index = this.result.indexOf(category);
            //    this.result.splice(index, 1);
            //this.list(this.result.current_page);
            this.list();
        }
        });



    },//end function


    //get all category with pagination
    async list(page=1){
        axios.get(`/a-dmin/categories?page=${page}`)
        .then((response)=>{
            this.result = response.data;
            //console.log(response)
        })
    }//end function
    }//methods


}
</script>


