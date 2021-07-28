<template>
    <div>
<code>{{ bookable }}</code>

<h2>{{ bookable.title }} </h2>

<p>{{ bookable.content }}</p>
    </div>
</template>

<script>
export default {

data() {
    return {
        bookable: null
    }
},
 created() {
     axios
     .get(`/api/bookable/${ this.$route.params.id}`)
     .then(response =>(this.bookable = response.data));
    },
}
</script>