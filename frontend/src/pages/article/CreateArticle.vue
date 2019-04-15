<template>
  <div>
    <mavon-editor
      :toolbars="markdownOption"
      v-model="handbook"
      ref="md"
      language="en"
      @imgAdd="$imgAdd"
      @imgDel="$imgDel"
    />
  </div>
</template>

<script>
export default {
  name: "Article",
  data: function() {
    return {
      handbook: "#### how to use mavonEditor in nuxt.js"
    };
  },
  methods: {
    // bind @imgAdd event
    $imgAdd(pos, $file) {
      // step 1. upload image to server.
      var formdata = new FormData();
      formdata.append("image", $file);
      axios({
        url: "server url",
        method: "post",
        data: formdata,
        headers: { "Content-Type": "multipart/form-data" }
      }).then(url => {
        // step 2. replace url ![...](0) -> ![...](url)
        $vm.$img2Url(pos, url);
      });
    }
  }
};
</script>
