<template>
<div>
<div class="row">
              <!--  <div class="col-md-12" v-if="error">
                Unknow error has occured, please try  again later!
                </div>-->

                <fatal-error v-if="error"></fatal-error>
              

        <div class="col-md-12" v-else>
        <div class="row">
                    <div :class="[{'col-md-4':twoColumn},{'d-none': oneColumn}]">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div v-if="loading"> Loading... </div>
                                    <div v-if="hasBooking">
                                        <router-link :to="{name: 'bookable', params:{ id: booking.bookable.id}}"> Saty {{ booking.bookable.title }}</router-link>
                                        <p>From {{ booking.from }} to {{ booking.to }} </p>
                                    </div>

                                </div>
                            </div>
                    </div>

                        <div :class="[{'col-md-8': twoColumn},{'col-md-12': oneColumn}]">

                                <div v-if="loading"> Loading.....{{ loading}}</div>
                                            <div v-else>
                                                        <div v-if="alreadyReviewed">
                                                        <h3>You`ve already left a review for this booking!</h3>
                                                        </div>
                                                            <div v-else>
                                                                    <div class="from-group">
                                                                    <label for="stat"
                                                                    class="text-muted"> Select the star rating (1 is woest - 5 is best)</label>
                                                                    <stare-rating class="fa-3x" v-model="review.rating">
                                                                    </stare-rating>
                                                                    </div>

                                                                    <div class="form-group">
                                                                    <label for="content" class="text-muted"> Describe your experince</label>
                                                                    <textarea 
                                                                    name="content" 
                                                                    id="content"
                                                                    cols="30"
                                                                    rows="10"
                                                                    class="form-control" 
                                                                    v-model="review.content"
                                                                    :class="[{'is-invalide': errorFor('content')}]"
                                                                    ></textarea>
                                                                    <v-error :errors="errorFor('content')"></v-error>
                                                                    
                                                                    </div>
                                                                    
                                                                    <button class="btn btn-primary btn-lg btn-block"
                                                                     @click.pervent="submit"
                                                                     :disable="sending">Submit </button>
                                                            </div>
                                            </div>
                                </div>
                         </div>
                 </div>
            </div>
             </div>

</template>

<script>
import {is404, is422} from './../shared/utils/response.js';
import validationError from './../shared/mixins/validationErrors.js';
export default {

  mixins: [validationError],
  data() {
    return {
      review: {
        id:null,
        rating: 5,
        content: null,
      },
      existingReview: null,
      loading: false,
      booking: null,
      error: false,
      sending: false,
      success: false
    };
  },
async created() {
    this.review.id = this.$route.params.id;
    this.loading = true;

try{
    this.existingReview = await (axios.get(`/api/reviews/${this.review.id}`)).data.data;
    }catch(err){
        if (is404(err)) {
            try{ 
            this.booking = (await axios.get(`/api/booking-by-review/${this.review.id}`)).data.data;
            }catch(err){
                    this.error = !is404(err);
            }
        }else{
            this.error = true;

        }
       
    }
this.loading = false

    //   axios
    //     .get(`/api/reviews/${this.review.id}`)
    //     .then((response) => (this.existingReview = response.data.data))
    //     .catch((err) => {
    //                         if (is404(err)) {
    //                             return axios
    //                             .get(`/api/booking-by-review/${this.review.id}`)
    //                             .then((response) => {
    //                                 this.booking = response.data.data;
    //                             }).catch(

    //                                     err=>{
    //                                     //is404(err) ? {} :(this.error = true);
    //                                     this.error = !is404(err);
    //                                     });
    //                         }
    //                         this.error = true;
    //     })
    //     .then(() => (this.loading = false));
  },
  computed: {
    alreadyReviewed() {
      return this.hasReview || !this.booking;
    },
    hasReview() {
      return this.existingReview != null;
    },
    hasBooking() {
      return this.booking != null;
    },
    oneColumn(){
        return !this.loading && this.alreadyReviewed;
    },
    twoColumn(){
        return this.loading || !this.alreadyReviewed;
            }
  },
  methods: {
      submit(){
          // 3. Store the review
this.errors = null;
this.sending = true;
this.success = true;
/*this.review.rating = 6;*/
      axios.post(`/api/reviews/`, this.review)
      .then(response => {
          this.success = 201 == response.status;
      })
      .catch( (err) => {
          if(is422(err)){
              const errors = err.response.data.errors;
            if(errors["content"] && 1 == _.size(errors)){
                this.errors = errors;
                return;
            }              
          }
          this.error = true;
      })
      .then(() => (this.sending= false));
      },
    // errorFor(field){
    // return null!= this.errors && this.errors[field] 
    // ? this.errors[field] :
    //  null;
    // }
  }
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