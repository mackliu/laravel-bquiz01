<template>
  <div class="text-center py-2 border-bottom my-1">主選單區</div>
  <ul class="list-group">
    <li
      class="list-group-item list-group-item-action py-1 bg-warning position-relative menu"
      v-for="menu in menus"
      @mouseover="menu.show = true"
      @mouseleave="menu.show = false"
      :key="menu.id"
    >
      <a :href="menu.href">{{ menu.text }}</a>

      <ul
        class="list-group position-absolute w-75 subs"
        style="z-index: 99; left: 100px; top: 25px"
        v-if="menu.subs.length > 0"
        v-show="menu.show"
      >
        <li
          class="list-group-item list-group-item-action bg-success py-1"
          v-for="sub in menu.subs"
          :key="sub.id"
        >
          <a :href="sub.href" style="color: white">{{ sub.text }}</a>
        </li>
      </ul>
    </li>
  </ul>

  <div class="viewer">進站總人數：{{ total }}</div>
</template>
<script>
export default {
    props:['menus','total']
};
</script>