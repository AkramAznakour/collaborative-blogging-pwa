<template>
  <div class="sticky-top sticky-top-offset">
    <h4 class="font-weight-bold spanborder">
      <span>Featured</span>
    </h4>
    <ol class="list-featured">
      <div v-for="(post, index) in posts" :key="index">
        <li class="mb-4">
          <span>
            <h6 class="font-weight-bold">
              <a
                href
                @click.prevent="$router.push({ name: 'show-post', params: { id: post.id } })"
                class="text-dark"
              >{{ post.title }}</a>
            </h6>
            <span class="d-block text-muted">
              In
              <span class="catlist">
                <a
                  href
                  class="text-capitalize text-muted smoothscroll p-1"
                  @click.prevent="$router.push({ name: 'show-topic', params: { id: post.topic_id } })"
                >{{ post.topic }}</a>
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
  props: {
    posts: {
      type: Array
    }
  }
};
</script>
