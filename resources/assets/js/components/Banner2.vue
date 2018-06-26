<template>
<div>
<div v-for="banner in banners" v-bind:key="banner.id" >
<form @submit.prevent="processForm(banner)" enctype="multipart/form-data" method="post"> 
        <div class="col-md-4 "  >    
            <div class="card " style="border: 1px solid;">
            <img class="card-img-top img-responsive "  v-bind:id="'im'+banner.id" :src="'/storage'+banner.banner_img" alt="Card image cap" style="min-height:200px;max-height:200px;min-width:100%;">
            <div class="card-body">
                  <h5 class="card-title" style="margin-left:5px;">Banner: {{banner.banner_img}}</h5>
                  <input type="hidden" id="bid" name="bid"  v-model="banner.id">
                  <input type="file" style="margin-left:5px;margin-bottom:5px;" name="image" v-on:change="getImage" accept="image/*" @click="passId(banner.id)">
                  <a href="#" aria-disabled="" v-bind:id="'cancelUpload'+banner.id" @click.prevent="cancelUpload(banner)" class="btn btn-default"  style="margin-left:5px;margin-bottom:5px;">Cancel</a>
                  <input type="submit" disabled v-bind:id="'submitUpload'+banner.id" class="btn btn-success" value="Upload" style="">
                </div>
                <div class="card-footer">
                  <small class="text-muted">
                    <div v-for="error in errors"  v-bind:key="error">
                        <span class="text-danger">{{error}}</span>
                    </div>  
                  </small>
                </div>  
            </div> 
            <br>
        </div>
  </form>
  </div>
</div>
</template>
<script>
export default {
  props: ["resource", "resource_errors"],
  data() {
    return {
      banners: {},
      errors: {},
      banner: {
        id: "",
        banner_img: "",
        banner_file:''
      }
      
    };
  },
  created() {
    this.setValues();
   
  },
  computed: {
    upload: function() {}
  },
  methods: {
    setValues() {
      var data = JSON.parse(this.resource);
      var error = JSON.parse(this.resource_errors);
      let error1 = {
        error_message: data.error
      };
      this.errors = error1;
      this.banners = data;
    },
    getImage(e) {
      let image = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = e => {
        this.banner.banner_img = e.target.result;
        this.banner.banner_file = image;
        document.getElementById("im" + this.banner.id).src = e.target.result;
        document.getElementById("submitUpload" + this.banner.id).disabled = false;
        document.getElementById("cancelUpload" + this.banner.id).disabled = false;
      };
    },
    passId(id) {
      this.banner.id = id;
    },
    uploadImage() {
      let data = {
        image: this.banner.banner_img
      };
    },
    cancelUpload(banner) {
      document.getElementById("im" + this.banner.id).src = '/storage'+banner.banner_img;
      this.loaded=false;
      
    },
 
    processForm: function(banner) {
      let bodyFormData = new FormData();
      
      bodyFormData.append("image", this.banner.banner_file);
      bodyFormData.append("banner_id", this.banner.id);
      bodyFormData.append("_token", myToken.csrfToken);

      let headers = {
        // 'X-CSRF-Token': $('meta[name=_token]').attr('content'),
      };
      var vm = this;
      axios({
        method: "post",
        url: "/upload",
        data: bodyFormData,
        config: { headers: { "Content-Type": "multipart/form-data" } }
      })
        .then(function(response) {
          vm.showAlert('Photo successfully added!',1);
          setTimeout(function(){
             window.location.reload(true);
          }, 2000);
          
        })
        .catch(function(response) {
          console.log(response);
          vm.showAlert('Failed to add photo',0);
          setTimeout(function(){
              window.location.reload(true);
          }, 2000);
        });
    },
    showAlert(message,status){
      if(status==1){
        this.$toasted.show(message,{type:'success'});
      }else if(status==0){
        this.$toasted.show(message,{type:'error'});
      }else{
        this.$toasted.show(message,{type:'info'});
      }
      
    },
  }
};
</script>