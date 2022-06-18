<template>
    <button
        type="button"
        class="btnn"
        @click="wishlistAdd"
        v-text="buttonText"
    ></button>
</template>

<script>
export default {
    props: ["productId", "inWishlist"],

    mounted() {
        console.log("Component mounted.");
    },

    data: function () {
        return {
            status: this.inWishlist,
        }
    },

    methods: {
        wishlistAdd() {
            axios.post("/wishlist/" + this.productId)
                .then((response) => {
                    console.log(this.status);
                    this.status = !this.status;
            })
            .catch(error=>{
                if(errors.response.status==401){
                    window.location='/';
                }
            });
        }
    },

    computed: {
        buttonText() {
            return (this.status) ? "Remove From Wishlist" : "Add To Wishlist";
        },
    },
};
</script>
