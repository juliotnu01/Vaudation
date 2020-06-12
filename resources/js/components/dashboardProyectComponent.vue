<template>
    <v-app>
        <v-container>
            <v-layout row wrap justify-space-around>
                <v-flex xs12 sm12 md2  v-for="p in project" :key="p.id">
                    <v-card>
                        <img src="https://img.icons8.com/wired/64/000000/movie-projector.png">
                        </img>
                        {{p.project_name}}
                        <v-card-actions>
                            <v-btn color="purple" text>
                                <router-link :to="{name: 'dashboard.casting', params:{ id_project: p.id} }">
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
import {mapState} from 'vuex'
export default {
    mounted() {
        this.$root.services.projectService.get()
    },
    computed:{
        ...mapState(['project'])
    }
};

</script>
