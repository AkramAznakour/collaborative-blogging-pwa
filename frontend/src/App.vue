<template>
  <div id="app">
    <!-- if need to refresh token before doing requests, if token expired then tokenNeedToRefresh === true -->
    <div v-if="loggedIn && tokenExpired">
      <h1>Loading...</h1>ddd
    </div>
    <router-view v-else/>
    <!--v-else-if="(loggedIn && user) || !loggedIn"-->
  </div>
</template>

<style lang="sass">

</style>

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
