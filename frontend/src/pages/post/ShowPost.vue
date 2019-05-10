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
                    @click.prevent="$router.push({ name: 'show-topic', params: { id: post.topic_id } })"
                  >{{ post.topic }}</a>
                  <span class="sep">,</span>
                </span>
              </p>
              <h1 class="display-4 mb-4 article-headline">{{ post.title }}</h1>
              <a href @click.prevent="$router.push({ name: 'profile', params: { id: author.id} })">
                <div class="d-flex align-items-center">
                  <img
                    class="rounded-circle"
                    style="height:100px;width:100px"
                    :src=" author.avatar | imageUrlFilter"
                    :alt="author.name"
                    width="70"
                  >

                  <small class="ml-3">
                    {{ author.name }}
                    <span
                      class="text-muted d-block mt-1"
                    >{{ post.date }} · {{post.readingTime}}</span>
                  </small>
                </div>
              </a>
            </div>

            <div v-if="post.image " class="col-md-6 pr-0 align-self-center">
              <img class="rounded" :src="post.image| imageUrlFilter" :alt="post.title">
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
            <div class="text-muted"></div>
            <div class="share d-inline-block">
              <!-- AddToAny BEGIN -->
              <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <star-rating
                  :star-size="25"
                  :glow="10"
                  v-model="post.rating"
                  :rating="post.rating"
                  :show-rating="false"
                  :border-width="0"
                  :read-only="$auth.user == null"
                  @rating-selected="setPostRating"
                  :rounded-corners="true"
                ></star-rating>
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
                style="height:100px;width:100px"
                :src="author.avatar  | imageUrlFilter"
                :alt="author.name"
                width="90"
              >
            </div>
            <div class="col-md-10">
              <h5 class="font-weight-bold">
                <a
                  href
                  @click.prevent="$router.push({ name: 'profile', params: { id: author.id} })"
                >Written by {{ author.name }}</a>
              </h5>
              {{ author.bio }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Aletbar Prev/Next -->
    <div>
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
                :src="post.previous.image  | imageUrlFilter"
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
                :src="post.next.image  | imageUrlFilter"
              >
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- comments -->
    <div class="row pt-5">
      <div class="container">
        <h4 class="font-weight-bold spanborder">
          <span>Comments</span>
        </h4>
          <div  v-if="comments.length == 0" class="container text-center"  >
            <h6>no comments</h6>
          </div>
        <div
          class="mb-5 row d-flex justify-content-between main-loop-card"
          v-for="(comment, index) in comments"
          :key="index"
        >
          <div class="col-md-2 pr-0 text-right">
            <img
              class="rounded-circle"
              style="height:100px;width:100px"
              :src="comment.author.image | imageUrlFilter"
              :alt="comment.author.name"
            >
          </div>

          <div class="pr-3 col-md-10">
            <h4 class="mb-1 h4 font-weight-bold">
              <a class="text-black-50">{{comment.author.name}}</a>
            </h4>
            <h2 class="mb-1 h4 font-weight-bold">
              <span class="text-dark">{{ comment.title }}</span>
            </h2>

            <p class="excerpt" v-html="comment.content"></p>

            <small class="text-muted">{{ post.date }}</small>
          </div>
        </div>
      </div>
    </div>

    <!-- comments -->
    <div class="row pt-5" v-if="$auth.user !=null">
      <div class="container">
        <h4 class="font-weight-bold spanborder">
          <span>Add comment</span>
        </h4>
        <div class="mb-5 row d-flex justify-content-between main-loop-card container">
          <form class="mt-4 w-100 clearfix">
            <div class="form-group">
              <label for="title">Title :</label>
              <input
                id="title"
                required
                v-model="newComment.title"
                type="text"
                class="form-control"
                placeholder="Enter title"
              >
            </div>

            <div class="form-group">
              <label >Content :</label>
              <mavon-editor
                v-model="newComment.contentPreRender"
                ref="md"
                :ishljs="true"
                language="en"
                @save="save"
              />
            </div>
            <button type="submit" class="btn btn-primary float-right" @click.prevent="submit">
              <span v-if="loading">Loading...</span>
              <span v-else>Submit your post</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import StarRating from "vue-star-rating";
import  {vp}  from '@/tools/helpers'

export default {
  components: { StarRating },

  data: function() {
    return {
      loading: false,
      author: {},
      post: {
        previous: {},
        next: {}
      },
      comments: [],
      newComment: {
        title: "",
        content: "",
        contentPreRender: ""
      }
    };
  },
  methods: {
    async submit() {
      this.loading = true;

      this.$post("addComment/" + this.post.id, this.newComment)
        .then(data => {
           this.comments.push(data.comment);
          this.newComment.title = "";
          this.newComment.content = "";
          this.newComment.contentPreRender = "";
        })
        .catch(e => {
          console.log(e);
        });


      this.loading = false;
    },
    async save(value, render) {
      this.newComment.content = render;
    },
    async setPostRating(rating) {
      this.$get("rate/" + this.post.id + "/" + rating)
        .then(data => {
             vp.$notify.succes(data.message);
        })
        .catch(e => {
          console.log(e);
        });

     },
    async fetchPostData() {
      this.$get("posts/" + this.$route.params.id)
        .then(data => {
          this.post = data.post;
           this.author = data.author;
        })
        .catch(e => {
          console.log(e);
        });

      this.$get("getComments/" + this.$route.params.id)
        .then(data => {
           this.comments = data.comments;
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
    imageUrlFilter: function(imgName) {
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
