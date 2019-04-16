<template>
  <div>
    <!--------------------------------------
HEADER
    --------------------------------------->
    <div class="container">
      <div class="jumbotron jumbotron-fluid mb-3 pl-0 pt-0 pb-0 bg-white position-relative">
        <div class="h-100 tofront">
          <div class="row justify-content-between">
            <div class="col-md-12 pt-6 pb-6 pr-6 align-self-center">
              <p class="text-uppercase font-weight-bold">
                <a class="text-danger" href="./category.html">Stories</a>
              </p>
              <h1 class="display-4 secondfont mb-3 font-weight-bold">{{title}}</h1>
              <p
                class="mb-3"
              >Analysts told CNBC that the currency could hit anywhere between $1.35-$1.40 if the deal gets passed through the U.K. parliament.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Header -->

    <!--------------------------------------
MAIN
    --------------------------------------->
    <div class="container pt-4 pb-4">
      <div class="row justify-content-center">
        <div class="col-lg-2 pr-4 mb-4 col-md-12">
          <div class="sticky-top text-center d-block">
            <div class="d-flex align-items-center">
              <img class="rounded-circle" src="http://localhost:8000/img/avatar2.jpg" width="70">
              <div>
                <small class="ml-2">
                  {{author}}
                  <span class="text-muted d-block">A few hours ago &middot; 5 min. read</span>
                </small>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-8">
          <article class="article-post">
            <div v-html="content" v-highlight></div>
          </article>
        </div>
      </div>
    </div>

    <!-- End Main -->
  </div>
</template>
<script>
export default {
  name: "ShowPost",
  data: function() {
    return {
      id: this.$route.params.id,
      title: "Vue Offline",
      author: "Akram Aznakour",
      content:
        "# Vue Offline\r\n\r\nThis library allows you to enhance offline capabilities of your Vue.js application. It's especially useful when you're building offline-first Progressive Web Apps or just want to inform your users that they lost internet connection. \r\n\r\n**TL;DR** Adds `isOnline` `isOffline` data properties, `online`, `offline` events via global mixin and enables offline storage via `Vue.$offlineStorage` based on Local Storage\r\n\r\n- [Installation](#installation)\r\n- [Capabilities](#capabilities)\r\n    - [VueOfflineMixin](#vueofflinemixin)\r\n    - [VueOfflineStorage](#vueofflinestorage)\r\n\r\nInitially made for [Vue Storefront](https://github.com/DivanteLtd/vue-storefront)\r\n\r\n## Installation\r\nTo install this package as a plugin just type:\r\n````\r\nnpm install vue-offline --save\r\n````\r\n\r\nand add it into your application with\r\n````js\r\nimport VueOffline from 'vue-offline'\r\n\r\nVue.use(VueOffline)\r\n````\r\n\r\n## Capabilities\r\nThis plugin contains two features:\r\n\r\n### VueOfflineMixin\r\nGlobal mixin that'll add following properties to every component in your application:\r\n\r\n- `isOnline` & `isOffline` data properties\r\n````html\r\n<template>\r\n    <p v-if=\"isOnline\">This part will be visible only if user is online</p>\r\n    <p v-if=\"isOffline\">This part will be visible only if user is offline</p>\r\n</template>\r\n````\r\n````js\r\nexport default {\r\n    name: 'MyComponent',\r\n    computed: {\r\n        networkStatus () {\r\n            return this.isOnline ? 'My network is fine' : 'I am offline'\r\n        }\r\n    }\r\n}\r\n````\r\n- `online` and `offline` events in every component\r\n````js\r\nexport default {\r\n    name: 'MyComponent',\r\n    mounted () {\r\n        this.$on('offline' () => {\r\n            alert('You are offline! The website will not work')\r\n        })\r\n    }\r\n}\r\n````\r\n\r\n### Additional configuration\r\n\r\nBy default `VueOfflineMixin` is injected into every component which may be a cause of potential performance problems. You can disable this behavior by setting plugin option `mixin` to `false`. \r\n````js\r\nVue.use(VueOffline, {\r\n    mixin: false\r\n})\r\n````\r\n\r\nYou can still make use of `VueOfflineMixin` by injecting it directly into your components:\r\n````js \r\nimport { VueOfflineMixin } from 'vue-offline'\r\n\r\nexport default {\r\n    name: 'MyComponent',\r\n    mixins: [VueofflineMixin],\r\n    computed: {\r\n        networkStatus () {\r\n            return this.isOnline ? 'My network is fine' : 'I am offline'\r\n        }\r\n    },\r\n    mounted () {\r\n        this.$on('offline' () => {\r\n            alert('You are offline! The website will not work')\r\n        })\r\n    }\r\n}\r\n````\r\n### VueOfflineStorage \r\n Offline storage that uses [local storage](https://developer.mozilla.org/pl/docs/Web/API/Window/localStorage) to persist data for offline usage and caching. It's a perfect choice for offline-first PWA. You can use it as a fallback for failed network requests or a local cache. \r\n\r\nThe storage object has following properties: \r\n- `set(key, value)` - puts (or updates if already exists) `value` into storage under key `key`.\r\n- `get(key)` - returns value stored under key `key`\r\n- `keys` - return array of keys existing in your offline storage\r\n\r\nTo use this storage inside your app you can either\r\n-  use `this.$offlineStorage` from Vue instance property in your components:\r\n````js\r\nexport default {\r\n    methods: {\r\n        getUserData () {\r\n            if (this.isOnline) {\r\n                // make network request that returns 'userData' object\r\n                this.appData = userData\r\n                this.$offlineStorage.set('user', userData)\r\n            } else {\r\n                this.appData = this.$offlineStorage.get('user')\r\n            }\r\n        }\r\n    }\r\n}\r\n````\r\n- import the `VueOfflineStorage` instance if you want to use it somewhere else (e.g. Vuex store)\r\n````js\r\nimport { VueOfflineStorage } from 'vue-offline'\r\n\r\nconst cachedData = VueOfflineStorage.get('cached-data')\r\n\r\n````\r\n### Additional configuration\r\n\r\nBy default `VueofflineStorage` reference is included into every Vue component. You can disable this behavior by setting plugin option `storage` to `false`. \r\n````js\r\nVue.use(VueOffline, {\r\n    storage: false\r\n})\r\n````\r\n\r\nYou can still make use of `VueOfflineStorage` by importing it directly into your components:\r\n````js \r\nimport { VueOfflineStorage } from 'vue-offline'\r\n\r\nexport default {\r\n    name: 'MyComponent',\r\n    methods: {\r\n        getUserData () {\r\n            if (this.isOnline) {\r\n                // make network request that returns 'userData' object\r\n                this.appData = userData\r\n                VueOfflineStorage.set('user', userData)\r\n            } else {\r\n                this.appData = VueOfflineStorage.get('user')\r\n            }\r\n        }\r\n    }\r\n}\r\n````\r\n",
      imageSrc: process.env.VUE_APP_BACKEND_IMG_PATH + "intro.jpg"
    };
  }
};
</script>
