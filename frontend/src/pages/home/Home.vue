<template>
  <div class="container">
    <!-- Begin post excerpts, let's highlight the first 4 posts on top -->
    <div class="row remove-site-content-margin">
      <!-- latest post -->

      <div class="col-md-6">
        <div class="card border-0 mb-4 box-shadow">
          <a
            href
            @click.prevent="$router.push({ name: 'show-post',  params: { id: latest_post.id }})"
          >
            <div
              :style="{'background-image': 'url(' + BACKEND_IMG_PATH + latest_post.image   + ')'}"
              style="  background-size: cover; background-repeat: no-repeat ; height : 200px;"
            ></div>
          </a>
          <div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
            <h2 class="h4 font-weight-bold">
              <a
                class="text-dark"
                href
                @click.prevent="$router.push({ name: 'show-post',  params: { id: latest_post.id }})"
              >{{ latest_post.title }}</a>
            </h2>
            <star-rating
              :star-size="25"
              :glow="10"
              v-model="latest_post.rating"
              :show-rating="false"
              :border-width="0"
              :read-only="true"
              :rounded-corners="true"
            ></star-rating>
            <p class="excerpt">{{ latest_post.excerpt }}</p>
            <div>
              <small class="d-block text-muted">
                In
                <span class="catlistread-only">
                  <a
                    class="text-capitalize text-muted smoothscroll p-1"
                    href="#"
                  >{{ latest_post.topic }}</a>
                  <span class="sep">,</span>
                </span>
              </small>
              <small class="text-muted">{{ latest_post.date }}</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <!-- second latest posts -->
        <div
          class="mb-3 d-flex align-items-center"
          v-for="(second_post,index) in second_posts"
          :key="index"
        >
          <div v-if="second_post.image" class="col-md-4">
            <a
              href
              @click.prevent="$router.push({ name: 'show-post',  params: { id: second_post.id }})"
            >
              <img class="w-100" :src="second_post.image | imageUrlFilter" :alt="second_post.title">
            </a>
          </div>

          <div>
            <h2 class="mb-2 h6 font-weight-bold">
              <a
                class="text-dark"
                href
                @click.prevent="$router.push({ name: 'show-post',  params: { id: second_post.id }})"
              >{{ second_post.title }}</a>
            </h2>
            <star-rating
              :star-size="20"
              :glow="10"
              v-model="second_post.rating"
              :show-rating="false"
              :border-width="0"
              :read-only="true"
              :rounded-corners="true"
            ></star-rating>
            <small class="d-block text-muted">
              In
              <span class="catlist">
                <a
                  @click.prevent="$router.push({ name: 'topic',  params: { id: second_post.topic_id }})"
                  class="text-capitalize text-muted smoothscroll p-1"
                  href="#"
                >{{ second_post.topic }}</a>
                <span class="sep">,</span>
              </span>
            </small>
            <small class="text-muted">{{ second_post.date }}</small>
          </div>
        </div>
      </div>
    </div>

    <!--   <div>
      <div
        class="jumbotron jumbotron-fluid jumbotron-home pt-0 pb-0 mb-2rem bg-lightblue position-relative"
      >
        <div class="pl-4 pr-0 h-100 tofront">
          <div class="row justify-content-between">
            <div class="col-md-6 pt-6 pb-6 pr-lg-4 align-self-center">
              <h1 class="mb-3">{{jumbotron_post.title}}</h1>
              <p class="mb-3 lead">{{ jumbotron_post.excerpt }}</p>
              <a
                href
                @click.prevent="$router.push({ name: 'show-post',  params: { id: jumbotron_post.id }})"
                class="btn btn-dark"
              >Read More</a>
            </div>
            <div
              :style="{'background-image': 'url(' + BACKEND_IMG_PATH + jumbotron_post.image  + ')'}"
              style="background-size:cover"
              class="col-md-6 d-none d-md-block pr-0"
            ></div>
          </div>
        </div>
      </div>
    </div>-->
    <!--endif page url is / -->

    <!-- Now the rest of the posts with the usual loop but with an offset:4 on the first page so we can skeep the first 4 posts displayed above -->

    <div class="row mt-3">
      <div class="col-md-8 main-loop">
        <h4 class="font-weight-bold spanborder">
          <span>All Stories</span>
        </h4>
        <MainLoopCard v-for="(post , index) in posts" :key="index" :post="post"/>
      </div>

      <div class="col-md-4">
        <SidebarFeatured :posts="featureds"/>
      </div>
    </div>
  </div>
</template>

<script>
import SidebarFeatured from "@/components/layout/sidebar-featured.vue";
import MainLoopCard from "@/components/layout/main-loop-card.vue";
import StarRating from "vue-star-rating";

export default {
  name: "Home",
  components: { SidebarFeatured, MainLoopCard, StarRating },
  data: () => ({
    BACKEND_IMG_PATH: process.env.VUE_APP_BACKEND_IMG_PATH,
    latest_post: {},
    second_posts: [],
    posts: [],
    jumbotron_post: {}
  }),

  methods: {
    async fetchUserData() {
      this.$get("home/")
        .then(data => {
          console.log(data);
          this.latest_post = data.latest_post;
          this.second_posts = data.second_posts;
          this.posts = data.posts;
          this.featureds = data.featureds;
          this.jumbotron_post = data.posts[0];
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
    imageUrlFilter: function(imgName) {
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
