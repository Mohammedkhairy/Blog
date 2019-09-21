<template>
  <!-- Main content -->
  <div class="content">
    <button href="#" @click="addProduct()"  v-show="products == ''" class="btn btn-default" style="margin-left:45%"> Add New Product</button>
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-8" style="margin-left:15%">
          <div class="card" style="text-align:center" v-for="(product , key) in products" :key="key">
            <div class="card-header">
              <h3 class="card-title" >{{product.title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <img class="img-fluid pad" style="width:100%;height:400px" :src="`storage/product/${product.image}`" alt="Photo">
                <h4>Name : {{product.name}}</h4>
                <h4>Code : {{product.code}}</h4>
                <h4>Price : {{product.price}}</h4>
                <p>Discription : {{product.description}}</p>
                <div>
                  <a href="#" @click="addProduct()" class="btn btn-default btn-sm"> Add Product</a>
                  <a href="#" @click="addCustomFeild(product)" class="btn btn-default btn-sm"> Add Custom Feild</a>
                  <a href="#" @click="editProduct(product)" class="btn btn-default btn-sm"> Edit</a>
                  <a href="#" @click="deleteProduct(product)" class="btn btn-default btn-sm"> Delete</a>
                </div>
            </div>
            <!-- /.card-body -->
               
          </div>
                <pagination :data="proObj.data" @pagination-change-page="getResults"></pagination>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>

    <!-- /.container-fluid -->
              <div class="modal fade" id="ArtModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered"  role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editMod" >Add New Article</h5>
                            <h5 class="modal-title" v-show="editMod" >Update Article</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form role="form"  method="post" :action="action" enctype="multipart/form-data">
                          <input type="hidden" name="_method" :value="method">
                          <div class="card-body">
                            <div class="form-group">
                              <label for="name">name</label>
                              <input type="text" v-model="name" class="form-control" name="name" id="name" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                              <label for="code">code</label>
                              <input type="text"  v-model="code" class="form-control" name="code" id="code" placeholder="Enter code">
                              <p>{{ errors.code }}</p>           
                            </div>

                            <div class="form-group">
                              <label for="price">price</label>
                              <input type="text" v-model="price" class="form-control" name="price" id="price" placeholder="Enter price">
                            </div>

                            <div class="form-group">
                              <label for="description">description</label>
                              <textarea class="form-control" name="description" v-model="description" id="description"></textarea>
                            </div>

                            <div class="form-group">
                              <label for="image">Image Upload</label>
                              <div class="input-group">

                                <div class="custom-file">
                                  <input type="file" multiple @change="onImageChange($event)" class="custom-file-input" name="image" id="image">
                                  <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                <div class="input-group-append">
                                   <img v-show="image != ''" :src="image" style="padding:10px" class="img-responsive" height="80" width="70">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                            <button type="button" @click="editMod ? updateProduct() : saveProduct()" class="btn btn-primary">Save</button>
                          </div>
                        </form>
                    </div>            
                </div>
            </div>

             <div class="modal fade" id="CustomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered"  role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Add Custom Feild</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form role="form"   method="post" >
                          <input type="hidden" name="_method" :value="method">
                          <div class="card-body">
                            <div class="form-group">
                              <label for="field">field name</label>
                              <input type="text" v-model="field" class="form-control" field="field" id="field" placeholder="Enter field">
                            </div>
      
                            <div class="form-group">
                              <label for="description">field description</label>
                              <textarea class="form-control" placeholder="enter feild description" name="description" v-model="f_description" id="description"></textarea>
                            </div>

                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                            <button type="button" @click="saveCustomFeild()" class="btn btn-primary">Save</button>
                          </div>
                        </form>
                    </div>            
                </div>
            </div>
  </div>
  <!-- /.content -->
             
</template>

<script>
export default {
  data(){
    return {
      name:'',
      code:'',
      image:'',
      price:'',
      description:'',
      action:'',
      method:'',
      products:[],
      proObj:{},
      editMod: false,
      field:'',
      f_description:'',
      product_id:'',
      errors: [],
    }
  },
  created() {    
    this.getResults();
  },
  methods:{
    addProduct(){
          this.editMod = false;
          this.action = "/api/products";
          this.method = 'post';
          this.name = '';
          this.code = '';
          this.image = '';
          this.price = '';
          this.description = '';
          $('#ArtModal').modal('show');
    },
    saveProduct(){
          axios.post('/api/products' , { name:this.name , image:this.image , code:this.code , price:this.price , description:this.description})
          .then((res) => {
          this.errors = [];
            this.products.push(res.data)
            $('#ArtModal').modal('hide');
          })
          .catch((err) => {
                if (err.response.status = 422) {
                    $.each(err.response.data.errors, function(key, value) {
                      alert(value);
                    });
                }
             })
    },
    editProduct(product){
        this.editMod = true;
        this.action = "/api/products/"+product.id;
        this.method = 'put';
        this.name = product.name;
        this.code = product.code;
        this.image = product.image;
        this.price = product.price;
        this.description = product.description;        
        $('#ArtModal').modal('show');
    },
    updateProduct(){
          axios.put(this.action , { name:this.name , image:this.image , code:this.code , price:this.price , description:this.description})
          .then((res) => {
            this.getResults()
            $('#ArtModal').modal('hide');
          })
          .catch((err) => {
                if (err.response.status = 422) {
                                    $.each(err.response.data.errors, function(key, value) {
                                      alert(value);
                                    });
                                }
                 })
    },
    deleteProduct(product){
      axios.delete("/api/products/"+product.id )
      .then((res) => {
        this.getResults();
      })
      .catch((err) => {
        if (err.response.status = 422) {
                    $.each(err.response.data.errors, function(key, value) {
                      alert(value);
                    });
                }
      })
    },
    getResults(page = 1){
      axios.get("api/products?page="+page).then(response=>{
          this.products = response.data.data;
          this.proObj = response;
      }).catch(err => {
        if (err.response.status = 422) {
                    $.each(err.response.data.errors, function(key, value) {
                      alert(value);
                    });
                }
      })
    },
    addCustomFeild(product){
          this.action = "/api/custom";
          this.method = 'post';
          this.field = '';
          this.f_description = '';
          this.product_id = product.id;
          $('#CustomModal').modal('show'); 
    },
    saveCustomFeild(){
      axios.post('/api/custom' , { field:this.field , description: this.f_description , product_id:this.product_id})
      .then(res => {
        this.field = '';
        this.f_description = '';
      })
      .catch(err => {
if (err.response.status = 422) {
                    $.each(err.response.data.errors, function(key, value) {
                      alert(value);
                    });
                }      })
    },
    onImageChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        this.createImage(files[0]);
    },
    createImage(file) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
            vm.image = e.target.result;
        };
        reader.readAsDataURL(file);
    }
  }
};
</script>
