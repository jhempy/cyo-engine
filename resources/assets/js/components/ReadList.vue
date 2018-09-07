<template>
    <div>
        <ul class="list-unstyled list-indented">
            <li v-for="adventure in adventures"><a :href="readUrl(adventure.id)">{{ adventure.title }}</a> - {{ adventure.description }}</li>
        </ul>
    </div>
</template>

<script>
    export default {

        props: ['adventures'],

        methods: {

            readUrl: function(id) {
                return "/read/" + id;
            }

        }

    }
</script>
