<template>
  <ul class="navbar-nav ml-auto d-flex align-items-center">
    <template v-if="!loggedIn" class="form-inline">
      <li class="nav-item">
        <a href="#" class="nav-link" @click.prevent="$router.push({ name: 'signin' })">Login in</a>
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
        <a href @click.prevent="$router.push({ name: 'profile',  params: { id: $auth.user.id }})">
          <img class="rounded-circle shadow" :src="avatarImageSrc" width="40" height="40">
        </a>
      </li>

      <li class="nav-item highlight">
        <a href="#" class="nav-link" @click.prevent="$actionWithLoading(logout, 'loadingLogout')">
          <span v-if="loadingLogout">Loading...</span>
          <span v-else>Logout</span>
        </a>
      </li>
    </template>
  </ul>
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";

export default {
  data: function() {
    return {
      loading: false,
      loadingLogout: false
    };
  },
  computed: {
    avatarImageSrc() {
      return process.env.VUE_APP_BACKEND_IMG_PATH + this.$auth.user.avatar;
    },
    ...mapState("auth", ["user"]),
    ...mapGetters("auth", ["token", "loggedIn"])
  },
  methods: {
    ...mapActions("auth", ["signin", "logout"])
  }
};
</script>