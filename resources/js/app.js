/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/**
* Vue.js
*/

import Vue from 'vue';

/**
 * Bootstrap for Vue.js
 */

import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

/**
* Axios (for API calls)
*/

import axios from 'axios';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 // processes: [{
 //   id: 1,
 //   uuid: 'uuid',
 //   name: 'name',
 //   description: 'description',
 //   code: 'code',
 //   status: 'status'
 // }]

const app = new Vue({
    el: '#app',
    data: {
      processes: [],
      processesFilter: 'all',
      testBool: true
    },
    methods: {
      create (data) {
        axios.post('/api/processes', data).then((response) => {
          switch (this.processesFilter) {
            case 'all':
              this.processes.push(response.data);
              break;
            case 'active':
              if (response.data.status == 1) this.processes.push(response.data);
              break;
            case 'inactive':
              if (response.data.status == 0) this.processes.push(response.data);
              break;
            default:
              this.processes.push(response.data);
          }
        })
      },
      read () {
        axios.get('/api/processes').then((response) => {
          response.data.forEach((value) => {
            this.processes.push(value)
          })
        })
      },
      update (data, id) {
        axios.put(`/api/processes/${id}`, data).then((response) => {
          switch (this.processesFilter) {
            case 'all':
              Object.assign(this.processes.find(process => process.id == response.data.id), response.data)
              break;
            case 'active':
              if (response.data.status == 1) {
                Object.assign(this.processes.find(process => process.id == response.data.id), response.data)
              } else {
                this.processes = this.processes.filter(process => process.id != response.data.id)
              }
              break;
            case 'inactive':
              if (response.data.status == 0) {
                Object.assign(this.processes.find(process => process.id == response.data.id), response.data)
              } else {
                this.processes = this.processes.filter(process => process.id != response.data.id)
              }
              break;
            default:
              Object.assign(this.processes.find(process => process.id == response.data.id), response.data)
          }
        })
      },
      delete (id) {
        axios.delete(`/api/processes/${id}`).then((response) => {
          this.processes = this.processes.filter(process => process.id != response.data)
        })
      },
      numToStatus (num) {
        switch (num) {
          case 0:
            return 'inactive'
          break;
          case 1:
            return 'active'
          break;
          default:
            return 'inactive'
        }
      },
      statusSelect (status) {
        switch (status) {
          case 'all':
            this.processesFilter = 'all';
            break;
          case 'active':
            this.processesFilter = 'active';
            break;
          case 'inactive':
            this.processesFilter = 'inactive';
            break;
          default:
            this.processesFilter = 'all';
        }
      }
    },
    created () {
      this.read();
    }
});
