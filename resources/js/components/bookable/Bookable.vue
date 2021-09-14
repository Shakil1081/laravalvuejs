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
                <Avalablecheck :bookable-id="this.$route.params.id" @availability="checkPrice($event)"></Avalablecheck>
            </div>
        </div>
    </div>
</template>

<script>
import Avalablecheck from "./Avalablecheck";
import ReviewList from "./ReviewList";
import { mapState } from 'vuex';

export default {
    components: {
        Avalablecheck,
        ReviewList
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
