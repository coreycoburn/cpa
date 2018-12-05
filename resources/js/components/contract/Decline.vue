<template>
  <div class="flex flex-col w-full md:w-1/3 mr-3 bg-white p-6 border-t-4 border-red-light shadow text-center">
    <h3 class="mb-4 text-center">Not Interested</h3>
    <p class="flex-1 text-left">
      If you are no longer interested in services from C.P.A. Valet for this event, please let us know by clicking "not interested" below.
    </p>
    <button
      class="justify-end bg-transparent border border-red-light text-red-light hover:bg-red-light hover:text-white hover:border-none text-sm tracking-wide uppercase font-bold py-3 px-6 mx-6 rounded"
      @click="$refs.modal.open()"
    >
      Not Interested
    </button>

    <sweet-modal
      ref="modal"
      title="Not Interested"
      blocking
      overlay-theme="dark"
      hide-close-button
    >
      <div class="text-left normal-case">
        <div class="bg-orange-lightest border-l-4 border-orange text-orange-dark px-4 py-1" role="alert">
          <p class="font-bold capitalize">
            <span class="capitalize">{{ type }}</span> Can Be Modified
          </p>
          <p class="text-xs">
            Note that the {{ type }} can be modified to best suite your service needs / budget.
          </p>

          <button
            class="mb-2"
            @click="cancel"
          >
              <portal-target name="toggle-revision"/>
          </button>
        </div>
        <p>
          To help keep us competitive, please let us know why you are no longer interested.
        </p>
        <div class="mt-3">
            <app-textarea
            formClass="bg-grey-lighter text-grey-darkest shadow"
            field="message"
            title="Comments"
            help="Please add feedback here..."
            v-model="form.message"
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
            <div v-show="!processing">Submit</div>
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
      ref="modalConfirm"
      title="Not Interested"
      blocking
      overlay-theme="dark"
      hide-close-button
    >
      <div class="text-left normal-case">
        Thank you for your time. We hope you will consider us for your next event. Please don't hesitate to reach out to us at <a :href="`mailto:${officeContact}`">{{ officeContact }}</a> if you have any questions or concerns regarding the {{ type }}.
      </div>
      <button
        slot="button"
        class="bg-green hover:bg-green-dark text-white text-sm tracking-wide uppercase font-bold py-3 px-6 mr-3 rounded"
        @click="closeDeclineConfirm"
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
    eventId: {
      required: true,
      type: Number
    },
    contractId: {
      required: true,
      type: Number
    },
    email: {
      required: true,
      type: String
    },
    officeContact: {
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
      processing: false
    };
  },
  methods: {
    cancel() {
        this.$refs.modal.close();
        this.form.message = '';
    },
    async submit() {
      this.processing = true;
      try {
        const data = {
            message: this.form.message,
            type: this.type,
            'event_id': this.eventId,
            'contract_id': this.contractId,
            email: this.email,
            'office_contact': this.officeContact
        };

        await axios.post("decline", data);

        this.processing = false;
      } catch (error) {
        this.processing = false;

        return;
      }

      this.form.message = '';
      this.$refs.modal.close();
      this.$refs.modalConfirm.open();
    },
    closeDeclineConfirm() {
        location.replace("/");
    }
  }
};
</script>
