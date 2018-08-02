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
    <b-form-group label="Plain inline radios">
      <b-form-radio-group v-model="selected" :options="options" plain name="plainInline" horizontal />
    </b-form-group>
    </template>
      <template slot="edit" slot-scope="row"><button @click.stop="viewMessage(row.item)" class="btn btn-info btn-sm" >View</button></template>
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
          <h4 class="modal-title" >Message</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" v-model="modalInfo.name">
          </div>
          <div class="form-group">
            <label>Email:</label>
            <input class="form-control" v-model="modalInfo.email">
          </div>
           <div class="form-group">
            <label>Subject:</label>
            <input class="form-control" v-model="modalInfo.subject">
          </div>
          <label>Message:</label>
          <div class="form-group">
            
            <textarea  id="" cols="78" rows="10" v-model="modalInfo.message"></textarea>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" @click.stop="markAsRead">Mark as Read</button>
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
        { key: "id", label: "Id" },
        { key: "created_at", label: "Date" },
        { key: "name", label: "Name" },
        { key: "email", label: "Email" },
        { key: "subject", label: "Subject" },
        { key: "message", label: "Message" },
        { key: "edit", label: "", thStyle: { width: "60px" } }
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
        created_at: "",
        name: "",
        email: "",
        subject: "",
        message: "",
      },
      options: [
        { text: 'All', value: 'status_all' },
        { text: 'Unread', value: 'status_unread' },
        { text: 'Read', value: 'status_read' }
      ],
      selected: 'status_unread',
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
      let messages = [];
      var data = JSON.parse(this.resource);
      var error = JSON.parse(this.resource_errors);
      let error1 = {
        error_message: data.error
      };
      this.errors = error1;
      data.forEach(message => {
        let cl = {
          id: message.id,
          created_at: message.created_at,
          name: message.name,
          email: message.email,
          subject: message.subject,
          message: message.message
        };

        messages.push(cl);
      });
      this.items = messages;
      // console.log(JSON.stringify(services));
    },
    edit(item) {},
    viewMessage(item) {
      this.modalInfo.id = item.id;
      this.modalInfo.created_at = item.created_at;
      this.modalInfo.name = item.name;
      this.modalInfo.email = item.email;
      this.modalInfo.subject = item.subject;
      this.modalInfo.message = item.message;
      $("#myModal").modal();
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  }
};
</script>
