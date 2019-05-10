<template>
  <div>
    <div class="mb-5 d-flex justify-content-between main-loop-card">
      <div class="pr-3">
        <h2 class="mb-1 h4 font-weight-bold">
          <a
            class="text-dark"
            href
            @click.prevent="$router.push({ name: 'show-post', params: { id: post.id } })"
            post
          >{{ post.title }}</a>
          <star-rating
            :star-size="20"
            :glow="10"
            :rating="post.rating"
            :show-rating="false"
            :border-width="0"
            :read-only="true"
            :rounded-corners="true"
          ></star-rating>
        </h2>
        <p class="excerpt" v-html="post.excerpt"></p>
        <small class="d-block text-muted">
          In
          <span class="catlist">
            <a
              class="text-capitalize text-muted smoothscroll p-1"
              href
              @click.prevent="$router.push({ name: 'show-topic', params: { id: post.topic_id } })"
            >{{ post.topic }}</a>
          </span>
        </small>

        <small class="text-muted">{{ post.date }}</small>
      </div>
      <div v-if="post.image" class="col-md-3 pr-0 text-right">
        <a href @click.prevent="$router.push({ name: 'show-post', params: { id: post.id } })">
          <img class="w-100" :src="post.image | imageWatcher" :alt="post.title">
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";

export default {
  components: { StarRating },

  props: {
    post: {
      type: Object
    }
  },
  filters: {
    imageWatcher: function(imgName) {
      return process.env.VUE_APP_BACKEND_IMG_PATH + imgName;
    }
  }
};
</script>
