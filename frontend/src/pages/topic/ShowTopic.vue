<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
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
    return {
      featureds: [],
      topic: {},
      posts: []
    };
  },
  methods: {
    async fetchTpoicsData() {
      this.$get("topics/" + this.$route.params.id)
        .then(data => {
          console.log(data);
          this.featureds = data.featureds;
          this.topic = data.topic;
          this.posts = data.posts;
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.fetchTpoicsData();
  },
  filters: {
    avatarWatch: function(imgName) {
      return process.env.VUE_APP_BACKEND_IMG_PATH + imgName;
    }
  },
  watch: {
    $route(to, from) {
      this.fetchTpoicsData();
    }
  }
};
</script>
