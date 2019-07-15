<template>
    <span>
    <b-button variant="primary" v-b-modal.add-new-process><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Add new Process</b-button>
    <b-modal id="add-new-process" :hide-footer="true" title="Add New Process">
      <b-form @submit="submit" v-if="show">

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

        <b-button type="submit" variant="dark"><i class="fas fa-check"></i>&nbsp;&nbsp;Add Process</b-button>

      </b-form>
    </b-modal>
    </span>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          name: '',
          description: '',
          code: '',
          status: 0
        },
        show: true
      }
    },
    methods: {
      submit (evt) {
        evt.preventDefault();
        this.form.name = this.form.name.trim();
        this.form.description = this.form.description.trim();
        this.form.code = this.form.code.trim();
        this.form.status = parseInt(this.form.status);
        this.$root.create(this.form);
        this.form = {
          name: '',
          description: '',
          code: '',
          status: 0
        };
        this.$bvModal.hide('add-new-process');
      }
    }
  }
</script>
