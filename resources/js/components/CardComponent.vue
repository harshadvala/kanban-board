<template>
    <div class="card ">

        <div class="card-title">
            <h2 class="">{{ detail.title }}</h2>
        </div>

        <div class="card-desc">
            <p class="">{{ detail.description }}</p>
        </div>

    </div>
</template>

<script>
export default {
    props: ['detail'],
    data() {
        return {}
    }
}
</script>
<style scoped>
.card-delete {
    color: red;
}
</style>
