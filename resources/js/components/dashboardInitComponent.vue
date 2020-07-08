<template>
    <v-app>
        <v-container>
            <v-row v-if="!user.status_user">
                <v-col cols="12">
                    <h1 class="text-center">Enter the activation code that we send to your email</h1>
                </v-col>
                <v-col cols="12" xs="12" sm="12" md="12" class="mt-2">
                    <v-text-field label="Enter code ..." outlined v-model="code_activation"></v-text-field>
                </v-col>
                <v-col cols="12" xs="12" sm="12" md="12">
                    <v-btn x-large color="success" dark block :loading="loading" @click="activationAccount">Activate</v-btn>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <loading/>
                        <router-view></router-view>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>
<script>
import { mapGetters, mapState } from 'vuex'
export default {
    props: {
        user_auth: {
            type: Object,
            default: { a: null, c: null }
        }
    },
    data() {
        return {
            loading: false,
            code_activation: '',
            invitation: '',
        }
    },
    computed: {
        ...mapState(['user']),
        ...mapGetters({
            overlay: 'overlay'
        }),
        overlay: {
            get() {
                return this.overlay
            },
            set(newVal) {
                this.$store.commit('setOverlay', newVal)
            }
        }
    },
    async mounted() {
            await this.$root.services.userService.get(this.user_auth.a)
             this.overlay = false
        if (this.user.status_user && this.$route.path != `/` ) {
            await this.$router.push({ name: 'dashboard.proyect', params: { id_user: this.user_auth.a } })
            this.overlay = false
        } else if(this.user.code_activation != null){
            await this.$router.push({ name: 'dashboard.proyect', params: { id_user: this.user_auth.a } })
            this.overlay = false
        }
         else {
            axios(`/api/user/${this.user_auth.a}/activate-user-login`)
            this.overlay = false
        }

    },
    methods: {
        async activationAccount() {
            this.loading = true
            try {
                const URL = '/api/activate-account'

                let { data } = await axios.post(URL, { code: this.code_activation, user: this.user_auth.a })
                this.loading = false


                if (this.user.rol_user == 2) {
                    var el = this
                    data.forEach(function(element, index) {
                        if (element.character_related.length > 0) {

                            element.character_related.forEach(function(element2, index) {
                                if (element2.invitations_related.length > 0) {

                                    element2.invitations_related.forEach(function(element3, index) {
                                        if (element3.route_invitation_satus) {
                                            el.invitation = element3
                                        }
                                    });

                                }

                            });
                        }
                    });

                    if (this.user.email === this.invitation.email) {
                        this.$router.push(`/user/${this.user_auth.a}${this.invitation.route_invitation}`)
                        this.$root.services.userService.get(this.user_auth.a)
                    } else {
                        this.$root.services.userService.get(this.user_auth.a)
                        this.$router.push({ name: 'dashboard.proyect', params: { id_user: this.user_auth.a } })
                    }
                } else {

                    this.$root.services.userService.get(this.user_auth.a)
                    this.$router.push({ name: 'dashboard.proyect', params: { id_user: this.user_auth.a } })
                    location.reload();
                }




            } catch (e) {
                console.log(e);
            }
        }
    }



};

</script>
