<template lang="">
    <div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Nome do Vistoriador</label>
                <input
                    type="text"
                    v-model="survey_inspetor_name"
                    class="form-control"
                    placeholder="Nome do Vistoriador"
                    id="survey_inspetor_name"
                    @blur=alterValueField
                >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">CPF do vistoriador</label>
                <input
                    type="text"
                    v-model="cpf_inspector"
                    class="form-control"
                    placeholder="Nome do Vistoriador"
                    id="cpf_vistoriador"
                    @blur=alterValueField
                >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Data da vistoria</label>
                <!-- <input type="text" class="form-control" placeholder="Nome do Vistoriador" id="data_vistoria"> -->
                <date-picker
                    v-model="dtSurvey"
                    format="DD/MM/YYYY"
                    type="date"
                    placeholder="Seleciona um data"
                    input-class="form-control"
                    @change=alterValueField
                ></date-picker>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Tipo</label>
                <el-select 
                    v-model="value"
                    placeholder="Selecione o tipo"
                    size="large"
                    
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
        idSurvey: String
    },
    data() {
        return {
            dtSurvey: new Date(),
            survey_inspetor_name: 'Junior Logado',
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
            value: ''
        }
    },
    created() {
        console.log(Vue.moment().format('YYYY-MM-DD')) //es
    },
    methods: {
        
        alterValueField(event) {
            var dataUp = {survey_id: this.idSurvey }
            //verifica se é o campo datetime picker
            if (!event.hasOwnProperty('target')) {
                dataUp['survey_date'] = Vue.moment().format('YYYY-MM-DD');
            }else{
                dataUp[event.target.id] = event.target.value;
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
</style>