<template>
    <div class="container pt-3">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Blog</h4>
                    </div>

                    <div class="card-body">
                            <form @submit.prevent="storeBlog">
                                <div class="form-group">
                                    <label>Category Name <span class="text-danger">*</span></label>
                                    <select name="category_id" v-model="form.category_id"  class="form-control">
                                        <option value="" selected disabled>Select Category</option>
                                        <option :value="category.id" v-for="category in result">{{ category.category_name }}</option>
                                    </select>
                                   <div class="text-danger" v-if="form.errors.has('category_id')" v-html="form.errors.get('category_id')"/>
                                </div>


                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" v-model="form.title"  class="form-control">

                                   <div class="text-danger" v-if="form.errors.has('title')" v-html="form.errors.get('title')"/>
                                </div>

                                <div class="form-group">
                                    <label>Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image"  class="form-control" @change="handleFile">

                                    <div class="text-danger" v-if="form.errors.has('image')" v-html="form.errors.get('image')"/>
                                    <img  :src="imagePreview" width="150px" />
                                </div>


                                <div class="form-group">
                                    <label>Description<span class="text-danger">*</span></label>
                                    <textarea name="description" v-model="form.description" class="form-control" rows="5"></textarea>

                                   <div class="text-danger" v-if="form.errors.has('description')" v-html="form.errors.get('description')"/>
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
        category_id: '',
        title: '',
        description: '',
        image:null,
       }),

       result:[],
       imagePreview:null,
       }
    },

    mounted(){
        //get all category
        axios.get(`/get/all/categories`)
        .then((response)=>{
            this.result = response.data;
            //console.log(response)
        })

    },

    methods: {
    async storeBlog () {
       const response = await this.form.post('/a-dmin/store/blog')
       this.$router.push('/admin/blog')
       // Make a success toastr
       this.$toast.success(`Blog Created Successfully`);
       setTimeout(this.$toast.clear, 3000);

    },//store blog end

    handleFile (event) {
      const file = event.target.files[0]
      this.form.image = file
      //preview image
        let reader = new FileReader();
        reader.addEventListener("load",function(){
            this.imagePreview = reader.result;
        }.bind(this), false);
        if(this.form.image){
            reader.readAsDataURL(this.form.image);
        }
    },
  }//methods
}
</script>
