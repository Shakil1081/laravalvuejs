<template>
    <div>
        <div v-if="loading" class="loading">
            loding .. ... ..
        </div>
        <div v-else>
            Row is : {{ rows }}

            <div class="row" v-for="row in rows" :key="'row' + row">
                <div
                    class="col d-flex align-items-stretch card m-2"
                    v-for="(bookable, index) in bookableInRow(row)"
                    :key="'row' + row + index"
                >
                    <BookAbleList
                        v-bind="bookable"
                        :key="index"
                    ></BookAbleList>
                </div>
                <div
                    class="col"
                    v-for="p in placeholderInRow(row)"
                    :key="'placeholder' + row + p"
                ></div>
            </div>
        </div>
    </div>
</template>

<script>
import BookAbleList from "./BookAbleList";

export default {
    components: {
        BookAbleList
    },
    data() {
        return {
            bookables: null,
            loading: false,
            colums: 3
        };
    },
    computed: {
        rows() {
            return this.bookables
                ? Math.ceil(this.bookables.length / this.colums)
                : "0";
        }
    },
    methods: {
        bookableInRow(row) {
            return this.bookables.slice(
                (row - 1) * this.colums,
                row * this.colums
            );
        },
        placeholderInRow(row) {
            return this.colums - this.bookableInRow(row).length;
        }
    },
    // beforeCreate(){
    //     console.log(' Before Create ');
    // },
    created() {
        this.loading = true;

        // const p = new Promise((resolve, reject) => {
        //     console.log(resolve);
        //     console.log(reject);

        //     setTimeout(() => {
        //         resolve('Application Request is success');

        //     }, 8000);

        // })
        // .then( result=>console.log(`Sucess == ${ result}`))
        // .then( result=>console.log(result))
        // .catch( result=>(` Error ${ result}`));

        // console.log(p);

        const request = axios.get("/api/bookable").then(response => {
            (this.bookables = response.data.data), (this.loading = false);
        });
    }
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
};
</script>
