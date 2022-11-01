<template lang="">
    <div>
        <div class="col-md-12">
            <el-link icon="el-icon-circle-plus" title="Criar novo usuário"
            @click="addLocator" type="primary">
                Locador
            </el-link>
        </div>
        <div class="col-md-12">
           <div v-for="item in usersLocator" :key="item.id">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nome do locador</label>
                        <input type="text" class="form-control" 
                        :class="{'hide-border': showBorder}" v-model="item.name"
                        @focus="addClassInput" @blur="hideClassInput">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">CPF do locador</label>
                        <input type="text" class="form-control" 
                        :class="{'hide-border': showBorder}" v-model="item.cpf"
                        @focus="addClassInput" @blur="hideClassInput">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">E-mail do locador</label>
                        <input type="text" class="form-control" 
                        :class="{'hide-border': showBorder}" v-model="item.email"
                        @focus="addClassInput" @blur="hideClassInput">
                    </div>
                </div>
           </div>
        </div>

        <div class="col-md-12" v-if="locator"  style="box-shadow: 0 2px 4px rgb(0 0 0 / 37%);margin-top: 5px">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="survey_inspetor_name">Nome do Locador</label>
                        <input v-model="survey_inspetor_name" placeholder="Nome do Vistoriador" 
                        name="survey_inspetor_name" type="text" 
                        class="form-control" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="survey_inspetor_name">CPF do Locador</label>
                        <input v-model="survey_inspetor_cpf" placeholder="Nome do Vistoriador" 
                        name="survey_inspetor_name" type="text" 
                        class="form-control" />
                </div>                
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="survey_inspetor_name">E-mail do Locador</label>
                        <input v-model="survey_inspetor_email" placeholder="Nome do Vistoriador" 
                        name="survey_inspetor_name" type="text" 
                        class="form-control" />
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
        users: Array
    },
    data() {
        return {
            locator: true,
            usersLocator: [],
            survey_inspetor_name: '',
            survey_inspetor_cpf: '',
            survey_inspetor_email: '',
            showBorder : true
        }
    },
    created() {
        this.usersLocator = this.users
        console.log(this.users)
    },
    methods: {
        addLocator() {
            console.log(this.locator)
            this.locator = true
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
</style>