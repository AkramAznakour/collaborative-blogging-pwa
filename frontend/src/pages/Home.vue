<template>
  <div class="row">
    <!------- HEADER    ------->
    <div class="container">
      <LgArticleCard
        v-for="i in [1]"
        :key="i"
        :id="i"
        :title="article.title"
        :date="article.date"
        :author="article.author"
        :description="article.description"
        :imgFileName="article.imgSource"
      />
    </div>
    <!------- MAIN -------->
    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="col-lg-6">
          <MdArticleCard
            v-for="i in [1]"
            :key="i"
            :id="i"
            :title="article.title"
            :date="article.date"
            :author="article.author"
            :description="article.description"
            :imgFileName="article.imgSource"
          />
        </div>
        <div class="col-lg-6">
          <div class="flex-md-row mb-4 box-shadow h-xl-300">
            <SmArticleCard
              v-for="i in [1,2,3,4,5]"
              :key="i"
              :id="i"
              :title="article.title"
              :date="article.date"
              :author="article.author"
              :imgFileName="article.imgSource"
            />
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
    loading: false,
    article: {
      id: "1",
      title: "Nasa's IceSat space laser makes height maps of Earth",
      date: "Dec 12",
      imgSource: "blog4.jpg",
      description:
        "Researchers have found an effective target in the brain for electrical stimulation to improve mood in people suffering from depression.",
      author: "Jake Bittle in LOVE/HATE"
    }
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
