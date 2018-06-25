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
     <button class="btn btn-primary pull-right btn-sm" @click="addNewTestimonial">Add New</button>
    </template>
      <template slot="photo" slot-scope="row"><img :src="'/storage'+row.value" class="img-responsive" style="min-height:35px;max-height:35px;"></template>
      
      <template slot="edit" slot-scope="row"><button @click.stop="info(row.item)" class="btn btn-info btn-sm" >Edit</button></template>
      <template slot="delete" slot-scope="row"><button  @click.stop="deleteTestimonial(row.item)" class="btn btn-danger btn-sm" >Delete</button></template>
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
          <h4 class="modal-title" v-if="modalInfo.save === 'update'">Edit Testimonial</h4>
          <h4 class="modal-title" v-else>Add Testimonial</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" v-model="modalInfo.name">
          </div>
           <div class="form-group">
            <label>Company</label>
            <input class="form-control" v-model="modalInfo.company">
          </div>
          <div class="form-group">
            <label>Designation</label>
            <input class="form-control" v-model="modalInfo.designation">
          </div>
          <div class="form-group">
            <label>Message:</label>
            <textarea class="form-control" v-model="modalInfo.message"></textarea>
          </div>


          <div class="form-group "  >  
             <label>Image:</label> 
            <img class="card-img-top img-responsive "  v-bind:id="'cl'+modalInfo.id" :src="'/storage'+modalInfo.photo" alt="Card image cap"  style="min-height:35px;max-height:35px;width:40%">
            <div class="card-body">
                  <h5 class="card-title" style="margin-left:5px;">Source: {{modalInfo.photo}}</h5>
                  <input type="hidden" id="cid" cid="cid"  v-model="modalInfo.id">
                  <input type="file" style="margin-left:5px;margin-bottom:5px;" name="image" v-on:change="getImage" accept="image/*" @click="passId(modalInfo.id)">
                  <!-- <a href="#" aria-di  sabled="" v-bind:id="'cancelUpload'+modalInfo.id" @click.prevent="cancelUpload(modalInfo)" class="btn btn-default"  style="margin-left:5px;margin-bottom:5px;">Cancel</a> -->
                  <!-- <input type="submit" disabled v-bind:id="'submitUpload'+modalInfo.id" class="btn btn-success" value="Upload" style=""> -->
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
          <button type="button" class="btn btn-success" data-dismiss="modal" @click.stop="saveTestimonial">Save</button>
        </div>
        </div> 
      </div>
    </div>
  </b-container>
</template>

<script>
const items = [];
export default {
  props: ["resource","resource_errors"],
  data() {
    return {
      items: [],
      errors: {},
      fields: [
        { key: "id", label: "Id" },
        { key: "photo", label: "Image" },
        { key: "name", label: "Name" },
        { key: "company", label: "Company" },
        { key: "designation", label: "Designation" },
        { key: "message", label: "Message" },
        { key: "edit", label: "" },
        { key: "delete", label: "" }
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
          name: "", 
          company: "", 
          designation: "",
          message: "",
          photo:  '/images/testimonials/blank.png', 
          save: "add" }
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
      let testimonials = [];
      var data = JSON.parse(this.resource);
      var error = JSON.parse(this.resource_errors);
      let error1 = {
        error_message: data.error
      };
      this.errors = error1;
      data.forEach(testimonial => {
        let cl = {
          id: testimonial.id,
          name : testimonial.name,
          company : testimonial.company,
          designation : testimonial.designation,
          message : testimonial.message,
          photo : testimonial.photo,
          testimonial_file : ''
        };
      
      testimonials.push(cl);
      });
      this.items = testimonials;
      // console.log(JSON.stringify(services));
    },
    edit(item) {},
    addNewTestimonial() {
      this.modalInfo.id = '';
      this.modalInfo.name = '';
      this.modalInfo.company = '';
      this.modalInfo.designation = '';
      this.modalInfo.message = '';
      this.modalInfo.photo = '/images/testimonials/blank.png';
      this.modalInfo.save = "add";
      $("#myModal").modal();
    },
    info(item) {
      this.modalInfo.save = "update";
      this.modalInfo.id = item.id;
      this.modalInfo.name = item.name;
      this.modalInfo.company = item.company;
      this.modalInfo.designation = item.designation;
      this.modalInfo.message = item.message;
      this.modalInfo.photo = item.photo;
      $("#myModal").modal();
    },
    saveTestimonial() {
      let config = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*",
          "Content-Type": "multipart/form-data" 
        }
      };
      let myData = JSON.stringify({
        id: this.modalInfo.id,
        name: this.modalInfo.name,
        company: this.modalInfo.company,
        designation: this.modalInfo.designation,
        message: this.modalInfo.message,
        photo: '/images/testimonials/blank.png',
        testimonial_file: this.modalInfo.testimonial_file
      });
      let bodyFormData = new FormData();
      bodyFormData.append("data", myData);
      bodyFormData.append("testimonial_file", this. modalInfo.testimonial_file);
      if (this.modalInfo.save === "add") {
        var vm = this;
        axios
          .post("/api/settings-testimonials-add", bodyFormData, config)
          .then(function(response) {
            // console.log(response.data);
            vm.showAlert("Testimonial successfully added!", 1);
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
            "/api/settings-testimonials-update/" + this.modalInfo.id,
            bodyFormData,
            config
          )
          .then(function(response) {
           
            vm.showAlert("Testimonial successfully updated!", 1);
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
    deleteTestimonial(item) {
      var vm = this;
      let config = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*"
        }
      };
      if(confirm("Are you sure you want to continue?")){
        axios
        .delete("/api/settings-testimonials-delete/" + item.id, {}, config)
        .then(function(response) {
            vm.showAlert("Testimonial successfully deleted!", 1);
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
        
        this.modalInfo.testimonial_file = image;
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
