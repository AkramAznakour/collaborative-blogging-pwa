<template>
  <div class="mb-3 d-flex align-items-center">
    <img height="80" :src="imageSrc">
    <div class="pl-3">
      <h2 class="mb-2 h6 font-weight-bold">
        <a
          class="text-dark" href="#"
          @click.prevent="$router.push({ name: 'article' ,params:{id:id}})"
        >{{title}}</a>
      </h2>
      <div class="card-text text-muted small"></div>
      <small class="text-muted">{{date}} &middot; 5 min read</small>
    </div>
  </div>
</template>

<script>
export default {
  name: "SmArticleCard",
  data: function() {
    return {
      imageSrc: process.env.VUE_APP_BACKEND_IMG_PATH + this.imgFileName
    };
  },
  props: {
    id: Number,
    title: String,
    date: String,
    imgFileName: String,
    author: String
  }
};
</script>
