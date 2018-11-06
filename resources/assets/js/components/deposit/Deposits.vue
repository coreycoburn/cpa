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
                v-for="{ id, payment_made_in_dollars, formatted_payment_created } in payments"
                :key="id"
                class="text-md"
              >
                <span class="font-bold">{{ inDollars(payment_made_in_dollars) }}</span> on {{ formatted_payment_created }}
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
          @click="depositModalOpen"
        >
          Make a Payment
        </button>
      </div>
    </div>

    <sweet-modal
      ref="modalPay"
      :title="modalTitle"
      blocking
      overlay-theme="dark"
      hide-close-button
    >
      <pay-deposit
        :current-due="currentDue"
        :estimated-total-due="estimatedTotalDue"
      />
    </sweet-modal>
  </div>
</template>

<script>
import PayDeposit from "./modal/PayDeposit";
import AppRadio from "../Radio";

export default {
  store: {
    currentlyDue: "deposits.currentlyDue",
    depositPayment: "deposits.payment",
    modalOpen: "modals.open"
  },
  components: {
    PayDeposit,
    AppRadio
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
    estimatedTotal: {
      required: true,
      type: Number
    },
    payments: {
      type: Array
    }
  },
  mounted() {
    //this.$refs.modalPay.open();
  },
  computed: {
    modalTitle() {
      return `Make a Deposit Payment of <span class="text-green text-3xl">${this.inDollars(
        this.depositPayment
      )}</span>`;
    },
    paymentsSum() {
      return this.payments.reduce(
        (accum, payment) => accum + payment.payment_made_in_dollars,
        0
      );
    },
    estimatedTotalDue() {
      return this.estimatedTotal - this.paymentsSum;
    },
    currentDue() {
      return this.originalDue - this.paymentsSum;
    }
  },
  methods: {
    inDollars(amount) {
      return Number(amount).toLocaleString("en-US", {
        style: "currency",
        currency: "USD"
      });
    },
    depositModalOpen() {
      this.$refs.modalPay.open();
      this.modalOpen = true;
    }
  },
  watch: {
    modalOpen() {
      if (this.modalOpen === false) {
        this.$refs.modalPay.close();
      }
    }
  }
};
</script>
