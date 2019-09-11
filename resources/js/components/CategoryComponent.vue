<template>
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-8" style="margin-left:15%">
          <div class="card" style="text-align:center">
          <div class="card-header">
            <h1>All Categories</h1>
          </div>
          <div class="row">
              <div class="info-box-content col-lg-4" v-for="(cat,index) in categories" :key="index">
                <button @click="getAllArticles(cat)" class="btn btn-warning">
                <span class="info-box-text">{{cat.name}}</span>
                <span class="info-box-number">41,410</span>
                </button>
              </div>
          </div>

          </div>
            <pagination :data="categoriesObj" @pagination-change-page="getResults"></pagination>
          
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>
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
                       
                        <div class="card" style="text-align:center" v-for="(post , key) in posts" :key="key">
                          <div class="card-header">
                            <h3 class="card-title" >{{post.title}}</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <img class="img-fluid pad" :src="`storage/${post.image}`" alt="Photo">
                              <p>{{post.content}}</p>
                          </div>
                          <!-- /.card-body -->
                            
                        </div>
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
      categories:{},
      categoriesObj:{},
      posts:{}
    }
  },
  mounted() {
    this.getResults();
  },
  methods:{
    getCategories(){
      axios.get('/api/categories')
      .then( (res) => {
              // console.log(res.data);
              this.categories = res.data.data;
      })
      .catch(()=>{ });
    },
    getResults(page = 1){
      axios.get("api/categories?page="+page).then(response=>{
          this.categories = response.data.data;
          this.categoriesObj = response.data;
      });
    },
    getAllArticles(cat){

      axios.get("api/posts/"+cat.id)
      .then((res) => {
        this.posts = res.data;
        $('#ArtModal').modal('show');
      });
    }
  }
};
</script>
