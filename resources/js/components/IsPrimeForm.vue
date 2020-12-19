<template>
    <form action="">
        <div class="row">
            <div class="col">
                <input type="number" v-model="number" min="1" class="form-control" placeholder="Please enter number">
                <p class="text-center" v-if="this.answer.length">{{this.answer}}</p>
            </div>
            <div class="col">
                <button class="btn btn-primary" @click="isPrime" type="button">Submit</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "IsPrimeForm",
        data() {
            return {
                answer: '',
                number: null,
            }
        },
        methods: {
            isPrime() {
                this.answer = "Will get an answer for number " + this.number;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
