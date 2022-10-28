<template lang="">
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
        <div class="col-md-10">
            <el-input
            :placeholder="infoPlaceholder"
            v-model="input"
            clearable
            style="width: 100%"
            v-if="showInput">
                <el-button 
                    slot="append" 
                    class="btn bg-olive btn-flat" 
                    icon="el-icon-search"
                    style="width: 100px"
                    title="Pesquisar vistoria">
                </el-button>
            </el-input>
            <el-select 
            v-model="value" 
            :placeholder="infoPlaceholder" 
            v-if="showInput == false"
            style="width: 100%">
            <el-option
            
            v-for="item in options"
            :key="item.value"
            :label="item.label"
            :value="item.value">
            </el-option>
        </el-select>
        </div>
        <!-- <a href="{{ 'vistoria/create' }}" class="btn bg-olive btn-flat pull-right load-modal"  tabindex="0"  data-toggle="popover" data-trigger="hover" data-content="Você criará uma nova vistoria" data-placement="left" style="margin: 10px;"> 
            <i class="fa fa-plus"></i>  Nova Vistoria
        </a> -->
        <!-- <a @click="search()" class="btn bg-navy btn-flat pull-left"  tabindex="0" title="Pesquisar mais vistorias" style="margin: 10px;">
            <i class="fa fa-search"></i> Pesquisa avançada
        </a> -->
        
    </div>
</template>
<script>
export default {
    data(){
        return {
            searchTitle: 'Pesquisa avançada',
            labelBtnSearch: 'Pesquisa avançada',
            infoPlaceholder: 'Escolha uma opção para pesquisar',
            input: '',
            showInput: true,
            options: [{
                value: 'Option1',
                label: 'Option1'
                }, {
                value: 'Option2',
                label: 'Option2'
                }, {
                value: 'Option3',
                label: 'Option3'
                }],
        }
    },
    methods: {
        search() {
            console.log(this.$eventBus)
            this.$eventBus.$emit('search-survey', this.searchTitle);
        },
        handleClick(command) {
            // this.$message('click on item ' + command);
            switch (command) {
                case 'codigo':
                    this.infoPlaceholder = 'Digite um código para pesquisa'
                    this.labelBtnSearch = 'Código'
                    this.showInput = true
                    break;
                case 'tipo':
                    this.infoPlaceholder = 'Escolha um tipo'
                    this.labelBtnSearch = 'Tipo de Imóvel'
                    this.showInput = false
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
                    break;
                case 'endereco':
                    this.infoPlaceholder = 'Digite um endereço'
                    this.labelBtnSearch = 'Endereço'
                    this.showInput = true
                    break;
            }
        }
    },
}
</script>
<style lang="">
    
</style>