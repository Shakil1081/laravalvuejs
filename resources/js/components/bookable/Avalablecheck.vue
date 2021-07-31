<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fromdate">From</label>
                    <input
                        type="text"
                        name="from"
                        v-model="from"
                        id="from"
                        class="form-control"
                        placeholder="From"
                        @keyup.enter="click"
                        :class="[{'is-invalide': this.errorFor('from')}]"
                    />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="to">To</label>
                    <input
                        type="text"
                        name="to"
                        v-model="to"
                        id="to"
                        class="form-control"
                        placeholder="To"
                        @keyup.enter="click"
                        :class="[{'is-invalide': this.errorFor('to')}]"
                    />
                </div>
            </div>
        </div>
        <button type="button" name="Check !" id="check" @click="click" @disable="loading" class="btn btn-primary btn-lg btn-block">Check ! </button>
    </div>
</template>


<script>
export default {
    data() {
        this.loading= false;
        return {
            from:null,
            to:null,
            status:null,
            error:null,
            
        }
    },
    methods:{
            click(){
            this.error=null;
            this.loading = true;
            axios.get(`/api/bookable/${this.$route.params.id}/availability?from=${this.from}&to=${this.to}`)
            .then(response => {
            this.status = response.status;
            })
            .catch(error => {
            if( 422 == error.response.status){
                this.error = error.response.data.errors;
            }
            this.status= error.response.status;
            }).then(()=>this.loading= false);
            },

                errorFor(fiels){
                console.log(this.hasErrors+" 3333");
                console.log(this.error +" 2222");
                return this.hasErrors && this.error[fiels] ? this.error[fiels] : null;
                }

    },
 
    computed: {
        hasErrors(){
            return 422 == this.status && this.error != null;
        },
        hasAvaiability(){
            return 200 == this.status;
        },
        noAvailability(){
            return 400 == this.status;
        }
    },
};
</script>
