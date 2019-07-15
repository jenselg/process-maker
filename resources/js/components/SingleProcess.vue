<template>
  <tr>
    <td class="nowrap">
      <span v-if="process.status"><i class="fas fa-circle text-success"></i>&nbsp;&nbsp;<strong>Active</strong></span>
      <span v-else><i class="fas fa-circle text-danger"></i>&nbsp;&nbsp;Inactive</span>
    </td>
    <td class="w-100">{{ process.name }}</td>
    <td class="nowrap">
      <div>
        <b-button variant="dark" size="sm" @click="$bvModal.show('details-' + process.uuid)"><i class="fas fa-eye"></i>&nbsp;&nbsp;Process Details</b-button>
        <b-modal :id="'details-' + process.uuid" :hide-footer="true" title="Process Details">
          <h4>{{ process.name }}</h4>
          <h6 class="nomargin">{{ process.description }}</h6>
          <br/>
          <div class="card card-body bg-light">
            <code>
              <pre>{{ process.code }}</pre>
            </code>
          </div>
          <br/>
          <span class="badge badge-dark custom-badge">UUID</span>&nbsp;&nbsp;<i class="fas fa-caret-right"></i>&nbsp;
          <span class="text-info">
            {{ process.uuid }}
          </span>
          <br/>
          <span class="badge badge-dark custom-badge">STATUS</span>&nbsp;&nbsp;<i class="fas fa-caret-right"></i>&nbsp;
          <code v-if="process.status" class="text-success">Active</code>
          <code v-else class="text-danger">Inactive</code>
        </b-modal>
        <b-button variant="dark" size="sm" @click="$bvModal.show('edit-' + process.uuid)"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Edit Process</b-button>
        <b-modal :id="'edit-' + process.uuid" :hide-footer="true" title="Edit Process">
          <b-form @submit="submit">
            <b-form-group
              id="input-group-name"
              label="Process Name:"
              label-for="input-name"
            >
              <b-form-input
                id="input-name"
                v-model="form.name"
                type="text"
                required
                placeholder="// Enter process name"
              ></b-form-input>
            </b-form-group>
            <b-form-group id="input-group-description" label="Process Description:" label-for="input-description">
              <b-form-input
                id="input-description"
                v-model="form.description"
                required
                placeholder="// Enter process description"
              ></b-form-input>
            </b-form-group>
            <b-form-group id="input-group-code" label="Process Code:" label-for="input-code">
              <b-form-textarea
                id="input-code"
                v-model="form.code"
                placeholder="// Enter process code"
                required
                rows="6"
                max-rows="6"
              ></b-form-textarea>
            </b-form-group>
            <b-form-checkbox
              id="input-status"
              v-model="form.status"
              name="input-status"
              value="1"
              unchecked-value="0"
            >
              Activate Process
            </b-form-checkbox>
            <br/>
            <b-button type="submit" variant="dark"><i class="fas fa-check"></i>&nbsp;&nbsp;Update Process</b-button>
          </b-form>
        </b-modal>
        <b-button variant="dark" size="sm" @click="deleteProcess"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete Process</b-button>
      </div>
    </td>
  </tr>
</template>

<script>
  export default {
    props: ['process'],
    data: function () {
      return {
        form: {
          name: this.process.name,
          description: this.process.description,
          code: this.process.code,
          status: this.process.status
        },
        currentFilter: this.$root.$data.processesFilter
      }
    },
    methods: {
      submit (evt) {
        evt.preventDefault();
        this.form.name = this.form.name.trim();
        this.form.description = this.form.description.trim();
        this.form.code = this.form.code.trim();
        this.form.status = parseInt(this.form.status);
        this.$root.update(this.form, this.process.id);
        this.$bvModal.hide('edit-' + this.process.uuid);
      },
      deleteProcess (evt) {
        evt.preventDefault();
        this.$root.delete(this.process.id);
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
      }
    },
    mounted () {
    }
  }
</script>
