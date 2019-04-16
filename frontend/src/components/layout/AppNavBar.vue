<template>
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
          <li class="nav-item" v-for="item in navItems" v-bind:key="item">
            <a class="nav-link" href="#" @click.prevent="$router.push({ name: 'article' })">{{item}}</a>
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
              <a href="#" class="nav-link" @click.prevent="$router.push({ name: 'signup' })">Sign up</a>
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
                  src="http://localhost:8000/img/avatar2.jpg"
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
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";
export default {
  name: "AppNavBar",
  data: () => ({
    appName: process.env.VUE_APP_TITLE,
    loading: false,
    loadingLogout: false,
    navItems: [
      "Intro",
      "Culture",
      "Tech",
      "Politics",
      "Health",
      "Collections",
      "About"
    ]
  }),
  computed: {
    ...mapState("auth", ["user"]),
    ...mapGetters("auth", ["token", "loggedIn"])
  },
  methods: {
    ...mapActions("auth", ["signin", "logout"])
  }
};
</script>
