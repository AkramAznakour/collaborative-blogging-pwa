<template>
  <div>
    <li v-for="(menuItem,index) in menuItems" :key="index" class="nav-item">
      <a
        target="_blank"
        class="nav-link"
        href="#"
        @click.prevent="$router.push({ name: menuItem.route})"
      >
        {{menuItem.title}}
        <i v-if="menuItem.icon" :class="icon" class="fa text-danger"></i>
      </a>
    </li>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      menuItems: [
        {
          title: "Write a new post",
          icon: "fa-plus",
          route: "createPost"
        }
      ]
    };
  }
};
</script>
