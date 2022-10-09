<template lang="">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" required v-model="form.address" class="form-control" id="" placeholder="Logradouro">
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label>Número</label>
                            <input type="text" required  v-model="form.number" class="form-control" id="" placeholder="Número">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Complemento</label>
                            <input type="text" required v-model="form.complement" class="form-control" id="" placeholder="Complemento">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Bairro</label>
                            <input type="text" required v-model="form.district" class="form-control" id="" placeholder="Bairro">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" required v-model="form.city" class="form-control" id="" placeholder="Cidade">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Estado</label>
                            <input type="text" required v-model="form.state" class="form-control" id="" placeholder="Estado">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>E-mail</label>
                            <input type="email" v-model="form.email" class="form-control" id="" placeholder="E-mail">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telefone Fixo</label>
                            <input type="text" required v-model="form.phoneFixed" v-mask="'(##) ####-####'" 
                            class="form-control" id="" placeholder="Telefone Fixo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telefone Celular</label>
                            <input type="text" required v-model="form.mobile"  v-mask="'(##) ####-####'" 
                            class="form-control" id="" placeholder="Telefone Celular">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>CNPJ</label>
                        <input type="text" required v-model="form.cnpj"  v-mask="'##.###.###/####-##'" 
                        class="form-control" id="" placeholder="CNPJ">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CRECI/CE</label>
                            <input type="text" required v-model="form.creci" required class="form-control" id="" placeholder="CRECI/CE">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CEP</label>
                            <input type="text" required v-model="form.cep" v-mask="'##.###-##'" 
                            class="form-control" id="" placeholder="CEP">
                        </div>
                    </div>
                </div>

            </div>    
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right" title="Cadastrar ou alterar contato"> 
                    <i class="fa fa-save"></i> 
                    <span v-if="typeSave == 'create'">Cadastrar</span>
                    <span v-if="typeSave == 'update'">Alterar</span>
                </button>
                <input type="hidden" v-model="form.id">
                <button type="button" @click="resetForm(form)" class="btn btn-default pull-left" title="Limpar" v-if="typeSave == 'update'"> 
                    <span>Cancelar alteração</span>
                </button>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        form: Object,
        typeSave: String
    },
    methods: {
        resetForm(form) {
            this.$emit('resetFormContact', form)
        }
    },
}
</script>
<style lang="">
    
</style>