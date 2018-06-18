<template>
  
  <div>
    
    <label >Image:</label>
    <form @submit.prevent="processForm" enctype="multipart/form-data" method="post"> 
        <div class="form-group">
        <div class="col-md-4 "  >    
            <div class="card " style="border: 1px solid;">
            <img class="card-img-top img-responsive "  v-bind:id="'im'+setting.id" :src="'/storage'+setting.about_img" alt="Card image cap" style="min-height:200px;max-height:200px;min-width:100%;">
            <div class="card-body">
                  <h5 class="card-title" style="margin-left:5px;">Image: {{setting.about_img}}</h5>
                  <input type="hidden" id="bid" name="bid"  v-model="setting.id">
                  <input type="file" style="margin-left:5px;margin-bottom:5px;" name="image" v-on:change="getImage" accept="image/*" >
                  <a href="#" aria-disabled="" v-bind:id="'cancelUpload'+setting.id" @click.prevent="cancelUpload" class="btn btn-default"  style="margin-left:5px;margin-bottom:5px;">Cancel</a>
                  <input type="submit" disabled v-bind:id="'submitUpload'+setting.id" class="btn btn-success" value="Upload" style="">
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
        </div>
  </form>
  
 <div class="col-md-12">
  <div class="form-group">
        <label>Title:</label>
        <input class="form-control"  placeholder="Title" v-model="setting.about_title">
 
 </div>

    <label >Description:</label>
    <quill-editor v-model="content"
                    ref="myQuillEditor"
                    :options="editorOption"
                    @blur="onEditorBlur($event)"
                    @focus="onEditorFocus($event)"
                    @ready="onEditorReady($event)"
                    @change="onEditorChange($event)"
                    name="post"
                    id="post"
                    >
    </quill-editor>
    <br>
    <button class="btn btn-default" @click="cancelUpdate">Cancel</button>
    <button class="btn btn-success" @click="updateAbout">Update</button>

  </div>
 </div>
</template>

<script>
export default {
  props: ["resource", "resource_errors"],
  data() {
    return {
      content: "",
      setting: {
        id: "",
        about_img: "",
        about_file: ""
      },
      errors: {},
      editorOption: {
        // some quill options
      }
    };
  },
  created() {
    this.setValues();
  },
  methods: {
    setValues() {
      var data = JSON.parse(this.resource);
      this.setting = data;
      this.setting.id = data.id;
      this.setting.about_description = data.about_description;
      this.content = data.about_description;
      var error = JSON.parse(this.resource_errors);
      let error1 = {
        error_message: data.error
      };
      this.errors = error1;
    },
    getImage(e) {
      let image = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = e => {
        // this.setting.about_img = e.target.result;
        this.setting.about_file = image;
        document.getElementById("im" + this.setting.id).src = e.target.result;
        document.getElementById(
          "submitUpload" + this.setting.id
        ).disabled = false;
        document.getElementById(
          "cancelUpload" + this.setting.id
        ).disabled = false;
        document.getElementById(
          "cancelUpload" + this.setting.id
        ).disabled = false;
      };
    },
    cancelUpload() {
      document.getElementById("im" + this.setting.id).src =
        "/storage" + this.setting.about_img;
      this.loaded = false;
    },
    processForm: function() {
      let bodyFormData = new FormData();

      bodyFormData.append("image", this.setting.about_file);
      bodyFormData.append("setting_id", this.setting.id);
      bodyFormData.append("_token", myToken.csrfToken);
      
      let headers = {
        // 'X-CSRF-Token': $('meta[name=_token]').attr('content'),
      };
      var vm = this;
      axios({
        method: "post",
        url: "/upload-about",
        data: bodyFormData,
        config: { headers: { "Content-Type": "multipart/form-data" } }
      })
        .then(function(response) {
          vm.showAlert("Photo successfully added!", 1);
          setTimeout(function() {
            window.location.reload(true);
          }, 2000);
        })
        .catch(function(response) {
          vm.showAlert("Failed to add photo", 0);
          setTimeout(function() {
            window.location.reload(true);
          }, 2000);
        });
    },
    cancelUpdate() {
      var data = JSON.parse(this.resource);
      this.setting.about_title = data.about_title;
      this.content = data.about_description;
    },
    onEditorBlur(quill) {
      // console.log('editor blur!', quill)
    },
    onEditorFocus(quill) {
      // console.log('editor focus!', quill)
    },
    onEditorReady(quill, html, text) {
      // console.log('editor ready!', quill)
    },
    onEditorChange({ quill, html, text }) {
      // console.log('editor change!', quill, html, text)
      this.content = html;
    },
    updateAbout() {
      let myData = JSON.stringify({
        id: this.setting.id,
        about_title: this.setting.about_title,
        about_description: this.content
      });
      let config = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*"
        }
      };
      var vm = this;
      axios
        .post("/api/settings-update-about", myData, config)
        .then(function(response) {
          if (confirm("Are you sure you want to update?")) {
            vm.showAlert("Settings successfully updated!", 1);
            setTimeout(function() {
              window.location.reload(true);
            }, 2000);
          }
        })
        .catch(function(response) {
          console.log(response.data);
          vm.showAlert("Failed update", 0);
          setTimeout(function() {
            window.location.reload(true);
          }, 2000);
        });
    },
    showAlert(message, status) {
      if (status == 1) {
        this.$toasted.show(message, { type: "success" });
      } else if (status == 0) {
        this.$toasted.show(message, { type: "error" });
      } else {
        this.$toasted.show(message, { type: "info" });
      }
    }
  },

  computed: {
    editor() {
      return this.$refs.myQuillEditor.quill;
    }
  },
  mounted() {
    //   console.log('this is current quill instance object', this.editor)
  }
};
</script>

