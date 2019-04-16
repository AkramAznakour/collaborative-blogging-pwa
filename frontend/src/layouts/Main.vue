<template>
  <div>
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
import AppNavBar from "@/components/layout/AppNavBar.vue";
import AppFooter from "@/components/layout/AppFooter.vue";

export default {
  name: "MainLayout",
  components: { AppFooter, AppNavBar }
};
</script>
