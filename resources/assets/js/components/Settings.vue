<template>
        <form @submit.prevent="processForm" method="post">
            <div class="form-group">
                <label >Business Name: </label>
                <input class="form-control"  placeholder="Business Name" v-model="setting.business_name">
            </div>
            <div class="form-group">
                <label >Address: </label>
                <input class="form-control"  placeholder="Address" v-model="setting.address">
            </div>
            <div class="form-group">
                <label >Phone Number: </label>
                <input class="form-control"  placeholder="Phone Number" v-model="setting.phone_number">
            </div>
            <div class="form-group">
                <label >Email Address: </label>
                <input class="form-control"  placeholder="Email Address" v-model="setting.email">
            </div>
            <div class="form-group">
                <label >Slogan: </label>
                <input class="form-control"  placeholder="Slogan" v-model="setting.slogan">
            </div>
            <div class="form-group">
                <label >Call to Action: </label>
                <input class="form-control"  placeholder="Description" v-model="setting.call_to_action_description">
            </div>
            <div class="form-group">
                <label >Contact Us: </label>
                <input class="form-control"  placeholder="Description" v-model="setting.contact_us_description">
            </div>
            <button type="button" class="btn btn-default" @click="cancelUpdate">Cancel</button>
            <input type="submit" class="btn btn-success" value="Update">
        </form>
        
</template>

<script>
export default {
  props: ["resource"],
  data() {
    return {
      setting: {}
    };
  },
  created() {
    this.setValues();
  },
  methods: {
    setValues() {
      var data = JSON.parse(this.resource);

      let setting = {
        id: data.id,
        business_name: data.business_name,
        address: data.address,
        phone_number: data.phone_number,
        email: data.email,
        slogan: data.slogan,
        banner_img: data.banner_img,
        about_title: data.about_title,
        about_description: data.about_description,
        about_img: data.about_img,
        services_description: data.services_description,
        clients_description: data.clients_description,
        portfolio_description: data.portfolio_description,
        testimonials_description: data.testimonials_description,
        call_to_action_description: data.call_to_action_description,
        contact_us_description: data.contact_us_description
      };
      this.setting = setting;
    },
    cancelUpdate(){
      var data = JSON.parse(this.resource);
      this.setting.business_name = data.business_name;
      this.setting.address = data.address;
      this.setting.phone_number = data.phone_number;
      this.setting.email = data.email;
      this.setting.slogan = data.slogan;
      this.setting.call_to_action_description = data.call_to_action_description;
      this.setting.contact_us_description = data.contact_us_description;
    },
    processForm() {
     
      let myData=JSON.stringify({
          id:this.setting.id,
          business_name:this.setting.business_name,
          address:this.setting.address,
          phone_number:this.setting.phone_number,
          email:this.setting.email,
          slogan:this.setting.slogan,
          call_to_action_description:this.setting.call_to_action_description,
          contact_us_description:this.setting.contact_us_description
      });
      let config ={ 
          headers: { 
          'Content-Type': 'application/json;charset=UTF-8',
          "Access-Control-Allow-Origin": "*",
          } 
      };
      var vm = this;
      axios.post('/api/settings-update',myData,config)
        .then(function(response) {
          if(confirm("Are you sure you want to update?")){
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
  }
};
</script>