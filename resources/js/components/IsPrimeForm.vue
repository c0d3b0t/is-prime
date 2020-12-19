<template>
    <form action="">
        <div class="row">
            <div class="col">
                <input type="number" min="1" class="form-control" placeholder="Please enter number">
            </div>
            <div class="col">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
