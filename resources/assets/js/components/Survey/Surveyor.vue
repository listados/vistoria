<template lang="">
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
                    placeholder="Nome do Vistoriador"
                    id="cpf_vistoriador"
                    @blur="alterValueField('input')"
                >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Data da vistoria</label>
                <date-picker
                    v-model="survey.survey_date"
                    format="DD/MM/YYYY"
                    type="date"
                    placeholder="Seleciona um data"
                    input-class="form-control"
                    @change="alterValueField('datepicker', 'survey_date')"
                ></date-picker>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Tipo</label>
                <el-select 
                    v-model="survey.survey_type"
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
    </div>
</template>
<script>
const moment = require('moment')
export default {    
    props: {
        idSurvey: String,
        survey: Array
    },
    data() {
        return {
            dtSurvey: new Date(),
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
            valueType: ''
        }
    },
    created() {
        console.log(Vue.moment().format('YYYY-MM-DD')) //es
        console.log(this.survey)
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
                    dataUp[name] = this.valueType;
                    break;
            }
            axios.put('http://localhost:5050/api/survey/alter-field', dataUp)
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