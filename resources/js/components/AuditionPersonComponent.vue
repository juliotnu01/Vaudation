<template>
    <v-app>
        <v-container>
            <v-layout row wrap class="m-4 ">
                <v-flex xs12 sm12 md4>
                    <img :src="audition.banner_audition" alt="" width="400" height="300">
                </v-flex>
                <v-spacer></v-spacer>
                <v-flex xs12 sm12 md7 class="elevation-1">
                    <v-container>
                        <v-layout row wrap>
                            <v-flex xs12 sm12 md12>
                                <h4> Casting Title :</h4>{{audition.title_audition}}
                            </v-flex>
                            <v-divider></v-divider>
                            <v-flex xs12 sm12 md12>
                                <h4> Casting Description :</h4>{{audition.description_audition}}
                            </v-flex>
                            <v-flex xs12 sm12 md12>
                                <h4> Casting Script Text :</h4>{{audition.script_text_audition}}
                            </v-flex>
                            <v-flex xs12 sm12 md12>
                                <h4> Casting Attachmend script :</h4>
                                <img src="https://img.icons8.com/metro/25/000000/pdf-2.png" />
                                <a :href="audition.script_attached_audition">PDF Attachmend</a>
                            </v-flex>
                            <v-flex xs12 sm12 md12>
                                <!-- <h4>Date Casting:</h4> {{audition.created_at.substr(0,10)}} to {{audition.end_date_available}} -->
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
            </v-layout>
            <v-layout row wrap>
                <v-flex xs12 sm12 md12 class="justify-center m-3" v-for="scene in audition.related_scenes" :key="scene.id">
                    <v-card class="mx-auto" max-width="1050" tile>
                        <v-container>
                            <v-layout row wrap class="m-1 text-sm-center">
                                <v-flex xs12 sm12 md12 class="text-sm-center">
                                    <h4>ACT </h4>
                                    <p>{{scene.act_scene}}</p>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <h4>Scene </h4>
                                    <p>{{scene.numbre_scene}}</p>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <h4>Direction Scene </h4>
                                    <p>{{scene.scene_direction}}</p>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <h4>Character Scene </h4>
                                    <p>{{scene.character_scene}}</p>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <h4>Description Character Scene </h4>
                                    <p>{{scene.descripction_character_scene}}</p>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <h4>Dialog Character Scene </h4>
                                    <p>{{scene.dialogue_scene}}</p>
                                </v-flex>
                            </v-layout>
                        </v-container>
                        <v-card-actions>
                            <v-btn text>Add Audition</v-btn>
                        </v-card-actions>
                    </v-card>
                    <v-timeline  dense>
                        <v-timeline-item v-for="n in 2" :key="n">
                            <span slot="opposite">Tus eu perfecto</span>
                            <v-card class="elevation-2">
                                <v-card-title class="headline">Lorem ipsum</v-card-title>
                                <v-card-text>
                                    Lorem ipsum dolor sit amet, no nam oblique veritus. Commune scaevola imperdiet nec ut, sed euismod convenire principes at. Est et nobis iisque percipit, an vim zril disputando voluptatibus, vix an salutandi sententiae.
                                </v-card-text>
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>
                </v-flex>
            </v-layout>
        </v-container>
    </v-app>
</template>
<script>
export default {
    data() {
        return {
            audition: [],
        }
    },
    mounted() {
        this.getAuditionSpecific(this.$route.params.id_audition);
    },
    methods: {
        async getAuditionSpecific(id) {
            const URL = `get-audition-specific/${id}`

            try {
                let { data } = await axios(URL)
                this.audition = data
                console.log(this.audition)
            } catch (e) {
                console.log(e);
            }

        }
    }
}

</script>
