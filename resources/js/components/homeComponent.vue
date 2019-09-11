<template>
  <!-- Main content -->
  <div class="content">
    <button href="#" @click="addPost()"  v-show="posts == ''" class="btn btn-default" style="margin-left:45%"> Add New Article</button>
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-8" style="margin-left:15%">
          <div class="card" style="text-align:center" v-for="(post , key) in posts" :key="key">
            <div class="card-header">
              <h3 class="card-title" >{{post.title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <img class="img-fluid pad" :src="`storage/${post.image}`" alt="Photo">
                <p>{{post.content}}</p>
                <h4>{{post.categories.name}}</h4>
                <div v-if="user_id != ''">
                  <a href="#" @click="addPost()" class="btn btn-default btn-sm"><i class="fa fa-share"></i> Add</a>
                  <a href="#" @click="editPost(post)" class="btn btn-default btn-sm"><i class="fa fa-share"></i> Edit</a>
                  <a href="#" @click="deletePost(post)" class="btn btn-default btn-sm"><i class="fa fa-thumbs-o-up"></i> Delete</a>
                </div>
            </div>
            <!-- /.card-body -->
               
          </div>
                <pagination :data="postsObj.data" @pagination-change-page="getResults"></pagination>
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
                          <input type="hidden" name="user_id" :value="user_id">
                          <div class="card-body">
                            <div class="form-group">
                              <label for="title">title</label>
                              <input type="text" v-model="title" class="form-control" name="title" id="title" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                              <label for="content">content</label>
                              <input type="text" v-model="content" class="form-control" name="content" id="content" placeholder="Enter content">
                            </div>
                            <div class="form-group">
                              <label for="image">Image Upload</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="image" id="image">
                                  <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                <div class="input-group-append">
                                  <span class="input-group-text" id="">Upload</span>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="content">Category</label>
                              <select class="form-control" name="category_id">
                                <option>select-category</option>
                                <option  v-for="(cat , index) in categories" :key="index" :value="`${cat.id}`">
                                  {{ cat.name}}
                                </option>
                              </select>
                            </div>
                          </div>

                          <!-- /.card-body -->

                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
      user_id:$("meta[name='user']").attr('content'),
      title:'',
      content:'',
      image:'',
      category_id:'',
      action:'',
      method:'',
      posts:[],
      postsObj:{},
      categories:{},
      editMod: false
    }
  },
  mounted() {
    console.log(this.user_id);
    
    this.getResults();
    this.getCategories();    
  },
  methods:{
    getCategories(){
      axios.get('/api/categories')
      .then( (res) => {
              console.log(res.data);
              this.categories = res.data.data;
      })
      .catch(()=>{ });
    },
    getPosts(){
      axios.get('/api/posts')
      .then( (res) => {
              this.posts = res.data.data;
              this.postsObj = res;
      })
      .catch(()=>{ });
    },
    addPost(){
          this.editMod = false;
          this.action = "/api/posts";
          this.method = 'post';
          this.title = '';
          this.content = '';
          this.image = '';
          this.category_id = '';
          $('#ArtModal').modal('show');
    },
    editPost(post){
        this.editMod = true;
        this.action = "/api/posts/"+post.id;
        this.method = 'put';
        this.title = post.title;
        this.content = post.content;
        this.image = post.image;
        this.category_id = post.category_id;
        console.log(this.category_id);
        
        $('#ArtModal').modal('show');
    },
    deletePost(post){
      axios.post("api/posts/"+post.id , { _method : 'delete'})
      .then((res) => {
        this.getResults();
      })
      .catch((res) => {})
    },
    getResults(page = 1){
      axios.get("api/posts?page="+page).then(response=>{
          this.posts = response.data.data;
          this.postsObj = response;
      });
    }
  }
};
</script>
