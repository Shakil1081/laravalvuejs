<template>
    <div>


        <div class="row">
          <h5 class="col-12 text-uppercase text-secondary font-weight-bold pt-5">
            Check availablity 
            <transition name="fade">
            <span v-if="hasAvaiability" class="text-success">( Available)</span>
            <span v-if="noAvailability" class="text-danger">( NO Available)</span>
            </transition>
        </h5>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fromdate">From</label>
                    <input
                        type="text"
                        name="from"
                        v-model="from"
                        id="from"
                        class="form-control"
                        placeholder="From"
                        @keyup.enter="click"
                        :class="[{'is-invalide': this.errorFor('from')}]"
                    />
                     <v-error :errors="errorFor('from')"></v-error>
                </div>
                 
            <!--
                <div class="invalid-feedback" v-for="(error, index) in this.errorFor('from')" :key="'from'+ index">
                    {{ error}}
                </div>-->
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="to">To</label>
                    <input
                        type="text"
                        name="to"
                        v-model="to"
                        id="to"
                        class="form-control"
                        placeholder="To"
                        @keyup.enter="click"

                        :class="[{'is-invalide': this.errorFor('to')}]"
                    />
              <v-error :errors="errorFor('to')"></v-error>
                </div>
            </div>
        </div>

        <button type="button" name="Check !" id="check" @click="click" :disabled="loading" class="btn btn-primary btn-lg btn-block">
        <span v-if="!loading">Check !</span>
        <span v-if="loading"> <i class="fas fa-circle-notch fa-spin"></i> Checking...</span>
        </button>
    </div>
</template>


<script>

import { is404, is422} from './../shared/utils/response';
import validationError from './../shared/mixins/validationErrors.js';
export default {
    mixins: [validationError],
     props:{
        bookableId: [String, Number]
    },
    data() {

        return {
            from: this.$store.state.lastSearch.from,
            to: this.$store.state.lastSearch.to,
            loading: false,
            status:null,            
        }
    },
    methods:{
           async click(){
                
            this.loading = true;
            this.errors = null;

            // this.$store.commit('setLastSearch',{                
            // from: this.from,
            // to: this.to
            // });

            this.$store.dispatch('setLastSearch',{                
            from: this.from,
            to: this.to
            });

                try{
                     this.status = ( await axios.get(`/api/bookable/${this.$route.params.id}/availability?from=${this.from}&to=${this.to}`
                     )).status;
                     this.$emit("availability", this.hasAvaiability);
                    }catch(err){
                        if(is422(err) ){
                        this.errors = err.response.data.errors;
                        }
                     this.status= err.response.status;  
                      this.$emit("availability", this.hasAvaiability); 
                }
                    this.loading = false;


            // axios.get(`/api/bookable/${this.$route.params.id}/availability?from=${this.from}&to=${this.to}`)
            // .then(response => {
            //         this.status = response.status;
            // }).catch(error => {
               
            // if(is422(error) ){
            //     this.errors = error.response.data.errors;
            // }
            // this.status= error.response.status;            
            // }).then(
            //     ()=>this.loading = false
            //     );
            // }
            // errorFor(fiels){
            // return this.hasErrors && this.errors[fiels] ? this.errors[fiels] : null;
     }

    },
 
    computed: {
        hasErrors(){

            return 422 == this.status && this.errors != null;
        },
        hasAvaiability(){
            console.log(this.status+"______");
            return 200 == this.status;
        },
        noAvailability(){
                            console.log(this.status);
            return 404 == this.status;
        }
    },
};
</script>
<style scoped>
label{
   font-size: 0.7rem;
   text-transform: uppercase;
   color: gray;
   font-weight: bolder;
}
.is-invalide{
    border-color: red;
    background-image: none;
}
.invalid-feedback{
    color: red;
}
.invalid-feedback {
    display: block;
}
</style>