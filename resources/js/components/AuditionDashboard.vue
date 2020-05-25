<template>
    <v-app>
        <v-container>
            <v-layout row wrap>
                <v-flex xs12 sm12 md12>
                    <v-btn fab dark color="primary">
                        <router-link :to="{name: 'audition', params:{ id_project: $route.params.id_project}}">
                            <v-icon x-large color="white">mdi-plus</v-icon>
                        </router-link>
                    </v-btn>
                </v-flex>
                <v-flex xs12 sm12 md4 v-for="(audition, key) in data_character" :key="audition.id" class="m-3">
                    <v-card max-width="344">
                        <v-card-text>
                            <strong><h2>Character: {{audition.character_name}}</h2></strong>: <br />
                            <strong><h2> Description: {{audition.description_character}}</h2></strong>: <br />
                        </v-card-text>
                        <v-card-actions>
                            <router-link :to="{ name: 'audition.person', params: { id_project: $route.params.id_project, id_user: $route.params.id_user }}">
                                READ
                            </router-link>
                            <v-spacer></v-spacer>
                            <v-btn icon>
                                <v-icon>mdi-heart</v-icon>
                            </v-btn>
                            <v-btn icon>
                                <v-icon>mdi-share-variant</v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-app>
</template>
<script>
export default {
    data() {
        return {

            data_character: [],
        }
    },
    mounted() {
        this.getAudition();
    },
    methods: {
        async getAudition() {
            const URL = `${this.$route.params.id_project}/get-character`
            try {
                let { data } = await axios(URL)
                this.data_character = data.character_related
            } catch (e) {
                // statements
                console.log(e);
            }
        }
    }
}

</script>
