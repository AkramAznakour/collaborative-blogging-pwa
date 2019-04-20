<template>
  <div id="app">
    <div v-if="loggedIn && tokenExpired">
      <h1>Loading...</h1>
    </div>
    <router-view v-else/>
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
  async mounted() {
    await this.$store.dispatch("auth/init");
    if (this.loggedIn && this.tokenExpired) {
      localStorage.clear();
      this.$router;
    }
  }
};
</script>

 

