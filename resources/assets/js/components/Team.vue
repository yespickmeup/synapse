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
     <button class="btn btn-primary pull-right btn-sm" @click="addNewTeamMember">Add New</button>
    </template>
      <template slot="photo" slot-scope="row"><img :src="'/storage'+row.value" class="img-responsive" style="min-height:100px;max-height:100px;min-width:100px;max-width:100px;"></template>
      <template slot="socials" slot-scope="row">
        
        <a :href="row.item.socials.twitter_account" target="_blank"><i class="fa fa-twitter"></i> {{row.item.socials.twitter_account}}</a><br>
        <a :href="row.item.socials.facebook_account" target="_blank"><i class="fa fa-facebook"></i> {{row.item.socials.facebook_account}}</a><br>
        <a :href="row.item.socials.google_account" target="_blank"><i class="fa fa-google-plus"> {{row.item.socials.google_account}}</i></a><br>
        <a :href="row.item.socials.linkedin_account" target="_blank"><i class="fa fa-linkedin"></i> {{row.item.socials.linkedin_account}}</a>
      </template>
      <template slot="edit" slot-scope="row"><button @click.stop="info(row.item)" class="btn btn-info btn-sm" >Edit</button></template>
      <template slot="delete" slot-scope="row"><button  @click.stop="deleteTeamMember(row.item)" class="btn btn-danger btn-sm" >Delete</button></template>
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
          <h4 class="modal-title" v-if="modalInfo.save === 'update'">Edit Team Member</h4>
          <h4 class="modal-title" v-else>Add Team Member</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" v-model="modalInfo.name">
          </div>
          <div class="form-group">
            <label>Designation</label>
            <input class="form-control" v-model="modalInfo.designation">
          </div>
           <div class="form-group">
            <label>Socials</label>
            <br>Twitter:<input class="form-control" v-model="modalInfo.twitter_account">
            Facebook:<input class="form-control" v-model="modalInfo.facebook_account">
            Google+:<input class="form-control" v-model="modalInfo.google_account">
            Linkedin:<input class="form-control" v-model="modalInfo.linkedin_account">
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
          <button type="button" class="btn btn-success" data-dismiss="modal" @click.stop="saveTeamMember">Save</button>
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
        { key: "photo", label: "Photo" },
        { key: "name", label: "Name" },
        { key: "designation", label: "Designation" },
        { key: "socials", label: "Socials" },
        { key: "edit", label: "",thStyle: {width: '60px'} },
        { key: "delete", label: "",thStyle: {width: '60px'} }
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
          designation: "",
          twitter_account: "",
          facebook_account: "", 
          google_account: "", 
          linkedin_account: "", 
          photo:  '/images/team/blank.png', 
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
      let team_members = [];
      var data = JSON.parse(this.resource);
      var error = JSON.parse(this.resource_errors);
      let error1 = {
        error_message: data.error
      };
      this.errors = error1;
      data.forEach(team_member => {
        let cl = {
          id: team_member.id,
          name : team_member.name,
          designation : team_member.designation,
          twitter_account : team_member.twitter_account,
          facebook_account : team_member.facebook_account,
          google_account : team_member.google_account,
          linkedin_account : team_member.linkedin_account,
          socials: {
              twitter_account: team_member.twitter_account,
              facebook_account: team_member.facebook_account,
              google_account: team_member.google_account,
              linkedin_account: team_member.linkedin_account
          },
          photo : team_member.photo,
          team_file : ''
        };
      
      team_members.push(cl);
      });
      this.items = team_members;
      // console.log(JSON.stringify(services));
    },
    edit(item) {},
    addNewTeamMember() {
      this.modalInfo.id = '';
      this.modalInfo.name = '';
      this.modalInfo.designation = '';
      this.modalInfo.twitter_account = '';
      this.modalInfo.facebook_account = '';
      this.modalInfo.google_account = '';      
      this.modalInfo.linkedin_account = '';
      this.modalInfo.photo = '/images/team/blank.png';
      this.modalInfo.save = "add";
      $("#myModal").modal();
    },
    info(item) {
      this.modalInfo.save = "update";
      this.modalInfo.id = item.id;
      this.modalInfo.name = item.name;
      this.modalInfo.designation = item.designation;
      this.modalInfo.twitter_account = item.twitter_account;
      this.modalInfo.facebook_account = item.facebook_account;
      this.modalInfo.google_account = item.google_account;
      this.modalInfo.linkedin_account = item.linkedin_account;
      this.modalInfo.photo = item.photo;
      $("#myModal").modal();
    },
    saveTeamMember() {
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
        designation: this.modalInfo.designation,
        twitter_account: this.modalInfo.twitter_account,
        facebook_account: this.modalInfo.facebook_account,
        google_account: this.modalInfo.google_account,
        linkedin_account: this.modalInfo.linkedin_account,
        photo: '/images/team/blank.png',
        team_file: this.modalInfo.team_file
      });
      let bodyFormData = new FormData();
      bodyFormData.append("data", myData);
      bodyFormData.append("team_file", this. modalInfo.team_file);
      if (this.modalInfo.save === "add") {
        var vm = this;
        axios
          .post("/api/settings-teamMember-add", bodyFormData, config)
          .then(function(response) {
            console.log(response.data);
            vm.showAlert("Team Member successfully added!", 1);
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
            "/api/settings-teamMember-update/" + this.modalInfo.id,
            bodyFormData,
            config
          )
          .then(function(response) {
           
            vm.showAlert("Team Member successfully updated!", 1);
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
    deleteTeamMember(item) {
      var vm = this;
      let config = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*"
        }
      };
      if(confirm("Are you sure you want to continue?")){
        axios
        .delete("/api/settings-teamMember-delete/" + item.id, {}, config)
        .then(function(response) {
            vm.showAlert("Team Member successfully deleted!", 1);
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
        
        this.modalInfo.team_file = image;
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
