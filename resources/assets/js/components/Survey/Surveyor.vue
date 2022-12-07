<template lang="">
    <div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Nome do Vistoriador</label>
                <input type="text" class="form-control" placeholder="Nome do Vistoriador" id="survey_inspetor_name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">CPF do vistoriador</label>
                <input type="text" class="form-control" placeholder="Nome do Vistoriador" id="cpf_vistoriador">
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

export default {
    props: {
        idSurvey: String
    },
    data() {
        return {
            dtSurvey: null,
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
    methods: {
        alterValueField() {
            var dataUp = {survey_id: this.idSurvey }
            axios.put('api/survey/alter-field', dataUp)
            .then( (res) => {
                
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