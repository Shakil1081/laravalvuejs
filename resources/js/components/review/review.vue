<template>
<div>
<div class="row">
                <div class="col-md-12" v-if="error">
                Unknow error has occured, please try  again later!
                </div>

        <div class="col-md-12" v-else>
        <div class="row">
                    <div :class="[{'col-md-4':twoColumn},{'d-none': oneColumn}]">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div v-if="loading"> Loading... </div>
                                    <div v-if="hasBooking">
                                        <router-link :to="{name: 'bookable', params:{ id: booking.bookable.id}}"> Saty{{ booking.bookable.title }}</router-link>
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
                                                                    <div class="from-group">
                                                                    <label for="content" class="text-muted"> Describe your experince</label>
                                                                    <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                                                                    </div>
                                                                    <button type="button" class="btn btn-primary btn-lg"
                                                                     @click.pervent="submit"
                                                                     :disable="loading">Submit </button>
                                                            </div>
                                            </div>
                                </div>
                         </div>
                 </div>
            </div>
             </div>

</template>

<script>
import {is404} from './../shared/utils/response.js';
export default {
  data() {
    return {
      review: {
        rating: 5,
        content: null,
      },
      existingReview: null,
      loading: false,
      booking: null,
      error: false
    };
  },
  created() {
    this.review.id = this.$route.params.id;
    this.loading = true;
      axios
        .get(`/api/reviews/${this.review.id}`)
        .then((response) => (this.existingReview = response.data.data))
        .catch((err) => {
                            if (is404(err)) {
                                return axios
                                .get(`/api/booking-by-review/${this.review.id}`)
                                .then((response) => {
                                    this.booking = response.data.data;
                                }).catch(

                                        err=>{
                                        //is404(err) ? {} :(this.error = true);
                                        this.error = !is404(err);
                                        });
                            }
                            this.error = true;
        })
        .then(() => (this.loading = false));
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
          this.loading = true;
      axios.post(`/api/reviews/`)
      .then( response => console.log(response))
      .catch( (err) => (this.error= true))
      .then(() => (this.loading= false));
      }
  }
};
</script>
