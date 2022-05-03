<template>
    <div>
        <input id="num1" v-model.number="num1" type="number">
        <input id="num2" v-model.number="num2" type="number">

        <div>
            <div>
                Sum: <span v-text="this.num1 + this.num2"></span>
            </div>

            <div>
                Product: <span v-text="this.num1 * this.num2"></span>
            </div>
        </div>

    </div>
</template>

<script>
export default {

    data() {
        return {
            num1: 0,
            num2: 0
        }
    },

    methods: {
        updateNum() {
            this.num1 = document.querySelector('#num1').value;
            this.num2 = document.querySelector('#num2').value;
        }
    },

    computed: {
        sum() {
            return (this.num1 + this.num2);
        },

        product() {
            return (this.num1 * this.num2);
        }
    }


}
</script>
