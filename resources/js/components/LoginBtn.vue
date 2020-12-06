<template>

  <a :href="auth.href" class="btn py-3 w-100 my-2" :class="auth.class">
  {{auth.text}}({{ auth.user }})
  </a>
</template>
<script>
export default {
  props: ["auth"],
};
</script>