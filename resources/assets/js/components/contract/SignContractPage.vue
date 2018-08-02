<template>
  <div class="container mx-auto">
    <div class="flex flex-col md:flex-row mb-8">
      <cpa-sign
        :data="data"
        :pdf="pdf"
        :type="type"
        :box-width="(signedCount === 0) ? 'md:w-1/3' : 'md:w-1/2'"
        :first-name="firstName"
        :last-name="lastName"
        :email="email"
        :contract="contract"
        :today="today"
        :confirmation="confirmation"
        :proposal="proposal"
        :event="event"
      />

      <cpa-revise
        :type="type"
        :box-width="(signedCount === 0) ? 'md:w-1/3' : 'md:w-1/2'"
        :contract="contract"
        :contract-id="contractId"
        :email="email"
      >
        For corrections / changes to the above {{ type }}, please click the button below.
      </cpa-revise>

      <cpa-decline
        :type="type"
        :event-id="event"
        :contract-id="contractId"
        :email="email"
        :officeContact="officeContact"
        v-if="signedCount === 0"
      />
    </div>
  </div>
</template>

<script>
import CpaSign from "./Sign";
import CpaDecline from "./Decline";

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
    today: {
      required: true,
      type: String
    },
    type: {
      required: true,
      type: String
    },
    contract: {
      required: true,
      type: String
    },
    event: {
      required: true,
      type: Number
    },
    contractId: {
      required: true,
      type: Number
    },
    proposal: {
      required: true,
      type: String
    },
    confirmation: {
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
    officeContact: {
      required: true,
      type: String
    },
    signedCount: {
      required: true,
      type: Number
    }
  },
  components: {
    CpaSign,
    CpaDecline
  },
  methods: {
    cancelChanges() {
      this.$refs.changesModal.close();
    }
  }
};
</script>
