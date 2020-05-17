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
              @click="getStockData"
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
          >
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th v-for="(data, key) in getStocks[0]" :key="key">{{key}}</th>
                  <th>total_money</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(data, key) in getStocks" :key="key">
                  <td>{{key+1}}</td>
                  <td v-for="(k,v) in data" :key="v.id">{{k}}</td>
                  <td>{{data['quantity'] * data['purchasing_price']}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["userid", "userdetails"],
  data() {
    return {
      stocks: null
    };
  },
  computed: {
    getObject: function() {
      var dummy = JSON.parse(
        this.userdetails.substring(
          this.userdetails.indexOf("{"),
          this.userdetails.lastIndexOf("}") + 1
        )
      );
      console.log(dummy, typeof dummy);
      return dummy;
    },
    getStocks: function() {
      if (!this.stocks) {
        console.log(this.userid);
        var url = "/api/stocks/" + this.userid;
        axios
          .get(url)
          .then(response => {
            console.log(response.data);
            this.stocks = response.data;
          })
          .catch(error => {
            console.log("Error");
          });
      }
      return this.stocks;
    }
  },
  methods: {
    capitalizeFirstLetter: function(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    },
    getStockData: function() {}
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
