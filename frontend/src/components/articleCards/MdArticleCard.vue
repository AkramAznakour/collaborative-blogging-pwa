<template>
  <div class="card border-0 mb-4 box-shadow h-xl-300">
    <div
      :style="{'background-image': 'url(' +imageSrc+ ')'}"
      style="  background-size: cover; background-repeat: no-repeat ; height : 400px;"
    ></div>
    <div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
      <h2 class="h4 font-weight-bold">
        <a
          class="text-dark"
          href="#"
          @click.prevent="$router.push({ name: 'showArticle' ,params:{id:id}})"
        >{{title}}</a>
      </h2>
      <p class="card-text">{{description}}</p>
      <div>
        <small class="d-block">
          <a
            class="text-muted"
            href="#"
            @click.prevent="$router.push({ name: 'author' ,params:{id:author}})"
          >{{author}}</a>
        </small>
        <small class="text-muted">{{date}} &middot; 5 min read</small>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MdArticleCard",
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
    description: String,
    author: String
  }
};
</script>