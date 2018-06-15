<template>

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
    }
  }
};
</script>