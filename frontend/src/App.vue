<template>
  <div id="app">
    <!-- if need to refresh token before doing requests, if token expired then tokenNeedToRefresh === true -->
    <div v-if="loggedIn && tokenExpired">
      <h1>Loading...</h1>
    </div>
    <router-view v-else/>
    <!--v-else-if="(loggedIn && user) || !loggedIn"-->
  </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";

export default {
  data: () => ({}),
  computed: {
    ...mapState("auth", ["user"]),
    ...mapGetters("auth", ["loggedIn", "tokenExpired"])
  },
  async mounted () {
     await this.$store.dispatch('auth/init')
  }
};
</script>


<style lang="scss">
  @import "./styles/main.scss";
</style>
