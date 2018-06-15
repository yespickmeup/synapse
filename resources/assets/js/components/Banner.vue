<template>  
        <div class="col-md-4" style="-webkit-box-sizing: border-box;box-sizing: border-box;" >    
            <div class="card mb-3" style="border: 1px solid;">
            <img class="card-img-top img-responsive" :src="banner.banner_img" alt="Card image cap" style="min-height:200px;max-height:200px;">
            <div class="card-body">
                  <h5 class="card-title">Banner {{banner.id}}</h5>
                  <input type="file" name="image" v-on:change="getImage" accept="image/*" >
                  <input type="hidden" v-model="banner.id" name="banner_id">
                  <a href="#" @click.prevent="cancelUpload" class="btn btn-default"  style="">Cancel</a>
                  <input type="submit" class="btn btn-success" value="Upload" style="">
                </div>
                <div class="card-footer">
                  <small class="text-muted">
                    <div v-for="error in errors"  v-bind:key="error">
                        <span class="text-danger">{{error}}</span>
                    </div>  
                  </small>
                </div>  
            </div> 
        </div>
</template>

<script>
export default {
  props: ["resource", "resource_errors"],
  data() {
    return {
      banner: {},
      errors: {}
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
      let banner = {
        id: data.id,
        banner_img: "storage" + data.banner_img
      };
      let error1 = {
        error_message: data.error
      };
      this.errors = error1;
      this.banner = banner;
    },
    getImage(e) {
      let image = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = e => {
        this.banner.banner_img = e.target.result;
      };
    },
    uploadImage() {
      let data = {
        image: this.banner.banner_img
      };
      axios
        .post("/upload", data)
        .then(function(response) {
          console.log(response.data);
        })
        .catch(function(error) {
          console.log(error);
          throw error;
        });
    },
    cancelUpload() {
      var data = JSON.parse(this.resource);
      this.banner.banner_img = "/storage" + data.banner_img;
    }
  }
};
</script>