<template>
  <div>
    <h1 >Enter new password</h1>

    <form autocomplete="on" @submit.prevent="submit" @keydown.enter="submit">
      <div>
        <input
          v-validate="$formValidator.rules.password"
          v-model="form.password"
          :class="{
            'form-control': true,
            'is-invalid': errors.has('password')
          }"
          data-vv-name="password"
          type="password" 
          placeholder="Password"
        >
        <div
          :class="{ 'validation-feedback': true, 'invalid-feedback': errors.has('password') }"
        >{{ errors.first('password') }}</div>
      </div>

      <!--:loading="btnLoading"-->
      <button :disabled="btnDisabled" type="submit">
        <span v-if="btnLoading">Loading...</span>
        <span v-else>Continue</span>
      </button>
    </form>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data: () => ({
    form: {
      password: null
    },
    btnLoading: false,
    passwordShow: true
  }),
  computed: {
    btnDisabled() {
      return !!this.errors.items.length;
    }
  },
  methods: {
    async submit() {
      if (await this.$formValidator.validate(this.form)) {
        const { email, token } = this.$route.params;

        await this.$actionWithLoading(this.resetPassword, "btnLoading", {
          password: this.form.password,
          email,
          token
        });
      }
    },
    ...mapActions("auth/forgotPassword", ["resetPassword"])
  }
};
</script>
