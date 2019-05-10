<template>
    <div class="container">
        <!-- Begin post excerpts, let's highlight the first 4 posts on top -->
        <div class="row remove-site-content-margin">
            <!-- latest post -->

            <div class="col-md-6">
                <div class="card border-0 mb-4 box-shadow" v-if="latest_post">
                    <a
                        href
                        @click.prevent="$router.push({ name: 'show-post',  params: { id: latest_post.id }})"
                    >
                        <div
                            :style="{'background-image': 'url(' + BACKEND_IMG_PATH + latest_post.image   + ')'}"
                            style="  background-size: cover; background-repeat: no-repeat ; height : 200px;"
                        ></div>
                    </a>
                    <div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
                        <h2 class="h4 font-weight-bold">
                            <a
                                class="text-dark"
                                href
                                @click.prevent="$router.push({ name: 'show-post',  params: { id: latest_post.id }})"
                            >{{ latest_post.title }}</a>
                        </h2>
                        <star-rating
                            :star-size="25"
                            :glow="10"

                            v-model="latest_post.rating"
                            :rating="latest_post.rating"

                            :show-rating="false"
                            :border-width="0"
                            :read-only="true"
                            :rounded-corners="true"
                        ></star-rating>
                        <p class="excerpt">{{ latest_post.excerpt }}</p>
                        <div>
                            <small class="d-block text-muted">
                                In
                                <span class="catlistread-only">
                  <a
                      class="text-capitalize text-muted smoothscroll p-1"
                      href="#"
                  >{{ latest_post.topic }}</a>
                  <span class="sep">,</span>
                </span>
                            </small>
                            <small class="text-muted">{{ latest_post.date }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" v-if="second_posts">
                <!-- second latest posts -->
                <div
                    class="mb-3 d-flex align-items-center"
                    v-for="(second_post,index) in second_posts"
                    :key="index"
                >
                    <div v-if="second_post.image" class="col-md-4">
                        <a
                            href
                            @click.prevent="$router.push({ name: 'show-post',  params: { id: second_post.id }})"
                        >
                            <img class="w-100" :src="second_post.image | imageUrlFilter" :alt="second_post.title">
                        </a>
                    </div>

                    <div>
                        <h2 class="mb-2 h6 font-weight-bold">
                            <a
                                class="text-dark"
                                href
                                @click.prevent="$router.push({ name: 'show-post',  params: { id: second_post.id }})"
                            >{{ second_post.title }}</a>
                        </h2>
                        <star-rating
                            :star-size="20"
                            :glow="10"
                            :rating="second_post.rating"
                            :show-rating="false"
                            :border-width="0"
                            :read-only="true"
                            :rounded-corners="true"
                        ></star-rating>
                        <small class="d-block text-muted">
                            In
                            <span class="catlist">
                <a
                    @click.prevent="$router.push({ name: 'topic',  params: { id: second_post.topic_id }})"
                    class="text-capitalize text-muted smoothscroll p-1"
                    href="#"
                >{{ second_post.topic }}</a>
                <span class="sep">,</span>
              </span>
                        </small>
                        <small class="text-muted">{{ second_post.date }}</small>
                    </div>
                </div>
            </div>
        </div>


        <!-- Now the rest of the posts with the usual loop but with an offset:4 on the first page so we can skeep the first 4 posts displayed above -->

        <div class="row mt-3">
            <div class="col-md-8 main-loop" v-if="posts">
                <h4 class="font-weight-bold spanborder">
                    <span>All Stories</span>
                </h4>
                <MainLoopCard v-for="(post , index) in posts" :key="index" :post="post"/>

                <scroll-loader :loader-method="getImagesInfo" :loader-enable="loadMore"></scroll-loader>
            </div>

            <div class="col-md-4" v-if="featureds">
                <SidebarFeatured :posts="featureds"/>
            </div>
        </div>
    </div>
</template>

<script>
    import SidebarFeatured from "@/components/layout/sidebar-featured.vue";
    import MainLoopCard from "@/components/layout/main-loop-card.vue";
    import StarRating from "vue-star-rating";
    import {vp} from '@/tools/helpers'

    export default {
        name: "Home",
        components: {SidebarFeatured, MainLoopCard, StarRating},
        data: () => ({
            BACKEND_IMG_PATH: process.env.VUE_APP_BACKEND_IMG_PATH,
            allPosts: [],
            latest_post: {},
            second_posts: [],
            posts: [],
            jumbotron_post: {},
            featureds: [],
            loadMore: true,
            postsPage: 0,
            notNotified: true
        }),

        methods: {
            getImagesInfo() {
            },
            async fetchUserFeed() {
                this.$get("home/" + this.postsPage)
                    .then(data => {

                        this.allPosts = data.posts.sort((b, a) => a.time - b.time);

                        this.latest_post = this.allPosts.slice(0, 1)[0];
                        this.second_posts = this.allPosts.slice(1, 4);
                        this.posts = this.allPosts.slice(4);

                        this.featureds = this.allPosts
                            .sort((b, a) => a.rating - b.rating)
                            .slice(0, 5);

                        this.loadMore = data.loadMore;

                        this.postsPage += 5;

                        if (this.notNotified) {

                            vp.$notify.info(data.message);
                            this.notNotified = false;
                        }

                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            async fetchMoreUserFeed() {
                this.$get("home/" + this.postsPage)
                    .then(data => {

                        if (this.loadMore) {
                            Object.keys(data.posts).map(key => {
                                this.allPosts.push(data.posts[key]);
                            });

                            this.allPosts = this.allPosts.sort((b, a) => a.time - b.time);

                            this.latest_post = this.allPosts.slice(0, 1)[0];
                            this.second_posts = this.allPosts.slice(1, 4);
                            this.posts = this.allPosts.slice(4);

                            this.featureds = this.allPosts
                                .sort((b, a) => a.rating - b.rating)
                                .slice(0, 5);
                            this.postsPage += 5;

                            this.loadMore = data.loadMore;

                            if (this.notNotified || !data.loadMore) {

                                vp.$notify.info(data.message);
                                this.notNotified = false;
                            }

                        }

                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            scroll(person) {
                window.onscroll = () => {
                    let bottomOfWindow =
                        document.documentElement.scrollTop + window.innerHeight ===
                        document.documentElement.offsetHeight;

                    if (bottomOfWindow) {
                        this.fetchMoreUserFeed();
                    }
                };
            }
        },
        mounted() {
            this.fetchUserFeed();
            this.scroll();
        },
        filters: {
            imageUrlFilter: function (imgName) {
                return process.env.VUE_APP_BACKEND_IMG_PATH + imgName;
            }
        },
        watch: {
            $route(to, from) {
                this.fetchUserFeed();
            }
        }
    };
</script>
