<template>
  <b-dropdown variant="dark" id="process-status-dropdown" text="Filter Processes" class="m-md-2">
    <b-dropdown-item @click="statusselect('all')">Show All Processes</b-dropdown-item>
    <b-dropdown-item @click="statusselect('active')">Show Active Processes</b-dropdown-item>
    <b-dropdown-item @click="statusselect('inactive')">Show Inactive Processes</b-dropdown-item>
  </b-dropdown>
</template>
<script>
  export default {
    props: ['statusselect']
  }
</script>
