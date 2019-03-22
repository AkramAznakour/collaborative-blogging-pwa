<template>
  <div v-show="$auth.user && !$auth.user.hasVerifiedEmail" role="alert">
    Please, verify your email. We sent a message there.
    <button @click="resendEmailVerification">
      <span v-if="loading">Loading...</span>
      <span v-else>Resend</span>
    </button>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "MainLayoutVerifyEmail",
  data: () => ({
    loading: false
  }),
  methods: {
    async resendEmailVerification() {
      await this.$actionWithLoading(this.resend);
    },
    ...mapActions("auth/emailVerification", ["resend"])
  }
};
</script>

<style scoped>
</style>
