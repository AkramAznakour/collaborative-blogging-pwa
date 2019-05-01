<template>
  <div class="container" v-if="profile.id">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="row align-items-center mb-5">
          <div class="col-md-9">
            <h2 class="font-weight-bold tag">
              <span
                @click.prevent="$router.push({ name: 'profile', params: { id: author.id } })"
              >{{profile.name}}</span>
              <a
                v-if="profile.id != $auth.user.id"
                @click.prevent="toggleFollow"
                href
                class="btn btn-outline-success btn-sm btn-round ml-1"
              >
                <span v-if="profile.isFollowed">Unfollow</span>
                <span v-else>follow</span>
              </a>
              <span v-else class="small btn btn-outline-success btn-sm btn-round">
                <a href @click.prevent="$router.push({ name: 'account-settings' })">Edit Account</a>
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
              style="height:100px;width:100px"
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
        id: "0",
        name: "",
        site: "",
        avatar: "",
        isFollowed: "",
        bio: ""
      },
      posts: [],
      follower: [],
      following: []
    };
  },
  methods: {
    toggleFollow() {
      this.$get("toggle-follow/" + this.profile.id)
        .then(data => {
          console.log(data);
          if (data.toggleFollow == true)
            this.profile.isFollowed = !this.profile.isFollowed;
        })
        .catch(e => {
          console.log(e);
        });
    },
    async fetchUserData() {
      this.$get("users/" + this.$route.params.id)
        .then(data => {
          this.profile = data.user;
          console.log(data);
        })
        .catch(e => {
          console.log(e);
        });

      this.$get("user-posts/" + this.$route.params.id)
        .then(data => {
          this.posts = data.posts;
          console.log(data);
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
  },
  watch: {
    $route(to, from) {
      this.fetchUserData();
    }
  }
};
</script>
