<template>
  <div></div>
</template>

<script>
export default {
  mounted() {
    this.stripe = Stripe(process.env.MIX_STRIPE_KEY);
    this.elements = this.stripe.elements({
      fonts: [
        {
          cssSrc: "https://fonts.googleapis.com/css?family=Roboto",
          family: '"Roboto"',
          style: "normal",
          weight: 400
        }
      ]
    });

    this.card = this.elements.create("card", {
      classes: {
        focus: "bg-blue-lightest border-blue-light"
      },
      style: {
        base: {
          color: "rgb(96, 111, 123)",
          fontSize: "14px",
          fontFamily: "Roboto",
          fontWeight: "normal",
          fontSmoothing: "antialiased",
          "::placeholder": {
            color: "rgba(96, 111, 123, 0.5)"
          }
        }
      }
    });
    this.card.mount(this.$el);
  },
  methods: {
    createToken() {
      return this.stripe.createToken(this.card).then(result => {
        if (result.error) {
          console.log(result.error);
          // let errorElement = document.getElementById("card-errors");
          // errorElement.textContent = result.error.message;
        } else {
          return result.token;
        }
      });
    }
  }
};
</script>
