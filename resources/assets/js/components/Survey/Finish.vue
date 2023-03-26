<template lang="">
    <div class="">
        <div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Finalizar {{survey.survey_status}}</h3>					
				</div>					
				<div class="box-body">
					<div class="col-md-6">
						<div class="form-group pull-left">
                            <el-button
                             type="primary"
                             :disabled="survey.survey_status === 'Finalizada'"
                             title="Finaliza a vistoria sem a possibilidade de edição"
                             @click="open">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                CONLUIR VISTORIA
                            </el-button>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group pull-right">
							<el-button
                             title="Sairá dessa vistoria e irá para lista de vistorias"
                             @click="closedSurvey"
                            >
                                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
								SAIR DA VISTORIA
                            </el-button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</template>
<script>
import  {urlBase}  from "../../../../../public/js/helpers.js";

export default {
    props: {
        idSurvey: String,
        survey: String
    },
     created() {
      console.log( process.env.MIX_SENTRY_DSN_PUBLIC)
    },
    methods: {
      open() {
        this.$confirm('Tem certeza que queseja finalizar essa vistoria?', 'Finalizar', {
          confirmButtonText: 'Sim',
          cancelButtonText: 'Não, desistir',
          type: 'info',
          beforeClose: (action, instance, done) => {
            if (action === 'confirm') {
              instance.confirmButtonLoading = true;
              instance.confirmButtonText = 'Finalizando ...';
              setTimeout(() => {
                done();
                setTimeout(() => {
                  instance.confirmButtonLoading = false;
                }, 300);
              }, 3000);
            } else {
              done();
            }
          }
        }).then(() => {
            var dataUp = {survey_id: this.idSurvey, survey_status: 'Finalizada' }
            axios.put(process.env.MIX_SENTRY_DSN_PUBLIC+ '/api/survey/alter-field', dataUp)
            .then( (res) => {
                 this.$message({
                    showClose: true,
                    type: 'success',
                    message: 'Vistoria finalizada com sucesso',
                    duration: 1000
                });
                setTimeout(() => {               
                    window.location.href= process.env.MIX_SENTRY_DSN_PUBLIC + "/vistoria"
                }, 2000);
            })
            .catch( (erro) =>{
                this.$message({
                    type: 'error',
                    message: res.data.message
                }); 
            })
        })
      },
      closedSurvey() {
        window.location.href=process.env.MIX_SENTRY_DSN_PUBLIC + "/vistoria"
      }
    }
  
}
</script>
<style lang="">
    
</style>