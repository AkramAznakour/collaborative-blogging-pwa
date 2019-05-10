<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="font-weight-bold title h2 text-uppercase mb-4">Topics</h1>

        <div v-if="topics.length > 0" v-for="(topic, index) in topics" :key="index">
          <h4 class="font-weight-bold h3 spanborder text-capitalize">
            <a href @click.prevent="$router.push({ name: 'show-topic', params: { id: topic.id } })">
              <span>{{ topic.name }}</span>
            </a>
          </h4>

          <MainLoopCard v-if="topic.post !=null" :post="topic.post"/>
        </div>
      </div>

      <div class="col-md-4">
        <SidebarFeatured v-if="featureds" :posts="featureds"/>
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
      topics: []
    };
  },
  methods: {
    async fetchTpoicsData() {
      this.$get("topics/")
        .then(data => {
          console.log(data);
          this.topics = data.topics;
          this.featureds = data.featureds;
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
