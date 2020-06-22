<template>
    <v-app>
        <v-stepper v-model="var_step">
            <v-stepper-header>
                <v-stepper-step editable :complete="var_step > 1" step="1">Step 1 Project Name</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step editable :complete="var_step > 2" step="2">step 2 Add Character and Description </v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step editable :complete="var_step > 3" step="3">step 3 Add Questions / Comments</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step editable :complete="var_step > 4" step="4">step 4 Add Scene</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step editable step="5">step 5 Send Invitations </v-stepper-step>
            </v-stepper-header>
            <v-stepper-items>
                <v-stepper-content step="1">
                    <v-row>
                        <v-col>
                            <v-card class="mb-12 mx-auto elevation-2" height="400px" max-width="344">
                                <v-container>
                                    <v-layout row wrap>
                                        <v-flex xs12 sm12 md12 class="m-2">
                                            <v-text-field label="Project Name" v-model="var_project.name_project"></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12 class="m-3">
                                            <h3>Project Name: </h3>{{var_project.name_project}}
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="text-right">
                            <v-btn color="primary" @click="addNameProject">
                                Continue
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>
                <v-stepper-content step="2">
                    <v-row justify="center">
                        <v-col cols="12" xs="12" sm="12" md="4" class="text-center">
                            <v-card>
                                <img src="https://img.icons8.com/wired/128/000000/movie-projector.png">
                                <v-card-title> {{var_project.name_project}}</v-card-title>
                                </img>
                            </v-card>
                        </v-col>
                        <v-col cols="12" xs="12" sm="12" md="4">
                            <v-card>
                                <v-card-title> Character</v-card-title>
                                <v-container>
                                    <v-row justify="center">
                                        <v-col cols="12" xs="12" sm="12" md="5">
                                            <img src="https://img.icons8.com/wired/128/000000/user.png" />
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="5">
                                            <img src="https://img.icons8.com/pastel-glyph/128/000000/user-female--v1.png" />
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12" xs="12" sm="12" md="12">
                                            <v-text-field label="Character Name" v-model="var_name_character"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="12">
                                            <v-textarea color="black" label="Character Description" v-model="var_description_character"></v-textarea>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="text-right">
                            <v-btn color="primary" @click="addCharacter">
                                Continue
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>
                <v-stepper-content step="3">
                    <v-row justify="center">
                        <v-col cols="12" xs="12" sm="12" md="4">
                            <v-card>
                                <v-container>
                                    <v-row justify="center">
                                        <v-col cols="12" xs="12" sm="12" md="12">
                                            <img src="https://img.icons8.com/ios/128/000000/ask-question.png" />
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="12">
                                            <v-text-field v-model="query" label="Questions Character"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="12">
                                            <v-btn color="success btn bg-info" block @click="addQuerys()">Add</v-btn>
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Questions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(q, i) in questions" :key="i">
                                                        <td>{{q.question}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="text-right">
                            <v-btn color="primary" @click="addQuestions">
                                Continue
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>
                <v-stepper-content step="4">
                    <v-row>
                        <v-col cols="12" xs="12" sm="12" md="12">
                            <v-card>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" xs="12" sm="12" md="12" class="text-center">
                                            <h1>Script File (PDF)</h1>
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="12">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" ref="customFile" @change="PDFcharge($event)" />
                                                <label class="custom-file-label" for="customFile">Choose script file</label>
                                            </div>
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="12">
                                            <pdf :src="pdfName"></pdf>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="text-right">
                            <v-btn color="primary" @click=" var_step = 5">
                                Continue
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>
                <v-stepper-content step="5">
                    <v-row justify="center">
                        <v-col cols="6">
                            <v-card class="mx-auto" max-width="400">
                                <v-card-title>
                                    <img src="https://img.icons8.com/wired/64/000000/movie-projector.png">
                                    <span class="title ml-5 font-weight-light">{{var_project.name_project}}</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-textarea color="black" label="Note" v-model="invitation.note" background-color="light-blue"></v-textarea>
                                </v-card-text>
                                <v-card-actions>
                                    <v-list-item class="grow">
                                        <v-row align="center" justify="end">
                                            Add Invitations
                                            <v-btn :color="show === true ? 'info': 'default'" text @click.prevent="show = !show">
                                                <v-icon class="mr-1">mdi-share-variant</v-icon>
                                            </v-btn>
                                            <span class="subheading">{{invitations.length}}</span>
                                        </v-row>
                                    </v-list-item>
                                </v-card-actions>
                                <v-expand-transition>
                                    <div v-show="show">
                                        <v-divider></v-divider>
                                        <v-card-text>
                                            <v-row justify="center">
                                                <v-col cols="12" xs="12" sm="12" md="12">
                                                    <v-text-field v-model="invitation.name" label="Name"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="12">
                                                    <v-text-field v-model="invitation.email" label="Email"></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="12">
                                                    <v-btn color="info" text block @click.prevent="addInvitation"> Add invitation</v-btn>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(invitation, i) in invitations" :key="i">
                                                                <td>{{invitation.name}}</td>
                                                                <td>{{invitation.email}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </v-col>
                                            </v-row>
                                        </v-card-text>
                                    </div>
                                </v-expand-transition>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="text-right">
                            <v-btn color="primary" @click="dialog_finish = true ">
                                Continue
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>
            </v-stepper-items>
        </v-stepper>
        <v-dialog v-model="dialog_finish" persistent max-width="700px" transition="dialog-transition">
            <v-card>
                <v-toolbar>
                    <v-row aling="end" justify="end">
                        <v-toolbar-items>
                            <v-card-title primary-title>
                                Finalize
                            </v-card-title>
                        </v-toolbar-items>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn icon @click="dialog_finish = false">
                                <v-icon>mdi-close</v-icon>
                            </v-btn>
                        </v-toolbar-items>
                    </v-row>
                </v-toolbar>
                <v-card-actions>
                    <v-row>
                        <v-col cols="12" xs="12" sm="12" md="12">
                            <v-btn color="success" block @click="AddAnotherCharacter">Add another character to project: {{ var_project.name_project }}</v-btn>
                        </v-col>
                        <v-col cols="12" xs="12" sm="12" md="12">
                            <v-btn color="info" block @click="anotherCharacterToAnotherProject">Add another character to another project</v-btn>
                        </v-col>
                        <v-col cols="12" xs="12" sm="12" md="12">
                            <v-btn color="warning" block @click="addNewProject">Create a new project</v-btn>
                        </v-col>
                        <v-col cols="12" xs="12" sm="12" md="12">
                            <v-btn color="error" block @click="reviewSubmissions">Review submissions</v-btn>
                        </v-col>
                        <v-col cols="12" xs="12" sm="12" md="12">
                            <v-btn color="default" block @click="LeaveAudtionAndSave">Leave vauditions</v-btn>
                        </v-col>
                    </v-row>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="dialog_another_character_to_another_project" width="800">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    Add another character to another project
                </v-card-title>
                <v-card-text>
                    <v-select :items="var_projects_to_redirect" label="Select Project" return-object item-text="project_name" v-model="project_selected">
                    </v-select>
                    <v-btn color="info" @click="goToProject(project_selected.id)">Go to Project:{{ project_selected.project_name}} </v-btn>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialog_another_character_to_another_project = false">
                        Cancel
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="dialog_review" width="900">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    Review submissions
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-card>
                            <v-row>
                                <v-col cols="12" sm="12" xs="12" md="12">
                                    <h4> Project: {{var_project.name_project}}</h4>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="6" v-for="(character, c) in var_project.character" :key="c">
                                    <div>
                                        Character
                                        <p> -Name character: {{character.name}}<br />
                                            -Descripcion character: {{character.description}}
                                        </p>
                                    </div>
                                    <div>
                                        Questions
                                        <p v-for="q in character.questions">
                                            - {{q.question}}
                                        </p><br />
                                    </div>
                                    <div>
                                        Invitations
                                        <p v-for="i in invitations">
                                            - name: {{i.name }}<br />
                                            - email: {{i.email}}
                                        </p><br />
                                    </div>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-container>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialog_review = false">
                        Cancel
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        </div>
    </v-app>
</template>
<script>
import { mapGetters } from 'vuex'
import pdf from "vue-pdf";

export default {
    components: {
        pdf
    },
    computed: {
        ...mapGetters(['project'])
    },
    data() {
        return {
            dialog_review: false,
            project_selected: '',
            var_projects_to_redirect: [],
            dialog_another_character_to_another_project: false,
            dialog_finish: false,
            var_step: 1,
            var_name_character: '',
            var_description_character: '',
            query: '',
            questions: [],
            invitations: [],
            invitation: {
                name: '',
                email: '',
                note: '',
            },
            var_project: {
                id: '',
                name_project: '',
                character: [],
            },
            pdfName: '',
            show: false,


        }
    },
    methods: {
        PDFcharge(e) {
            var character = this.var_project.character.findIndex(item => item.name === this.var_name_character)
            this.var_project.character[character].script = e.target.files[0];
            this.pdfName = pdf.createLoadingTask(
                URL.createObjectURL(e.target.files[0])
            );
        },
        addQuerys() {
            var valid  = this.questions.some(item => item.question === this.query)

            if (valid) {
                this.$swal('warning', 'Questions already created', 'warning')
            }else if(this.query === ''){
                this.$swal('warning', 'Input questions character cannot be empty', 'warning')
            }else {
            this.questions.push({ question: this.query })
            this.query = ''
            }
        },
        addQuestions() {
            this.var_step = 4
            var character = this.var_project.character.findIndex(item => item.name === this.var_name_character)
            this.var_project.character[character].questions = this.questions

        },
        deleteQuestion(item) {
            let index = this.var_project.questions.findIndex(item => item.question === item.question)
            this.var_project.questions.splice()
        },
        addInvitation() {
            var character = this.var_project.character.findIndex(item => item.name === this.var_name_character)
            this.var_project.character[character].invitations.push({ name: this.invitation.name, email: this.invitation.email, note: this.invitation.note })
            this.invitations.push({ name: this.invitation.name, email: this.invitation.email })
            this.invitation.name = ''
            this.invitation.email = ''
            this.invitation.note = ''

        },
        async addProject() {


            this.$root.services.projectService.add(this.var_project.character, this.var_project.name_project, this.$route.path)
            this.$router.push({ name: 'dashboard.proyect', params: { userId: this.$route.params.id_user } })
            this.dialog_finish = false
            this.var_step = 1
            this.limpiar()
        },
        limpiar() {
            this.query = ''
            this.invitation = {
                name: '',
                email: '',
                note: '',
            }
            this.var_project = {
                id: '',
                name_project: '',
                character: [],
                invitations: []
            }
            this.pdfName = ''
        },
        addCharacter() {

            var valid = this.var_project.character.some(item => item.name === this.var_name_character)
            if (valid) {
                this.$swal('warning', 'this name of character already are created', 'warning')
            } else if (this.var_name_character === '' || this.var_description_character === '') {
                this.$swal('warning', 'It\'s necessary put a name and description of the character', 'warning')
            } else {

                this.var_step = 3
                this.var_project.character.push({
                    name: this.var_name_character,
                    description: this.var_description_character,
                    script: '',
                    questions: [],
                    invitations: []

                })
            }

        },
        AddAnotherCharacter() {

            this.var_step = 2
            this.var_name_character = ''
            this.var_description_character = ''
            this.questions = []
            this.invitations = []
            this.dialog_finish = false
            this.$refs.customFile.value = '';
            this.pdfName = ''

        },
        anotherCharacterToAnotherProject() {
            this.getProjects()
            this.dialog_another_character_to_another_project = true
        },
        async getProjects() {
            const URL = `get-project/user/${this.$route.params.id_user}`
            try {
                let { data } = await axios(URL)
                this.var_projects_to_redirect = data.project_related
            } catch (e) {
                console.log(e);
            }
        },
        goToProject(id_project) {
            this.$router.push({ name: 'dashboard.casting', params: { id_user: this.$route.params.id_user, id_project: id_project } })
            this.$root.services.projectService.add(this.var_project.character, this.var_project.name_project)
        },
        addNewProject() {
            this.addProject()
            this.var_step = 1
            this.var_name_character = ''
            this.var_description_character = ''
            this.questions = []
            this.invitations = []
            this.dialog_finish = false
            this.$refs.customFile.value = ''
            this.pdfName = ''
            this.var_project = {
                id: '',
                name_project: '',
                character: [],
            }
        },
        reviewSubmissions() {
            this.dialog_review = true
        },
        LeaveAudtionAndSave() {
            this.addProject();
        },
        async addNameProject() {
            await this.$root.services.projectService.get()
            var valid = this.project.some(item => item.project_name === this.var_project.name_project)
            if (valid) {
                this.$swal('warning', 'this name project already exists', 'warning')
            } else if (this.var_project.name_project === '') {
                this.$swal('warning', 'It\'s necessary put a project name ', 'warning')
            } else {
                this.var_step = 2
            }
        }
    }
}

</script>
