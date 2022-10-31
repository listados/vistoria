<template lang="">
<div>
    <div class="row">
        <div class="col-md-2">
            <el-dropdown @command="handleClick">
                <el-button class="btn btn-flat margin">
                {{labelBtnSearch}} <i class="el-icon-arrow-down el-icon--right"></i>
                </el-button>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item command="codigo">Código</el-dropdown-item>
                    <el-dropdown-item command="tipo">Tipo de Imóvel</el-dropdown-item>
                    <el-dropdown-item command="status">Status da Vistoria</el-dropdown-item>
                    <el-dropdown-item command="vistoriador">Vistoriador</el-dropdown-item>
                    <el-dropdown-item command="endereco">Endereço</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
        <div class="col-md-8">
            <el-input
            :placeholder="infoPlaceholder"
            v-model="input"
            clearable
            style="width: 100%"
            :type="typeInput"
            v-if="showInput"
            @change="search(input)">
                <el-button 
                    slot="append" 
                    class="btn bg-olive btn-flat" 
                    icon="el-icon-search"
                    style="width: 100px"
                    title="Pesquisar vistoria"
                    @click="search()"
                    :disabled="disabledBtnSeach">
                </el-button>
            </el-input>
            <el-select
                v-model="valueSelect" 
                :placeholder="infoPlaceholder" 
                v-show="showInput == false"
                style="width: 100%"
                @change="search(valueSelect)">
                <el-option            
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
                </el-option>
            </el-select>
        </div>
        <div class="col-md-2">
            <el-button type="primary"
            class="btn btn-block btn-primary">
                Criar Vistoria
            </el-button>
        </div>

        <!-- <a href="{{ 'vistoria/create' }}" class="btn bg-olive btn-flat pull-right load-modal"  tabindex="0"  data-toggle="popover" data-trigger="hover" data-content="Você criará uma nova vistoria" data-placement="left" style="margin: 10px;"> 
            <i class="fa fa-plus"></i>  Nova Vistoria
        </a> -->
        <!-- <a @click="search()" class="btn bg-navy btn-flat pull-left"  tabindex="0" title="Pesquisar mais vistorias" style="margin: 10px;">
            <i class="fa fa-search"></i> Pesquisa avançada
        </a> -->
        
    </div>
</div>
</template>
<script>
export default {
    props: {
        typeImmobile: Array,
        typeInspector: Array
    },
    data(){
        return {
            searchTitle: 'Pesquisa avançada',
            labelBtnSearch: 'Pesquisa avançada',
            infoPlaceholder: 'Escolha uma opção para pesquisar',
            input: '',
            showInput: true,
            typeInput: 'text',
            disabledBtnSeach: true,
            typeSearch: '',
            options: [],
            valueSelect: ''
        }
    },
    created() {
        
    },
    methods: {
        search(value) {
            var arrayData = {
                value : value,
                params: this.typeSearch
            }
            //Enviando dados para outro componente
            this.$eventBus.$emit('search-survey', arrayData);
        },
        handleClick(command) {
            //Recebendo valor selecionado
            this.typeSearch = command
            switch (command) {
                case 'codigo':
                    this.infoPlaceholder = 'Digite um código para pesquisa e aperte ENTER'
                    this.labelBtnSearch = 'Código'
                    this.showInput = true
                    this.disabledBtnSeach = false
                    break;
                case 'tipo':
                    this.infoPlaceholder = 'Escolha um tipo'
                    this.labelBtnSearch = 'Tipo de Imóvel'
                    this.showInput = false
                    this.options = this.typeImmobile
                    break;
                case 'status':
                    this.infoPlaceholder = 'Escolha um status'
                    this.labelBtnSearch = 'Status de Vistoria'
                    this.showInput = false
                    break;
                case 'vistoriador':
                    this.infoPlaceholder = 'Digite o nome do vistoriador'
                    this.labelBtnSearch = 'Vistoriador'
                    this.showInput = false
                    this.showType = true
                    this.options = this.typeInspector
                    break;
                case 'endereco':
                    this.infoPlaceholder = 'Digite um endereço'
                    this.labelBtnSearch = 'Endereço'
                    this.showInput = true
                    this.disabledBtnSeach = false   
                    break;
            }
        }
    },
}
</script>
<style lang="">
    .el-dropdown {
        display: grid !important;
    }
.btn-primary {
    background-color: #3c8dbc;
    border-color: #367fa9;
}
.btn-primary:hover {
    color: #fff;
    background-color: #286090;
    border-color: #204d74;
}
</style>