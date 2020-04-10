<template>
    <v-app>
        <v-container>
            <v-layout row wrap>
                <v-flex xs12 sm12 md12>
                    <v-btn class="mx-2" fab dark color="indigo" @click.prevent="dialog = true">
                        <v-icon dark>mdi-plus</v-icon>
                    </v-btn>
                </v-flex>
                <v-spacer></v-spacer>
                <v-flex xs12 sm12 md12 class="m-3">
                    <v-data-table :headers="headers" :items="data_auditions" :items-per-page="5" class="elevation-1">
                        <template v-slot:item.banner_audition="{ item }">
                            <v-img :src="item.banner_audition" height="25" width="100"></v-img>
                        </template>
                        <template v-slot:items="props">
                            <td class="text-center"> {{props.item.title_audition}} </td>
                            <td class="text-center"> {{props.item.description_audition}} </td>
                            <td class="text-center"> {{props.item.script_text_audition}} </td>
                            <td class="text-center"> {{props.item.end_date_available}} </td>
                        </template>
                        <template v-slot:item.script_attached_audition="{ item }">
                            <img src="https://img.icons8.com/metro/26/000000/pdf-2.png"/>
                            <a :href="item.script_attached_audition">PDF attachmend</a>
                        </template>
                    </v-data-table>
                </v-flex>
            </v-layout>
            <v-layout row wrap>
                <v-flex xs12 sm12 md12>
                    <v-btn class="mx-2" fab dark color="warning" @click.prevent="dialog_scene = true">
                        <v-icon dark>mdi-plus</v-icon>
                    </v-btn>
                </v-flex>
                <v-spacer></v-spacer>
                <v-flex xs12 sm12 md12 class="m-3">
                    <v-data-table :headers="headers_scene" :items="data_scene" :items-per-page="5" class="elevation-1">
                    </v-data-table>
                </v-flex>
            </v-layout>
        </v-container>
        <!-- modal -->
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title class="headline orange lighten-2" primary-title>
                    Add Audition
                </v-card-title>
                <!-- body -->
                <v-container>
                    <v-layout row wrap class="m-1">
                        <v-flex xs12 sm12 md12>
                            <v-text-field label="Title Audition" v-model="var_title_audition"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12 md12>
                            <v-text-field label="Description Audition" v-model="var_description_audition"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12 md12 class="m-3">
                            <!-- upload button -->
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" ref="customFileIMG" @change="IMGcharge">
                                <label class="custom-file-label" for="customFile">Choose banner image</label>
                            </div>
                        </v-flex>
                        <v-flex xs12 sm12 md12 class="m-3 elevation-2" v-if="imgF === ''? false: true">
                            <img :src="imgF" width="400" height="450">
                        </v-flex>
                        <v-flex xs12 sm12 md12 class="m-3">
                            <!-- upload button -->
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" ref="customFile" @change="PDFcharge">
                                <label class="custom-file-label" for="customFile">Choose script file</label>
                            </div>
                        </v-flex>
                        <v-flex xs12 sm12 md12 class="m-3 elevation-2" v-if="pdfName === ''? false: true">
                            <pdf :src="pdfName"></pdf>
                        </v-flex>
                        <v-flex xs12 sm12 md12 class="m-3">
                            <v-textarea outlined name="input-7-4" label="Script audition text" v-model="var_script_text_audition"></v-textarea>
                        </v-flex>
                        <v-flex xs12 sm12 md12 class="m-3 ">
                            <p>Final Date Available for audition</p>
                            <v-row justify="center">
                                <v-date-picker v-model="picker" year-icon="mdi-calendar-blank" prev-icon="mdi-skip-previous" next-icon="mdi-skip-next"></v-date-picker>
                            </v-row>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="SaveAudition">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- modal -->
        <v-dialog v-model="dialog_scene" width="500">
            <v-card>
                <v-card-title class="headline purple lighten-2" primary-title>
                    Add Scene
                </v-card-title>
                <!-- body -->
                <v-container>
                    <v-layout row wrap class="m-1">
                        <v-flex xs12 sm12 md12>
                            <v-select
                              :items="data_auditions"
                              v-model="var_audition_selected"
                              label="Select Audition"
                              return-object
                              item-text="title_audition"
                            ></v-select>
                        </v-flex>
                        <v-flex xs12 sm12 md12>
                            <v-text-field label="Act Scene" v-model="var_act_scene"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12 md12>
                            <v-text-field label="Number Scene" v-model="var_number_scene"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12 md12>
                            <v-text-field label="Scene Direction" v-model="var_scene_direction"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12 md12>
                            <v-text-field label="Character Scene" v-model="var_character_scene"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12 md12 class="m-3">
                            <v-textarea outlined name="input-7-4" label="Description Character Scene" v-model="var_description_character_scene"></v-textarea>
                        </v-flex>
                        <v-flex xs12 sm12 md12 class="m-3">
                            <v-textarea outlined name="input-7-4" label="Dialogue Character Scene" v-model="var_dialogue_character_scene"></v-textarea>
                        </v-flex>
                    </v-layout>
                </v-container>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="addScene">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</template>
<script>
import pdf from 'vue-pdf'
export default {
    components: {
        pdf
    },
    mounted() {
        this.getAudition()
        this.getScene();
    },
    data() {
        return {
            data_scene: [],
            dialog_scene: false,
            var_audition_selected: '',
            var_act_scene: '',
            var_number_scene: '',
            var_scene_direction: '',
            var_character_scene: '',
            var_description_character_scene: '',
            var_dialogue_character_scene: '',
            var_title_audition: '',
            var_description_audition: '',
            var_script_text_audition: '',
            var_banner_audition: '',
            var_attachment_audition: '',
            picker: new Date().toISOString().substr(0, 10),
            dialog: false,
            headers: [
                { text: 'Title Audition', value: 'title_audition' },
                { text: 'Description Audition', value: 'description_audition' },
                { text: 'Banner Audition', value: 'banner_audition' },
                { text: 'Script Text', value: 'script_text_audition' },
                { text: 'End Date Available Audition', value: 'end_date_available' },
                { text: 'Script Attachmend', value: 'script_attached_audition' },
            ],
            headers_scene:[

                { text: 'Title Audition', value: 'act_scene' },
                { text: 'Description Audition', value: 'numbre_scene' },
                { text: 'Banner Audition', value: 'scene_direction' },
                { text: 'Script Text', value: 'character_scene' },
                { text: 'End Date Available Audition', value: 'descripction_character_scene' },
                { text: 'Script Attachmend', value: 'dialogue_scene' },
                { text: 'Related Auditon ', value: 'audition.title_audition' },
            ],
            data_auditions: [],
            pdfName: '',
            imgF: '',
        }
    },
    methods: {
        async detenerGrabacion() {
            try {
                if (!this.mediaRecorder) {
                    return;
                }
                this.mediaRecorder.stop();
                this.mediaRecorder = null;
                let form = new FormData();
                form.append("video", this.blob);
                form.append("nombre", "grabacion" + new Date().getTime() + ".webm");
                const { data } = await axios
                    .post("http://127.0.0.1:8000/api/guardar-video", form)
                    .catch(console.log("error enviando"));
            } catch (error) {
                console.log(error);
            }
        },
         grabarVideo() {
            try {
                let that = this;
                navigator.mediaDevices
                    .getUserMedia({ audio: true, video: true })
                    .then(stream => {
                        let video = that.$refs.video;
                        video.srcObject = stream;
                        video.play();
                        that.mediaRecorder = new MediaRecorder(stream);
                        that.mediaRecorder.start();
                        that.mediaRecorder.addEventListener(
                            "dataavailable",
                            e => {
                                console.log(e.data);
                                that.array_video.push(e.data);
                            }
                        );
                        that.mediaRecorder.addEventListener("stop", () => {
                            alert("Finalizó la grabación");
                            video.pause();
                            that.blob = new Blob(that.array_video, {
                                type: "video/webm"
                            });

                            that.array_video = [];
                            let link = document.createElement("a");
                            link.href = window.URL.createObjectURL(that.blob);
                            link.setAttribute(
                                "download",
                                "grabacion" + new Date().getTime() + ".webm"
                            );
                            link.click();
                        });
                    })
                    .catch(error => console.log(error));
            } catch (error) {
                console.log(error);
            }
        },
        PDFcharge(e) {
            this.var_attachment_audition = e.target.files[0]
            this.pdfName = pdf.createLoadingTask(URL.createObjectURL(e.target.files[0]));
        },
        IMGcharge(e) {
            this.var_banner_audition = e.target.files[0]
            this.imgF = URL.createObjectURL(e.target.files[0]);
        },
        async SaveAudition() {
            const URL = `save-audition`

            var data = new FormData();

            data.append('title_audition', this.var_title_audition)
            data.append('description_audition', this.var_description_audition)
            data.append('script_text_audition', this.var_script_text_audition)
            data.append('banner_audition', this.var_banner_audition)
            data.append('attachment_audition', this.var_attachment_audition)
            data.append('picker', this.picker)

            try {
                let audition = await axios.post(URL, data, { headers: { 'Content-type': 'multipart/form-data' } })
                this.dialog = false
                this.getAudition();
                this.limpiar();
            } catch (e) {
                console.log(e);
            }
        },
        async getAudition() {
            const URL = `get-audition`
            try {
                let { data } = await axios(URL)
                this.data_auditions = data
            } catch (e) {
                console.log(e);
            }
        },
        async getScene() {
            const URL = `get-scene`
            try {
                let { data } = await axios(URL)
                this.data_scene = data
                console.log(data)
            } catch (e) {
                console.log(e);
            }
        },
        async addScene(){
            const URL = `save-scene`
            var id_audition,act_scene,numbre_scene,scene_direction,character_scene,descripction_character_scene, dialogue_scene;

            id_audition = this.var_audition_selected.id
            act_scene = this.var_act_scene
            numbre_scene = this.var_number_scene
            scene_direction = this.var_scene_direction
            character_scene = this.var_character_scene
            descripction_character_scene = this.var_description_character_scene
            dialogue_scene = this.var_dialogue_character_scene

            try {
                let {data} = await axios.post(URL, {id_audition, act_scene, numbre_scene, scene_direction, character_scene, descripction_character_scene, dialogue_scene})
                this.limpiar();
                this.getScene();
                this.dialog_scene = false
            } catch(e) {
                console.log(e);
            } 
        },
        limpiar(){
            this.var_audition_selected = ''
            this.var_act_scene = ''
            this.var_number_scene = ''
            this.var_scene_direction = ''
            this.var_character_scene = ''
            this.var_description_character_scene = ''
            this.var_dialogue_character_scene = ''
            this.var_title_audition = ''
            this.var_description_audition = ''
            this.var_script_text_audition = ''
            this.var_banner_audition = ''
            this.var_attachment_audition = ''
            this.picker = ''
        }
    }
}

</script>
