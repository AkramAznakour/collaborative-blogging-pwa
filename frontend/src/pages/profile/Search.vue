<template>
  <div class="container">
    <h4 class="font-weight-bold spanborder">
      <span>Search results for {{query}}</span>
    </h4>
    <div class="row gap-y listrecent listrecent listauthor">
      <div v-for="(user, index) in users" :key="index" class="col-lg-6 mb-4">
        <div class="p-4 border rounded">
          <div class="row">
            <div class="col-md-3 mb-4 mb-md-0">
              <img
                :alt="user.name"
                :src="user.avatar | imageWatcher"
                class="rounded-circle"
                height="80"
                width="80"
              >
            </div>
            <div class="col-md-9">
              <a href @click.prevent="$router.push({ name: 'profile',  params: { id: user.id }})">
                <h4 class="text-dark mb-0">{{ user.name }}</h4>
                <small class="d-inline-block mt-1 mb-3 font-weight-normal">(View Posts)</small>
                <div class="excerpt">{{ user.bio }}</div>
              </a>
              <div class="icon-block mt-3 d-flex justify-content-between">
                <div>
                  <a target="_blank" href="user.twitte">
                    <i class="fab fa-twitter text-muted" aria-hidden="true"></i>
                  </a> &nbsp;
                  <a target="_blank" href="user.site">
                    <i class="fa fa-globe text-muted" aria-hidden="true"></i>
                  </a> &nbsp;
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MainLoopCard from "@/components/layout/main-loop-card.vue";
export default {
  name: "Profile",
  components: { MainLoopCard },
  data: function() {
    return {
      query: this.$route.params.name,
      users: []
    };
  },
  methods: {
    async fetchUsersData() {
      this.users = await this.$get("search-user/" + this.query);
    }
  },
  mounted() {
    this.fetchUsersData();
  },
  filters: {
    imageWatcher: function(imgName) {
      return process.env.VUE_APP_BACKEND_IMG_PATH + imgName;
    }
  },
  watch: {
    "$route.params.name": function(name) {
      this.query = name;
      this.fetchUsersData();
    }
  }
};
</script>
