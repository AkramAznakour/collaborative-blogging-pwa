<template>
  <div class="d-flex flex-column" style="height: 100%;">
    <!-------------------------------------- NAVBAR --------------------------------------->
    <nav class="topnav navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#" @click.prevent="$router.push({ name: 'home' })">
          <strong>{{ appName }}</strong>
        </a>
        <button
          class="navbar-toggler collapsed"
          type="button"
          data-toggle="collapse"
          data-target="#navbarColor02"
          aria-controls="navbarColor02"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarColor02" style>
          <ul class="navbar-nav mr-auto d-flex align-items-center">
            <li class="nav-item">
              <a class="nav-link" href="#" @click.prevent="$router.push({ name: 'home' })">
                Intro
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                href="#"
                @click.prevent="$router.push({ name: 'article' })"
              >Culture</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" @click.prevent="$router.push({ name: 'article' })">Tech</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                href="#"
                @click.prevent="$router.push({ name: 'article' })"
              >Politics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" @click.prevent="$router.push({ name: 'article' })">Health</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                href="#"
                @click.prevent="$router.push({ name: 'article' })"
              >Collections</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" @click.prevent="$router.push({ name: 'about' })">About</a>
            </li>
          
          </ul>
          <ul class="navbar-nav ml-auto d-flex align-items-center">
            <template v-if="!loggedIn" class="form-inline">
              <li class="nav-item">
                <a
                  href="#"
                  class="nav-link"
                  @click.prevent="$router.push({ name: 'signin' })"
                >Login in</a>
              </li>
              <li class="nav-item highlight">
                <a
                  href="#"
                  class="nav-link"
                  @click.prevent="$router.push({ name: 'signup' })"
                >Sign up</a>
              </li>
            </template>
            <template v-else>
              <li class="nav-item pr-3">
                <b>{{ user.name }}</b>
              </li>
              <li class="nav-item pr-3">
                <a href @click.prevent="$router.push({ name: 'profile' })">
                  <img
                    class="rounded-circle shadow"
                    src="../assets/img/demo/avatar2.jpg"
                    width="40"
                  >
                </a>
              </li>

              <li class="nav-item highlight">
                <a
                  href="#"
                  class="nav-link"
                  @click.prevent="$actionWithLoading(logout, 'loadingLogout')"
                >
                  <span v-if="loadingLogout">Loading...</span>
                  <span v-else>Logout</span>
                </a>
              </li>
            </template>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div
      class="container d-flex align-items-center justify-content-center pt-5"
      style="height: 100%;"
    >
      <transition name="router" mode="out-in">
        <router-view/>
      </transition>
    </div>

    <!--------------------------------------
FOOTER
    --------------------------------------->
    <div class="container mt-5">
      <footer class="bg-white border-top p-3 text-muted small">
        <div class="row align-items-center justify-content-between">
          <div>
            <span class="navbar-brand mr-2">
              <strong>ColabBlogin</strong>
            </span> Copyright &copy;
       
          </div>
          <div>
          
          </div>
        </div>
      </footer>
    </div>
    <!-- End Footer -->

    <!--------------------------------------
JAVASCRIPTS
    --------------------------------------->
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
