<template>
    <div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" v-if="bookable">
                        <code>{{ bookable }}</code>
                        <h4 class="card-title">{{ bookable.title }}</h4>
                        <h6 class="card-subtitle text-muted">
                            {{ bookable.content }}
                        </h6>
                    </div>
                </div>
                <review-list :bookable-id="this.$route.params.id"></review-list>
            </div>
            <div class="col-md-4">
                <Avalablecheck :bookable-id="this.$route.params.id" @availability="checkPrice($event)" class="mb-4"></Avalablecheck>

                   <transition name="fade">
                       <pricr-breakdoen v-if="price" :price="price"></pricr-breakdoen>
</transition>
                          <transition name="fade">
                        <button type="button" class="btn btn-outline-secondary btn-lg btn-block" v-if="price">Booka now</button>
                   </transition>
                   
            </div>
        </div>
    </div>
</template>

<script>
import Avalablecheck from "./Avalablecheck";
import ReviewList from "./ReviewList";
import PricrBreakdoen from './pricrBreakdoen';
import { mapState } from 'vuex';


export default {
    components: {
        Avalablecheck,
        ReviewList,
        PricrBreakdoen
    },
    data() {
        return {
            bookable: null,
            loading:false,
            price:null
        };
    },
    created() {
        axios
            .get(`/api/bookable/${this.$route.params.id}`)
            .then(response => {
                this.bookable = response.data.data;
                this.loading = false;            
            });
    },
    computed: mapState({
        lastSearch: "lastSearch"
    }),
    methods: {
        async checkPrice(hasAvaiability){
          
            if(!hasAvaiability){
                this.price = null;
                return;
            }
            try{
               /* console.log(this.lastSearch);
                 console.log(this.lastSearch.from);*/
             this.price = ( await axios.get(
                 `/api/bookable/${ this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`
                 )).data.data;
                
            }catch(err){
             this.price = null;
            }
        }
    },
};
</script>
