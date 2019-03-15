<template>
  <div v-if="$auth.user">
    <div>
      <div>
        <h1>{{ $auth.user.name }}</h1>
        <router-link to="/">🡄 Go back</router-link>
        <div>
          <router-link :to="{ name: 'profile' }" active-class="active">Main info</router-link>
          <router-link
            :to="{ name: 'profile-change-password' }"
            active-class="active"
          >Change password</router-link>
        </div>
      </div>
      <div>
        <transition name="router" mode="out-in">
          <router-view/>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Profile",
  data: () => ({})
};
</script>

<style >
</style>
