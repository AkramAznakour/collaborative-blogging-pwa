<template>
  <div class="container">
    <h3 class="font-weight-bold spanborder">
      <span>{{page.title}}</span>
    </h3>
    <div class="row">
      <div class="col-md-8">
        <img
          v-if="page.image"
          class="card-img-top mb-5 shadow-lg"
          :src="page.image"
          :alt="page.title"
        >
        <div class="page-content">{{ content }}</div>
      </div>
      <div class="col-md-4">
        <SideBar/>
      </div>
    </div>
  </div>
</template>

<script>
import SideBar from "@/components/layout/side-bar.vue";

export default {
  components: { SideBar }
};
</script>

