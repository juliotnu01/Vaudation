<template>
    <v-app>
        <v-container>
            <v-row>
                <v-col cols="12" xs="12" sm="4" md="4" v-for="n in 12" v-if="skeletonCardLoading">
                    <skeletonComponent/>
                </v-col>
                <v-col cols="12" v-if="!skeletonCardLoading && user.rol_user == 1 || user.rol_user == 3">
                    <v-btn fab dark color="primary" @click="dialog_character = true">
                        <v-icon x-large color="white">mdi-plus</v-icon> 
                    </v-btn>
                    Add new character to project
                </v-col>
                <v-col cols="12" xs="12" sm="4" md="4" v-for="(audition, key) in auditions.character_related" :key="key" v-if="!skeletonCardLoading">
                    <v-card max-width="344" >
                        <v-list-item>
                           <!--  <v-list-item-avatar color="grey"></v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title class="headline">Our Changing Planet</v-list-item-title>
                                <v-list-item-subtitle>by Kurt Wagner</v-list-item-subtitle>
                            </v-list-item-content> -->
                        </v-list-item>
                        <!-- <v-img src="https://cdn.vuetifyjs.com/images/cards/mountain.jpg" height="194"></v-img> -->
                        <v-card-text>
                             <strong>
                                <h2>Character: {{audition.character_name}}</h2>
                            </strong>: <br />
                            <strong>
                                <h4> Description: {{audition.description_character}}</h4>
                            </strong>: <br />
                        </v-card-text>
                        <v-card-actions>
                            <router-link :to="{ name: 'audition.person', params: { id_project: $route.params.id_project, id_user: $route.params.id_user, id_character: audition.id }}">
                                READ
                            </router-link>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
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
import { mapGetters, mapState } from 'vuex'
import pdf from "vue-pdf";
import skeletonComponent from './skeletonComponent.vue'
export default {
    components: {
        pdf,
        skeletonComponent
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
        this.$root.services.auditionService.get(this.$route.params.id_project)
        this.$root.services.userService.get(this.$route.params.id_user)
    },
    computed: {
        ...mapGetters(['user', 'auditions']),
        ...mapState(['skeletonCardLoading'])
    },
    methods: {
        PDFcharge(e) {
            this.script = e.target.files[0];
            this.pdfName = pdf.createLoadingTask(
                URL.createObjectURL(e.target.files[0])
            );
        },
        addQuerys() {
            this.questions.push({ question: this.query })
            this.query = ''
        },
        async addCharacter() {
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
                 this.$root.services.auditionService.get(this.$route.params.id_project)
            } catch (e) {
                console.log(e);
            }
        }
    }
}

</script>
