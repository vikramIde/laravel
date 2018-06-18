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
                        <button class="btn btn-success" v-if="product.status">
                          Click to disable
                        </button>
                        <button class="btn btn-danger" v-else>
                          Click to Enable
                        </button>
                      </td>
                    </tr>
                  </tbody>
               </table>
            </div>
        </div>
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
            }

        }
    }
</script>
