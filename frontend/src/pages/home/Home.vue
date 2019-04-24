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
              :style="{'background-image': 'url(' +latest_post.image+ ')'}"
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
            <p class="excerpt">{{ latest_post.excerpt }}</p>
            <div>
              <small class="d-block text-muted">
                In
                <span class="catlist">
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
              <img class="w-100" :src="second_post.image" :alt="second_post.title">
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

    <div v-for="(post, index) in site.posts" :key="index">
      <div
        class="jumbotron jumbotron-fluid jumbotron-home pt-0 pb-0 mb-2rem bg-lightblue position-relative"
      >
        <div class="pl-4 pr-0 h-100 tofront">
          <div class="row justify-content-between">
            <div class="col-md-6 pt-6 pb-6 pr-lg-4 align-self-center">
              <h1 class="mb-3">{{post.title}}</h1>
              <p class="mb-3 lead">{{ post.excerpt }}</p>
              <a
                href
                @click.prevent="$router.push({ name: 'show-post',  params: { id: post.id }})"
                class="btn btn-dark"
              >Read More</a>
            </div>
            <div
              :style="{'background-image': 'url(' +post.image + ')'}"
              style="background-size:cover"
              class="col-md-6 d-none d-md-block pr-0"
            ></div>
          </div>
        </div>
      </div>
    </div>
    <!--endif page url is / -->

    <!-- Now the rest of the posts with the usual loop but with an offset:4 on the first page so we can skeep the first 4 posts displayed above -->

    <div class="row mt-3">
      <div class="col-md-8 main-loop">
        <h4 class="font-weight-bold spanborder">
          <span>All Stories</span>
        </h4>
        <MainLoopCard v-for="i in [1,2,3,5]" :key="i" :post="site.posts[0]"/>
      </div>

      <div class="col-md-4">
        <SidebarFeatured/>
      </div>
    </div>
  </div>
</template>

<script>
import SidebarFeatured from "@/components/layout/sidebar-featured.vue";
import MainLoopCard from "@/components/layout/main-loop-card.vue";

export default {
  name: "Home",
  components: { SidebarFeatured, MainLoopCard },
  data: () => ({
    latest_post: {
      id: 1,
      title: "There are lots of powerful things you can",
      excerpt:
        "There are lots of powerful things you can do with the Markdown editor. If you've gotten pretty comfortable with writing in Markdown, then you may ",
      image: "http://localhost:8000/img/1.jpg",
      excerpt:
        "There are lots of powerful things you can do with the Markdown editor. If you've gotten pretty comfortable with writing in Markdown, then you may ",

      topic: "topic",
      date: "Feb 04, 2019"
    },
    second_posts: [
      {
        id: 1,
        title: "There are lots of powerful things you can",
        image: "http://localhost:8000/img/1.jpg",
        topic: "topic",
        date: "Feb 04, 2019"
      },
      {
        id: 1,
        title: "There are lots of powerful things you can",
        image: "http://localhost:8000/img/1.jpg",
        topic: "topic",
        date: "Feb 04, 2019"
      },
      {
        id: 1,
        title: "There are lots of powerful things you can",
        image: "http://localhost:8000/img/1.jpg",
        topic: "topic",
        date: "Feb 04, 2019"
      }
    ],
    site: {
      posts: [
        {
          id: 1,
          title: "There are lots of powerful things you can",
          image: "http://localhost:8000/img/1.jpg",
          excerpt:
            "There are lots of powerful things you can do with the Markdown editor. If you've gotten pretty comfortable with writing in Markdown, then you may ",
          date: "Feb 04, 2019",
          topic: "topic"
        }
      ]
    }
  }),
  methods: {
    async fetchPostsData() {
      this.$get("posts/" + this.$route.params.id)
        .then(data => {
          this.post = data.post;
          this.author = data.author;
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    this.fetchPostsData();
  },
  filters: {
    imageWatcher: function(imgName) {
      return process.env.VUE_APP_BACKEND_IMG_PATH + imgName;
    }
  }
};
</script>

