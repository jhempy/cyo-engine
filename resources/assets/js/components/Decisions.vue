<template>
  <div class="panel panel-default">
    <div class="panel-body panel-decisions">
      <label>Choices</label>
      <ul class="list-unstyled list-indented">
        <li 
          v-bind:text="decision.text"
          v-bind:id="decision.id"
          v-for="decision in decisions">
            <div class="input-group">
              <span class="input-group-addon light-background">
                <a href="#" v-on:click="removeDecision(decision.id)"><strong><i class="option-spacing fa fa-trash-o" aria-hidden="true"></i></strong></a>
              </span>
              <input 
                type="text" 
                name="decision[]"
                class="form-control light-background"
                v-bind:value="decision.text"
                disabled>
            </div>
        </li>
        <li v-if="decisions.length == 0">(no choices defined)</li>
      </ul>
      <div class="form-group">
        <label>New Choice</label>
        <input 
          type="text" 
          class="form-control" 
          v-model="newDecisionText"
          v-on:blur="addDecision"
          placeholder="Tell the wizard to leave!">
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data: function() {
    return {
      newDecisionText: '',
      decisions: [],
      nextDecisionId: 0
    };
  },

  methods: {

    addDecision: function() {
      this.decisions.push({
        id: this.nextDecisionId++,
        text: this.newDecisionText
      });
      this.newDecisionText = '';
    },

    removeDecision: function(id) {
      var index = this.findDecision(id);
      this.decisions.splice(index, 1);
    },

    findDecision: function(id) {
      return this.decisions.findIndex(function(decision) {
        return id === decision.id;
      });
    }

  }

}
</script>