<template>
    <div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Endereço</th>
                    <th>Fone Fixo</th>
                    <th>CRECI</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts" :key="contact.id">
                    <td>
                        {{contact.address}}, {{contact.district}},
                        {{contact.city}}, {{contact.state}}, CEP: {{contact.cep}}
                    </td>
                    <td>{{contact.phoneFixed}}</td>
                    <td>{{contact.creci}}</td>
                    <td>
                        <button 
                        @click="editContact($event, contact)" 
                        title="Alterar"
                        class="btn btn-default">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button 
                        @click="deleteContact(contact)" 
                        title="Excluir"
                        class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
            </div>           
        </div>
    </div>
    <div class="col-md-12">
        <form @submit.prevent="savecontact($event)" ref="formContact" enctype="multipart/form-data" >
            <form-contact 
                :form="this.form" 
                :typeSave="this.typeSave" 
                @resetFormContact="formReset(form)"
            ></form-contact>
        </form>
    </div>
    <modal 
        name="modal-edit" 
        :width="600" 
        :adaptive="true"
        :height="430">
            <div class="modal-header">           
                <div class="dialog-c-title">Excluir Registro</div>  <br />            
            </div>
            <div class="dialog-content">
                <div class="dialog-c-text">Deseja realmente excluir esse registro?</div>
            </div>
            <form @submit.prevent="savecontact($event)" ref="form" enctype="multipart/form-data" ></form>
                <!-- <form-contact :form="this.form" :typeSave="this.typeUpdate"></form-contact> -->
            </form>
    </modal>
</div>
</template>

<script>
import 'vue-js-modal/dist/styles.css'
export default {
    data () {
        return {
            contacts: [],
            form: {
                id: '',
                address: '',
                number: '',
                complement: '',
                district: '',
                city: '',
                state: '',
                email: '',
                phoneFixed: '',
                mobile: '',
                cnpj: '',
                creci: '',
                cep: ''
            },
            typeSave: 'create',
            titleDelete: ''
        }
    },
    created() {
        this.getContact()
    },
    methods: {
        getContact(){
            axios.get(domain_complet + 'api/contact')
            .then(response =>{
                // console.log('contact', response.data)
                this.contacts = response.data
            })
        },
        savecontact(event){
            var form = this.form;
            if(form.id === ''){
                axios.post(domain_complet + 'api/contact/create', form)
                .then((response) =>  {
                    this.$swal({
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.getContact();
                    
                })
                .catch( (error) =>{
                   console.log({error})
                    this.$swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ocorreu um erro inesperado'
                    })
                })
            }else{
                axios.patch(domain_complet + 'api/contact/'+form.id, form)
                .then((response) =>  {
                    this.$swal({
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.getContact();
                })
                .catch( (error) => {
                    this.$swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: error.data.message
                    })
                })
            }  
            
        },
        editContact(event, contacts) {
            console.log(contacts)
            this.form.id = contacts.id
            this.form.address = contacts.address
            this.form.complement = contacts.address
            this.form.district = contacts.district
            this.form.city = contacts.city
            this.form.state = contacts.state
            this.form.email = contacts.email
            this.form.phoneFixed = contacts.phoneFixed
            this.form.mobile = contacts.mobile
            this.form.cnpj = contacts.cnpj
            this.form.creci = contacts.creci
            this.form.cep = contacts.cep
            this.typeSave = 'update'
            // this.$modal.show('modal-edit')
        },
        deleteContact(contacts){
            // this.$modal.show('modal-edit')
            // this.$swal('Hello Vue world!!!');
            console.log({contacts})
            this.$swal({
            title: 'Excluir Contato',
            text: "Deseja realmente excluir esse contato?",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, quero excluir',
            cancelButtonText: 'Não, quero sair'
            }).then((result) => {
                console.log('contacts',contacts)
                if (result.isConfirmed) {
                axios.delete(domain_complet + 'api/contact/delete/'+contacts.id)
                .then(response =>{
                    this.getContact();
                    this.$swal({
                        icon: 'success',
                        title: 'Excluído com sucesso',
                        showConfirmButton: true
                    })
                })
                .catch(error =>{
                    this.$swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href="">Why do I have this issue?</a>'
                    })
                })
                
                }
            })
        },
        resetForm(form){
            var self = this;
            Object.keys(form).forEach(function(key,index) {
                self.form[key] = '';
            });
        },
        formReset(form) {
            console.log('formReset' , form)
            this.resetForm(form);
            this.typeSave = 'create'
        }
    }
}
</script>
<style>
    .vm--modal {
        border-radius: 8px;
    }
    .dialog-content {
        flex: 1 0 auto;
        width: 100%;
        padding: 15px;
        font-size: 14px;
    }
    .dialog-c-title {
        font-weight: 600;
        padding-bottom: 15px;
    }
    .modal-header {
        display: flex;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: .3rem;
        border-top-right-radius: .3rem;
    }
    .vue-dialog div {
        box-sizing: border-box;
    }
</style>