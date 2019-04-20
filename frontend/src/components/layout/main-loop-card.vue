<template>
  <div>
    <div class="mb-5 d-flex justify-content-between main-loop-card">
      <div class="pr-3">
        <h2 class="mb-1 h4 font-weight-bold">
          <a class="text-dark" href="#">{{ post.title }}</a>
        </h2>
        <!-- <p class="excerpt">{{ post.excerpt | strip_html | strip_newlines | truncate: 186}}</p> -->
        <small class="d-block text-muted">
          In
          <span class="catlist" v-for="category in post.categories" :key="category">
            <a class="text-capitalize text-muted smoothscroll p-1" href="#">{{ category }}</a>
            <span class="sep">,</span>
          </span>
        </small>
        <small class="text-muted">{{ post.date }}</small>
      </div>
      <div v-if="post.image" class="col-md-3 pr-0 text-right">
        <a :href="post.url">
          <img class="w-100" :src="post.image" :alt="post.title">
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      post: {
        title:
          "There are lots of powerful things you can do with the Markdown editor",
        image: "http://localhost:8000/img/1.jpg",
        date: "Feb 04, 2019",
        categories: ["categories1"],
        tags: ["tag1", "tag2", "tag3", "tag4"]
      }
    };
  }
};
</script>
