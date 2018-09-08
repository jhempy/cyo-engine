<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Choice</th>
                    <th>Destination</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="choice in choices">
                    <td>{{ choice.wording }}</td>
                    <td><a v-on:click="editPage(choice.next_page_id)">{{ lookup[choice.next_page_id] }}</a></td>
                    <td style="vertical-align: middle;"><a v-on:click="removeChoice(choice.id)">Remove</a></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" v-model=newChoiceText></td>
                    <td>
                        <select class="form-control" v-model=newChoiceDestination>
                            <option value="NEW">New page</option>
                            <option v-for="page in pages" v-bind:value=page.id>{{ page.name }}</option>
                        </select>
                    </td>
                    <td style="vertical-align: middle;"><a v-on:click="addChoice">Add</a></td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="choices" v-model=JSON.stringify(choices)>
    </div>
</template>

<script>
    export default {
        props: ['choices', 'pages'],

        data() {
            return {
                newChoiceText: '',
                newChoiceDestination: '',
                temporaryId: 1
            }
        },

        computed: {

            lookup: function () {
                var temp = [];
                this.pages.forEach(function(page) {
                    temp[page.id] = page.name;
                });
                return temp;
            }

        },

        methods: {

            addChoice: function () {

                this.choices.push({
                    page_id: this.page_id,
                    wording: this.newChoiceText,
                    next_page_id: this.newChoiceDestination,
                    id: 'NEW_' + this.temporaryId
                });
                console.log(this.choices);
                this.newChoiceText = '';
                this.newChoiceDestination = '';
                this.temporaryId++;

            },

            removeChoice: function (id) {
                console.log("removing...");
                var index = this.findIndexById(id);
                this.choices.splice(index, 1);
                this.$forceUpdate();
            },

            findIndexById: function (id) {
                return this.choices.findIndex(function(choice) {
                    return id === choice.id;
                });
            },

            editPage: function(id) {
                window.location.href = '/pages/' + id + '/edit';
            }

        }
    }
</script>
