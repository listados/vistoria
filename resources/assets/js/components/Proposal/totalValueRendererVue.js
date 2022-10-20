export default {
    template: `
          <span>
                <span>{{ cellValue }}</span>
                <button @click="buttonClicked()">Editar</button>
            </span>
      `,
    data: function () {
      return {
        cellValue: null,
      };
    },
    beforeMount() {
      // this.params contains the cell and row information and is made available to this component at creation time
      // see ICellRendererParams for more details
      console.log('this.params ' , this.params)
      this.cellValue = this.getValueToDisplay(this.params);
    },
    methods: {
      buttonClicked() {
        console.log(`${this.cellValue} medals won!`);
        console.log(this.params)
        // this.params.context.componentParent.methodFromParent(
        //     `Row: ${this.params.node.rowIndex}, Col: ${this.params.colDef.headerName}`
        //   );
      },
  
      getValueToDisplay(params) {
        return params.valueFormatted ? params.valueFormatted : params.value;
      },
    },
  };