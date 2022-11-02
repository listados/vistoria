<template lang="">
    <div>
        <div class="col-md-12">
            <el-link icon="el-icon-circle-plus" title="Criar novo usuário"
            @click="addLocator" type="primary">
                {{typeSurvey}}
            </el-link>
        </div>
        <div class="col-md-12">
           <div v-for="item in usersLocator" :key="item.id">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nome do {{typeSurvey}}</label>
                        <input type="text" class="form-control" 
                        :class="{'hide-border': showBorder}" v-model="item.name"
                        name="survey_inspetor_name" 
                        @focus="addClassInput" @blur="addUserSurvey($event, 'name', item.id)">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">CPF do {{typeSurvey}}</label>
                        <input type="text" class="form-control" 
                        :class="{'hide-border': showBorder}" v-model="item.cpf"
                        name="survey_inspetor_cpf" 
                        @focus="addClassInput" @blur="addUserSurvey($event, 'cpf', item.id)">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">E-mail do {{typeSurvey}}</label>
                        <input type="text" class="form-control" 
                        :class="{'hide-border': showBorder}" v-model="item.email"
                        name="survey_inspetor_email" 
                        @focus="addClassInput" @blur="addUserSurvey($event, 'email', item.id)">
                    </div>
                </div>
                <div class="col-md-1 text-center">
                    <div class="form-group">
                        <label for="survey_inspetor_name">Remover</label>
                        <el-button type="danger" icon="el-icon-delete" 
                        title="Excluir esse item" size="small"
                        @click="deleteUserSurvey(item.relation_survey_user_id)">
                        </el-button>
                    </div>
                </div>
           </div>
        </div>

        <div class="col-md-12 add-users" v-if="locator">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="survey_inspetor_name">Nome do {{typeSurvey}}</label>
                        <input v-model="survey_inspetor_name" placeholder="Nome do Vistoriador" 
                        name="survey_inspetor_name" type="text" 
                        class="form-control"  />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="survey_inspetor_name">CPF do {{typeSurvey}}</label>
                        <input v-model="survey_inspetor_cpf" placeholder="Nome do Vistoriador" 
                        name="survey_inspetor_cpf" type="text" 
                        class="form-control" />
                </div>                
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>E-mail do {{typeSurvey}}</label>
                        <input v-model="survey_inspetor_email" placeholder="Nome do Vistoriador" 
                        name="survey_inspetor_email" type="text" 
                       class="form-control" 
                       />
                       <!-- @blur="addUserSurvey($event, 'email')"  -->
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group text-center">
                    <div class="col-md-12">
                        <label>Ação</label>
                    </div>
                    <el-button
                        type="default" icon="el-icon-circle-plus" 
                        title="Criar usuário" size="small"
                        @click="addUser">
                    </el-button>
                    <el-button 
                        type="danger" icon="el-icon-delete" 
                        title="Excluir esse item" size="small"
                        @click="removeElement">
                    </el-button>
                </div>
               
            </div>
        </div>
    </div>
</template>
<script>
import { runInThisContext } from 'vm'

export default {
    props: {
        typeSurvey: String,
        idSurvey: String
    },
    data() {
        return {
            locator: false,
            usersLocator: [],
            survey_inspetor_name: '',
            survey_inspetor_cpf: '',
            survey_inspetor_email: '',
            showBorder : true,
            typeSurvey: ''
        }
    },
    created() {
        this.getUsers()
    },
    methods: {
        getUsers(){
            axios.get(domain_complet+'api/survey/user-survey/'+this.idSurvey+'/'+this.typeSurvey)
            .then( (res) => {
                this.usersLocator = res.data
            })
            .catch( (err)=>{
                this.$message({
                    showClose: true,
                    type: 'error',
                    message: ' Ops! Ocorreu um erro: '+ err.data.message
                });
            })\te
        },
        removeElement() {
            this. clearFields()
            this.locator = false
        },
        clearFields() {            
            this.survey_inspetor_name = ''
            this.survey_inspetor_cpf = ''
            this.survey_inspetor_email = ''
        },
        addUser() {
            var createUser = {
                relation_survey_user_id_survey: this.idSurvey,
                relation_survey_user_type: this.typeSurvey,
                survey_inspetor_name: this.survey_inspetor_name,
                survey_inspetor_cpf: this.survey_inspetor_cpf,
                survey_inspetor_email: this.survey_inspetor_email,
            }
            axios.post(domain_complet  + 'api/survey/add-user', createUser)
            .then( (res) => {
                this.locator = false
                this.getUsers()
                this. clearFields()
            })
            .catch( (erro) =>{
                console.log({res})
            })
        },
        addUserSurvey(event, params, idUser) {
            var upUser = {
                relation_survey_user_id_survey: this.idSurvey,
                relation_survey_user_type: this.typeSurvey,
                params: params,
                relation_survey_user_id_user: idUser
            }
            upUser[event.target.name] = event.target._value

            axios.post(domain_complet  + 'api/survey/up-user', upUser)
            .then( (res) => {
                console.log({res})
                // this.locator = false
                this.getUsers()
            })
            .catch( (erro) =>{
                this.$message({
                    type: 'error',
                    message: res.data.message
                }); 
            })
        },
        addLocator() {
            this.locator = true
        },
        deleteUserSurvey(id){
            this.$confirm('Deseja realmente excluir esse '+this.typeSurvey+' ?', 'Excluir  '+this.typeSurvey, {
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não, desisto',
            type: 'error'
            }).then(() => {
                axios.delete(domain_complet + 'api/survey/delete-user/'+id)
                .then( (res)=>  {
                    this.getUsers()
                    this.$message({
                        type: 'success',
                        message: res.data.message
                    });  
                }).catch( (err)  =>  {
                    this.$message({
                        showClose: true,
                        type: 'error',
                        message: ' Ops! Ocorreu um erro:'
                    });
                })
                
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Delete canceled'
                });          
            });
        },
        addClassInput() {
            this.showBorder = false
        },
        hideClassInput() {
            this.showBorder = true
        }
       
    }
}
</script>
<style lang="">
    .hide-border {
        border: 0px solid #fff;
    }
    .add-users{
        /* background-color: #3c8dbc; */
        color: #211f1f;
        box-shadow: 0 2px 4px rgb(0 0 0 / 37%);
        margin-top: 5px;
        padding-top: 5px;
    }
</style>