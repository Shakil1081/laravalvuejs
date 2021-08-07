<template>
    <div>
        <h4 class="text-uppercase text-secondary font-weight-bold pt-5">List of reviewlist </h4>

        <div v-if="loading"> Loading ...</div>
        <div v-else> 
            <stare-rating :rating="0.1"></stare-rating>
            <stare-rating :rating="0.5"></stare-rating>
            <stare-rating :rating="review.rating"></stare-rating>
        <div class="border-bottom d-none d-md-block" v-for="(review, index) in reviews" :key="index">
            <div class="row pt-3">
                <div class="col-md-6">Namr </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <stare-rating :rating="review.rating"></stare-rating>
                    {{ review.rating }}
                    </div>
               
                    <div class="col-md-12"> {{ review.created_at | fromNow }}</div>
                    <div class="col-md-12"> {{ review.content }}</div>
                </div>
            </div>
            </div>
        </div>
</template>

<script>
import moment from "moment";
export default {
    props:{
        bookableId: String
    },
    data(){

        return {
            loading: false,
            reviews:null
        }
        },
        created() {
            this.loading = true;
            axios.get(`/api/bookable/${this.bookableId}/reviews`)
            .then(response => this.reviews=response.data.data)
            .then(()=>this.loading= false )
        
    }
    /*,
    filters:{
        fromNow(value){ 
        return moment(value).fromNow();
      }
    }
    */
}
</script>