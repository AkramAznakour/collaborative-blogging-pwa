<template>
  <div>
    <nav>
      <a c href="#">{{ appName }}</a>

      <div>
        <ul>
          <li>
            <router-link to="/">Home</router-link>
          </li>
          <li>
            <router-link to="/about">About</router-link>
          </li>
        </ul>
        <form v-if="!loggedIn">
          <div>
            <label for="inputEmail">Email:</label>
            <input
              v-validate="'required|' + $formValidator.rules.email"
              id="inputEmail"
              v-model="form.email"
              :error-messages="errors.collect('email')"
              :class="{
                'form-control': true,
                'is-invalid': errors.has('email')
              }"
              data-vv-name="email"
              type="email"
              placeholder="Enter email"
            >
          </div>
          <div>
            <label for="inputPassword">Password:</label>
            <input
              v-validate="$formValidator.rules.password"
              id="inputPassword"
              v-model="form.password"
              :class="{
                'form-control': true,
                'is-invalid': errors.has('password')
              }"
              data-vv-name="password"
              type="password"
              class="form-control mx-2"
              placeholder="Password"
            >
          </div>
          <button type="submit" @click.prevent="submit">
            <span v-if="loading">Loading...</span>
            <span v-else>Sign in</span>
          </button>
          
          <span>or
            <router-link :to="{ name: 'signup' }">Sign up</router-link>
          </span>
        </form>
        <template v-else>
          Hi,
          <b>{{ user.name }}</b>
          .
          <button @click="$router.push({ name: 'profile' })">Profile</button>
          
          <button @click="$actionWithLoading(logout, 'loadingLogout')">
            <span v-if="loadingLogout">Loading...</span>
            <span v-else>Logout</span>
          </button>
        </template>
      </div>
    </nav>

    <verify-email-alert/>

    <div>
      <transition name="router" mode="out-in">
        <router-view/>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";
import VerifyEmailAlert from "@/components/layout/main/VerifyEmail.vue";

export default {
  name: "MainLayout",
  components: { VerifyEmailAlert },
  data: () => ({
    appName: process.env.VUE_APP_TITLE,
    form: {
      email: "test@test.com",
      password: "password"
    },
    loading: false,
    loadingLogout: false
  }),
  computed: {
    ...mapState("auth", ["user"]),
    ...mapGetters("auth", ["token", "loggedIn"])
  },
  methods: {
    async submit() {
      await this.$actionWithLoading(this.signin, "loading", this.form);

      // this.loading = true
      // try {
      //   await this.signin(this.form)
      // } finally {
      //   this.loading = false
      // }
    },
    ...mapActions("auth", ["signin", "logout"])
  }
};
</script>
