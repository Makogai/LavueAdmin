<template>
  <div class="loader">
    <circle-svg :w="w"/>
  </div>
</template>

<script>
import CircleSvg from './CircleSvg'

export default {
  name: 'LoadingFull',
  components: { CircleSvg },
  data: () =>({
    w: 48
  })
}
</script>

<style scoped>
.loader {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: var(--sidebar-color);
  opacity: 0.6;
  z-index: 1;
}

.loader svg {
  position: absolute;
  top: 50%;
  left: 50%;
  height: 50%;
  transform: translate(-50%, -50%);
}
</style>
