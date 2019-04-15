<template>
  <div>
    <!-- Begin Top Author Page
    ==================================================-->
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-md-offset-2">
          <div class="mainheading">
            <div class="row">
              <div class="col-md-10 col-xs-12">
                <h1>{{name}}</h1>
                <p class="mb-20 text-justify">{{bio}}</p>
                <button
                  href="https://twitter.com/wowthemesnet"
                  class="btn btn-outline-primary btn-round"
                >Follow</button>
              </div>
              <div class="col-md-2 col-xs-3">
                <img
                  class="rounded-circle shadow center align-content-center justify-content"
                  src=" http://localhost:8000/img/avatar2.jpg"
                  alt="Sal"
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="container pt-4 pb-4">
          <h5 class="font-weight-bold spanborder">
            <span>{{name}}'s Posts</span>
          </h5>
          <div class="row">
            <!------- MAIN -------->
            <div class="container pt-4 pb-4">
              <div class="row">
                <div class="col-lg-6">
                  <MdArticleCard
                    v-for="i in [1]"
                    :key="i"
                    :id="i"
                    :title="article.title"
                    :date="article.date"
                    :author="article.author"
                    :description="article.description"
                    :imgFileName="article.imgSource"
                  />
                </div>
                <div class="col-lg-6">
                  <div class="flex-md-row mb-4 box-shadow h-xl-300">
                    <SmArticleCard
                      v-for="i in [1,2,3,4]"
                      :key="i"
                      :id="i"
                      :title="article.title"
                      :date="article.date"
                      :author="article.author"
                      :imgFileName="article.imgSource"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SmArticleCard from "@/components/articleCards/SmArticleCard.vue";
import MdArticleCard from "@/components/articleCards/MdArticleCard.vue";

export default {
  name: "Author",
  components: { SmArticleCard, MdArticleCard },
  data: () => ({
    name: "",
    bio:
      "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis commodi autem quo incidunt molestiae amet eum repellendus voluptas nemo soluta!",
    article: {
      id: "1",
      title: "Nasa's IceSat space laser makes height maps of Earth",
      date: "Dec 12",
      imgSource: "blog4.jpg",
      description:
        "Researchers have found an effective target in the brain for electrical stimulation to improve mood in people suffering from depression.",
      author: "Jake Bittle in LOVE/HATE"
    }
  }),
  mounted() {
    this.name = this.$route.params.id;
  }
};
</script>
 