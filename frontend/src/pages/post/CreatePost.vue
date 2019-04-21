<template>
  <div>
    <mavon-editor v-model="handbook" ref="md" :ishljs="true" language="en" @save="save"/>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "CreatePost",
  data: function() {
    return {
      handbook: "#### how to use mavonEditor in nuxt.js"
    };
  },
  methods: {
    async save(value, render) {
      console.log("value :", value);
      console.log("render :", render);
      let form = {
        title: " akram aznakour title",
        content: value,
        image: "1.jpg",
        user_id: this.$auth.user.id,
        topic_id: 1
      };
      await this.$actionWithLoading(this.addPost, "loading", form);
    },

    ...mapActions("posts", ["addPost"])
  }
};
</script>
