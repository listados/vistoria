<template lang="">
    <div>
        <div>
        <div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Nome do Vistoriador</label>
                <input
                    type="text"
                    v-model="survey.survey_inspetor_name"
                    class="form-control"
                    placeholder="Nome do Vistoriador"
                    id="survey_inspetor_name"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">CPF do vistoriador</label>
                <input
                    type="text"
                    v-model="survey.survey_inspetor_cpf"
                    class="form-control"
                    placeholder="CPF do Vistoriador"
                    id="survey_inspetor_cpf"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Data da vistoria</label>
                <date-picker
                    v-model="dtSurvey"
                    format="DD/MM/YYYY"
                    type="date"
                    placeholder="Selecione uma data"
                    input-class="form-control"
                    @change="alterValueField('datepicker', 'survey_date')"
                ></date-picker>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Tipo</label>
                <el-select 
                    v-model="typeSurvey"
                    placeholder="Selecione o tipo"
                    size="large"
                    id="survey_type"
                    @change="alterValueField('select', 'survey_type')"
                >
                    <el-option
                    v-for="item in options"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                    </el-option>
                </el-select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box-header with-border">
                <h3 class="box-title">Dados do imóvel</h3>
            </div>		
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="">Endereço do imóvel</label>
                <input
                    type="text"
                    v-model="survey.survey_address_immobile"
                    class="form-control"
                    placeholder="Endereço do imóvel"
                    id="survey_address_immobile"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Tipo do imóvel</label>
                <el-select 
                    v-model="typeImmobile"
                    placeholder="Selecione o tipo"
                    size="large"
                    id="survey_type_immobile"
                    filterable
                    @change="alterValueField('select', 'survey_type_immobile')"
                >
                    <el-option
                    v-for="item in optionsTypeImmobile"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                    </el-option>
                </el-select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="survey_energy_meter">Medidor de energia</label>
                <input
                    type="text"
                    v-model="survey.survey_energy_meter"
                    class="form-control"
                    placeholder="---"
                    id="survey_energy_meter"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="survey_energy_load">Leitura de energia</label>
                <input
                    type="text"
                    v-model="survey.survey_energy_load"
                    class="form-control"
                    placeholder="---"
                    id="survey_energy_load"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="survey_water_meter">Medidor de água</label>
                <input
                    type="text"
                    v-model="survey.survey_water_meter"
                    class="form-control"
                    placeholder="---"
                    id="survey_water_meter"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="survey_water_load">Leitura de água</label>
                <input
                    type="text"
                    v-model="survey.survey_water_load"
                    class="form-control"
                    placeholder="---"
                    id="survey_water_load"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="survey_gas_meter">Medidor de gás</label>
                <input
                    type="text"
                    v-model="survey.survey_gas_meter"
                    class="form-control"
                    placeholder="---"
                    id="survey_gas_meter"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="survey_gas_load">Leitura do gás</label>
                <input
                    type="text"
                    v-model="survey.survey_gas_load"
                    class="form-control"
                    placeholder="---"
                    id="survey_gas_load"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="form-group">
            <label for="">Link do tour</label>
            <input 
                type="text" 
                name="survey_link_tour" 
                v-model="survey.survey_link_tour"
                placeholder="Digite o link do tour virtual já feito" 
                class="form-control"
                id="survey_link_tour"
                @blur="alterValueField('input')"
            >
        </div>
        </div>
    </div>
</template>
<script>
import  {Admin}  from "../../../../../public/js/helpers.js";
export default {    
    props: {
        idSurvey: String,
        survey: Array
    },
    data() {
        return {
            dtSurvey: Vue.moment( this.survey.survey_date).format('DD/MM/YYYY'),
            typeImmobile: this.survey.survey_type_immobile,
            typeSurvey: this.survey.survey_type,
            cpf_inspector: '',
            options: [{
                value: 'Alteração',
                label: 'Alteração'
                }, {
                value: 'Entrada',
                label: 'Entrada'
                }, {
                value: 'Saída',
                label: 'Saída'
            }],
            optionsTypeImmobile: [{
                value: 'Andar Corporativo',
                label: 'Andar Corporativo'
                },{
                value: 'Apartamento',
                label: 'Apartamento'
                },{
                value: 'Apartamento Duplex',
                label: 'Apartamento Duplex'
                },{
                value: 'Apartamento Garden',
                label: 'Apartamento Garden'
                },{
                value: 'Apartamento Triplex',
                label: 'Apartamento Triplex'
                },{
                value: 'Área',
                label: 'Área'
                },{
                value: 'Barracão',
                label: 'Barracão'
                },{
                value: 'Box/Garagem',
                label: 'Box/Garagem'
                },{
                value: 'Casa',
                label: 'Casa'
                },{
                value: 'Chácara',
                label: 'Chácara'
                },{
                value: 'Cobertura',
                label: 'Cobertura'
                },{
                value: 'Conjunto',
                label: 'Conjunto'
                },{
                value: 'Fazenda',
                label: 'Fazenda'
                },{
                value: 'Flat',
                label: 'Flat'
                },{
                value: 'Galpão',
                label: 'Galpão'
                },{
                value: 'Ilha',
                label: 'Ilha'
                },{
                value: 'Kitnet',
                label: 'Kitnet'
                },{
                value: 'Laje',
                label: 'Laje'
                },{
                value: 'Loft',
                label: 'Loft'
                },{
                value: 'Hotel',
                label: 'Hotel'
                },{
                value: 'Loja',
                label: 'Loja'
                },{
                value: 'Ponto',
                label: 'Ponto'
                },{
                value: 'Pousada',
                label: 'Pousada'
                },{
                value: 'Prédio',
                label: 'Prédio'
                },{
                value: 'Rancho',
                label: 'Rancho'
                },{
                value: 'Resort',
                label: 'Resort'
                },{
                value: 'Sala',
                label: 'Sala'
                },{
                value: 'Salão',
                label: 'Salão'
                },{
                value: 'Pavilhão',
                label: 'Pavilhão'
                },{
                value: 'Sítio',
                label: 'Sítio'
                },{
                value: 'Sobrado',
                label: 'Sobrado'
                },{
                value: 'Studio',
                label: 'Studio'
                },{
                value: 'Terreno',
                label: 'Terreno'
                },{
                value: 'Village',
                label: 'Village'
                }
            ],          
        }
    },
    created() {
        console.log(Vue.moment(this.dtSurvey).format('YYYY-MM-DD')) //es
        console.log(this.tour)
    },
    methods: {
        alterValueField(type, name = null) {
            var dataUp = {survey_id: this.idSurvey }
            switch (type) {
                case "input":
                    dataUp[event.target.id] = event.target.value;
                    break;
                case "datepicker":
                    dataUp[name] = this.dtSurvey;
                    break;
                case "select":
                    dataUp[name] = event.target.innerText;
                    break;
            }
            console.log({dataUp})
            axios.put(Admin.baseUrl() + '/api/survey/alter-field', dataUp)
            .then( (res) => {
                this.$message({
                    showClose: true,
                    type: 'success',
                    message: 'Salvo',
                    duration: 1000
                });
            })
            .catch( (erro) =>{
                this.$message({
                    type: 'error',
                    message: res.data.message
                }); 
            })
        }
    }
}
</script>
<style lang="">
    .mx-datepicker {
        position: relative;
        display: inline-block;
        width: 100% !important;
    }
    .el-input__inner {
        border: 1px solid #c3c3c3  !important;
        border-radius: 0px  !important;
        height: 34px  !important;
    }
    .el-input__icon {
        line-height: 34px !important;
    }
</style>