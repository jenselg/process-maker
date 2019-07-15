@extends('layouts.master')

@section('title', 'Manage Processes // Process Maker')

@section('page')

<div class="row">
  <div class="col">
    <br/>
    <!-- Sub Navigation/Actions -->
    <div class="navbar navbar-light bg-light justify-content-between">
      <div>
        <new-process-form></new-process-form>
        <sort-process-list :statusselect="statusSelect"></sort-process-list>
      </div>
      <processes-counter></processes-counter>
    </div>
    <br/>
    <!-- Process List -->
    <div class="card" v-if="this.processes.length > 0">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center">Status</th>
            <th>Process Name</th>
            <th class="text-center">Available Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            is="single-process"
            v-for="process in processes"
            v-bind:process="process"
            v-bind:key="process.id"
            v-if="processesFilter == numToStatus(process.status)"
          ></tr>
          <tr
            is="single-process"
            v-for="process in processes"
            v-bind:process="process"
            v-bind:key="process.id"
            v-if="processesFilter == 'all'"
          ></tr>
        </tbody>
      </table>
    </div>
    <h3 class="text-center" v-else>No processes to display.</h3>
    <br/>
  </div>
</div>

@endsection
