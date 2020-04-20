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
                                <!-- <h4>Date Casting:</h4> {{audition.created_at.substr(0,10)}} to {{audition.end_date_available}} -->
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3">
                                <h4>Questions </h4>
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3" v-for="question in  question_proyect" :key="question.id">
                                <p>{{question.question_proyect}}</p>
                                <v-text-field v-if="question.related_answer.length > 0 ? false : true"  v-model="question.answer_question" ></v-text-field>
                                <v-text-field v-else :disabled="question.related_answer.length > 0 ? true : false"  v-model="question.related_answer[0].answer_question" ></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm12 md12>
                              <v-btn color="success" @click="addAnswer" >Save Answer</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
           
                <v-flex xs12 sm12 md4 class="justify-center m-3" v-for="scene in audition.related_scenes" :key="scene.id">
                    <v-card class="mx-auto" max-width="1050" tile>
                        <v-container>
                            <v-layout row wrap class="m-1 text-sm-center">
                                <v-flex xs12 sm12 md12>
                                    <h4>Character Scene </h4>
                                    <p>{{scene.character_scene}}</p>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <h4>Description Character Scene </h4>
                                    <p>{{scene.descripction_character_scene}}</p>
                                    <a :href="scene.script_attached_audition"> PDF Script Attachmend</a>
                                </v-flex>
                            </v-layout>
                        </v-container>
                        <v-card-actions>
                            <v-btn text @click="dialog = true">Add Audition</v-btn>
                        </v-card-actions>
                    </v-card>
                    <v-timeline dense>
                        <v-timeline-item>
                            <span slot="opposite">Tus eu perfecto</span>
                            <v-card class="elevation-2">
                                <video width="320" height="240" controls>
                                    <source src="http://localhost:8000/videos/grabacion1586640591055.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>
                </v-flex>
            </v-layout
>
        </v-container>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    Privacy Policy
                </v-card-title>
                <v-card-text>
                    <div class="col-6">
                        <video id="video" width="400"></video>
                        <button class="btn btn-primary" @click="grabarVideo">
                            Grabar
                        </button>
                        <button class="btn btn-secondary" @click="detenerGrabacion">
                            Parar
                        </button>
                    </div>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" class="ml-3" @click="dialog = false">
                        I accept
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</template>
<script>
export default {
    data() {
        return {
            dialog: false,
            audition: [],
            array_video: [],
            mediaRecorder: null,
            question_proyect: [],
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
        async addAnswer(){
            const URL = `save-questions`
            try {
                let {data} = axios.post(URL, {questions:this.question_proyect})
                this.getAuditionSpecific(this.$route.params.id_audition);
            } catch(e) {
                console.log(e);
            }
        },
        async getAuditionSpecific(id) {
            const URL = `project/${this.$route.params.id_project}/get-audition-specific/${id}`
            var aud
            try {
                let { data } = await axios(URL)
                data.related_casting.forEach(item => {
                    aud = item
                })
                this.audition = aud

                for (let a of data.related_question_project) {
                    a.answer_question = ''
                }
                this.question_proyect = data.related_question_project
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
                const {
                    data
                } = await axios
                    .post("/guardar-video", form, {
                        headers: { "Content-Type": "multipart/form-data" }
                    })

                    .catch(console.log("error enviando"));
            } catch (error) {
                console.log(error);
            }
        },
        async detenerGrabacion() {
            try {
                if (!this.mediaRecorder) {
                    return;
                }
                //console.log(this.array_video);
                this.mediaRecorder.stop();
                this.mediaRecorder = null;
            } catch (error) {
                console.log(error);
            }
        },
    }
}

</script>
