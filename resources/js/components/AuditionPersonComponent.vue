<template>
    <v-app>
        <v-container>
            <v-layout row wrap class="m-4 ">
                <v-flex xs12 sm12 md12 class="elevation-1">
                    <v-container>
                        <v-layout row wrap>
                            <v-flex xs12 sm6 md6>
                                <v-layout row wrap>
                                    <v-flex xs12 sm12 md12 class="m-3">
                                        <h4> Character name :</h4>{{character.character_name}}
                                    </v-flex>
                                    <v-flex xs12 sm12 md12 class="m-3">
                                        <h4> character Description :</h4>{{character.description_character}}
                                    </v-flex>
                                    <v-flex xs12 sm12 md12 class="m-3">
                                        <h4>Script (pdf)</h4>
                                        <a :href="character.script_attached_audition" target="_blanck"> Attachment script PDF</a>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12 class="m-3" v-if="var_exist_vaudition">
                                        <v-btn color="info" @click="addVauditionModal">Add Vaudition</v-btn>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex xs12 sm6 md6>
                                <h4>Some suggestions before registering your audition</h4>
                                <ul>
                                    <li>Read the description and script of the character well to enter context when auditioning, each character has attached a script in pdf format that can be downloaded.</li>
                                    <li>To register the character's audition, you have to click on the button that says "add vaudition", you must choose one of the two options that appear there.</li>
                                    <li>If you choose the first option when recording the audition, prepare before pressing the record button. You cannot stop and resume the recording unless you decide to stop and end the audition (it is a registration by user for each character).</li>
                                    <li>Once the audition registration is finished, it immediately appears at the bottom, then it is necessary to answer some questions that will appear in your registry, if you do not answer those questions the addition will be incomplete.</li>
                                </ul>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
                <v-flex xs12 sm12 md4 class="mt-3" v-for="(ch, c) in character.vaudition_related" :key="c">
                    <v-card max-width="344" class="mx-auto" :class=" ch.chosenActor ? 'bg-success' : ''  ">
                        <v-list-item>
                            <v-list-item-avatar color="grey"></v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-subtitle>{{ch.userPost.name}}</v-list-item-subtitle>
                                <strong>{{ch.chosenActor ? 'Selected' : ''  }}</strong>
                            </v-list-item-content>
                        </v-list-item>
                        
                        <v-row class="d-flex">
                            <v-col>
                                <v-row>
                                    <v-col v-if="ch.url_video_upload">
                                        <video width="344" height="200" controls>
                                            <source width="344" :src="ch.url_video_upload" type="video/mp4">
                                        </video>
                                    </v-col>
                                    <v-col v-if="ch.url_video_redsocial">
                                        <a :href="ch.url_video_redsocial" target="_blanck" class="btn btn-block success">Link Vaudition</a>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" v-if="!ch.questionsResponse">
                                    <h4>Questions </h4>
                                    <v-text-field v-for="(q,i) in character.questions" :label="q.question_proyect" v-model="q.answer_question" :key="i" />
                                    <v-btn color="success" @click="addAnswer">Save Answer</v-btn>
                                </v-col>
                                <v-col cols="12">
                                    <h4>Question answered</h4>
                                    <ul>
                                        <li v-for="(q, qx) in ch.questions" :key="qx">
                                            {{q.question_proyect}}
                                            <ul>
                                                <li v-for="(ans, ix) in q.related_answer" :key="ix">
                                                    {{ans.answer_question}}
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </v-col>
                                <v-col>
                                    <v-btn v-if="user.rol_user == 1 || user.rol_user == 3 " color="success" @click="openDialogVauditioner(ch.userPost)">Selection Vaudiotioner</v-btn>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
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
                                <v-select :items="itemsSelectWayVaudition" v-model="wayVaudition" label="how do you want to register your vaudition" return-object item-text="text" clearable></v-select>
                            </v-flex>
                            <v-flex xs12 sm12 md12 v-if="wayVaudition.value === 1">
                                <video class="elevation-4" id="video" width="450"></video>
                                <button class="btn btn-primary" @click="grabarVideo">
                                    Record vaudition
                                </button>
                                <button class="btn btn-danger" @click="detenerGrabacion">
                                    Stop / Finish vaudition
                                </button>
                            </v-flex>
                            <v-flex xs12 sm12 md12 class="m-3" v-if="wayVaudition.value === 2">
                                <v-select v-model="var_red_selected" :items="items_red_social" label="Select Red Social" return-object item-text="name" outlined>
                                    <template v-slot:item="{item}">
                                        <v-icon>{{item.icon}}</v-icon>
                                        <div> {{item.name}}</div>
                                    </template>
                                </v-select>
                            </v-flex>
                            <v-flex xs12 sm12 md12 v-if="wayVaudition.value === 2">
                                <v-text-field label="Link to vaudition red social" v-model="var_url_audition"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-btn color="primary" block @click.prevent="addSceneAuditionLink" v-if="wayVaudition.value === 2">Save link and finish vaudition</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="dialog_preSeleccion" persistent max-width="500px" transition="dialog-transition">
            <v-card>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-textarea type="textarea" label="Note" placeholder="Write an additional note that will be sent to you by email user" v-model="var_note_actor_selected"></v-textarea>
                        </v-col>
                        <v-col>
                            <v-btn color="success" block @click="SelectionActor()" >Send Selection</v-btn>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>
        </v-dialog>
    </v-app>
</template>
<script>
import {  mapGetters } from 'vuex';
import { mdiYoutube, mdiVimeo } from '@mdi/js';
export default {
    data() {
        return {
            var_user_actor_selected: '',
            var_note_actor_selected: '',
            dialog_preSeleccion: false,
            wayVaudition: {},
            itemsSelectWayVaudition: [
                { text: 'I want to record directly from vaudition', value: 1 },
                { text: 'I have already recorded the audition and I have the link', value: 2 },
            ],
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
            var_exist_vaudition: true,
            var_exist_response_question: false,
        }
    },
    async mounted() {
        await this.getAuditionSpecific(this.$route.params.id_character);

        await this.$root.services.userService.get(this.$route.params.id_user)

    },
    watch: {
        array_video(newVal, oldVal) {
            if (!newVal.length) {
                return;
            }
            this.enviar_video();
        }
    },
    computed: {
        ...mapGetters(['user']),
        isExistVaudition: {
            get() {
                return this.var_exist_vaudition = true
            },
            set(newVal) {
                this.var_exist_vaudition = newVal
            }
        }
    },
    methods: {
        async addSceneAudition(scene, url = false) {
            this.dialog = true
            this.scene_id = scene.id

        },
        async addSceneAuditionLink() {
            var url_audition_red, character_id, red_selected, id_user;

            url_audition_red = this.var_url_audition
            character_id = this.$route.params.id_character
            red_selected = this.var_red_selected.name
            id_user = this.$route.params.id_user

            try {
                const URL = `/api/add-audition-scene`
                let { data } = await axios.post(URL, { character_id, url_audition_red, red_selected, id_user })
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
            const URL = `/api/save-questions`
            var result = this.character.questions.some(item => item.answer_question === null)

            try {
                if (result) {
                    this.$swal('warning', 'you need to answer all the questions', 'warning')
                } else {
                    let { data } = axios.post(URL, { questions: this.character.questions, id_user: this.$route.params.id_user })
                    this.getAuditionSpecific(this.$route.params.id_character);
                }
            } catch (e) {
                console.log(e);
            }
        },
        async getAuditionSpecific(id) {
            const URL = `/api/user/${this.$route.params.id_user}/character/${id}/get-character-audition`
            try {
                let { data } = await axios(URL)
                

                await axios.put(`/api/desactivate-invitation-vaudition`, { user: this.$route.params.id_user, project: this.$route.params.id_project, character: this.$route.params.id_character });
                this.character = data
                this.character.vaudition_related.forEach((item) => {

                    item.questions.forEach((item2) => {
                        this.var_exist_response_question = item2.related_answer.length

                    });

                    item.userPost.has_contact_user.forEach((item3) =>  {
                        if (parseInt(item3.character_id) === parseInt(this.$route.params.id_character)){
                            item.chosenActor = true
                        }else {
                            item.chosenActor = false
                        }

                    });

                    if (this.var_exist_response_question > 0) {
                        item.questionsResponse = true
                    } else {
                        item.questionsResponse = false
                    }


                });
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
                video.srcObject = stream;
                video.play();
                this.mediaRecorder = new MediaRecorder(stream);
                this.mediaRecorder.start();
                this.mediaRecorder.addEventListener(
                    "dataavailable",
                    this.add_video_data
                );
                this.mediaRecorder.addEventListener("stop", () => {
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
                form.append("id_user", this.$route.params.id_user);

                const {
                    data
                } = await axios
                    .post("/api/guardar-video", form, {
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
        addVauditionModal() {
            var result = this.character.vaudition_related.some(item => item.user_id === parseInt(this.$route.params.id_user))
            if (result) {
                this.$swal('warning', 'You already did an vaudition', 'warning')
            } else {
                this.dialog = true
            }
        },
        openDialogVauditioner(user){
            console.log()
            this.var_user_actor_selected = user
            this.dialog_preSeleccion = true
        },
        async SelectionActor(){
            var character_id, id_user,  note;
            character_id = this.$route.params.id_character
            id_user = this.var_user_actor_selected.id
            note = this.var_note_actor_selected
            this.$root.services.userService.selectedUser(character_id, id_user, note)
               await this.getAuditionSpecific(this.$route.params.id_character);
            this.dialog_preSeleccion = false
        }
    }
};

</script>
