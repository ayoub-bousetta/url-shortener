<template>
  <form @submit.prevent="Senddata"  method="post">
     
     


<div class="f-input">
    <input type="text" placeholder="Name" name="name" v-model="fields.name">
<span v-if="errors.name" class='error'>{{errors.name[0]}}</span>

</div>
<div class="f-input">
<input type="text" placeholder="Url" name="or_link" v-model="fields.or_link">
<span v-if="errors.or_link" class='error'>{{errors.or_link[0]}}</span>
</div>
<button  type="submit"><i class="material-icons">
    keyboard_arrow_right
    </i></button>

</form>
</template>

<script>
 import axois from 'axios';
 import { bus } from '../app';
export default {

   
//route('sendit')
  data() {
    return {
      fields: {},
      errors: {},
      msg:"",
      hasError:false,
      haSuccess:false
    }
  },
 
    methods: {
        Senddata(e){
       
                this.msg=""

            axois.post('/url',this.fields).then(Response=>{

 
                  if(Response.data.error){
                      this.errors =Response.data.error
                      if (Response.data.error == "You must be connected") {
                        this.msg =Response.data.error 
                        this.hasError =true
                        this.haSuccess =false


 bus.$emit('ErrorsHandler',{'msg':this.msg,'success':this.haSuccess})

                      }else{
                        this.msg ="Hum!! Many errors are detected..."
                          this.hasError =true
                        this.haSuccess =false
                        bus.$emit('ErrorsHandler',{'msg':this.msg,'success':this.haSuccess,'errors':Response.data.error})
                      }
                       
                  }else{
                   this.errors={}
                     this.hasError =false
                        this.haSuccess =true
                        this.msg =Response.data.success

                         bus.$emit('ErrorsHandler',{'msg':this.msg,'success':this.haSuccess})
                  }
                   this.$root.$emit('updateurls')
 
            }).catch(error=>{
               
               console.log(error)
            })
           
        }
    },

}
</script>

