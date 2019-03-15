<template>
  <div>
    <table>
      <tbody>
        <tr>
          <th scope="row">Created at:</th>
          <td>{{ $auth.user.createdAt }}</td>
        </tr>
        <tr>
          <th scope="row">Email:</th>
          <td>{{ $auth.user.email }}</td>
        </tr>
        <tr>
          <th scope="row">Has verified email:</th>
          <td>{{ $auth.user.hasVerifiedEmail }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
