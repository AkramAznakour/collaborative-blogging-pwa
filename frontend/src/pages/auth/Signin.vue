<template>
  <div>
    <h1>Sign in</h1>
    <router-link to="/">🡄 Go back</router-link>
    <br>
    <form>
      <div>
        <label for="signinInputEmail">Email:</label>
        <input
          v-validate="'required|' + $formValidator.rules.email"
          id="signinInputEmail"
          v-model="form.email"
          :error-messages="errors.collect('email')"
          :class="{
            'form-control': true,
            'is-invalid': errors.has('email')
          }"
          data-vv-name="email"
          type="email"
          class="form-control"
          placeholder="Enter email"
        >
        <div
          :class="{ 'validation-feedback': true, 'invalid-feedback': errors.has('email') }"
        >{{ errors.first('email') }}</div>
      </div>
      <div>
        <label for="signinInputPassword">Password:</label>
        <input
          v-validate="$formValidator.rules.password"
          id="signinInputPassword"
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
      <button :disabled="!!errors.items.length" type="submit" @click.prevent="submit">
        <span v-if="loading">Loading...</span>
        <span v-else>Sign in</span>
      </button>
      
      <span>
        <router-link :to="{ name: 'forgot-password' }">Forgot password?</router-link>
        <br>
        <router-link :to="{ name: 'signup' }">Sign up</router-link>
      </span>
    </form>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "Signin",
  data: () => ({
    form: {
      email: "",
      password: ""
    },
    loading: false
  }),
  methods: {
    async submit() {
      if (await this.$formValidator.validate(this.form)) {
        this.loading = true;
        try {
          await this.signin(this.form);
        } finally {
          this.loading = false;
        }
      }
    },
    ...mapActions("auth", ["signin"])
  }
};
</script>
