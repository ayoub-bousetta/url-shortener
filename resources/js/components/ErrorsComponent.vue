<template lang="">


   <div v-if="msg" class="alert-popup" v-bind:class="{'error': typeError == false ,  'success': typeError == true }">
            <p>{{msg}}</p>
            <ul v-if="errorslist">
                <li v-for="(errors, index) in errorslist" :key="index">
                    <span v-for="(errorsitem, indexs) in errors" :key="indexs">{{errorsitem}}</span>

                </li>
            </ul>
            <i @click="closeMe" class="material-icons">
clear
</i>
        </div>

</template>
<script>
import Axios from 'axios';
import { bus } from '../app';

export default {

    data() {
        return {
            msg:"",
            typeError:"",
            errorslist:""
            
        }
    },
    mounted() {
         bus.$on('ErrorsHandler', (playload)=>  {

              this.msg ="";
                     this.typeError = "";
                     this.errorslist=""
             const {msg,success}=playload

         
                     this.msg =msg;
                     this.typeError = success;
                     if (playload.errors) {
                         this.errorslist=playload.errors
                     }
                     

            })
    },
    methods: {
        closeMe(){
             this.msg ="";
                     this.typeError = "";
                 
        },
       
    },
    
}
</script>