<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a
              class="nav-item nav-link active"
              id="nav-profile-tab"
              data-toggle="tab"
              href="#nav-profile"
              role="tab"
              aria-controls="nav-profile"
              aria-selected="false"
            >Profile</a>
            <a
              class="nav-item nav-link"
              id="nav-stockexchange-tab"
              data-toggle="tab"
              href="#nav-stockexchange"
              role="tab"
              aria-controls="nav-stockexchange"
              aria-selected="false"
            >Stock Exchanges</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div
            class="tab-pane fade active show"
            id="nav-profile"
            role="tabpanel"
            aria-labelledby="nav-profile-tab"
          >
            <table class="table table-bordered">
              <tbody>
                <tr class v-for="(data, key) in getObject" :key="data">
                  <td>{{capitalizeFirstLetter(key)}}</td>
                  <td>{{data}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div
            class="tab-pane fade"
            id="nav-stockexchange"
            role="tabpanel"
            aria-labelledby="nav-stockexchange-tab"
          >...</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  computed: {
    getObject: function() {
      var dummy = JSON.parse(
        this.user.substring(
          this.user.indexOf("{"),
          this.user.lastIndexOf("}") + 1
        )
      );
      console.log(dummy, typeof dummy);
      return dummy;
    }
  },
  methods: {
    capitalizeFirstLetter: function(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>

<style scoped>
.table {
  background: white;
}
</style>
