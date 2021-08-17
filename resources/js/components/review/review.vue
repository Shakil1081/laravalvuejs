<template>
    <div>

    <div v-if="loading"> loading</div>
    <div v-else>

   <div v-if="alreadyReviewed">
    <div class="card p-5 d-f ">
        <div class="card-body text-center">
            <h5 class="card-title">Already Feedback provide</h5>
            <p class="card-text">Content</p>
        </div>
    </div>
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
        loading: false,
        booking: null
    }
 },
 created() {
     this.loading = true,
     axios.get(`/api/reviews/${this.$route.params.id}`)
     .then(response => (this.existingReview = response.data.data))
     .catch(err => {
console.log(err);
     }).then((response)=>{
        console.log(response+"ffffffffffff"+ this.booking);
          this.loading=false;
     });
 },
 computed:{
     alreadyReviewed(){
         return this.existingReview != null;
     }
 }
}

</script>
