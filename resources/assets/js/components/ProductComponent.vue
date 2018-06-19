<template>
    <div>
        <div class="col-md-12">
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
                      <select class="form-control" v-model="country_index"  @change="selected()">
                        <option value="">Select</option>
                        <option v-for="(country,index) in countryList" :value="index">
                          {{country.name}}
                        </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="pwd">State </label>
                      <select class="form-control" v-model="form_data.state"  >
                        <option value="">Select</option>
                        <option v-for="(state,index) in selectedState" >
                          {{state}}
                        </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Phone *</label>
                      <input type="text" name="" v-model='form_data.dial_code'>
                      <input type="text" class="form-control" id="quantity" v-model="form_data.phone" required>
                    </div>
                    
                    <button type="button" class="btn btn-default" @click="storeProduct()">Submit</button>
              </form>
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
                        this.getProducts()
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
