<template>
    <v-app>
        <v-container>
            <v-layout row wrap class="m-4 ">
                <v-flex xs12 sm12 md12 class="elevation-1">
                    <v-container>
                        <v-layout row wrap>
                            <v-flex xs12 sm12 md12 class="m-3">
                                <h4> Casting Title :</h4>{{audition.title_audition}}
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3">
                                <h4> Casting Description :</h4>{{audition.description_audition}}
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3">
                                <h1>pdf</h1>
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3" >
                                <h4>Questions </h4>
                                <!-- <p>{{question.question_proyect}}</p>
                                <v-text-field v-if="question.related_answer.length > 0 ? false : true" v-model="question.answer_question"></v-text-field>
                                <v-text-field v-else :disabled="question.related_answer.length > 0 ? true : false" v-model="question.related_answer[0].answer_question"></v-text-field> -->
                            </v-flex>
                            <v-flex xs12 sm12 md12>
                                <v-btn color="success" @click="addAnswer">Save Answer</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
                <v-flex xs12 sm12 md4 class="justify-center m-3">
                   <v-timeline dense>
                        <v-timeline-item >
                            <v-card class="elevation-2">
                                <v-container>
                                    <v-layout row wrap>
                                        <v-flex xs12 sm12 md6 class="ml-3" >
                                            <v-container>
                                                <v-layout row wrap>
                                                    <v-flex xs12 sm12 md3>
                                                        <!-- <v-icon>{{vaudition.red_selected}}</v-icon> -->
                                                    </v-flex>
                                                    <v-flex xs12 sm12 md8>
                                                        <a href="#" target="_blanck">Link Vaudition</a>
                                                    </v-flex>
                                                </v-layout>
                                            </v-container>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12 >
                                            <video width="270" height="200" controls>
                                                <source src="#" type="video/mp4">
                                            </video>
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
            audition: [],
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
        this.getAuditionSpecific(this.$route.params.id_audition);
    },
    methods: {
        async addSceneAudition(scene, url = false) {
            this.dialog = true
            this.scene_id = scene.id

        },
        async addSceneAuditionLink() {
            var url_audition_red, scene_id, red_selected;

            url_audition_red = this.var_url_audition
            scene_id = this.scene_id
            red_selected = this.var_red_selected.icon

            try {
                const URL = `add-audition-scene`
                let { data } = await axios.post(URL, { scene_id, url_audition_red, red_selected })
                this.getAuditionSpecific(this.$route.params.id_audition);
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
                let { data } = axios.post(URL, { questions: this.question_proyect })
                this.getAuditionSpecific(this.$route.params.id_audition);
            } catch (e) {
                console.log(e);
            }
        },
        async getAuditionSpecific(id) {
            const URL = `${this.$route.params.id_project}/project/${this.$route.params.id_user}/get-character`
            var aud
            try {
                let { data } = await axios(URL)

                console.log({data})
                
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
            console.log(this.array_video);
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

                form.append("scene_id", this.scene_id);

                const {
                    data
                } = await axios
                    .post("/guardar-video", form, {
                        headers: { "Content-Type": "multipart/form-data" }
                    })

                    .catch(console.log("error enviando"));
                this.getAuditionSpecific(this.$route.params.id_audition);
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
