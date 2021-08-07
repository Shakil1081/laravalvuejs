<template>
    <div>
       <div class="from-group">
           <label for="stat" 
           class="text-muted"> Select the star rating (1 is woest - 5 is best)</label>
           <stare-rating 
           :rating="review.rating" 
           class="fa-3x" 
           v-model="review.rating">
           </stare-rating>

       </div>
       <div class="from-group">
           <label for="content" class="text-muted"> Describe your experince</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
       </div>
     <button type="button" class="btn btn-primary btn-lg">Submit</button>
    </div>
</template>

<script>
export default {
    data(){
    return{
        review:{
            rating:5,
            content: null
        }
    }
 }
}
    
</script>