<template>
    <div>
        <div class="container">
            <form action="/save_form">
                    <div class="form-group">
                      <label for="email">Product name: *</label>
                      <input type="text" class="form-control" id="product_name" v-model="form_data.name" required>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Quantity in Stock: *</label>
                      <input type="text" class="form-control" id="quantity" v-model="form_data.quantity" required>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Price per item: *</label>
                      <input type="text" class="form-control" id="price" v-model="form_data.price" required>
                    </div>
                    
                    <button type="button" class="btn btn-default" @click="storeProduct()">Submit</button>
              </form>
        </div>
        <div class="container">
            <div clas="table-responsive">
                 <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Product name</th>
                      <th>Quantity in stock</th>
                      <th>Price per item</th>
                      <th>Datetime submitted</th>
                      <th>Total value number</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(product,index) in product_list">
                      <td>{{product.name}}</td>
                      <td>{{product.quantity}}</td>
                      <td>{{product.price}}</td>
                      <td>{{product.date}}</td>
                      <td>{{calculateTvm(index)}}</td>
                    </tr>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>Total</th>
                      <th>{{calculateTotalTvm()}}</th>
                    </tr>
                  </tbody>
               </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getProducts()
        },
        data(){
            return {
                product_list:[{
                    name:'Product 1',
                    quantity:20,
                    price:2,
                    date:"20-04-1992"
                }],
                form_data:{
                    name:'',
                    quantity:'',
                    price:'',
                    date:''
                }
            }
        },
        methods: {

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

                if(this.form_data.name!='' && this.form_data.price!='' && this.form_data.quantity!='')
                {
                    let form_data = JSON.stringify(this.form_data)
                    axios.post('/api/store_product/',{form_data})
                    .then(e => { 
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
