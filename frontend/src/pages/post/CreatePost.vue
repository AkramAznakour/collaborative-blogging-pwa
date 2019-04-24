<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div>
          <h4 class="font-weight-bold spanborder">
            <span>Write a new post</span>
          </h4>
          <form class="mt-4 w-100 clearfix">
            <div class="form-group">
              <label for="title">Title :</label>
              <input
                id="title"
                required
                v-model="form.title"
                type="text"
                class="form-control"
                placeholder="Enter title"
              >
            </div>

            <div class="form-group">
              <label for="content">Image :</label>

              <div class="custom-file">
                <input
                  type="file"
                  class="custom-file-input"
                  ref="file"
                  v-on:change="handleFileUpload()"
                >
                <label class="custom-file-label" for="validatedCustomFile">Choose Image...</label>
              </div>
            </div>
            <div class="form-group">
              <label for="topic">Tpoc :</label>
              <input
                id="topic"
                required
                v-model="form.topic"
                type="text"
                class="form-control"
                placeholder="Enter title"
              >
            </div>

            <div class="form-group">
              <label for="content">Content :</label>
              <mavon-editor
                v-model="form.contentPreRender"
                ref="md"
                :ishljs="true"
                language="en"
                @save="save"
              />
            </div>
            <button type="submit" class="btn btn-primary float-right" @click.prevent="submit">
              <span v-if="loading">Loading...</span>
              <span v-else>Submit your post</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

 

<script>
import { mapActions } from "vuex";
import { vp } from "@/tools/helpers";
export default {
  name: "CreatePost",
  data: function() {
    return {
      form: {
        title: "",
        contentPreRender: "",
        content: "",
        image: null,
        topic: "my topic"
      },
      loading: false
    };
  },
  methods: {
    async save(value, render) {
      this.form.content = render;
    },
    handleFileUpload() {
      this.form.image = this.$refs.file.files[0];
    },
    async submit() {
      this.loading = true;
      var form_data = new FormData();

      for (var key in this.form) {
        if (key != "image") form_data.append(key, this.form[key]);
      }

      if (this.form.image)
        form_data.append("image", this.form.image, this.form.image.fileName);

      const { post_id, message } = await this.$post("posts/", form_data);

      vp.$notify.error(message);

      this.$router.push({ name: "show-post", params: { id: post_id } });

      this.loading = false;
    },
    ...mapActions("posts", ["addPost"])
  }
};
</script>
