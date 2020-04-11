<template>
    <v-app>
        <v-container>
            <v-layout row wrap>
                <v-flex xs12 sm12 md4 class="m-1" v-for="project in data_project" :key="project.id" >
                    <v-card  max-width="344">
                       <v-card-title>
                            {{project.project_name}}
                        </v-card-title>
                        <v-card-actions>
                            <v-btn color="purple" text>
                                <router-link :to="{name: 'dashboard.casting', params:{ id_project: project.id}}">
                                           Explore
                                </router-link>
                            </v-btn>
                            <!-- <v-spacer></v-spacer> -->
                          <!--   <v-btn icon @click="show = !show">
                                <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                            </v-btn> -->
                        </v-card-actions>
                        <!-- <v-expand-transition>
                            <div v-show="show">
                                <v-divider></v-divider>
                                <v-card-text>
                                    I'm a thing. But, like most politicians, he promised more than he could deliver. You won't have time for sleeping, soldier, not with all the bed making you'll be doing. Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk! You're going to do his laundry? I've got to find a way to escape.
                                </v-card-text>
                            </div>
                        </v-expand-transition> -->
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-app>
</template>
<script>
    export default {
        data(){
            return {
                data_project: [],
            }
        },
        mounted(){
            this.getProject();
        },
        methods:{
            async getProject(){
                const URL = `get-project`
                try {

                    let {data} = await axios(URL)
                    this.data_project = data
                } catch(e) {
                    console.log(e);
                }
            }
        }
    }
</script>
