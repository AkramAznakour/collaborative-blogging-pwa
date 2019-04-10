<template>
  <div class="mb-3 d-flex align-items-center">
    <img height="80" src="../../assets/img/demo/blog4.jpg">
    <div class="pl-3">
      <h2 class="mb-2 h6 font-weight-bold">
        <a class="text-dark" href="#" @click.prevent="$router.push({ name: 'article' })">
          Nasa's IceSat space laser makes height maps
          of Earth
        </a>
      </h2>
      <div class="card-text text-muted small">Jake Bittle in LOVE/HATE</div>
      <small class="text-muted">Dec 12 &middot; 5 min read</small>
    </div>
  </div>
</template>

<script>
export default {
  name: "SmArticleCard",
  data: () => ({})
};
</script>
