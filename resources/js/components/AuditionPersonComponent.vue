<template>
    <v-app>
        <v-container>
            <v-layout row wrap class="m-4 ">
                <v-flex xs12 sm12 md12 class="elevation-1">
                    <v-container>
                        <v-layout row wrap>
                            <v-flex xs12 sm12 md12 class="m-3">
                                <h4> Character name :</h4>{{character.character_name}}
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3">
                                <h4> character Description :</h4>{{character.description_character}}
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3">
                                <h1>pdf</h1>
                                <a :href="character.script_attached_audition" target="_blanck"> Attachment PDF</a>
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3">
                                <h4>Questions </h4>
                                <v-text-field 
                                 v-if="q.related_answer.length == 0" 
                                 v-for="(q,i) in character.questions" 
                                 :label="q.question_proyect" 
                                 v-model="q.answer_question" 
                                 :key="i"></v-text-field>
                                <v-btn color="success" @click="addAnswer" >Save Answer</v-btn>
                                <v-btn color="info" @click="dialog = true" >Add Vaudition</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
                <v-flex xs12 sm12 md4 class="justify-center m-3">
                    <v-timeline dense>
                        <v-timeline-item v-for="(ch, c) in character.vaudition_related" :key="c">
                            <v-card class="elevation-2">
                                <v-container>
                                    <v-layout row wrap>
                                        <v-flex xs12 sm12 md6 class="ml-3" v-if="ch.url_video_redsocial">
                                            <v-container>
                                                <v-layout row wrap>
                                                    <v-flex xs12 sm12 md12>
                                                        <a :href="ch.url_video_redsocial" target="_blanck">Link Vaudition</a>
                                                    </v-flex>
                                                </v-layout>
                                            </v-container>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12 v-if="ch.url_video_upload" >
                                            <video width="270" height="200" controls>
                                                <source :src="ch.url_video_upload" type="video/mp4">
                                            </video>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12>
                                          <h4>Question answered</h4>
                                           <ul>
                                               <li v-for="q in character.questions" >
                                                   {{q.question_proyect}}
                                                   <ul>
                                                       <li v-for="ans in q.related_answer" >
                                                           {{ans.answer_question}}
                                                       </li>
                                                   </ul>
                                               </li>
                                           </ul> 
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>
                </v-flex>
            </v-layout>
        </v-container>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title class="headline blue lighten-2" primary-title>
                    Add Vaudition
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-layout row wrap>
                            <v-flex xs12 sm12 md12>
                                <video class="elevation-4" id="video" width="450"></video>
                                <button class="btn btn-primary" @click="grabarVideo">
                                    Record vaudition
                                </button>
                                <button class="btn btn-danger" @click="detenerGrabacion">
                                    Stop / Finish vaudition
                                </button>
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3">
                                <v-select v-model="var_red_selected" :items="items_red_social" label="Select Red Social" return-object item-text="name" outlined>
                                    <template v-slot:item="{item}">
                                        <v-icon>{{item.icon}}</v-icon>
                                        <div> {{item.name}}</div>
                                    </template>
                                </v-select>
                            </v-flex>
                            <v-flex xs12 sm12 md12>
                                <v-text-field label="Link to vaudition red social" v-model="var_url_audition"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-btn color="primary" block @click.prevent="addSceneAuditionLink">Save link and finish vaudition</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</template>
<script>
import { mdiYoutube, mdiVimeo } from '@mdi/js';
export default {
    data() {
        return {
            dialog: false,
            character: [],
            array_video: [],
            mediaRecorder: null,
            question_proyect: [],
            var_url_audition: '',
            items_red_social: [
                { name: 'Youtube', icon: mdiYoutube, value: 1 },
                { name: 'Vimeo', icon: mdiVimeo, value: 2 }
            ],
            scene_id: '',
            var_red_selected: '',
        }
    },
    watch: {
        array_video(newVal, oldVal) {
            if (!newVal.length) {
                return;
            }
            this.enviar_video();
        }
    },
    mounted() {
        this.getAuditionSpecific(this.$route.params.id_character);
    },
    methods: {
        async addSceneAudition(scene, url = false) {
            this.dialog = true
            this.scene_id = scene.id

        },
        async addSceneAuditionLink() {
            var url_audition_red,character_id, red_selected;

            url_audition_red = this.var_url_audition
            character_id = this.$route.params.id_character
            red_selected = this.var_red_selected.name

            try {
                const URL = `add-audition-scene`
                let { data } = await axios.post(URL, {character_id, url_audition_red, red_selected })
                this.getAuditionSpecific(this.$route.params.id_character);
                this.var_red_selected = ''
                this.var_url_audition = ''
                this.dialog = false
                this.$swal.success('Save', 'Vaudition Save');
            } catch (e) {
                console.log(e);
            }

        },
        async addAnswer() {
            const URL = `save-questions`
            try {
                let { data } = axios.post(URL, { questions: this.character.questions })
                // this.getAuditionSpecific(this.$route.params.id_audition);
            } catch (e) {
                console.log(e);
            }
        },
        async getAuditionSpecific(id) {
            const URL = `user/${this.$route.params.id_user}/${id}/get-character-audition`
            var aud
            try {
                let { data } = await axios(URL)
                this.character = data
            } catch (e) {
                console.log(e);
            }

        },
        async grabarVideo() {
            try {
                let array_video = [];
                let stream = await navigator.mediaDevices.getUserMedia({
                    audio: true,
                    video: true
                });
                let video = document.querySelector("#video");
                console.log(video)
                video.srcObject = stream;
                video.play();
                this.mediaRecorder = new MediaRecorder(stream);
                this.mediaRecorder.start();
                this.mediaRecorder.addEventListener(
                    "dataavailable",
                    this.add_video_data
                );
                this.mediaRecorder.addEventListener("stop", () => {
                    console.log("grabación terminada");
                    video.pause();
                });
            } catch (error) {
                console.log(error);
            }
        },
        add_video_data(e) {
            this.array_video.push(e.data);
        },
        async enviar_video() {
            try {
                let blob = new Blob(this.array_video, {
                    type: "video/mp4"
                });
                this.array_video = [];
                let link = document.createElement("a");
                link.href = window.URL.createObjectURL(blob);
                link.setAttribute(
                    "download",
                    "grabacion" + new Date().getTime() + ".mp4"
                );
                link.click();

                let form = new FormData();
                form.append(
                    "video",
                    blob,
                    "grabacion" + new Date().getTime() + ".mp4"
                );

                form.append("character_id", this.$route.params.id_character);

                const {
                    data
                } = await axios
                    .post("/guardar-video", form, {
                        headers: { "Content-Type": "multipart/form-data" }
                    })

                    .catch(console.log("error enviando"));
                this.getAuditionSpecific(this.$route.params.id_character);
                this.dialog = false
            } catch (error) {
                console.log(error);
            }
        },
        async detenerGrabacion() {
            try {
                if (!this.mediaRecorder) {
                    return;
                }
                this.mediaRecorder.stop();
                this.mediaRecorder = null;
            } catch (error) {
                console.log(error);
            }
        },
    }
}

</script>
