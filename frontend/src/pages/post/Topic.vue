<template></template>
<script>
export default {
  name: "topic",
  components: { VueMarkdown },
  mounted() {
    console.log("post page");
  },
  data: function() {
    return {
      author: {
        name: "Akram Aznakour",
        avatar: "http://localhost:8000/img/avatar1.jpg",
        twitter: "",
        bio:
          "There are lots of powerful things you can do with the Markdown editor"
      },
      post: {
        id: "",
        title:
          "There are lots of powerful things you can do with the Markdown editor",
        image: "http://localhost:8000/img/1.jpg",
        date: "",
        content:
          'There are lots of powerful things you can do with the Markdown editor. If you\'ve gotten pretty comfortable with writing in Markdown, then you may enjoy some more advanced tips about the types of things you can do with Markdown!\r\n\r\nAs with the last post about the editor, you\'ll want to be actually editing this post as you read it so that you can see all the Markdown code we\'re using.\r\n\r\n\r\n## Special formatting\r\n\r\nAs well as bold and italics, you can also use some other special formatting in Markdown when the need arises, for example:\r\n\r\n+ ~~strike through~~\r\n+ ==highlight==\r\n+ \\*escaped characters\\*\r\n\r\n\r\n## Writing code blocks\r\n\r\nThere are two types of code elements which can be inserted in Markdown, the first is inline, and the other is block. Inline code is formatted by wrapping any word or words in back-ticks, `like this`. Larger snippets of code can be displayed across multiple lines using triple back ticks:\r\n\r\n```\r\n.my-link {\r\n    text-decoration: underline;\r\n}\r\n```\r\n\r\nIf you want to get really fancy, you can even add syntax highlighting using Rouge.\r\n\r\n\r\n![walking]({{ site.baseurl }}/assets/images/8.jpg)\r\n\r\n## Reference lists\r\n\r\nThe quick brown jumped over the lazy.\r\n\r\nAnother way to insert links in markdown is using reference lists. You might want to use this style of linking to cite reference material in a Wikipedia-style. All of the links are listed at the end of the document, so you can maintain full separation between content and its source or reference.\r\n\r\n## Full HTML\r\n\r\nPerhaps the best part of Markdown is that you\'re never limited to just Markdown. You can write HTML directly in the Markdown editor and it will just work as HTML usually does. No limits! Here\'s a standard YouTube embed code as an example:\r\n\r\n<p><iframe style="width:100%;" height="315" src="https://www.youtube.com/embed/Cniqsc9QfDo?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></p>',
        topic: ["topic1", "topic2", "topic3", "topic4"],
        previous: {
          title: "There are lots of powerful things",
          image: "http://localhost:8000/img/1.jpg",
          url: "./"
        },
        next: {
          title: "There are lots of powerful things",
          image: "http://localhost:8000/img/1.jpg",
          url: "./"
        }
      }
    };
  },
  methods: {
    async fetchPost() {
      let { id, title, content, image, timestamps } = await this.$get(
        "posts/" + this.$route.params.id
      );
      this.post.id = id;
      this.post.title = title;
      this.post.content = content;
      this.post.date = timestamps;
      this.post.image = image;
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
