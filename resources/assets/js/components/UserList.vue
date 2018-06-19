<template>
    <div>
        <div class="col-md-12">
            <div clas="table-responsive">
                 <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>User name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Datetime submitted</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(product,index) in user_list">
                      <td>{{product.name}}</td>
                      <td>{{product.email}}</td>
                      <td>{{product.role}}</td>
                      <td>{{product.updated_at}}</td>
                      <td>
                        <a class="btn btn-info" @click="editMe(product.id,index)">
                          Edit
                        </a>
                        <a class="btn btn-danger" @click="deleteMe(product.id,index)">
                          Delete
                        </a>
                      </td>
                    </tr>
                  </tbody>
               </table>
            </div>
        </div>
        <transition name="modal" v-if="openPopup" class="modal fade">
            <div class="modal-mask">
              <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">User Details</h4>
                      </div>
                      <div class="modal-body">
                          <form action="/save_form">

                          <div class="form-group">
                              <label for="email">Name: *</label>
                              <input type="text" class="form-control" id="product_name" v-model="form_data.name" required>
                              </div>
                            <div class="form-group">
                              <label for="pwd">Email </label>
                              <input type="text" class="form-control" v-model="form_data.email"  >
                            </div>
                            <div class="form-group">
                              <label for="pwd">Role *</label>
                              <input type="text" class="form-control" id="quantity" v-model="form_data.role" required>
                            </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click="updateMe()">Submit</button>
                        <button type="button" class="btn btn-info" @click="closeme()">Close</button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </transition>
    </div>
</template>
<style type="text/css">
  .modal-container {
    /* width: 300px; */
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    font-family: Helvetica, Arial, sans-serif;
    max-width: 50%;
}
</style>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getusers()
        },
        data(){
            return {
                openPopup:false,
                user_list:[],
                form_data:{
                    name:'',
                    email:'',
                    role:''
                }
            }
        },
        methods: {

            getusers(){

                axios.get('/api/get_users/')
                    .then(e => { 
                        console.log(e.data)
                        this.user_list = e.data
                    })
            },
            editMe(id,index){
                this.form_data = this.user_list[index]
                this.openPopup=true
            },
            closeme(){
              this.openPopup=false;
            },
            updateMe(){
                alert('Are you sure you wanna update the user')
                axios.post('/api/update_users/',this.user_list)
                    .then(e => { 
                        console.log(e.data)
                        this.user_list = e.data
                    })
            },
            deleteMe(id,index){
                alert('Are you sure you wanna delete the user')
                axios.get('/api/delete_users/'+id)
                    .then(e => { 
                        this.getusers()
                    })
            },


        }
    }
</script>
