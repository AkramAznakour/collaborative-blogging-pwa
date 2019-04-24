<template>
  <form class="bd-search hidden-sm-down">
    <input
      v-model="query"
      type="text"
      class="form-control text-small"
      id="lunrsearch"
      v-on:keydown.enter.prevent="submit"
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
    submit() {
      this.$router.push({ name: "search", params: { name: this.query } });
    }
  },
  watch: {
    query: function(val) {
      if (this.$route.name == "search")
        this.$router.push({ name: "search", params: { name: this.query } });
    }
  }
};
</script>