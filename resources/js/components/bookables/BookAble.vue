<template>
    <div> 
                <div v-if="loading" class="loading">
                    loding .. ... .. 
              </div>
        <div v-else >

            Row is : {{ rows }}

            <div class="row" v-for="row in rows" :key="'row'+row">
                <div class="col" v-for="(bookable, index) in bookableInRow(row)" :key="'row'+row+index">
                <BookAbleList 
            :title="bookable.title"
            :content="bookable.content" 
            :price="bookable.price"            
           
            :key= "index"
            ></BookAbleList>
                </div>
                <div class="col" v-for="p in placeholderInRow(row)" :key="'placeholder'+ row + p"></div>
            </div>
            
           
        </div>
            

        </div>
</template>

<script>
import  BookAbleList from "./BookAbleList";

 export default {
    components:{
        BookAbleList
    },
    data () {
       
    return {
            bookables: null,
            loading: false,
            colums: 3
        }
    },
    computed: {
        rows(){
            return this.bookables? Math.ceil(this.bookables.length / this.colums) : '0';
        }
    },
    methods: {
        bookableInRow(row){
            return this.bookables.slice((row-1)*this.colums, row*this.colums);
            },
            placeholderInRow(row){
                return this.colums- this.bookableInRow(row).length
            }
    },
    // beforeCreate(){
    //     console.log(' Before Create ');
    // },
    created() {
        this.loading = true;

        setTimeout(
            ()=>{
                      this.bookables = [
                      {
                        title:'New value update6',
                        content:' THis is updated Content',
                        price:200
                        },
                         {
                        title:'New value update5',
                        content:' THis is updated Content',
                        price:200
                        },
                         {
                        title:'New value update4',
                        content:' THis is updated Content',
                        price:200
                        },
                         {
                        title:'New value update3',
                        content:' THis is updated Content',
                        price:200
                        },
                         {
                        title:'New value update2',
                        content:' THis is updated Content',
                        price:200
                        },
                         {
                        title:'New value update1',
                        content:' THis is updated Content',
                        price:200
                        },
                         {
                        title:'New value update0',
                        content:' THis is updated Content',
                        price:200
                        },
                        
                        ];

                        this.loading= false;
        },
        
        5000);
    },
    // beforeMount() {
    //     console.log('Before Mount');
    // },
    // mounted() {
    //     console.log('mounted');
    // },
    // beforeDestroy() {
    //     console.log('Before Destroy');
    // },
    // destroyed() {
    //     console.log(' Destroyed');
    // },
}
</script>


