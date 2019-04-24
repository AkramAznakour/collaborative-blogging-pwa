<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <ChangeAvatar/>
      </div>
      <div class="col-md-4">
        <ChangeUserData/>
      </div>
      <div class="col-md-4">
        <ChangePassword/>
      </div>
    </div>
  </div>
</template>

<script>
import ChangeAvatar from "@/components/profile/account/ChangeAvatar.vue";
import ChangeUserData from "@/components/profile/account/ChangeUserData.vue";
import ChangePassword from "@/components/profile/account/ChangePassword.vue";

export default {
  components: { ChangeAvatar, ChangeUserData, ChangePassword }
};
</script>
