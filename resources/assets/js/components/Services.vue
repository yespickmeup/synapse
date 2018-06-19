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
     <button class="btn btn-primary pull-right btn-sm" @click="addNewService">Add New</button>
    </template>
      <template slot="icon" slot-scope="row"><i :class="'fa ' + row.value " style=" font-size: 25px;text-center"></i></template>
      <template slot="edit" slot-scope="row"><button @click.stop="info(row.item)" class="btn btn-info btn-sm" >Edit</button></template>
      <template slot="delete" slot-scope="row"><button  @click.stop="deleteService(row.item)" class="btn btn-danger btn-sm" >Delete</button></template>

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
          <h4 class="modal-title" v-if="modalInfo.save === 'update'">Edit Service</h4>
          <h4 class="modal-title" v-else>Add Service</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label>Title:</label>
            <input class="form-control" v-model="modalInfo.title">
          </div>
          <div class="form-group">
            <label>Description:</label>
            <textarea class="form-control" v-model="modalInfo.description"></textarea>
          </div>
          <div class="form-group">
            <label>Icon:</label>
            <i :class="'fa '+modalInfo.icon " style=" font-size: 25px;"></i>
            <input class="form-control" v-model="modalInfo.icon">
            <span><a href="http://astronautweb.co/snippet/font-awesome/" target="_blank">http://astronautweb.co/snippet/font-awesome/</a></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" @click.stop="saveService">Save</button>
        </div>
      </div>

    </div>
  </div>
  </b-container>
</template>

<script>
const items = [];
export default {
  props: ["resource"],
  data() {
    return {
      items: [],
      fields: [
        { key: "id", label: "Id" },
        { key: "icon", label: "Icon" },
        { key: "title", label: "Title" },
        { key: "description", label: "Descriptions" },
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
      modalInfo: { id: "", icon: "", title: "", description: "", save: "add" }
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
      let services = [];
      var data = JSON.parse(this.resource);
      data.forEach(service => {
        let se = {
          id: service.id,
          icon: service.icon,
          title: service.title,
          description: service.description
        };
        services.push(se);
      });
      this.items = services;
      // console.log(JSON.stringify(services));
    },
    edit(item) {},
    addNewService() {
      this.modalInfo.icon = "fa-bar-chart";
      this.modalInfo.save = "add";
      $("#myModal").modal();
    },
    info(item) {
      this.modalInfo.save = "update";
      this.modalInfo.id = item.id;
      this.modalInfo.icon = item.icon;
      this.modalInfo.title = item.title;
      this.modalInfo.description = item.description;
      $("#myModal").modal();
    },
    saveService() {
      let config = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*"
        }
      };
      let myData = JSON.stringify({
        icon: this.modalInfo.icon,
        title: this.modalInfo.title,
        description: this.modalInfo.description
      });
      if (this.modalInfo.save === "add") {
        var vm = this;
        axios
          .post("/api/settings-services-add", myData, config)
          .then(function(response) {
            vm.showAlert("Service successfully added!", 1);
            setTimeout(function() {
              window.location.reload(true);
            }, 2000);
          })
          .catch(function(response) {
            console.log(response.data);
            vm.showAlert("Failed add", 0);
            setTimeout(function() {
              window.location.reload(true);
            }, 2000);
          });
      } else {
        var vm = this;
        axios
          .post(
            "/api/settings-services-update/" + this.modalInfo.id,
            myData,
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
    deleteService(item) {
      var vm = this;
      let config = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*"
        }
      };
      if(confirm("Are you sure you want to continue?")){
        axios
        .delete("/api/settings-services-delete/" + item.id, {}, config)
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
