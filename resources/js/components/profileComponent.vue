<template>
    <div class="profiledata" v-if=" this.authid.name != '' " >
        <div class="imageInfo">
        <span class="image">{{this.authid.name.substring(0, 2).toUpperCase()}}</span>
        <span class='name'>{{this.authid.name}}</span>
        </div>

        <div class="data">
            
            <p>Email : <span>{{this.authid.email}} </span></p>
            <p>Links : <span>{{urlcount}} {{ (urlcount > 1 ) ? 'Links' : 'Link' }} </span></p>
              <span class="getout" @click="getOut">Get Out ➔</span>

            
     
        </div>
    </div>
</template>

<script>
import Axios from 'axios'


export default {

    data(){
        return{
            datainfo:{},
            urlcount:0
        }
    },

    created() {
      
    },
    mounted() {
    
         this.$root.$on('countingUrl', (infos)=>  {
         
                     this.urlcount = infos;
            })
    },
    methods: {
        getOut(){
          Axios.get('/logout').then(res=>{
            window.location = '/login';
           });
            
        }
    },
      props:['authid'],
 
}
</script>