<template>
  <div class="container">
    <div>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" style="height:400px">
          <div class="carousel-item active">
            <img class="img-fluid" src="news.jpg" alt="News articles" />
          </div>
          <div class="carousel-item">
            <img class="img-fluid" src="news.jpg" alt="News articles" />
          </div>
          <div class="carousel-item">
            <img class="img-fluid" src="news.jpg" alt="News articles" />
          </div>
        </div>
        <h3>{{tablename}}</h3>
        <a
          class="carousel-control-prev"
          href="#carouselExampleIndicators"
          role="button"
          data-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a
          class="carousel-control-next"
          href="#carouselExampleIndicators"
          role="button"
          data-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div :hidden="!specific">
      <div class="row">
        <div class="col-lg-2">
          <div class="input-group">
            <h5>Quantity:</h5>
            <span class="input-group-btn">
              <button
                type="button"
                class="quantity-left-minus btn btn-danger btn-number"
                data-type="minus"
                data-field
                :disabled="quantity == 0"
                @click="quantity > 0 ? quantity-=1 : 0"
              >
                <span class="glyphicon glyphicon-minus">-</span>
              </button>
            </span>
            <input
              type="text"
              id="quantity"
              name="quantity"
              class="form-control input-number"
              value="10"
              min="0"
              max="100"
              v-model="quantity"
            />
            <span class="input-group-btn">
              <button
                type="button"
                class="quantity-right-plus btn btn-success btn-number"
                data-type="plus"
                data-field
                @click="quantity+=1"
              >
                <span class="glyphicon glyphicon-plus">+</span>
              </button>
            </span>
          </div>
        </div>
        <div class="col-lg-2">
          <button type="button" class="btn btn-primary" :disabled="quantity==0" @click="buy()">Buy</button>
        </div>
      </div>
    </div>
    <table class="table table-hover table-bordered">
      <thead class="thead-dark">
        <tr>
          <th v-for="header in headers" :key="header.id" scope="col">{{header}}</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="data in datas"
          :key="data.id"
          @click="showdata(data)"
          scope="row"
          style="cursor:pointer;"
        >
          <td v-for="val in data" :key="val.id">{{val}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      headers: [],
      datas: [],
      tablename: "",
      quantity: 0,
      specific: null
    };
  },
  methods: {
    getdata: function(url, tablename) {
      if (!this.specific) {
        axios
          .get(url)
          .then(response => {
            console.log(response);
            // alert('Success');
            this.headers = response.data.keys;
            this.datas = response.data.data;
            this.tablename = tablename;
          })
          .catch(error => {
            console.log(error);
            alert("Resource does not exist in server.");
          });
      }
    },
    showdata: function(data) {
      //   console.log(data);
      var url = "./api/data/" + data.symbol.toLowerCase() + ".csv";
      this.getdata(url, data.symbol);
      this.specific = data;
      return;
    },
    buy: function() {
      alert("buying " + this.quantity.toString());
      axios
        .put("./api/buy", {
          stock: this.specific.symbol,
          quantity: this.quantity,
          price: 10
        });
    }
  },
  mounted() {
    // console.log("Dashboard Component mounted.");
    var url = "./api/data/nifty.csv";
    this.specific = null;
    this.getdata(url, "NIFTY50");
  }
};
</script>
