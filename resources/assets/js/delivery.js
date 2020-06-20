
    $('#delivery-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: domain_complet + '/delivery/all',
        columns: [
        {data: 'deliveries_id', name: 'deliveries_id'},
        {data: 'deliveries_name', name: 'deliveries_name'},
        {data: 'deliveries_phone', name: 'deliveries_phone'},
        {data: 'deliveries_mobile', name: 'deliveries_mobile'},
        {data: 'deliveries_cpf', name: 'deliveries_cpf'},
        {data: 'action', name: 'action', orderable: false, searchable: false}

        ]
    }); 