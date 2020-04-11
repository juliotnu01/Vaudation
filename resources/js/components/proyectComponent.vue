<template>
    <v-app>
        <v-stepper v-model="e1">
            <v-stepper-header>
                <v-stepper-step :complete="e1 > 1" step="1">Step 1 Project Name</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step :complete="e1 > 2" step="2">step 2 Add Character and Description </v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step step="3">step 3 Add Questions</v-stepper-step>
            </v-stepper-header>
            <v-stepper-items>
                <v-stepper-content step="1">
                    <v-card class="mb-12 mx-auto elevation-2"  height="400px" max-width="344">
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
                    <v-card class="mb-12 mx-auto elevation-2"  height="400px" max-width="500">
                        <v-container>
                            <v-layout row wrap>
                                <v-flex xs12 sm12 md3>
                                    <v-text-field label="Character Name" v-model="var_project_character_name"></v-text-field>
                                </v-flex>
                                <v-spacer></v-spacer>
                                <v-flex xs12 sm12 md4>
                                    <v-text-field label="Character Description" v-model="var_project_character_description"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm12 md4>
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
                                                <td>{{character.description}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                    <v-btn color="primary"  @click="e1 = 3">
                        Continue
                    </v-btn>
                    <v-btn text>Cancel</v-btn>
                </v-stepper-content>
                <v-stepper-content step="3">
                    <v-card class="mb-12 mx-auto elevation-2"  height="400px" max-width="500">
                        <v-container>
                            <v-layout row wrap>
                                <v-flex xs12 sm12 md5>
                                    <v-text-field label="Questions ProJect" v-model="var_question_project"></v-text-field>
                                </v-flex>
                                <v-spacer></v-spacer>
                                <v-flex xs12 sm12 md5>
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
            </v-stepper-items>
        </v-stepper>
    </v-app>
</template>
<script>
export default {
    data() {
        return {
            e1: 1,
            var_project_name: '',
            var_project_character_name: '',
            var_project_character_description: '',
            characterItems: [],
            questionsItems: [],
            var_question_project: '',
        }
    },
    methods: {
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
                this.$router.push({ name: 'dashboard.proyect' });
                this.limpiar();
                this.e1 = 1
            } catch (e) {
                console.log(e);
            }
        },
        limpiar() {
            this.var_project_name = ''
            this.var_project_character_name = ''
            this.var_project_character_description = ''
            this.var_question_project = ''
        }
    }
}

</script>
