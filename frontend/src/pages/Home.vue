<template>
  <div>
    <!------- HEADER    ------->
    <div class="container">
      <LgArticleCard/>
    </div>
    <!------- MAIN -------->

    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="col-lg-6">
          <MdArticleCard/>
        </div>
        <div class="col-lg-6">
          <div class="flex-md-row mb-4 box-shadow h-xl-300">
            <SmArticleCard/>
            <SmArticleCard/>
            <SmArticleCard/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";

import Auth from "@/components/auth/Auth.vue";
import SmArticleCard from "@/components/articleCards/SmArticleCard.vue";
import MdArticleCard from "@/components/articleCards/MdArticleCard.vue";
import LgArticleCard from "@/components/articleCards/LgArticleCard.vue";

export default {
  name: "Home",
  components: { Auth, SmArticleCard, MdArticleCard, LgArticleCard },
  data: () => ({
    users: [],
    loading: false
  }),
  computed: {
    ...mapState("auth", ["user"]),
    ...mapGetters("auth", ["loggedIn"])
  },
  watch: {
    loggedIn(val) {
      if (val) this.fetchUsers();
    }
  },
  mounted() {
    if (this.loggedIn) this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      this.loading = true;
      this.users = await this.$get("users");
      this.loading = false;
    }
  }
};
</script>
