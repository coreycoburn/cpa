<template>
  <div
    class="flex flex-col w-full mr-6 bg-white p-6 border-t-4 border-green shadow text-center"
    :class="boxWidth"
  >
    <h3 class="mb-4 text-center">Acceptance of <span class="capitalize">{{ type }}</span></h3>
    <p class="flex-1 text-left">
      To accept the terms of the above {{ type }}, please click the "sign {{ type }}" button below.
    </p>
    <portal to="sign-target">
      <button
        class="justify-end bg-green hover:bg-green-dark text-white text-sm tracking-wide uppercase font-bold py-3 px-6 mx-6 rounded"
        @click="openModal"
      >
        Sign {{ type }}
      </button>
    </portal>

    <button
      class="justify-end bg-green hover:bg-green-dark text-white text-sm tracking-wide uppercase font-bold py-3 px-6 mx-6 rounded"
      @click="openModal"
    >
      Sign {{ type }}
    </button>

    <sweet-modal
      ref="modal"
      :title="modalSignTitle"
      blocking
      overlay-theme="dark"
      hide-close-button
    >
      <div class="text-left">
        <div>
            <p>
              I, {{ firstName }} {{ lastName }}, accept the terms and conditions outlined in {{ type }} #{{ contract }}.” By signing in the box and clicking "<span class="uppercase">I accept</span>", I am securing C.P.A. Valet services based on {{ type }} #{{ contract }}.
            </p>
            <p>
              Please refer to the {{ type }} for our cancellation policy.
            </p>
            <p>
              If there are changes to your event that will impact this {{ type }}, return to this page to request a revision.
            </p>
        </div>



        <div class="bg-blue-lightest border-l-4 border-blue text-blue-dark px-4 py-1 mb-3" role="alert">
          <div class="font-bold capitalize my-2 text-md">
            How to Write Your Signature:
          </div>
          <div class="flex">
            <div class="mr-3 mb-2">
              <svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M528 0H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h192l-16 48h-72c-13.3 0-24 10.7-24 24s10.7 24 24 24h272c13.3 0 24-10.7 24-24s-10.7-24-24-24h-72l-16-48h192c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zm-16 352H64V64h448v288z"/></svg>
            </div>
            <div>
              Left-click and hold down your mouse while dragging to draw your signature.
            </div>
          </div>
          <div class="flex">
            <div class="mr-3 mb-2 pl-1 pr-1">
              <svg class="h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M272 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h224c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM160 480c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm112-108c0 6.6-5.4 12-12 12H60c-6.6 0-12-5.4-12-12V60c0-6.6 5.4-12 12-12h200c6.6 0 12 5.4 12 12v312z"/></svg>
            </div>
            <div>
              Draw your signature with your finger.
            </div>
          </div>
        </div>
        <cpa-canvas
          canvas="signature"
          class="bg-grey-lighter shadow border-b-4 border-black"
          :width="canvasW"
          :height="canvasH"
        />
        <div class="text-sm mb-2">
            X Sign above line
        </div>
        <div class="text-sm">
          {{ firstName }} {{ lastName }} on {{ today }}
        </div>
        <transition name="fade">
          <div class="bg-red-lightest border-l-4 border-red text-red-dark p-2 mt-3" role="alert" v-if="signatureIsEmpty && submitAttempt">
            <span class="text-sm">You must sign in the above box to complete.</span>
          </div>
        </transition>
      </div>
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
            class="bg-transparent border border-blue text-blue hover:bg-blue hover:border-none hover:text-white text-xs tracking-wide uppercase font-bold py-2 px-4 mr-3 rounded sm:text-sm sm:py-3 sm:px-6"
            :class="{ 'cursor-not-allowed': processing }"
            :disabled="processing"
            @click="signaturePad.clear()"
          >
            Clear
          </button>
          <button
            class="bg-green hover:bg-green-dark text-white text-xs tracking-wide uppercase font-bold py-2 px-4 rounded sm:text-sm sm:py-3 sm:px-6"
            :class="{ 'cursor-not-allowed': processing }"
            :disabled="processing"
            @click="submit"
          >
            <div v-show="!processing">I Accept</div>
            <hollow-dots-spinner
              :animation-duration="1000"
              :dot-size="15"
              :dots-num="3"
              :color="'#fff'"
              v-show="processing"
            />
          </button>
      </div>

    </sweet-modal>

    <sweet-modal
      ref="completedModal"
      :title="modalSignedTitle"
      blocking
      overlay-theme="dark"
      hide-close-button
      icon="success"
    >
      <div class="text-left">
        <p>Thank you! We have received your signed {{ type }}. An email confirmation has been sent to <em>{{ this.email }}</em> with your signed {{ type }}.</p>
        <div class="text-center">
          <button
            class="flex items-center bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 mb-6 rounded no-underline"
            @click="download"
          >
            <div class="fill-current mr-3">
              <svg class="h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M640 352c0 70.692-57.308 128-128 128H144C64.471 480 0 415.529 0 336c0-62.773 40.171-116.155 96.204-135.867A163.68 163.68 0 0 1 96 192c0-88.366 71.634-160 160-160 59.288 0 111.042 32.248 138.684 80.159C409.935 101.954 428.271 96 448 96c53.019 0 96 42.981 96 96 0 12.184-2.275 23.836-6.415 34.56C596.017 238.414 640 290.07 640 352zm-246.627-64H328V176c0-8.837-7.164-16-16-16h-48c-8.836 0-16 7.163-16 16v112h-65.373c-14.254 0-21.393 17.234-11.314 27.314l105.373 105.373c6.248 6.248 16.379 6.248 22.627 0l105.373-105.373c10.08-10.08 2.941-27.314-11.313-27.314z"/></svg>
            </div>
            <div>
              Download Signed Contract
            </div>
          </button>
          <h3>Deposit</h3>
          <p>A deposit of $1,000 is due by ##/##/####. If you prefer to pay your deposit at another time, an email has been sent to you with a link to pay your deposit.</p>
          <button
            class="flex items-center bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 mb-6 rounded no-underline"
            @click="payDeposit"
          >
            <div class="fill-current mr-3">
              <svg class="h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M113.411 169.375c0-23.337 21.536-38.417 54.865-38.417 26.726 0 54.116 12.263 76.461 28.333 5.88 4.229 14.13 2.354 17.575-4.017l23.552-43.549c2.649-4.898 1.596-10.991-2.575-14.68-24.281-21.477-59.135-34.09-91.289-37.806V12c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v49.832c-58.627 13.29-97.299 55.917-97.299 108.639 0 123.533 184.765 110.81 184.765 169.414 0 19.823-16.311 41.158-52.124 41.158-30.751 0-62.932-15.88-87.848-35.887-5.31-4.264-13.082-3.315-17.159 2.14l-30.389 40.667c-3.627 4.854-3.075 11.657 1.302 15.847 24.049 23.02 59.249 41.255 98.751 47.973V500c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-47.438c65.72-10.215 106.176-59.186 106.176-116.516.001-119.688-184.764-103.707-184.764-166.671z"/></svg>
            </div>
            <div>
              Pay Deposit Now
            </div>
          </button>
        </div>
      </div>
      <button
        slot="button"
        class="bg-green hover:bg-green-dark text-white text-sm tracking-wide uppercase font-bold py-3 px-6 mr-3 rounded"
        @click="closeSignedComplete"
      >
        Close
      </button>
    </sweet-modal>
  </div>
</template>

<script>
import SignaturePad from "signature_pad";
import CpaCanvas from "../Canvas";
import { HollowDotsSpinner } from "epic-spinners";

export default {
  props: {
    data: {
      required: true,
      type: String
    },
    pdf: {
      required: true,
      type: String
    },
    type: {
      required: true,
      type: String
    },
    boxWidth: {
        required: true,
        type: String
    },
    firstName: {
      required: true,
      type: String
    },
    lastName: {
      required: true,
      type: String
    },
    email: {
      required: true,
      type: String
    },
    contract: {
      required: true,
      type: String
    },
    today: {
      required: true,
      type: String
    },
    proposal: {
      required: true,
      type: String
    },
    confirmation: {
      required: true,
      type: String
    },
    event: {
      required: true,
      type: Number
    }
  },
  components: {
    CpaCanvas,
    HollowDotsSpinner
  },
  data() {
    return {
      canvasH: 40,
      canvasW: 100,
      signatureIsEmpty: false,
      processing: false,
      signaturePad: {},
      submitAttempt: false,
    };
  },
  computed: {
    modalSignTitle() {
      return `Sign ${this.type.charAt(0).toUpperCase() + this.type.substr(1)}`;
    },
    modalSignedTitle() {
      return `Signed ${this.type.charAt(0).toUpperCase() + this.type.substr(1)} Received`;
    }
  },
  mounted() {
    const canvas = document.getElementById("signature");
    this.signaturePad = new SignaturePad(canvas);
  },
  methods: {
    async openModal() {
      await this.$refs.modal.open();

      this.canvas();
    },
    canvas() {
      const canvas = document.getElementById("signature");
      const parentElement = canvas.parentElement;

      setTimeout(
        () => {
          this.canvasH = parentElement.clientHeight;
          this.canvasW = parentElement.clientWidth;
        },
        500,
        parentElement
      );
    },
    async submit() {
      this.processing = true;

      if (this.signaturePad.isEmpty()) {
        this.submitAttempt = true;
        this.signatureIsEmpty = true;
        this.processing = false;

        return;
      }

      const data = {
        pdf: this.pdf,
        signature: this.signaturePad.toDataURL(),
        client: this.event,
        type: this.type,
        proposal_id: this.proposal,
        confirmation_id: this.confirmation,
        email: this.email
      };

      try {
        await axios.post("sign", data);

        this.signaturePad.clear();
        this.completed = true;
        this.$refs.modal.close();
        this.$refs.completedModal.open();
      } catch(error) {
        this.errors = error.response.data.errors;
      }

      this.submitAttempt = false;
      this.signatureIsEmpty = false;
      this.processing = false;
    },
    cancel() {
      this.$refs.modal.close();
      this.submitAttempt = false;
      this.signatureIsEmpty = false;
      this.signaturePad.clear();
    },
    download() {
      window.location.href = `${this.pdf}&save=1`;
    },
    payDeposit() {
      window.location.href = `/contract/deposit?data=${this.data}`;
    },
    closeSignedComplete() {
      window.location.replace(`/contract/sign?sign=${this.data}`);
    }
  }
};
</script>
