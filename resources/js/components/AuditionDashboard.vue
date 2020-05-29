<template>
    <v-app>
        <v-container>
            <v-layout row wrap>
                <v-flex xs12 sm12 md12>
                    <v-btn fab dark color="primary" @click="dialog_character = true">
                        <v-icon x-large color="white">mdi-plus</v-icon>
                    </v-btn>
                </v-flex>
                <v-flex xs12 sm12 md4 v-for="(audition, key) in data_character" :key="audition.id" class="m-3">
                    <v-card max-width="344">
                        <v-card-text>
                            <strong>
                                <h2>Character: {{audition.character_name}}</h2>
                            </strong>: <br />
                            <strong>
                                <h2> Description: {{audition.description_character}}</h2>
                            </strong>: <br />
                        </v-card-text>
                        <v-card-actions>
                            <router-link :to="{ name: 'audition.person', params: { id_project: $route.params.id_project, id_user: $route.params.id_user, id_character: audition.id }}">
                                READ
                            </router-link>
                            <v-spacer></v-spacer>
                            <v-btn icon>
                                <v-icon>mdi-heart</v-icon>
                            </v-btn>
                            <v-btn icon>
                                <v-icon>mdi-share-variant</v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
        <v-dialog v-model="dialog_character" width="800">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    Add new character
                </v-card-title>
                <v-card-text>
                    <v-card>
                        <v-card-title> Character</v-card-title>
                        <v-container>
                            <v-row>
                                <v-col cols="12" xs="12" sm="12" md="12">
                                    <v-text-field label="Character Name" v-model="var_name_character"></v-text-field>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="12">
                                    <v-textarea color="black" label="Character Description" v-model="var_description_character"></v-textarea>
                                </v-col>
                            </v-row>
                            <v-row justify="center">
                                <v-col cols="12" xs="12" sm="12" md="12">
                                    <h1>Questions</h1>
                                </v-col> 
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
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="addCharacter">
                        I accept
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
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
            dialog_character: false,
            data_character: [],
            var_name_character: '',
            var_description_character: '',
            query: '',
            questions: [],
            script: '',
            pdfName: '',
        }
    },
    mounted() {
        this.getAudition();
    },
    methods: {
        PDFcharge(e) {
            this.script = e.target.files[0];
            this.pdfName = pdf.createLoadingTask(
                URL.createObjectURL(e.target.files[0])
            );
        },
        async getAudition() {
            const URL = `${this.$route.params.id_project}/get-character`
            try {
                let { data } = await axios(URL)
                this.data_character = data.character_related
            } catch (e) {
                console.log(e);
            }
        },
        addQuerys() {
            this.questions.push({ question: this.query })
            this.query = ''
        },
        async addCharacter(){
            const URL = `save-character`
            try {
                 var form = new FormData()
                form.append('name', this.var_name_character);
                form.append('description', this.var_description_character);
                form.append('questions', JSON.stringify(this.questions));
                form.append('script_file', this.script);
                form.append('id', this.$route.params.id_project);
                let { data } = await axios.post(URL, form, { headers: { "Content-Type": "multipart/form-data" } })
                this.dialog_character = false
                this.getAudition();
            } catch(e) {
                console.log(e);
            }
        }
    }
}

</script>
