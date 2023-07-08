/**
 * buildDataGridTable
 * Builds DxDataGridTable settings and contents for the view page
 * @since 2023.07.06
 * @param {array} aData
 */
export function buildDataGridTable(aData) {
    let oGridInstance = {};

    $('#gridContainer').dxDataGrid({
        dataSource: aData,
        editing: {
            mode: 'row',
            allowUpdating: true
        },
        toolbar: {
            items: [
                {
                    widget: 'dxButton',
                    location: 'before',
                    options: {
                        text: 'Add New Kangaroo',
                        onClick: function() {
                            window.location.href = '/kangaroo/add';
                        }
                    }
                },
                {
                    widget: 'dxTextBox',
                    location: 'after',
                    options: {
                        placeholder: 'Search',
                        mode: 'search',
                        width: 180,
                        onValueChanged: function(oEvent) {
                            let sSearchText = oEvent.component.option('value');
                            oGridInstance.option('searchPanel.text', sSearchText);
                            if (sSearchText) {
                                oGridInstance.searchByText(sSearchText);
                            } else {
                                oGridInstance.clearFilter();
                            }
                        }
                    }
                },
            ]
        },
        loadPanel: {
            enabled: true
        },
        keyExpr: 'id',
        showBorders: true,
        filterRow: {
            visible: true,
            applyFilter: 'auto'
        },
        columns: [
            {
                dataField: 'name',
                caption: 'Name',
                alignment: 'center'
            },
            {
                dataField: 'birthday',
                caption: 'Birthday',
                alignment: 'center',
                dataType: 'date',
                format: 'yyyy-MM-dd'
            },
            {
                dataField: 'weight',
                caption: 'Weight',
                alignment: 'center'

            },
            {
                dataField: 'height',
                caption: 'Height',
                alignment: 'center'
            },
            {
                dataField: 'friendliness',
                caption: 'Friendliness',
                alignment: 'center'
            },
            {
                type: 'buttons',
                buttons: [{
                    template: function(oContainer, oOptions) {
                        $('<a>')
                            .addClass('dx-link')
                            .text('Edit')
                            .on('dxclick', function() {
                                window.location.href = '/kangaroo/edit/' + oOptions.data.id;
                            })
                            .appendTo(oContainer);
                    }
                }]
            }
        ],
        onInitialized: function(oEvent) {
            oGridInstance = oEvent.component;
        }
    });
}
