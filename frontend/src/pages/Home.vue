<template>
  <div>
    <!--------------------------------------
HEADER
    --------------------------------------->
    <div class="container">
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
              <a href="#" @click.prevent="$router.push({ name: 'article' })" class="btn btn-dark">Read More</a>
            </div>
            <div class="col-md-6 d-none d-md-block pr-0" style="background-size:cover;">
              <img src="../assets/img/demo/home.jpg" height="100%">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--------------------------------------
MAIN
    --------------------------------------->

    <div class="container pt-4 pb-4">
      <div class="row">
        <div class="col-lg-6">
          <div class="card border-0 mb-4 box-shadow h-xl-300">
            <div
              style="background-image: url(./assets/img/demo/1.jpg); height: 150px;    background-size: cover;    background-repeat: no-repeat;"
            >
                          <img src="../assets/img/demo/1.jpg" height="100%" width="100%">

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
        </div>
        <div class="col-lg-6">
          <div class="flex-md-row mb-4 box-shadow h-xl-300">
            <div class="mb-3 d-flex align-items-center">
              <img height="80" src="../assets/img/demo/blog4.jpg">
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
            <div class="mb-3 d-flex align-items-center">
              <img height="80" src="../assets/img/demo/blog5.jpg">
              <div class="pl-3">
                <h2 class="mb-2 h6 font-weight-bold">
                  <a class="text-dark" href="#" @click.prevent="$router.push({ name: 'article' })">
                    Underwater museum brings hope to Lake
                    Titicaca
                  </a>
                </h2>
                <div class="card-text text-muted small">Jake Bittle in LOVE/HATE</div>
                <small class="text-muted">Dec 12 &middot; 5 min read</small>
              </div>
            </div>
            <div class="mb-3 d-flex align-items-center">
              <img height="80" src="../assets/img/demo/blog6.jpg">
              <div class="pl-3">
                <h2 class="mb-2 h6 font-weight-bold">
                  <a class="text-dark" href="#" @click.prevent="$router.push({ name: 'article' })">Sun-skimming probe starts calling home</a>
                </h2>
                <div class="card-text text-muted small">Jake Bittle in LOVE/HATE</div>
                <small class="text-muted">Dec 12 &middot; 5 min read</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Header -->

  <!--------------------------------------
MAIN
  --------------------------------------->
</template>

<script>
import { mapState, mapGetters } from "vuex";
import Auth from "@/components/Auth.vue";

export default {
  name: "Home",
  components: { Auth },
  data: () => ({
    users: [],
    loading: false
  }),
  computed: {
    ...mapState("auth", ["user"]),
    ...mapGetters("auth", ["loggedIn"])
  },
  watch: {
    loggedIn(val) {
      if (val) this.fetchUsers();
    }
  },
  mounted() {
    if (this.loggedIn) this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      this.loading = true;
      this.users = await this.$get("users");
      this.loading = false;
    }
  }
};
</script>
