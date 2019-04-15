<template>
  <div class="jumbotron jumbotron-fluid mb-3 pt-0 pb-0 bg-lightblue position-relative">
    <div class="pl-4 pr-0 h-100 tofront">
      <div class="row justify-content-between">
        <div class="col-md-6 pt-6 pb-6 align-self-center">
          <h1 class="secondfont mb-3 font-weight-bold">{{title}}</h1>
          <small class="d-block">
            <a
              class="text-muted"
              href="#"
              @click.prevent="$router.push({ name: 'author' ,params:{id:author}})"
            >{{author}}</a>
          </small>
          <p class="mb-3">{{description}}</p>

          <a
            href="#"
            @click.prevent="$router.push({ name: 'article' ,params:{id:id}})"
            class="btn btn-primary"
          >Read More</a>
        </div>
        <div
          class="col-md-6 d-none d-md-block pr-0"
          :style="{'background-image': 'url(' +imageSrc+ ')'}"
          style="  background-size: cover; background-repeat: no-repeat ; height : 400px;"
        ></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LgArticleCard",
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