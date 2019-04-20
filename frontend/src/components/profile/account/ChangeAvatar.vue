<template>
  <div>
    <h4 class="font-weight-bold spanborder">
      <span>Change Avatar</span>
    </h4>

    <form>
      <label for="avatarInput">
        <img
          style="cursor :pointer"
          :alt="$auth.user.name"
          :src="avatarImageSrc"
          class="rounded-circle"
          height="100"
          width="100"
        >
      </label>
      <input
        style="display:none"
        type="file"
        id="avatarInput"
        ref="file"
        v-on:change="handleFileUpload()"
      >

      <button type="submit" class="btn btn-primary float-right" @click.prevent="submit">
        <span v-if="loading">Loading...</span>
        <span v-else>Change avatar</span>
      </button>
    </form>
  </div>
</template>
<script>
import { mapActions } from "vuex";

export default {
  data: () => ({
    form: {
      avatar: null
    },
    loading: false
  }),
  computed: {
    avatarImageSrc() {
      return process.env.VUE_APP_BACKEND_IMG_PATH + this.$auth.user.avatar;
    }
  },
  methods: {
    handleFileUpload() {
      this.form.avatar = this.$refs.file.files[0];
    },
    async submit() {
      let formData = new FormData();
      formData.append("avatar", this.form.avatar, this.form.avatar.fileName);
      await this.$actionWithLoading(this.setAvatar, "loading", formData);
    },
    ...mapActions("profile", ["setAvatar"])
  }
};
</script>
