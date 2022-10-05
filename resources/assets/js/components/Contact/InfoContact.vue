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
                    <td>{{contact.address}} ... {{contact.district}}</td>
                    <td>{{contact.phoneFixed}}</td>
                    <td>{{contact.creci}}</td>
                    <td>
                        <button @click="editContact($event, contact)">Editar</button></td>
                </tr>
            </tbody>
        </table>
            </div>           
        </div>
    </div>
    <div class="col-md-12">
        <form @submit.prevent="savecontact($event)" ref="form" enctype="multipart/form-data" >
        <div class="box">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Endereço</label>
                            <input type="text" v-model="form.address" class="form-control" id="" placeholder="Logradouro">
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label>Número</label>
                            <input type="text"  v-model="form.number" class="form-control" id="" placeholder="Número">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Complemento</label>
                            <input type="text" v-model="form.complement" class="form-control" id="" placeholder="Complemento">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Bairro</label>
                            <input type="text" v-model="form.district" class="form-control" id="" placeholder="Bairro">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" v-model="form.city" class="form-control" id="" placeholder="Cidade">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Estado</label>
                            <input type="text" v-model="form.state" class="form-control" id="" placeholder="Estado">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>E-mail</label>
                            <input type="text" v-model="form.email" class="form-control" id="" placeholder="E-mail">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telefone Fixo</label>
                            <input type="text" v-model="form.phoneFixed" class="form-control" id="" placeholder="Telefone Fixo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telefone Celular</label>
                            <input type="text" v-model="form.mobile" class="form-control" id="" placeholder="Telefone Celular">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>CNPJ</label>
                        <input type="text" v-model="form.cnpj" class="form-control" id="" placeholder="CNPJ">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CRECI/CE</label>
                            <input type="text" v-model="form.creci" class="form-control" id="" placeholder="CRECI/CE">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CEP</label>
                            <input type="text" v-model="form.cep" class="form-control" id="" placeholder="CEP">
                        </div>
                    </div>
                </div>

            </div>    
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right" title="Cadatrar Contato"> 
                    <i class="fa fa-save"></i>  Cadastrar
                </button>
            </div>
        </div>
        </form>
    </div>
    <modal name="example" @before-open="beforeOpen">
        <div class="partition-title">CREATE ACCOUNT</div>
        <div class="col-md-12">
            <div class="form-group">
                        <label>Endereço</label>
                            <input type="text" v-model="formEdit.address" class="form-control" id="" placeholder="Logradouro">
                    </div>
        </div>
    </modal>
</div>
</template>

<script>
import 'vue-js-modal/dist/styles.css'
export default {
    name: 'DemoLoginModal',
    data () {
        return {
            contacts: [],
            form: {
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
            formEdit: {
                address: 'Rua aqui',
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
            }
        }
    },
    created() {
        this.getContact()
    },
    mounted() {
        // this.savecontact();
        
    },
    methods: {
        getContact(){
            axios.get(domain_complet + 'api/contact')
            .then(response =>{
                console.log('contact', response.data)
                this.contacts = response.data
                console.log(this.contacts)
            })
        },
        savecontact(event){
            var form = this.form;
           axios.post(domain_complet + 'api/contact/create', form)
           .then(function (response) {
            console.log(response);
           })
           .catch()
        },
        editContact(event, contacts) {
            console.log(contacts)
            this.formEdit.address = contacts.address
            this.$modal.show('example')
        },
        beforeOpen (event) {
            console.log(event.params);
        }
    }
}
</script>
