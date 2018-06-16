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
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(product,index) in user_list">
                      <td>{{product.name}}</td>
                      <td>{{product.email}}</td>
                      <td>{{product.role}}</td>
                      <td>{{product.updated_at}}</td>
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
            this.getusers()
        },
        data(){
            return {
                user_list:[],
                form_data:{
                    name:'',
                    quantity:'',
                    price:'',
                    date:''
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
            }

        }
    }
</script>
