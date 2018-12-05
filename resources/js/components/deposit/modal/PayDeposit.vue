<template>
  <div>
    <form action="#" method="POST" @submit.prevent>
      <div id="deposit-form" class="flex">
        <div class="text-left normal-case w-2/5 mr-8">
          <div class="flex flex-col">
            <div
              class="border-2 p-3 mb-3 rounded cursor-pointer"
              :class="{ 'border-green-light': paymentAmtType === 'deposit'  }"
              @click="selectAmount(currentDue, 'deposit')"
            >
              <div class="text-xl">
                {{ inDollars(currentDue) }}
              </div>
              <div class="text-sm">
                Deposit Due Balance
              </div>
            </div>

            <div
              class="border-2 p-3 mb-3 rounded cursor-pointer"
              :class="{ 'border-green-light': paymentAmtType === 'total'  }"
              @click="selectAmount(estimatedTotalDue, 'total')"
            >
              <div class="text-xl">
                {{ inDollars(estimatedTotalDue) }}
              </div>
              <div class="text-sm">
                Estimated Total Balance
              </div>
            </div>

            <div
              class="border-2 p-3 rounded cursor-pointer"
              :class="{ 'border-green-light': paymentAmtType === 'custom'  }"
              @click="selectAmount(depositPayment, 'custom')"
            >
              <div class="text-sm">
                <div class="font-bold">
                  Custom Amount
                </div>
                <div>Choose this option if you would like to split up your payments.</div>
              </div>
              <div v-if="customShow" class="mb-3">
                <app-input
                  inputType="number"
                  formClass="bg-grey-lightest text-grey-darkest shadow border-2 border-grey-lightest focus:outline-none focus:bg-blue-lightest focus:border-blue-light"
                  field="customAmt"
                  title=""
                  help="Amount to pay"
                  v-model.number="depositPayment"
                />
              </div>
            </div>

          </div>
        </div>
        <div class="w-3/5">
          <div class="mb-4 w-full">
            <app-input
              formClass="bg-grey-lightest text-grey-darkest shadow border-2 border-grey-lightest focus:outline-none focus:bg-blue-lightest focus:border-blue-light"
              field="name"
              title="Full Name"
              v-model="form.name"
              :errors="errors"
              :required=true
            />
          </div>
          <div class="mb-4 w-full">
            <label
              class="block text-grey-darker text-sm font-bold mb-2"
              for="cc"
            >
              Credit Card
              <span class="text-red text-xs">*</span>
            </label>
            <credit-card-input ref="ccInput" class="block appearance-none rounded w-full py-2 px-3 text-grey-darker bg-grey-lightest leading-tight shadow border-2 border-grey-lightest"/>
          </div>
        </div>
      </div>

      <div class="text-right pt-6 mt-6 border-t border-grey-lighter">
        <button
          class="bg-transparent border border-orange text-orange hover:bg-orange hover:border-none hover:text-white text-xs tracking-wide uppercase font-bold py-2 px-4 mr-3 rounded sm:text-sm sm:py-3 sm:px-6"
          @click="cancel"
        >
          Cancel
        </button>
        <button
          class="bg-green hover:bg-green-dark text-white text-sm tracking-wide uppercase font-bold py-3 px-6 mr-3 rounded"
          :class="[
            { 'cursor-not-allowed': processing},
            { 'cursor-not-allowed opacity-50': (depositPayment === 0 || !depositPayment) }

          ]"
          :disabled="processing"
          @click="submit"
          >
          <div v-show="!processing">Submit Payment</div>
          <hollow-dots-spinner
            :animation-duration="1000"
            :dot-size="15"
            :dots-num="3"
            :color="'#fff'"
            v-show="processing"
          />
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import AppInput from "../../Input";
import CreditCardInput from "../../CreditCardInput";
import { HollowDotsSpinner } from "epic-spinners";

export default {
  props: {
    currentDue: {
      type: Number,
      required: true
    },
    estimatedTotalDue: {
      type: Number,
      required: true
    }
  },
  store: {
    currentlyDue: "deposits.currentlyDue",
    depositPayment: "deposits.payment",
    modalOpen: "modals.open"
  },
  components: {
    AppInput,
    CreditCardInput,
    HollowDotsSpinner
  },
  created() {
    this.depositPayment = this.currentDue;
  },
  data() {
    return {
      form: {
        name: ""
      },
      errors: [],
      processing: false,
      customShow: false,
      paymentAmtType: "deposit"
    };
  },
  methods: {
    selectAmount(amount, amtType) {
      this.depositPayment = amount;
      this.paymentAmtType = amtType;

      if (amtType === "custom") {
        this.customShow = true;

        return;
      }

      this.customShow = false;
    },
    inDollars(amount) {
      return Number(amount).toLocaleString("en-US", {
        style: "currency",
        currency: "USD"
      });
    },
    submit() {
      this.processing = true;

      this.$refs.ccInput.createToken().then(token => {
        if (token.type === "validation_error") {
          this.processing = false;
          return;
        }

        console.log(token);

        const response = axios
          .post("/contract/deposit", {
            name: this.form.name,
            payment_token: token.id,
            amount: this.depositPayment * 100
          })
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            this.errors = error.response.data.errors;
          });
      });

      this.processing = false;
    },
    cancel() {
      this.modalOpen = false;
    }
  }
};
</script>
