<template>
    <form action="">
        <div class="row">
            <div class="col-8">
                <input type="number" v-model="number" min="1" class="form-control" placeholder="Enter number to check if it's prime">
                <p class="text-center" v-if="this.message">{{this.message}}</p>
            </div>
            <div class="col-4">
                <button class="btn btn-outline-success" @click="isPrime" type="button">Submit</button>
            </div>
        </div>
    </form>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "IsPrimeForm",
        data() {
            return {
                message: '',
                number: null,
            }
        },
        methods: {
            isPrime() {
                if(this.number) {
                    axios.post('/api/numbers/is-prime', {
                        number: this.number
                    })
                        .then((response) => {
                            this.message = response.data.message;
                        })
                        .catch((error) => {
                            this.message = error.response.data.message
                        })
                }
            }
        }
    }
</script>
