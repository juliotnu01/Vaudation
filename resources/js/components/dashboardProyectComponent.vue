<template>
    <v-app>
        <v-container>
            <v-layout row wrap justify-space-around>
                <v-flex xs12 sm12 md2  v-for="project in data_project" :key="project.id">
                    <v-card>
                        <img src="https://img.icons8.com/wired/64/000000/movie-projector.png">
                        </img>
                        {{project.project_name}}
                        <v-card-actions>
                            <v-btn color="purple" text>
                                <router-link :to="{name: 'dashboard.casting', params:{ id_project: project.id}}">
                                    Explore
                                </router-link>
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
            data_project: [],
        }
    },
    mounted() {
        this.getProject();
    },
    methods: {
        async getProject() {
            const URL = `get-project`
            try {

                let { data } = await axios(URL)
                this.data_project = data
            } catch (e) {
                console.log(e);
            }
        }
    }
}

</script>
