<template lang="">
    <ag-grid-vue
    style="width: 100%; height: 200px"
    class="ag-theme-alpine"
    :columnDefs="columnDefs"
    :rowData="rowData"
  >
  </ag-grid-vue>
</template>
<script>

import { AgGridVue } from 'ag-grid-vue';

import TotalValueRenderer from './totalValueRendererVue'

const ColourComponent = {
  template: `<span>
    <a class="btn" href="https://bitbucket.org/dashboard/overview">
         Editar</a>        
    </span>`
};


export default {
    components: {
        AgGridVue,
        ColourComponent,
        totalValueRenderer: TotalValueRenderer,
    },
    data() {
        return {
            idButton: 0,
            displayValue: '',
            columnDefs: [
                { headerName: "Make", field: "make" },
                { headerName: "Model", field: "model" },
                { headerName: "Price", field: "price" },
                { 
                    headerName: "Ação", 
                    field: "action",
                    cellRenderer: 'totalValueRenderer',
                },
            ],
            rowData: [
                { make: "Toyota", model: "Celica", price: 35000 },
                { make: "Ford", model: "Mondeo", price: 32000 },
                { make: "Porsche", model: "Boxster", price: 72000 },
                { make: "Porsche", model: "Boxster", price: 72000 },
            ],
        }
    },
    beforeMount() {
       this.displayValue = this.params;
   },
    methods: {
        btnClickedHandler() {
            this.params.clicked(this.params.value);
        },
    }
}
</script>
<style lang="">
    
</style>