<template>
  <div v-if="post.id">
    <div class="container">
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
          <article class="article-post">
            <vue-markdown>{{ post.content }}</vue-markdown>
          </article>

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
import VueMarkdown from "vue-markdown";

export default {
  components: { VueMarkdown },
  mounted() {
    console.log("post page");
  },
  data: function() {
    return {
      author: {
        id: 1,
        name: "Akram Aznakour",
        avatar: "avatar1.jpg",
        twitter: "",
        bio:
          "There are lots of powerful things you can do with the Markdown editor"
      },
      post: {
        id: "",
        title:
          "There are lots of powerful things you can do with the Markdown editor",
        image: "1.jpg",
        date: "",
        content:
          'There are lots of powerful things you can do with the Markdown editor. If you\'ve gotten pretty comfortable with writing in Markdown, then you may enjoy some more advanced tips about the types of things you can do with Markdown!\r\n\r\nAs with the last post about the editor, you\'ll want to be actually editing this post as you read it so that you can see all the Markdown code we\'re using.\r\n\r\n\r\n## Special formatting\r\n\r\nAs well as bold and italics, you can also use some other special formatting in Markdown when the need arises, for example:\r\n\r\n+ ~~strike through~~\r\n+ ==highlight==\r\n+ \\*escaped characters\\*\r\n\r\n\r\n## Writing code blocks\r\n\r\nThere are two types of code elements which can be inserted in Markdown, the first is inline, and the other is block. Inline code is formatted by wrapping any word or words in back-ticks, `like this`. Larger snippets of code can be displayed across multiple lines using triple back ticks:\r\n\r\n```\r\n.my-link {\r\n    text-decoration: underline;\r\n}\r\n```\r\n\r\nIf you want to get really fancy, you can even add syntax highlighting using Rouge.\r\n\r\n\r\n![walking]({{ site.baseurl }}/assets/images/8.jpg)\r\n\r\n## Reference lists\r\n\r\nThe quick brown jumped over the lazy.\r\n\r\nAnother way to insert links in markdown is using reference lists. You might want to use this style of linking to cite reference material in a Wikipedia-style. All of the links are listed at the end of the document, so you can maintain full separation between content and its source or reference.\r\n\r\n## Full HTML\r\n\r\nPerhaps the best part of Markdown is that you\'re never limited to just Markdown. You can write HTML directly in the Markdown editor and it will just work as HTML usually does. No limits! Here\'s a standard YouTube embed code as an example:\r\n\r\n<p><iframe style="width:100%;" height="315" src="https://www.youtube.com/embed/Cniqsc9QfDo?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></p>',
        topic: "topic1",
        topic_id: 1,
        previous: {
          id: 2,
          title: "There are lots of powerful things",
          image: "1.jpg"
        },
        next: {
          id: 1,
          title: "There are lots of powerful things",
          image: "1.jpg"
        }
      }
    };
  },
  methods: {
    async fetchPost() {
      let { id, title, content, image, timestamps } = await this.$get(
        "posts/" + this.$route.params.id
      );

      const res = this.$get("posts/" + this.$route.params.id);
      console.log(res);

      /* 
      this.post.id = id;
      this.post.title = title;
      this.post.content = content;
      this.post.date = timestamps;
      this.post.image = image; */
    }
  },
  mounted() {
    this.fetchPost();
  },
  updated() {
    this.fetchPost();
  },
  filters: {
    imageWatcher: function(imgName) {
      return process.env.VUE_APP_BACKEND_IMG_PATH + imgName;
    }
  }
};
</script>
