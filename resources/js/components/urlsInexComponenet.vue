<template lang="">
  
<div class="listurl" v-if="loading == false && infos.length > 0">

    <div v-if="popup.gen_code" class="popup">
      <div class="insidebox"><span> {{this.url }}/{{this.popup.gen_code }}</span>
<a v-bind:href="this.url+'/'+popup.gen_code" target="blank"><i class="material-icons">
control_camera
</i></a>
 <span @click="closeitem()"><i class="material-icons">
close
</i></span>


</div>    
    </div>


    <div v-for="(item, index) in infos" :key="index">
        <div class="links">
              <span class="poplink" >
                <span>{{item.name}}</span>
                 
                <span>{{item.gen_code}}</span>
                <span>{{item.or_link}}</span>
        </span>
        <span class="actions" >
            <span @click="openurl(item.id)"><i class="material-icons">
aspect_ratio
</i></span>
            <span @click="editThis(item.id)"><i class="material-icons">create</i></span>
            <span @click="deleteThis(item.id)"><i class="material-icons">delete_sweep</i></span>
        </span>

   <form @submit.prevent='editThispost(item.id)' v-if="item.id ==current" class="form"  v-bind:class="{ active: activated }">
                <div class="f-input"><input type="text" placeholder="Name" name="name" v-model="infoData.name">
               
                </div>
                 <div class="f-input"><input type="text" placeholder="Url" name="Url" v-model="infoData.or_link"> 
               
                 </div>
                  <div class="actions">
                   <button type="submit"><i class="material-icons">
    done
    </i></button>
                    
                    <span @click="closeit"><i class="material-icons">clear</i></span>
                   </div>
                </form>
        </div>
    
          
      


    </div>




</div>

</template>

<script>
import Axios from 'axios'
import { bus } from '../app';
import { async } from 'q';
export default {

    data(){
        return{
            infos:{},
            loading:true,
            activated:false,
            current:0,
           infoData:{},
            iduser:"",
             errors: {},
            actionUrl:this.action,
            popup:{},
            hrefurl:""
           
        }
    },

    mounted(){
            this.getdata();

             
    },


        created() {
            this.iduser= this.authid.id
           
 
            

            this.$root.$on('updateurls', ()=>  {
                     this.getdata();
            })

           
          
        },

    props:['authid','action','url'],

    methods: {

          closeitem(){
this.popup = {}

      },

        openurl(id){

           const data=this.infos.filter(da=>{
               return da.id == id
           })

           this.popup = data[0]

         
            
            
             

        },

        getdata(){
            Axios.get('/getallurl',this.iduser).then(resp=>{

               this.infos = resp.data.urls
               this.loading =false
               
                this.$root.$emit('countingUrl',this.infos.length)
              
            })

        
        },

        editThis(id){
            //this.$root.$emit('editonUrl',id);
      Axios.get('/url/edit/'+id).then(resp=>{
          console.log(resp.data.urls[0])

          this.infoData=resp.data.urls[0];
         
               
              
            }).then(res=>{
     this.current = id 
this.activated = true;
            })





     
        },
deleteThis(id){
    Axios.delete('/url/delete/'+id).then(resp=>{

        

           if(resp.data.error){
                      this.errors =resp.data.error

                 
                       this.msg ="Hum!! Many errors are detected..."
                        bus.$emit('ErrorsHandler',{'msg':this.msg,'success':false,"errors":this.errors})



              }else{
  this.getdata();
          this.current = 0 
           this.errors={}
this.activated = false;
 this.msg ="Yep!! Deleted..."
bus.$emit('ErrorsHandler',{'msg':this.msg,'success':true})
              }
    })
},
      editThispost(id){
        Axios.post('/url/edit/'+id,this.infoData).then(resp=>{
              if(resp.data.error){
                      this.errors =resp.data.error
                       this.msg ="Hum!! Many errors are detected..."

                       

                        bus.$emit('ErrorsHandler',{'msg':this.msg,'success':false,'errors':this.errors})
              }else{
  this.getdata();
          this.current = 0 
           this.errors={}
this.activated = false;
 this.msg ="Yep!! Done and updated..."
bus.$emit('ErrorsHandler',{'msg':this.msg,'success':true})
              }

              
              
            })

      },
      closeit(){
    this.current = 0 
this.activated = false;
      },

    



        
    },

}
</script>