<template>
  <div v-if="$store.state.auth.user" class="navbar">
    <li v-for="(menuItem,index) in menuItems" :key="index" class="nav-item">
      <a class="nav-link" href @click.prevent="$router.push({ name: menuItem.route})">
        {{menuItem.title}}
        <i v-if="menuItem.icon" :class="menuItem.icon" class="fa text-danger"></i>
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
          route: "create-post"
        },
        {
          title: "Topics",
          icon: "fa-plus",
          route: "show-topics"
        }
      ]
    };
  }
};
</script>
