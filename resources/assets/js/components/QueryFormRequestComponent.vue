<template>
    <div>
        <div class="col-md-12">
            <div clas="table-responsive"><notifications group="foo" />
                 <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>User name</th>
                      <th>Addresse </th>
                      <th>Country</th>
                      <th>State</th>
                      <th>Phone</th>
                      <th>Datetime submitted</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(product,index) in product_list">
                      <td>{{product.name}}</td>
                      <td>{{product.Addresse}}</td>
                      <td>{{product.country}}</td>
                      <td>{{product.state}}</td>
                      <td>{{product.dial_code}}-{{product.phone}}</td>
                      <td>{{product.date}}</td>
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
                        <h4 class="modal-title">Query Form</h4>
                      </div>
                      <div class="modal-body">
                          <form action="/save_form">

                    <div class="form-group">
                      <label for="email">Name: *</label>
                      <input type="text" class="form-control" id="product_name" v-model="form_data.name" required>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Addresse </label>
                      <textarea  class="form-control" id="quantity" v-model="form_data.Addresse" required>
                      </textarea> 
                    </div>
                    <div class="form-group">
                      <label for="pwd">Country </label>
                      <input type="text" name="" v-model="form_data.country">
                    </div>
                    <div class="form-group">
                      <label for="pwd">State </label>
                      <input type="text" name="" v-model="form_data.state">
                      
                    </div>
                    <div class="form-group">
                      <label for="pwd">Phone *</label>
                      <input type="text" name="" v-model='form_data.dial_code'>
                      <input type="text" class="form-control" id="quantity" v-model="form_data.phone" required>
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



<script>
import countrylist from '../core/countrylist.js'
import statelist from '../core/statelist.js'

    export default {
        mounted() {
            console.log('Component mounted.')
            this.getProducts()
        },
        data(){
            return {
                openPopup:false,
                product_list:[],
                country_index:'',
                countryList:countrylist,
                stateList:statelist,
                selectedState:[],
                form_data:{
                    name:'',
                    // quantity:'',
                    // price:'',
                    date:'',
                    Addresse:'',
                    country:'',
                    dial_code:'',
                    state:'',
                    phone:'',
                    status:false,
                }
            }
        },
        methods: {
            selected(){
              let country = this.countryList[this.country_index]
              let selectedState = this.stateList[this.country_index].states
              this.form_data.country = country.name;
              this.form_data.dial_code = country.dial_code;
              this.selectedState = selectedState

            },
            calculateTvm(index){
                let tvm=0
                let p = this.product_list[index]

                tvm = p.quantity*p.price

                if(tvm !=0)
                    return tvm
                else
                    return 0 
            },
            calculateTotalTvm(){
                let totalTvm=0

                this.product_list.forEach((p, i) => {
                    totalTvm  = totalTvm+ this.calculateTvm(i)
                })

                return totalTvm
            },
            storeProduct(){

                if(this.form_data.name!='' && this.form_data.country!='' && this.form_data.state!='')
                {
                    let form_data = JSON.stringify(this.form_data)
                    axios.post('/api/store_product/',{form_data})
                    .then(e => { 
                        this.form_data ={
                          name:'',
                          // quantity:'',
                          // price:'',
                          date:'',
                          Addresse:'',
                          country:'',
                          dial_code:'',
                          state:'',
                          phone:'',
                       
                            status:false,
                      }
                 alert('Thanks for submiting the query')
                    })
                }
                else{
                    alert("All field are mandatory")
                }
                
            },
            getProducts(){

                axios.get('/api/get_product/')
                    .then(e => { 
                        console.log(e.data)
                        this.product_list = e.data
                    })
            },
             editMe(id,index){
                this.form_data = this.product_list[index]
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
                        this.getProducts()
                    })
            },

        }
    }
</script>
