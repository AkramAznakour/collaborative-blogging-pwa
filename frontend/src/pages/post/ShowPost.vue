<template>
  <div>
    <div v-if="post.id" class="container">
      <div class="jumbotron jumbotron-fluid mb-3 pl-0 pt-0 pb-0 bg-white position-relative">
        <div class="h-100 tofront">
          <div
            v-bind:class="{ 'justify-content-between': post.image, 'justify-content-center': !post.image }"
            class="row"
          >
            <div
              v-bind:class="{ 'col-md-6 ': post.image, 'col-md-8': !post.image }"
              class="pr-0 pr-md-4 pt-4 pb-4 align-self-center"
            >
              <p class="text-uppercase font-weight-bold">
                <span class="catlist">
                  <a
                    class="sscroll text-danger p-1"
                    href
                    @click.prevent="$router.push({ name: 'topic', params: { id: post.topic_id } })"
                  >{{ post.topic }}</a>
                  <span class="sep">,</span>
                </span>
              </p>
              <h1 class="display-4 mb-4 article-headline">{{ post.title }}</h1>
              <div class="d-flex align-items-center">
                <img
                  class="rounded-circle"
                  :src=" author.avatar | imageWatcher"
                  :alt="author.name"
                  width="70"
                >

                <small class="ml-3">
                  {{ author.name }}
                  <span>
                    <a
                      v-if="author.id != $auth.user.id"
                      target="_blank"
                      href
                      @click.prevent="$router.push({ name: 'profile', params: { id: author.id } })"
                      class="btn btn-outline-success btn-sm btn-round ml-1"
                    >Follow</a>
                  </span>
                  <span class="text-muted d-block mt-1">{{ post.date }} · {{post.readingTime}}</span>
                </small>
              </div>
            </div>

            <div v-if="post.image " class="col-md-6 pr-0 align-self-center">
              <img class="rounded" :src="post.image| imageWatcher" :alt="post.title">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-lg pt-4 pb-4">
      <div class="row justify-content-center">
        <!-- Share -->
        <div class="col-lg-2 pr-4 mb-4 col-md-12">
          <div class="sticky-top sticky-top-offset text-center">
            <div class="text-muted">Share this</div>
            <div class="share d-inline-block">
              <!-- AddToAny BEGIN -->
              <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                <a class="a2a_button_facebook"></a>
                <a class="a2a_button_twitter"></a>
              </div>
              <!-- AddToAny END -->
            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-8">
          <!-- Article -->
          <article class="article-post" v-html="post.content"></article>

          <!-- Author Box -->

          <div class="row mt-5">
            <div class="col-md-2 align-self-center">
              <img
                class="rounded-circle"
                :src="author.avatar  | imageWatcher"
                :alt="author.name"
                width="90"
              >
            </div>
            <div class="col-md-10">
              <h5 class="font-weight-bold">
                Written by {{ author.name }}
                <span>
                  <a
                    v-if="author.id != $auth.user.id"
                    target="_blank"
                    href
                    class="btn btn-outline-success btn-sm btn-round ml-2"
                  >Follow</a>
                </span>
              </h5>
              {{ author.bio }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Aletbar Prev/Next -->
    <div class>
      <div class="container">
        <div class="row prevnextlinks small font-weight-bold">
          <div v-if="post.previous.id" class="col-md-6 rightborder pl-0">
            <a
              class="text-dark"
              href
              @click.prevent="$router.push({ name: 'show-post' , params : {id:post.previous.id}})"
            >
              <img
                v-if="post.previous.image"
                height="30px"
                class="mr-1"
                :src="post.previous.image  | imageWatcher"
              >
              {{post.previous.title}}
            </a>
          </div>

          <div v-if="post.next.id" class="col-md-6 text-right pr-0">
            <a
              class="text-dark"
              href
              @click.prevent="$router.push({ name: 'show-post' , params : {id:post.next.id}})"
            >
              {{post.next.title}}
              <img
                v-if="post.next.image"
                height="30px"
                class="ml-1"
                :src="post.next.image  | imageWatcher"
              >
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
//import VueMarkdown from "vue-markdown";

export default {
  components: {},

  data: function() {
    return {
      author: {},
      post: {
        previous: {},
        next: {}
      }
    };
  },
  methods: {
    async fetchPostData() {
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
    this.fetchPostData();
  },
  filters: {
    imageWatcher: function(imgName) {
      return process.env.VUE_APP_BACKEND_IMG_PATH + imgName;
    }
  },
  watch: {
    $route(to, from) {
      this.fetchPostData();
    }
  }
};
</script>
