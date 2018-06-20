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
     <button class="btn btn-primary pull-right btn-sm" @click="addNewClient">Add New</button>
    </template>
      <template slot="client_logo" slot-scope="row"><img :src="'/storage'+row.value" class="img-responsive" style="min-height:35px;max-height:35px;width:80%"></template>
      <template slot="edit" slot-scope="row"><button @click.stop="info(row.item)" class="btn btn-info btn-sm" >Edit</button></template>
      <template slot="delete" slot-scope="row"><button  @click.stop="deleteClient(row.item)" class="btn btn-danger btn-sm" >Delete</button></template>

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
          <h4 class="modal-title" v-if="modalInfo.save === 'update'">Edit Client</h4>
          <h4 class="modal-title" v-else>Add Client</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" v-model="modalInfo.client_name">
          </div>
          <div class="form-group">
            <label>Contact No:</label>
            <input class="form-control" v-model="modalInfo.client_contact_no">
          </div>
          <div class="form-group">
            <label>Address:</label>
            <textarea class="form-control" v-model="modalInfo.client_address"></textarea>
          </div>
          <div class="form-group "  >  
             <label>Logo:</label> 
            <img class="card-img-top img-responsive "  v-bind:id="'cl'+modalInfo.id" :src="'/storage'+modalInfo.client_logo" alt="Card image cap"  style="min-height:35px;max-height:35px;width:40%">
            <div class="card-body">
                  <h5 class="card-title" style="margin-left:5px;">Source: {{modalInfo.client_logo}}</h5>
                  <input type="hidden" id="cid" cid="cid"  v-model="modalInfo.id">
                  <input type="file" style="margin-left:5px;margin-bottom:5px;" name="image" v-on:change="getImage" accept="image/*" @click="passId(modalInfo.id)">
                  <a href="#" aria-disabled="" v-bind:id="'cancelUpload'+modalInfo.id" @click.prevent="cancelUpload(modalInfo)" class="btn btn-default"  style="margin-left:5px;margin-bottom:5px;">Cancel</a>
                  <input type="submit" disabled v-bind:id="'submitUpload'+modalInfo.id" class="btn btn-success" value="Upload" style="">
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
          <button type="button" class="btn btn-success" data-dismiss="modal" @click.stop="saveClient">Save</button>
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
        { key: "client_logo", label: "Logo" },
        { key: "client_name", label: "Name" },
        { key: "client_contact_no", label: "Contact no" },
        { key: "client_address", label: "Address" },
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
      modalInfo: { id: "", client_name: "", client_contact_no: "", client_address: "",client_logo: '', save: "add" }
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
      let clients = [];
      var data = JSON.parse(this.resource);
      var error = JSON.parse(this.resource_errors);
      let error1 = {
        error_message: data.error
      };
      this.errors = error1;
      data.forEach(client => {
        let cl = {
          id: client.id,
          client_name : client.client_name,
          client_contact_no : client.client_contact_no,
          client_address : client.client_address,
          client_logo : client.client_logo,
          client_file : ''
        };
      
      clients.push(cl);
      });
      this.items = clients;
      // console.log(JSON.stringify(services));
    },
    edit(item) {},
    addNewClient() {
      this.modalInfo.id = '';
      this.modalInfo.client_name = '';
      this.modalInfo.client_contact_no = '';
      this.modalInfo.client_address = '';
      this.modalInfo.client_logo = '/images/clients/blank.png';
      this.modalInfo.save = "add";
      $("#myModal").modal();
    },
    info(item) {
      this.modalInfo.save = "update";
      this.modalInfo.id = item.id;
      this.modalInfo.client_name = item.client_name;
      this.modalInfo.client_contact_no = item.client_contact_no;
      this.modalInfo.client_address = item.client_address;
      this.modalInfo.client_logo = item.client_logo;
      $("#myModal").modal();
    },
    saveClient() {
      let config = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*",
          "Content-Type": "multipart/form-data" 
        }
      };
      let myData = JSON.stringify({
        client_name: this.modalInfo.client_name,
        client_contact_no: this.modalInfo.client_contact_no,
        client_address: this.modalInfo.client_address,
        client_logo: '/images/clients/blank.png',
        client_file: this.modalInfo.client_file
      });
      let bodyFormData = new FormData();
      bodyFormData.append("data", myData);
      bodyFormData.append("client_file", this.modalInfo.client_file);
      
      if (this.modalInfo.save === "add") {
        var vm = this;
        axios
          .post("/api/settings-clients-add", bodyFormData, config)
          .then(function(response) {
            console.log(response.data);
            vm.showAlert("Service successfully added!", 1);
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
            "/api/settings-clients-update/" + this.modalInfo.id,
            bodyFormData,
            config
          )
          .then(function(response) {
            vm.showAlert("Service successfully updated!", 1);
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
    deleteClient(item) {
      var vm = this;
      let config = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*"
        }
      };
      if(confirm("Are you sure you want to continue?")){
        axios
        .delete("/api/settings-clients-delete/" + item.id, {}, config)
        .then(function(response) {
            vm.showAlert("Service successfully deleted!", 1);
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
        
        this.modalInfo.client_file = image;
        document.getElementById("cl" + this.modalInfo.id).src = e.target.result;
        document.getElementById("submitUpload" + this.modalInfo.id).disabled = false;
        document.getElementById("cancelUpload" + this.modalInfo.id).disabled = false;
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
