<template>
    <div id="page">
        <div id="page-text" v-html="contents"></div>
        <div v-if="the_end">
            <p class="text-center"><em>The end.</em></p>
        </div>
        <div v-else>
            <ul id="choices">
                <li v-for="option in options">
                    <a href="#" v-on:click="choosePage(option.next_page_id)">{{ option.wording }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['choices', 'page_text', 'page_prompt'],

        data() {
            return {
                apiRequest: new XMLHttpRequest(),
                contents: '',
                options: [],
                the_end: false
            }
        },

        computed: {

        },

        mounted: function () {

            this.contents = this.page_text;
            this.options = this.choices;

        },

        methods: {

            choosePage: function (id) {

                // Set up url for fetching page data.
            	let url = "/pages/<pageId>";
            	url = url.replace("<pageId>", id);
                // console.log(url);

            	// Code that fetches data from the API URL and stores it in results.
            	this.apiRequest.onload = this.onPageSuccess;
            	this.apiRequest.onerror = this.onPageError;
            	this.apiRequest.open('get', url, true);
            	this.apiRequest.send();

            },

            onPageError: function () {

                this.options = [];
                this.content = 'There was a problem loading your page, sorry! :-(';

            },

            onPageSuccess: function () {

            	if (this.apiRequest.statusText === "OK") {

                    let self = this;

                    let data = JSON.parse(this.apiRequest.response);
                    this.contents = data.page_text;
                    this.options = [];
                    if (data.is_the_end) {
                        self.the_end = true;
                    }
                    else {
                        data.choices.forEach(function(choice) {
                            self.options.push(choice);
                        });
                    }

            	}
            	else {

                    this.onPageError();

            	}

            }

        }
    }
</script>
