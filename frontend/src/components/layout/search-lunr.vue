<template>
  <form class="bd-search hidden-sm-down">
    <input
      v-model="query"
      type="text"
      class="form-control text-small"
      id="lunrsearch"
      v-on:keydown.enter.prevent="onSubmit"
      placeholder="Type a user name"
    >
  </form>
</template>

<script>
export default {
  data: function() {
    return {
      query: ""
    };
  },
  methods: {
    onSubmit() {
      this.$router.push({ name: "search-user", params: { name: this.query } });
    }
  }
};
</script>