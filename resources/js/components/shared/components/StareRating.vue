<template>
    <div d-flex>
      <i class="fa fa-star" 
      v-for=" (Star,index)  in fullStar" 
      :key="'full'+ index"
       @click="$emit('input', Star)">
       </i>
      <i class="fa fa-star-half" 
       v-for="(Star,index) in halfStar" 
       :key="'half'+ index"></i>
      <i class="fas fa-star-of-david" 
      v-for=" (Star,index)  in emptyStar" 
      :key="'empty'+ index"
       @click="$emit('input', fullStar + Star)"></i>

    </div>
</template>
<script>
export default {
    props:{
        value: Number
    },
    computed:{
        halfStar(){
         const fraction = Math.round(
             (this.value- Math.floor(this.value))*100
         );
            console.log(fraction);
         return fraction >0 && fraction < 5
        },
        fullStar(){
            // > 4.5 = 5 stars
            // 4.3 = 4 and half 
            return Math.round(this.value);
        },
        emptyStar(){
            //if value would be 1.9, ceil(1.9)=2, 5-2=3 reander 3 empty stars 
            return 5 - Math.ceil(this.value);
        }
    },
    created(){
        const numbers= [0.9,4.0,4.4, 4.5,4.6,4.9];
    }
}
</script>