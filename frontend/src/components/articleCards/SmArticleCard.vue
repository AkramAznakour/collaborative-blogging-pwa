<template>
  <div class="mb-3 d-flex align-items-center">
    <img height="80" :src="imageSrc">
    <div class="pl-3">
      <h2 class="mb-2 h6 font-weight-bold">
        <a
          class="text-dark"
          href="#"
          @click.prevent="$router.push({ name: 'article' ,params:{id:id}})"
        >{{title}}</a>
      </h2>
      <div class="card-text text-muted small">
        <a
          class="text-muted"
          href="#"
          @click.prevent="$router.push({ name: 'author' ,params:{id:author}})"
        >{{author}}</a>
      </div>
      <small class="text-muted">
        {{date}} &middot;
        <svg
          v-for="i in Array.from(Array(id).keys())"
          :key="i"
          width="16"
          height="16"
          viewBox="0 0 1792 1792"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M1201 1004l306-297-422-62-189-382-189 382-422 62 306 297-73 421 378-199 377 199zm527-357q0 22-26 48l-363 354 86 500q1 7 1 20 0 50-41 50-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
          ></path>
        </svg>
      </small>
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
