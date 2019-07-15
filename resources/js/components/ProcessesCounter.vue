<template>
  <span>
    <span class="badge badge-primary custom-badge">{{ allCount() }}</span>&nbsp;Total&nbsp;&nbsp;
    <span class="badge badge-success custom-badge">{{ activeCount() }}</span>&nbsp;Active&nbsp;&nbsp;
    <span class="badge badge-danger custom-badge">{{ inactiveCount() }}</span>&nbsp;Inactive&nbsp;&nbsp;
  </span>
</template>

<script>
  export default {
    methods: {
      allCount () {
        return this.$root.$data.processes.length
      },
      activeCount () {
        return this.$root.$data.processes.filter(process => process.status == 1).length
      },
      inactiveCount () {
        return this.$root.$data.processes.filter(process => process.status == 0).length
      }
    }
  }
</script>
