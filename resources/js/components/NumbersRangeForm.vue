<template>
    <div>
        <form action="">
            <div class="row">
                <div class="col">
                    <input type="number" v-model="fromNumber" min="1" class="form-control" placeholder="From number">
                </div>
                <div class="col">
                    <input type="number" v-model="toNumber" min="1" class="form-control" placeholder="To number">
                </div>
                <div class="col mt-2">
                    <input id="show_all" type="checkbox" v-model="showAll" min="1">
                    <label for="show_all">Show all</label>
                </div>
                <div class="col">
                    <button class="btn btn-outline-primary" type="button" @click="listByRange">Submit</button>
                </div>
            </div>
            <p class="text-center" v-if="this.message">{{message}}</p>
        </form>
        <div class="table-responsive mt-4" v-if="this.results.length">
            <table class="table table-striped">
                <thead>
                    <th>Number</th>
                    <th>Count</th>
                    <th>Is Prime</th>
                </thead>
                <tbody>
                    <tr v-for="result in this.results">
                        <td>{{result.number}}</td>
                        <td>{{result.count}}</td>
                        <td>{{result.is_prime}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <th>Number</th>
                    <th>Count</th>
                    <th>Is Prime</th>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "NumbersRangeForm",
    data() {
        return {
            fromNumber: null,
            toNumber: null,
            showAll: false,
            message: '',
            results: []
        }
    },
    methods: {
        listByRange() {
            this.message = '';

            let url = this.showAll ? '/api/numbers/all-range' : '/api/numbers/prime-range';

            axios.get(url, {
                params: {
                    from: this.fromNumber,
                    to: this.toNumber
                }
            })
            .then((response) => {
                this.results = response.data.data.numbers;
            })
            .catch((error) => {
                this.message = error.response.data.message;
            })
        }
    }
}
</script>

<style scoped>

</style>
