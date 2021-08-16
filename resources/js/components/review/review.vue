<template>

    <div class="row">


            <div :class="[{'col-md-4': loading || !alreadyReviewed},{'d-none': !loading && alreadyReviewed}]">
            <div class="card text-left">
              <img class="card-img-top" src="holder.js/100px180/" alt="">
              <div class="card-body">
                  <div v-if="loading"> Loding</div>
                  <div v-else>
                    <router-link :to="{name: 'bookables', params:{ id:booking.bookable.bokable_id}}">{{ booking.bookable.title }}</router-link>
                    <p>

                        From {{ booking.from }} to {{ booking.to }}
                    </p>
                  </div>

              </div>
            </div>
            </div>

            <div :class="[{'col-md-8': loading || !alreadyReviewed},{'col-md-12': !loading && alreadyReviewed}]">

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
                  </div>
</template>

<script>
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
    };
  },
  created() {
    (this.loading = true),
      axios
        .get(`/api/reviews/${this.$route.params.id}`)
        .then((response) => (this.existingReview = response.data.data))
        .catch((err) => {
          if (
            err.response &&
            err.response.status &&
            404 == err.response.status
          ) {
            return axios
              .get(`/api/booking-by-review/${this.$route.params.id}`)
              .then((response) => {
                this.booking = response.data.data;
              });
          }
        })
        .then(() => (this.loading = false));
  },
  computed: {
    alreadyReviewed() {
      return this.hasReview || this.booking;
    },
    hasReview() {
      return this.existingReview != null;
    },
    hasBooking() {
      return this.booking != null;
    },
  },
};
</script>
