<template>
    <v-app>
        <v-stepper v-model="e1">
            <v-stepper-header>
                <v-stepper-step editable :complete="e1 > 1" step="1">Step 1 Project Name</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step editable :complete="e1 > 2" step="2">step 2 Add Character and Description </v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step editable :complete="e1 > 3" step="3">step 3 Add Questions</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step editable :complete="e1 > 4" step="4">step 4 Add Audition</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step editable :complete="e1 > 5" step="5">step 5 Add Scene</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step editable step="6">step 6 Send Invitations </v-stepper-step>
            </v-stepper-header>
            <v-stepper-items>
                <v-stepper-content step="1">
                    <v-card class="mb-12 mx-auto elevation-2" height="400px" max-width="344">
                        <v-container>
                            <v-layout row wrap>
                                <v-flex xs12 sm12 md12 class="m-2">
                                    <v-text-field label="Project Name" v-model="var_project_name"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm12 md12 class="m-3">
                                    <h3>Project Name: </h3>{{var_project_name}}
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                    <v-btn color="primary" @click="e1 = 2">
                        Continue
                    </v-btn>
                    <v-btn text>Cancel</v-btn>
                </v-stepper-content>
                <v-stepper-content step="2">
                    <v-card class="mb-12 mx-auto elevation-2" height="400px" max-width="500" style="overflow-y: scroll; max-height: 400px;">
                        <v-container>
                            <v-layout row wrap class="m-2">
                                <v-flex xs12 sm12 md12>
                                    <v-text-field label="Character Name" v-model="var_project_character_name"></v-text-field>
                                </v-flex>
                                <v-spacer></v-spacer>
                                <v-flex xs12 sm12 md12>
                                    <v-textarea color="black" label="Character Description" v-model="var_project_character_description"></v-textarea>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <v-btn color="success btn bg-warning" block @click="addCharacterItems">Add</v-btn>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Character Name</th>
                                                <th scope="col">Character description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="character in characterItems" :key="character.id">
                                                <td>{{character.name}}</td>
                                                <td style="word-wrap: break-word; width: 600px;">{{character.description}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                    <v-btn color="primary" @click="e1 = 3">
                        Continue
                    </v-btn>
                    <v-btn text>Cancel</v-btn>
                </v-stepper-content>
                <v-stepper-content step="3">
                    <v-card class="mb-12 mx-auto elevation-2" height="600px" max-width="500" style="overflow-y: scroll;">
                        <v-container>
                            <v-layout row wrap class="m-2">
                                <v-flex xs12 sm12 md12>
                                    <v-text-field label="Questions ProJect" v-model="var_question_project"></v-text-field>
                                </v-flex>
                                <v-spacer></v-spacer>
                                <v-flex xs12 sm12 md12>
                                    <v-btn color="success btn bg-info" block @click="addQuestions">Add</v-btn>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Questions Project</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="question in questionsItems" :key="question.id">
                                                <td>{{question.question}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                    <v-btn color="primary" @click="addProject">
                        Continue
                    </v-btn>
                    <v-btn text>Cancel</v-btn>
                </v-stepper-content>
                <v-stepper-content step="4">
                    <v-card class="mb-12 mx-auto elevation-2" max-width="600">
                        <v-container>
                            <v-layout row wrap>
                                <v-layout row wrap class="m-3">
                                    <v-flex xs12 sm12 md12>
                                        <v-text-field label="Title Audition" v-model="var_title_audition"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <v-textarea color="black" label="Character Description" v-model="var_description_audition"></v-textarea>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12 class="mx-auto elevation-2" v-if="imgF === '' ? false : true">
                                        <img :src="imgF" width="600" height="250" />
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <p>Final Date Available for audition</p>
                                        <v-row justify="center">
                                            <v-date-picker v-model="picker" year-icon="mdi-calendar-blank" prev-icon="mdi-skip-previous" next-icon="mdi-skip-next"></v-date-picker>
                                        </v-row>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <v-btn color="warning" @click="SaveAudition" block>
                                            Add Audiiton
                                        </v-btn>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <v-data-table :headers="headers" :items="data_auditions" :items-per-page="5" class="elevation-1">
                                            <template v-slot:items="props">
                                                <td class="text-center">
                                                    {{ props.item.title_audition }}
                                                </td>
                                                <td class="text-center">
                                                    {{ props.item.description_audition }}
                                                </td>
                                                <td class="text-center">
                                                    {{ props.item.end_date_available }}
                                                </td>
                                            </template>
                                        </v-data-table>
                                    </v-flex>
                                </v-layout>
                            </v-layout>
                        </v-container>
                    </v-card>
                    <v-btn color="primary" @click="e1 = 5">
                        Continue
                    </v-btn>
                    <v-btn text>Cancel</v-btn>
                </v-stepper-content>
                <v-stepper-content step="5">
                    <v-card class="mb-12 mx-auto elevation-2" max-width="600">
                        <v-container>
                            <v-layout row wrap class="m-3">
                                <v-flex xs12 sm12 md12>
                                    <v-select :items="data_auditions" v-model="var_audition_selected" label="Select Audition" return-object item-text="title_audition"></v-select>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <v-select :items="data_character" v-model="var_character_selected" label="Select Character" return-object item-text="character_name"></v-select>
                                    Description Character: {{var_character_selected.description_character}}
                                </v-flex>
                                <v-flex xs12 sm12 md12 class="m-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" ref="customFile" @change="PDFcharge" />
                                        <label class="custom-file-label" for="customFile">Choose script file</label>
                                    </div>
                                </v-flex>
                                <v-flex xs12 sm12 md12 class="m-3 elevation-2" v-if="pdfName === '' ? false : true">
                                    <pdf :src="pdfName"></pdf>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <v-btn color="primary" @click="addScene" block>
                                        Add Scene
                                    </v-btn>
                                </v-flex>
                                <v-flex xs12 sm12 md12 class="m-3">
                                    <v-data-table :headers="headers_scene" :items="data_scene" :items-per-page="5" class="elevation-1">
                                        <template v-slot:item.script_attached_audition="{ item }">
                                            <img src="https://img.icons8.com/metro/26/000000/pdf-2.png" />
                                            <a :href="item.script_attached_audition">PDF attachmend</a>
                                        </template>
                                    </v-data-table>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                    <v-btn color="primary" @click="e1 = 6">
                        Continue
                    </v-btn>
                    <v-btn text>Cancel</v-btn>
                </v-stepper-content>
                <v-stepper-content step="6">
                    <v-card class=" mx-auto elevation-2 " max-width="600">
                        <v-container>
                            <v-layout row wrap class="m-3">
                                <v-flex xs12 sm12 md12>
                                    <v-text-field label="Name" v-model="var_name_invitations"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <v-text-field type="email" label="Email" v-model="var_email_invitations"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <v-btn color="success" @click="addInvitation" block>Add Invitation</v-btn>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <v-data-table :headers="headers_invitations" :items="data_invitations" :items-per-page="5" class="elevation-1">
                                    </v-data-table>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                    <v-btn color="primary" @click="addFinal">
                        Finish
                    </v-btn>
                    <v-btn text>Cancel</v-btn>
                </v-stepper-content>
            </v-stepper-items>
        </v-stepper>
    </v-app>
</template>
<script>
import pdf from "vue-pdf";
export default {
    components: {
        pdf
    },
    data() {
        return {
            var_title_audition: "",
            var_description_audition: "",
            var_script_text_audition: "",
            var_banner_audition: "",
            var_attachment_audition: "",
            e1: 1,
            var_project_name: '',
            var_project_character_name: '',
            var_project_character_description: '',
            characterItems: [],
            questionsItems: [],
            var_question_project: '',
            pdfName: "",
            imgF: "",
            picker: new Date().toISOString().substr(0, 10),
            project_id: '',
            headers: [
                { text: "Title Audition", value: "title_audition" },
                { text: "Description Audition", value: "description_audition" },
                { text: "End Date Available Audition", value: "end_date_available" },
            ],
            headers_scene: [
                { text: "Character Name", value: "character_scene" },
                { text: "Character Description", value: "descripction_character_scene" },
                { text: "Attachmend Script (PDF)", value: "script_attached_audition" },
                { text: "Title Audition", value: "audition.title_audition" },

            ],
            headers_invitations: [
                { text: "Name", value: "name" },
                { text: "email", value: "email" },
            ],
            data_auditions: [],
            var_audition_selected: [],
            var_description_character_scene: '',
            var_attachment_audition: '',
            audition_id: '',
            data_character: [],
            var_character_selected: '',
            data_scene: [],
            data_invitations: [],
            var_name_invitations: '',
            var_email_invitations: '',
        }
    },
    methods: {
        async addFinal() {
            var t = this
            this.$swal({
                title: 'Do you want another Vaudition?',
                text: "you want to add another vaudition or you want to end and save the vaudition",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, I want to add another vaudition!',
                cancelButtonText: 'No, save and finish',
            }).then(async(result) => {
                if (result.value) {
                    t.e1 = 2
                }
                if (result.dismiss) {

                    const URL = `send-invitation`
                    try {
                        let { data } = await axios.post(URL, { invitations: this.data_invitations })
                        this.$router.push({ name: 'dashboard.proyect' });
                    } catch (e) {
                        console.log(e);
                    }
                }
            })

        },
        addInvitation() {

            this.data_invitations.push({ name: this.var_name_invitations, email: this.var_email_invitations })
        },
        async getScene() {
            const URL = `get-scene`;
            try {
                let { data } = await axios(URL);
                this.data_scene = data;
            } catch (e) {
                console.log(e);
            }
        },
        async getCharanter(id) {
            const URL = `${this.project_id}/get-character`
            try {
                let { data } = await axios(URL)
                this.data_character = data
            } catch (e) {
                console.log(e);
            }
        },
        async addScene() {
            const URL = `save-scene`;
            var script_attached_audition,
                id_audition,
                character_scene,
                descripction_character_scene,
                dialogue_scene;
            var scene = new FormData();
            scene.append("script_attached_audition", this.var_attachment_audition);
            scene.append("id_audition", this.var_audition_selected.id);
            scene.append("character_scene", this.var_character_selected.character_name);
            scene.append("descripction_character_scene", this.var_character_selected.description_character);

            try {
                let { data } = await axios.post(URL, scene, {
                    headers: { "Content-type": "multipart/form-data" }
                });
                this.getScene();
                this.dialog_scene = false;
                this.el = 6
            } catch (e) {
                console.log(e);
            }
        },
        PDFcharge(e) {
            this.var_attachment_audition = e.target.files[0];
            this.pdfName = pdf.createLoadingTask(
                URL.createObjectURL(e.target.files[0])
            );
        },
        async getAudition() {
            const URL = `${this.project_id}/get-audition`;
            try {
                let { data } = await axios(URL);
                this.data_auditions = data;
            } catch (e) {
                console.log(e);
            }
        },
        addQuestions() {
            var exits = this.questionsItems.find(item => item.question === this.var_question_project)
            if (!exits) {

                this.questionsItems.push({ question: this.var_question_project })
                this.var_question_project = ''
            }
        },
        addCharacterItems() {
            var exits = this.characterItems.find(item => item.name === this.var_project_character_name)
            if (!exits) {
                this.characterItems.push({ name: this.var_project_character_name, description: this.var_project_character_description })
                this.var_project_character_name = ''
                this.var_project_character_description = ''
            }
        },
        async addProject() {
            const URL = `save-project`
            try {
                let { data } = await axios.post(URL, {
                    project_name: this.var_project_name,
                    characters: this.characterItems,
                    questions: this.questionsItems
                })
                this.project_id = data.id
                this.e1 = 4
                this.getCharanter();
            } catch (e) {
                console.log(e);
            }
        },
        limpiar() {
            this.var_project_name = ''
            this.var_project_character_name = ''
            this.var_project_character_description = ''
            this.var_question_project = ''
            this.project_id = ''
        },
        async SaveAudition() {
            const URL = `save-audition`;
            var data = new FormData();
            data.append("title_audition", this.var_title_audition);
            data.append("description_audition", this.var_description_audition);
            data.append("banner_audition", this.var_banner_audition);
            data.append("id_project", this.project_id);
            data.append("picker", this.picker);

            try {
                let audition = await axios.post(URL, data, {
                    headers: { "Content-type": "multipart/form-data" }
                });
                this.getAudition();
            } catch (e) {
                console.log(e);
            }
        },
        PDFcharge(e) {
            this.var_attachment_audition = e.target.files[0];
            this.pdfName = pdf.createLoadingTask(
                URL.createObjectURL(e.target.files[0])
            );
        },
        IMGcharge(e) {
            this.var_banner_audition = e.target.files[0];
            this.imgF = URL.createObjectURL(e.target.files[0]);
        },
    }
}

</script>
