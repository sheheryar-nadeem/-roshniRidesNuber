<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
              <router-link class="btn btn-xs btn-primary" v-bind:to="{path: '/add-booking'}">
                <span class="glyphicon glyphicon-plus"></span>
                Add new Booking
              </router-link>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Booking List</div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Car Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(booking, index) in bookings">
                            <td>{{ index + 1 }}</td>
                            <td>{{ booking.name }}</td>
                            <td>{{ booking.email }}</td>
                            <td>{{ booking.address }}</td>
                            <td>{{ booking.type }}</td>
                            <td>{{ booking.status }}</td>
                            <td>
                              <button class="btn btn-xs btn-warning" v-on:click="acceptBooking(booking.bookingReference)">
                                Accept
                              </button>

                              <button class="btn btn-xs btn-danger" v-on:click="cancelBooking(booking.bookingReference)">
                                Cancel
                              </button>
                            </td>
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
    export default {
      data() {
        return {
          bookings: [],
          interval:''
        }
      },
      created() {
        this.bookingList();
        this.bookingListInterval();
      },
      methods: {
        bookingListInterval(){
          this.interval = setInterval(function(){
            let url = document.getElementById('baseurl').value+'/api/bookings';
            axios.get(url).then(response => {
              if(response.data.success){
                this.bookings = response['data']['bookingLists'];
              }else{
                alert(response['data']['message']);
              }
            }, error => {
              alert(error);
            });

          }, 5000);
        },
        bookingList(){
          let url = document.getElementById('baseurl').value+'/api/bookings';
          axios.get(url).then(response => {
            if(response.data.success){
              this.bookings = response['data']['bookingLists'];
            }else{
              alert(response['data']['message']);
            }
          }, error => {
            alert(error);
          });
        },
        acceptBooking(bookingReference){
          let url = document.getElementById('baseurl').value+'/api/bookings/'+bookingReference;
          axios.put(url, {'statusId': '2'}).then((response) => {
            if(response.data.success){
              alert("Booking Reference : "+ response['data']['message']);
              this.bookingList();
            }else{
              alert(response['data']['message']);
            }
          });
        },
        cancelBooking(bookingReference){
          let url = document.getElementById('baseurl').value+'/api/bookings/'+bookingReference;
          axios.put(url, {'statusId': '3'}).then((response) => {
            if(response.data.success){
              alert("Booking Reference : "+ response['data']['message']);
              this.bookingList();
            }else{
              alert(response['data']['message']);
            }
          });
        }
      }
    }
</script>
