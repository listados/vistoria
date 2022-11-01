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
                        @focus="addClassInput" @blur="hideClassInput">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">CPF do {{typeSurvey}}</label>
                        <input type="text" class="form-control" 
                        :class="{'hide-border': showBorder}" v-model="item.cpf"
                        @focus="addClassInput" @blur="hideClassInput">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">E-mail do {{typeSurvey}}</label>
                        <input type="text" class="form-control" 
                        :class="{'hide-border': showBorder}" v-model="item.email"
                        @focus="addClassInput" @blur="hideClassInput">
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
                        @blur="addUserSurvey(survey_inspetor_name, typeSurvey, 'name')" class="form-control"  />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="survey_inspetor_name">CPF do {{typeSurvey}}</label>
                        <input v-model="survey_inspetor_cpf" placeholder="Nome do Vistoriador" 
                        name="survey_inspetor_name" type="text" 
                        @blur="addUserSurvey(survey_inspetor_name, typeSurvey, 'cpf')"class="form-control" />
                </div>                
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="survey_inspetor_name">E-mail do {{typeSurvey}}</label>
                        <input v-model="survey_inspetor_email" placeholder="Nome do Vistoriador" 
                        name="survey_inspetor_name" type="text" 
                        @blur="addUserSurvey(survey_inspetor_name, typeSurvey, 'email')" class="form-control" />
                </div>
            </div>
            <div class="col-md-1 text-center">
                <div class="form-group">
                    <label for="survey_inspetor_name">Remover</label>
                    <el-button type="danger" icon="el-icon-delete" 
                    title="Excluir esse item" size="small"></el-button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        typeSurvey: String,
        idSurvey: String
    },
    data() {
        return {
            locator: true,
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
            })

        },
        addUserSurvey(survey_inspetor_name, typeSurvey, params) {
            console.log({survey_inspetor_name})
            console.log({typeSurvey})
            console.log({params})
            console.log('id ', this.idSurvey)
            axios.post(domain_complet  + 'api/survey/add-user')
            .then( (res) => {
                console.log({res})
            })
            .catch()
        },
        addLocator() {
            console.log(this.locator)
            this.locator = true
        },
        deleteUserSurvey(id){
            console.log({id})
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
        background-color: #3c8dbc;
        color: #fff;
        box-shadow: 0 2px 4px rgb(0 0 0 / 37%);
        margin-top: 5px;
        padding-top: 5px;
    }
</style>