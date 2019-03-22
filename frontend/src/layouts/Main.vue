<template>
  <div>
    <nav>
      <router-link to="/">{{ appName }}</router-link>
      <div>
        <router-link to="/">Home</router-link>

        <router-link to="/about">About</router-link>

        <template v-if="!loggedIn">
          <router-link class="signin" :to="{ name: 'signin' }">Sign in</router-link>
          <router-link class="signup" :to="{ name: 'signup' }">Sign up</router-link>
        </template>
        <template v-else>
          <b>{{ user.name }}</b>
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
        <router-view class="container"/>
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

<style lang="scss" scoped>
nav {
  box-shadow: 0 2px 2px -2px gray;
  padding: 1rem;
  * {
    text-decoration: none;
    display: inline;
    padding: 0 1rem;
  }
  div {
    float: right;
    box-sizing: border-box;
    a {
      color: #03a87c;
    }
    .signup {
      border: 1px #03a87c solid;
      border-radius: 4px;
      padding: 0.2rem 1rem;
      &:hover {
        background-color: #03a87c;
        color: white;
      }
    }
  }
}

.container {
  width: 90%;
  padding: 1rem;
  margin: 0 auto;
}
</style>
