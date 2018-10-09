<template>
    <div class="row">
        <div v-for="adventure in adventures" class="col-lg-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-container">
                    <div class="card-title"><a :href="adventure.url">{{ adventure.title }}</a></div>
                    <div class="card-author">by {{ adventure.author_name }}</div>
                    <div class="card-publishdate">Published on {{ adventure.pubdate }}</div>
                </div>
            </div>
        </div>
        <div v-if="adventures.length == 0">
            <p class="text-center"><br />There aren't any published adventures...yet.<br /><br /></p>
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
