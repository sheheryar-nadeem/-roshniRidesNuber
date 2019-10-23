<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add Booking</div>
                    <div class="card-body">
                      <form @submit.prevent="addBooking">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Name:</label>
                              <input type="text" class="form-control" v-model="booking.name" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Email:</label>
                              <input type="email" class="form-control" v-model="booking.email" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Address:</label>
                              <input type="text" class="form-control" v-model="booking.address" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Car Type:</label>
                              <select class="form-control" v-model="booking.cartypeId" required>
                                <option v-for="(cartype, index) in cartypes":value="cartype.id">{{ cartype.type }}</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <button class="btn btn-primary">Create</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data(){
        return {
          booking:{},
          cartypes: []
        }
      },
      methods: {
        cartypeList(){
          let url = document.getElementById('baseurl').value+'/api/cartypes';
          axios.get(url).then(response => {
            if(response.data.success){
              this.cartypes = response['data']['cartypes'];
            }else{
              alert(response['data']['message']);
            }
          }, error => {
            alert(error);
          });
        },
        addBooking(){
          let url = document.getElementById('baseurl').value+'/api/bookings';
          axios.post(url, this.booking).then((response) => {
            if(response.data.success){
              alert("Booking Reference : "+ response['data']['bookingReference']);
              this.$router.push({name: 'AllBookings'});
            }else{
              alert(response['data']['message'])
            }
          });
        }
      },
      created() {
        this.cartypeList();
      }
    }

</script>
