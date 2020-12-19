<template>
    <form action="">
        <div class="row">
            <div class="col">
                <input type="number" v-model="fromNumber" min="1" class="form-control" placeholder="From number">
            </div>
            <div class="col">
                <input type="number" v-model="toNumber" min="1" class="form-control" placeholder="To number">
            </div>
            <div class="col">
                <button class="btn btn-primary" type="button" @click="listByRange">Submit</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: "NumbersRangeForm",
    data() {
        return {
            fromNumber: null,
            toNumber: null
        }
    },
    methods: {
        listByRange() {

        }
    }
}
</script>

<style scoped>

</style>
