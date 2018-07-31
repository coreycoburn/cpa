<template>
  <div
    class="flex flex-col w-full mr-6 bg-white p-6 border-t-4 border-orange shadow text-center"
    :class="boxWidth"
  >
    <h3 class="mb-4 text-center">Request Changes</h3>
    <p class="flex-1 text-left">
      <slot/>
    </p>
    <button
      class="justify-end bg-orange hover:bg-orange-dark text-white text-sm tracking-wide uppercase font-bold py-3 px-6 mx-6 rounded"
      @click="$refs.modal.open()"
    >
      Revise {{ type }}
    </button>

    <portal to="toggle-revision">
        <button
            class="bg-orange hover:bg-orange-dark text-white text-xs tracking-wide uppercase font-bold py-2 px-4 rounded"
            @click="openModalFromDecline"
        >
            Revise {{ type }}
        </button>
    </portal>

    <sweet-modal
      class="capitalize"
      ref="modal"
      title="Request Change"
      blocking
      overlay-theme="dark"
      hide-close-button
    >
      <div class="text-left normal-case">
        <p>
          Please let us know what you would like changed to the {{ type }}.
        </p>
        <div class="mt-3">
          <app-textarea
            formClass="bg-grey-lighter text-grey-darkest shadow"
            field="message"
            title="Comments"
            help="Please describe what you would like revised..."
            v-model="form.message"
            :errors="errors"
            :required=true
          />
        </div>
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
            class="bg-green hover:bg-green-dark text-white text-xs tracking-wide uppercase font-bold py-2 px-4 rounded sm:text-sm sm:py-3 sm:px-6"
            :class="{ 'cursor-not-allowed': processing }"
            :disabled="processing"
            @click="submit"
          >
            <div v-show="!processing">Revise {{ type }}</div>
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
      class="capitalize"
      ref="successModal"
      title="Change Request Received"
      blocking
      overlay-theme="dark"
      icon="success"
      hide-close-button
    >
        <p class="normal-case">
            We have received your request for changes to {{ type }} #{{ contract }}. We will review the change request and will respond to your request shortly.
        </p>
        <button
            slot="button"
            class="bg-green hover:bg-green-dark text-white text-sm tracking-wide uppercase font-bold py-3 px-6 mr-3 rounded"
            @click="$refs.successModal.close()"
        >
            Close
        </button>
    </sweet-modal>
  </div>
</template>

<script>
import AppTextarea from "../Textarea";
import { HollowDotsSpinner } from "epic-spinners";

export default {
  props: {
    type: {
      required: true,
      type: String
    },
    contract: {
      required: true,
      type: String
    },
    contractId: {
      required: true,
      type: Number
    },
    email: {
      required: true,
      type: String
    },
    boxWidth: {
        required: true,
        type: String
    }
  },
  components: {
    AppTextarea,
    HollowDotsSpinner
  },
  data() {
    return {
      form: {
        message: ""
      },
      errors: [],
      processing: false
    };
  },
  methods: {
    openModalFromDecline() {
      this.$nextTick(() => {
          this.$refs.modal.open();
      });
    },
    cancel() {
      this.$refs.modal.close();
      this.errors = {};
      this.form.message = '';
    },
    async submit() {
      this.processing = true;
      try {
        const data = {
            message: this.form.message,
            type: this.type,
            'contract_id': this.contractId,
            email: this.email
        };
        await axios.post("revise", data);

        this.processing = false;
      } catch (error) {
        this.processing = false;
        this.errors = error.response.data.errors;

        return;
      }

        this.form.message = '';
        this.$refs.modal.close();
        this.$refs.successModal.open();
    }
  }
};
</script>
