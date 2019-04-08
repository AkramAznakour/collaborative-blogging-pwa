<template>
  <div class="d-flex flex-column" style="height: 100%;">
    <AppNavBar/>

    <div class="container d-flex align-items-center justify-content-center pt-5">
      <transition name="router" mode="out-in">
        <router-view/>
      </transition>
    </div>

    <AppFooter/>
    <!-- End Footer -->
  </div>
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";
import VerifyEmailAlert from "@/components/layout/main/VerifyEmail.vue";
import AppNavBar from "@/components/layout/AppNavBar.vue";
import AppFooter from "@/components/layout/AppFooter.vue";

export default {
  name: "MainLayout",
  components: { AppFooter, AppNavBar },
  data: () => ({
    appName: process.env.VUE_APP_TITLE,
    loading: false,
    loadingLogout: false
  })
};
</script>
