<template>
  <div>
    <h4 class="font-weight-bold spanborder">
      <span>General Account settings</span>
    </h4>
    <form>
      <div class="form-group">
        <label for="profileInputCurrentName">name:</label>
        <input id="profileInputCurrentName" v-model="form.name" type="text" class="form-control">
        <div
          :class="{ 'validation-feedback': true, 'invalid-feedback': errors.has('name') }"
        >{{ errors.first('name') }}</div>
      </div>
      <div class="form-group">
        <label for="profileInputEmail">email:</label>
        <input
          v-validate="$formValidator.rules.email"
          id="profileInputEmail"
          data-vv-name="email"
          v-model="form.email"
          :class="{
            'form-control': true,
            'is-invalid': errors.has('email')
          }"
          type="email "
          class="form-control"
        >
        <div
          :class="{ 'validation-feedback': true, 'invalid-feedback': errors.has('email') }"
        >{{ errors.first('email') }}</div>
      </div>
      <div class="form-group">
        <label for="profileInputBio">email:</label>
        <textarea
          id="profileInputBio"
          v-model="form.bio"
          :class="{
            'form-control': true,
            'is-invalid': errors.has('bio')
          }"
          type="test"
          class="form-control"
        ></textarea>
        <div
          :class="{ 'validation-feedback': true, 'invalid-feedback': errors.has('bio') }"
        >{{ errors.first('bio') }}</div>
      </div>

      <button
        :disabled="!!errors.items.length"
        type="submit"
        class="btn btn-primary float-right"
        @click.prevent="submit"
      >
        <span v-if="loading">Loading...</span>
        <span v-else>Change name</span>
      </button>
    </form>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data: function() {
    return {
      form: {
        name: this.$auth.user.name,
        email: this.$auth.user.email,
        bio: this.$auth.user.bio
      },
      loading: false
    };
  },
  methods: {
    async submit() {
      await this.$actionWithLoading(this.setUserData, "loading", this.form);
    },
    ...mapActions("profile", ["setUserData"])
  }
};
</script>
