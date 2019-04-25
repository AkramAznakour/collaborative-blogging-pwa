<template>
  <div class="container" v-if="profile.id">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="row align-items-center mb-5">
          <div class="col-md-9">
            <h2 class="font-weight-bold">
              {{profile.name}}
              <span class="small btn btn-outline-success btn-sm btn-round">
                <a v-if="profile.id != $auth.user.id" href @click="follow">Follow</a>
                <a
                  v-else
                  href
                  @click.prevent="$router.push({ name: 'account-settings' })"
                >Edit Account</a>
              </span>
            </h2>
            <p v-if="profile.site">
              <a href="profile.site">{{ profile.site }}</a>
            </p>
            <p class="excerpt">{{ profile.bio }}</p>
          </div>
          <div class="col-md-3 text-right">
            <img
              :alt="profile.name"
              :src="profile.avatar| avatarWatch"
              class="rounded-circle"
              height="100"
              width="100"
            >
          </div>
        </div>
        <h4 class="font-weight-bold spanborder">
          <span>Posts by {{profile.name}}</span>
        </h4>
        <MainLoopCard v-for="(post, index) in posts" :post="post" :key="index"/>
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
      profile: {
        id: "",
        name: "",
        site: "",
        avatar: "",
        bio: ""
      },
      posts: []
    };
  },
  methods: {
    async follow() {},
    async fetchUserData() {
      this.$get("users/" + this.$route.params.id)
        .then(data => {
          this.profile = data.user;
        })
        .catch(e => {
          console.log(e);
        });

      this.$get("user-posts/" + this.$route.params.id)
        .then(data => {
          console.log(data);

          this.posts = data.posts;
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.fetchUserData();
  },
  filters: {
    avatarWatch: function(imgName) {
      return process.env.VUE_APP_BACKEND_IMG_PATH + imgName;
    }
  }
};
</script>
