<template>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> {{ appVersion }}
    </div>
    <strong>Copyright &copy; {{ new Date().getFullYear() }} <b>{{ appName }}</b>.</strong>
  </footer>
</template>

<script>
export default {
  name: 'Footer',
  data: () => ({
    appVersion: window.config.appVersion,
    appName: window.config.appName
  })
}
</script>

<style scoped>

</style>
