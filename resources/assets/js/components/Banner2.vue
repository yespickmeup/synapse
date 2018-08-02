<template>
  <b-container fluid>    
    <!-- Main table element -->
    <b-table show-empty
             stacked="md"
             :items="items"
             :fields="fields"
             :current-page="currentPage"
             :per-page="perPage"
             :filter="filter"
             :sort-by.sync="sortBy"
             :sort-desc.sync="sortDesc"
             :sort-direction="sortDirection"
             @filtered="onFiltered"
             :bordered="true"
    >
    <template slot="table-caption">
     <button class="btn btn-primary pull-right btn-sm" @click="addNewBanner">Add New</button>
    </template>
      <template slot="banner_img" slot-scope="row"><img :src="'/storage'+row.value" class="img-responsive" style="min-height:100px;max-height:100px;min-width:100px;max-width:100px;"></template>
      <template slot="edit" slot-scope="row">&nbsp;&nbsp;<button @click.stop="info(row.item)" class="btn btn-info btn-sm" > Edit</button></template>
     <template slot="delete" slot-scope="row"> &nbsp;&nbsp;&nbsp;&nbsp;<button  @click.stop="deleteBanner(row.item)" class="btn btn-danger btn-sm" >Delete</button></template>
    </b-table>

    <b-row>
      <b-col md="6" class="my-1">
        <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
      </b-col>
    </b-row>

    <!-- Info modal -->
    
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" v-if="modalInfo.save === 'update'">Edit Banner</h4>
          <h4 class="modal-title" v-else>Add Banner</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label>Id: {{modalInfo.id}}</label>
          </div>
          <div class="form-group "  >  
             <label>Image:</label> 
            <img class="card-img-top img-responsive "  v-bind:id="'cl'+modalInfo.id" :src="'/storage'+modalInfo.banner_img" alt="Card image cap"  style="min-height:35px;max-height:35px;width:40%">
            <div class="card-body">
                  <h5 class="card-title" style="margin-left:5px;">Source: {{modalInfo.banner_img}}</h5>
                  <input type="hidden" id="cid" cid="cid"  v-model="modalInfo.id">
                  <input type="file" style="margin-left:5px;margin-bottom:5px;" name="image" v-on:change="getImage" accept="image/*" @click="passId(modalInfo.id)">
            </div>
            <div class="card-footer">
                  <small class="text-muted">
                    <div v-for="error in errors"  v-bind:key="error">
                        <span class="text-danger">{{error}}</span>
                    </div>  
                  </small>
            </div>  
          <br>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" @click.stop="saveBanner">Save</button>
        </div>
        </div> 
      </div>
    </div>
  </b-container>
</template>
<script>
const items = [];
export default {
  props: ["resource", "resource_errors"],
  data() {
    return {
      items: [],
      errors: {},
      fields: [
        { key: "id", label: "Id", thStyle: { width: "10px" } },
        { key: "banner_img", label: "Photo", thStyle: { width: "80%" } },
        { key: "edit", label: "", thStyle: { width: "10px" } },
        { key: "delete", label: "", thStyle: { width: "10px"} }
      ],
      currentPage: 1,
      perPage: 10,
      totalRows: items.length,
      pageOptions: [5, 10, 15],
      sortBy: null,
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      modalInfo: {
        id: "",
        banner_img: "/images/team/blank.png",
        save: "add"
      }
    };
  },
  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields.filter(f => f.sort).map(f => {
        return { text: f.label, value: f.key };
      });
    }
  },
  created() {
    this.setValues();
  },
  methods: {
    setValues() {
      let banners = [];
      var data = JSON.parse(this.resource);
      var error = JSON.parse(this.resource_errors);
      let error1 = {
        error_message: data.error
      };
      this.errors = error1;
      data.forEach(banner => {
        let cl = {
          id: banner.id,
          banner_img: banner.banner_img,
          banner_file: ""
        };

        banners.push(cl);
      });
      this.items = banners;
     
    },
    edit(item) {},
    addNewBanner() {
      this.modalInfo.id = "";
      this.modalInfo.banner_img = "/images/banners/blank.png";
      this.modalInfo.save = "add";
      $("#myModal").modal();
    },
    info(item) {
      this.modalInfo.save = "update";
      this.modalInfo.id = item.id;
      this.modalInfo.banner_img = item.banner_img;
      $("#myModal").modal();
    },
    saveBanner() {
      let config = {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      };
      let myData = JSON.stringify({
        id: this.modalInfo.id,
        banner_img: "/images/banners/blank.png",
        banner_file: this.modalInfo.banner_file
      });

      let bodyFormData = new FormData();
      bodyFormData.append("data", myData);
      bodyFormData.append("banner_file", this.modalInfo.banner_file);
      bodyFormData.append("_token", myToken.csrfToken);
      if (this.modalInfo.save === "add") {
        var vm = this;
        axios
          .post("/api/settings-banners-add", bodyFormData, config)
          .then(function(response) {
            // console.log(response.data);
            vm.showAlert("Banner successfully added!", 1);
            setTimeout(function() {
              window.location.reload(true);
            }, 2000);
          })
          .catch(function(response) {
            console.log(response);
            vm.showAlert("Failed add", 0);
            setTimeout(function() {
              window.location.reload(true);
            }, 2000);
          });

      } else {
        var vm = this;
        axios
          .post(
            "/api/settings-banners-update/" + this.modalInfo.id,
            bodyFormData,
            config
          )
          .then(function(response) {
            vm.showAlert("Banner successfully updated!", 1);
            setTimeout(function() {
              window.location.reload(true);
            }, 2000);
          })
          .catch(function(response) {
            console.log(response.data);
            vm.showAlert("Failed update", 0);
            setTimeout(function() {
              window.location.reload(true);
            }, 2000);
          });
      }
    },
    deleteBanner(item) {
      var vm = this;
      let config = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*"
        }
      };
      if (confirm("Are you sure you want to continue?")) {
        axios
          .delete("/api/settings-banners-delete/" + item.id, {}, config)
          .then(function(response) {
            vm.showAlert("Banner successfully deleted!", 1);
            setTimeout(function() {
              window.location.reload(true);
            }, 2000);
          })
          .catch(function(response) {
            console.log(response.data);
            vm.showAlert("Failed delete", 0);
            setTimeout(function() {
              window.location.reload(true);
            }, 2000);
          });
      }
    },
    getImage(e) {
      let image = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = e => {
        this.modalInfo.banner_file = image;
        document.getElementById("cl" + this.modalInfo.id).src = e.target.result;
        // document.getElementById("submitUpload" + this.modalInfo.id).disabled = false;
        // document.getElementById("cancelUpload" + this.modalInfo.id).disabled = false;
      };
    },
    passId(id) {
      this.modalInfo.id = id;
    },
    resetModal() {
      this.modalInfo.title = "";
      this.modalInfo.content = "";
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
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
  }
};
</script>