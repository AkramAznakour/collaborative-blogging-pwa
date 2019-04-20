<template>
  <form
    class="bd-search hidden-sm-down"
    onSubmit="return lunr_search(document.getElementById('lunrsearch').value);"
  >
    <input
      type="text"
      class="form-control text-small"
      id="lunrsearch"
      name="q"
      value
      placeholder="Type keyword and enter..."
    >
  </form>
</template>

<script>
export default {};
</script>