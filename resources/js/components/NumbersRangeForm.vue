<template>
    <form action="">
        <div class="row">
            <div class="col">
                <input type="number" min="1" class="form-control" placeholder="From number">
            </div>
            <div class="col">
                <input type="number" min="1" class="form-control" placeholder="To number">
            </div>
            <div class="col">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: "NumbersRangeForm"
}
</script>

<style scoped>

</style>
