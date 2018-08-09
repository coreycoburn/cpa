<template>
  <div>
    <div class="flex">
      <div class="w-2/3 mr-16">
        <p>Dear {{ clientName }},</p>
        <p>
          In order to keep our services secured for your {{ eventType }} on {{ eventDate }}, please make a payment of <span class="font-bold ">{{ inDollars(currentDue) }}</span> by <span class="italic">{{ dueDate }} <span class="text-sm">({{ dueDateHumans }})</span></span>.
        </p>
        <template v-if="payments.length !== 0">
          <div class="bg-white shadow rounded-b p-8 border-t-4 mt-8 border-green">
            <h4 class="text-green mb-4">Payments Received: {{ inDollars(paymentsSum) }}</h4>
            <ul class="list-reset">
              <li
                v-for="{ id, amount, formatted_payment_created } in payments"
                :key="id"
                class="text-md"
              >
                <span class="font-bold">{{ inDollars(amount) }}</span> on {{ formatted_payment_created }}
              </li>
            </ul>
          </div>
        </template>
      </div>
      <div class="w-1/3">
        <h3>Deposit Balance:</h3>
        <div class="text-2xl mb-6">
          {{ inDollars(currentDue) }}
        </div>
        <button
          class="justify-end bg-green hover:bg-green-dark text-white text-sm tracking-wide uppercase font-bold py-3 px-6 mb-8 rounded"
          @click="$refs.modalPay.open()"
        >
          Make a Payment
        </button>
      </div>
    </div>

    <sweet-modal
      ref="modalPay"
      title="Make a Deposit Payment"
      blocking
      overlay-theme="dark"
      hide-close-button
    >
      <div class="text-left normal-case">
        Please choose the amount that you would like to pay at this time.
      </div>
      <form action="/charge" method="post" id="payment-form">
        <app-input
          field="card_number"
          title="Card Number"
          v-model="form.card_number"
          :errors="errors"
          :required=true
        />
      </form>
      <div class="text-right pt-6 mt-6 border-t border-grey-lighter">
        <button
          class="bg-transparent border border-orange text-orange hover:bg-orange hover:border-none hover:text-white text-xs tracking-wide uppercase font-bold py-2 px-4 mr-3 rounded sm:text-sm sm:py-3 sm:px-6"
          :class="{ 'cursor-not-allowed': processing }"
          :disabled="processing"
          @click="cancel"
        >
          Cancel
        </button>
        <button
          class="bg-green hover:bg-green-dark text-white text-sm tracking-wide uppercase font-bold py-3 px-6 mr-3 rounded"
          @click="submit"
          >
          Submit Payment
        </button>
      </div>
    </sweet-modal>
  </div>
</template>

<script>
  import AppInput from '../Input';

  export default {
    store: {
      currentlyDue: 'deposits.currentlyDue'
    },
    components: {
      AppInput
    },
    props: {
      clientName: {
        required: true,
        type: String
      },
      eventType: {
        required: true,
        type: String
      },
      eventDate: {
        required: true,
        type: String
      },
      dueDate: {
        required: true,
        type: String
      },
      dueDateHumans: {
        required: true,
        type: String
      },
      originalDue: {
        required: true,
        type: Number
      },
      payments: {
        type: Array
      }
    },
    data() {
      return {
        form: {
          'card_number'
        },
        errors: [],
        processing: false,
      }
    },
    mounted() {
      this.$refs.modalPay.open();

    },
    computed: {
      paymentsSum() {
        return this.payments.reduce((accum, obj) => accum + obj.amount, 0);
      },
      currentDue() {
        return this.originalDue - this.paymentsSum;
      }
    },
    methods: {
      inDollars($amount)
      {
        return ($amount / 100).toLocaleString('en-US', { style: 'currency', currency: 'USD' });
      },
      submit() {
        console.log('submitting...');
      },
      cancel() {
        this.$refs.modalPay.close()
      }
    }
  }
</script>

<style scoped>
  .StripeElement {
  background-color: white;
  height: 40px;
  padding: 10px 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
