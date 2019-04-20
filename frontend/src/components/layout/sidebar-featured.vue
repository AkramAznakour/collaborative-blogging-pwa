<template>
  <div class="sticky-top sticky-top-offset">
    <h4 class="font-weight-bold spanborder">
      <span>Featured</span>
    </h4>
    <ol class="list-featured">
      <div v-for="(post, index) in site.tags.featured" :key="index">
        <li class="mb-4">
          <span>
            <h6 class="font-weight-bold">
              <a href="#" class="text-dark">{{ post.title }}</a>
            </h6>
            <span class="d-block text-muted">
              In
              <span class="catlist" v-for="category in post.categories" :key="category">
                <a class="text-capitalize text-muted smoothscroll p-1" href="#">{{ category }}</a>
                <span class="sep">,</span>
              </span>
            </span>
          </span>
        </li>
      </div>
    </ol>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      site: {
        tags: {
          featured: [
            {
              title: "There are lots of powerful things you can",
              categories: ["categories1", "categories2"],
              url: ""
            },
            {
              title: "There are lots of powerful things you can",
              categories: ["categories1", "categories2"],
              url: ""
            },
            {
              title: "There are lots of powerful things you can",
              categories: ["categories1", "categories2"],
              url: ""
            }
          ]
        }
      }
    };
  }
};
</script>
