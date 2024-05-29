<template>
    <div class="container pt-3">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Category</h4>
                    </div>

                    <div class="card-body">
                            <form @submit.prevent="storeCategory">
                                <div class="form-group">
                                    <label>Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="category_name" v-model="form.category_name" placeholder="Category Name" class="form-control">
                                   <div class="text-danger" v-if="form.errors.has('category_name')" v-html="form.errors.get('category_name')"/>
                                </div>

                                <div class="form-group">
                                    <label></label>
                                    <input type="submit" value="Add" class="btn btn-success" style="float: right;">
                                </div>


                            </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform'
export default{
    data(){
       return{
        form: new Form({
        category_name: '',
       })
       }
    },

    methods: {
    async storeCategory () {
       const response = await this.form.post('/a-dmin/store/category')
       this.$router.push('/admin/category')
       // Make a success toastr
       this.$toast.success(`Category Created Successfully`);
       setTimeout(this.$toast.clear, 3000);

    }
  }
}
</script>
