<template>
    <div>

        <div class="row">
            <div class="col-md-8">
<div class="card">
  <div class="card-body" v-if="bookable">
         <code>{{ bookable }}</code>
    <h4 class="card-title">{{ bookable.title }}</h4>
    <h6 class="card-subtitle text-muted">{{ bookable.content }}</h6>
  </div>
</div>
            </div>
            <div class="col-md-4">
                <Avalablecheck></Avalablecheck>
            </div>
        </div>
        
    </div>
</template>

<script>
import Avalablecheck from "./Avalablecheck";
export default {
     components: {
        Avalablecheck
    },
    data() {
        return {
            bookable: null
        };
    },
    created() {
        axios
            .get(`/api/bookable/${this.$route.params.id}`)
            .then(response => (this.bookable = response.data.data));
    }
};
</script>
