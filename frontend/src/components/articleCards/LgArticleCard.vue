<template>
  <div class="jumbotron jumbotron-fluid mb-3 pt-0 pb-0 bg-lightblue position-relative">
    <div class="pl-4 pr-0 h-100 tofront">
      <div class="row justify-content-between">
        <div class="col-md-6 pt-6 pb-6 align-self-center">
          <h1 class="secondfont mb-3 font-weight-bold">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            Laborum expedita
          </h1>
          <p class="mb-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam praesentium ipsam quasi nihil, voluptatum itaque officia sapiente quia, culpa, eum mollitia. Explicabo est adipisci, nemo aperiam harum qui id ea.
            Nisi dolorum suscipit sapiente aliquam sequi maxime atque quas doloribus quod iure, enim quae obcaecati tenetur sed sint nulla reprehenderit, aspernatur incidunt optio consectetur voluptatum libero placeat quibusdam ratione illum?
          </p>
          <a
            href="#"
            @click.prevent="$router.push({ name: 'article' })"
            class="btn btn-dark"
          >Read More</a>
        </div>
        <div class="col-md-6 d-none d-md-block pr-0" style="background-size:cover;">
          <img src="../../assets/img/demo/home.jpg" height="100%">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LgArticleCard",
  data: () => ({})
};
</script>
