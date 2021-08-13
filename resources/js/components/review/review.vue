<template>
    <div>
        <div v-if="loading"> Loading.....</div>
   <div v-if="alreadyReviewed">
   <strong>alreadyReviewed</strong>
   </div>
   <div v-else>
       <div class="from-group">
           <label for="stat"
           class="text-muted"> Select the star rating (1 is woest - 5 is best)</label>
           <stare-rating class="fa-3x" v-model="review.rating">
           </stare-rating>

       </div>
       <div class="from-group">
           <label for="content" class="text-muted"> Describe your experince</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
       </div>
     <button type="button" class="btn btn-primary btn-lg">Submit</button>
     </div>
     </div>
</template>

<script>
export default {
    data(){
    return{
        review:{
            rating:5,
            content: null
        },
        existingReview: null,
        loading:false,
        booking:null
    }
 },
 created() {
     this.loading=true,
     axios.get(`/api/review/${this.$route.params.id}`)
     .then(response => (this.existingReview = response.data.data))
     .catch( err => {
         if(err.response && err.response.status && 404==err.response.status){
             return axios.get(`/api/booking-by-review/${this.$route.params.id}`)
             .then(response=>{
                 this.booking = response.data.data;
             });
         }
     }).then(()=>(this.loading = false));
 },
 computed:{
     alreadyReviewed(){
         return this.existingReview != null;
     }
 }
}

</script>
