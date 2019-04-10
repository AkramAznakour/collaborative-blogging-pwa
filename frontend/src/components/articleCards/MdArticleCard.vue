<template>
  <div class="card border-0 mb-4 box-shadow h-xl-300">
    <div
      style="background-image: url(./../assets/img/demo/1.jpg); height: 150px;    background-size: cover;    background-repeat: no-repeat;"
    >
      <img src="../../assets/img/demo/1.jpg" height="100%" width="100%">
    </div>
    <div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
      <h2 class="h4 font-weight-bold">
        <a class="text-dark" href="#" @click.prevent="$router.push({ name: 'article' })">
          Brain Stimulation Relieves Depression
          Symptoms
        </a>
      </h2>
      <p class="card-text">
        Researchers have found an effective target in the brain for electrical stimulation to
        improve mood in people suffering from depression.
      </p>
      <div>
        <small class="d-block">
          <a class="text-muted" href="./author.html">Favid Rick</a>
        </small>
        <small class="text-muted">Dec 12 &middot; 5 min read</small>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MdArticleCard",
  data: () => ({})
};
</script>
