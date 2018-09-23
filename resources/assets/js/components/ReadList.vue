<template>
    <div>
        <div v-for="adventure in adventures">
            A card for {{ adventure.title }} goes here.
        </div>
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
