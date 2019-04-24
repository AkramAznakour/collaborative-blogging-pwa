<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8" v-for="(topic, index) in topics" :key="index">
        <h1 class="font-weight-bold title h6 text-uppercase mb-4">Topics</h1>
        <h4 class="font-weight-bold spanborder text-capitalize">
          <span>{{ topic.name }}</span>
        </h4>

        <MainLoopCard v-for="(post, index) in posts" :post="post" :key="index"/>
      </div>

      <div class="col-md-4">
        <SidebarFeatured :posts="featureds"/>
      </div>
    </div>
  </div>
</template>
<script>
import MainLoopCard from "@/components/layout/main-loop-card.vue";
import SidebarFeatured from "@/components/layout/sidebar-featured.vue";
export default {
  name: "Topic",
  components: { MainLoopCard, SidebarFeatured },
  data: function() {
    return {};
  },
  methods: {
    async fetchTopicData() {
      let { id, title, content, image, timestamps } = await this.$get(
        "posts/" + this.$route.params.id
      );
    }
  },
  mounted() {
    this.fetchTopicData();
  },
  filters: {
    imageWatcher: function(imgName) {
      return process.env.VUE_APP_BACKEND_IMG_PATH + imgName;
    }
  },
  watch: {
    $route(to, from) {
      this.fetchTopicData();
    }
  }
};
</script>
