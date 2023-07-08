$(() => {
    /**
     * Automatically includes CSRF token in all AJAX requests
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.07
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    init();
    function init() {
        let sPathName = window.location.pathname;
        // List Page
        if (sPathName === '/' || sPathName.split('/').pop() === 'list') {
            getKangarooData();
        } else { // If Add and Edit Page

        }
    }

    /**
     * getKangarooData
     * Fetch all kangaroo data
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.06
     */
    function getKangarooData() {
        $.ajax({
            url: '/api/list',
            type: 'GET',
            dataType: 'json',
            success: function(oSuccessResponse) {
                populateTable(oSuccessResponse);
            },
            error: function(oErrorResponse){
                alert(oErrorResponse.statusText);
                populateTable({});
            }
        });
    }

    /**
     * populateTable
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.06
     * @param {object} oData
     */
    function populateTable(oData) {
        let oGridInstance = {};

        $('#gridContainer').dxDataGrid({
            dataSource: oData,
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

    /**
     * Insert new kangaroo data upon clicking of the submit button
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.07
     */
    $('#submit').click(function() {
        if (confirm('Are you sure you want to register this new data') === false) {
            return false;
        }

        const oFormData = validateFields();
        if (oFormData.bIsValid === true) {
            $.ajax({
                url: '/api/add',
                type: 'POST',
                data: oFormData.form_data,
                success: function() {
                    alert('Registration successful');
                    window.location.href = '/kangaroo/list';
                },
                error: function(oErrorResponse) {
                    alert(oErrorResponse.responseText);
                    //Setting of alert messages from backend
                }
            });
        }
    });

    /**
     * Cancels insert or update of kangaroo data
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.07
     */
    $('#cancel').click(function() {
        window.location.href = '/kangaroo/list';
    });

    /**
     * validateFields
     * @author Lee Benedict F. Baniqued
     * @return {object}
     */
    function validateFields() {
        let oFormData = {};

        // Trim input and select tag values
        $('input, select', $('#kangaroo-form')).each(function() {
            oFormData[$(this).attr('id')] = $.trim($(this).val());
        });

        // Reset inline error messages
        $('.invalid-feedback').hide();

        if (checkIfEmpty(oFormData) === false || checkIfValidCharactersAndLength(oFormData) === false || checkIfNameExists(oFormData['name']) === false) {
            return {
                form_data : {},
                bIsValid  : false
            };
        }

        return {
            form_data : oFormData,
            bIsValid  : true
        };
    }

    /**
     * checkIfEmpty
     * Validates whether a given input is empty or not
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.07
     * @param oFormData
     * @return {boolean}
     */
    function checkIfEmpty(oFormData) {
        let bIsValid = true;
        $.each(oFormData, function(sKey, sValue) {
            if ($.inArray(sKey, ['name', 'weight', 'height', 'gender', 'birthday']) !== -1) {
                if (sValue === '') {
                    $('#' + sKey + '-error').show();
                    bIsValid = false;
                }
            }
        });

        return bIsValid;
    }

    /**
     * checkIfValidCharactersAndLength
     * Validates characters and length of a given input
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.07
     * @param {object} oFormData
     * @return {boolean}
     */
    function checkIfValidCharactersAndLength(oFormData) {
        let bIsValid= true;
        const oNameProperties = new RegExp('^[a-zA-Z\\s-]{1,50}$');
        const oNicknameProperties = new RegExp('^[a-zA-Z0-9\\s\-_]{0,20}$');
        const oColorProperties = new RegExp('^[a-zA-Z\\s]{0,20}$');

        $.each(oFormData, function(sKey, sValue) {
            if ($.inArray(sKey, ['name', 'nickname', 'color']) !== -1) {
                if (sKey === 'name' && oNameProperties.test(sValue) !== true) {
                    $('#' + sKey + '-chars-error').show();
                    bIsValid = false;
                }

                if (sKey === 'nickname' && oNicknameProperties.test(sValue) !== true) {
                    $('#' + sKey + '-chars-error').show();
                    bIsValid = false;
                }

                if (sKey === 'color' && oColorProperties.test(sValue) !== true) {
                    $('#' + sKey + '-chars-error').show();
                    bIsValid = false;
                }
            }
        });

        return bIsValid;
    }

    /**
     * checkIfNameExists
     * Checks if name is already exists in the current record
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.07
     * @param {string} sName
     * @return {boolean}
     */
    function checkIfNameExists(sName) {
        let bIsValid= true;

        $.ajax({
            url: '/api/check-name/' + sName,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function(oSuccessResponse) {
                if (oSuccessResponse.bIsExist === true) {
                    $('#name-exist-error').show();
                    bIsValid = false;
                }
            },
            error: function(oErrorResponse){
                alert(oErrorResponse.statusText);
                bIsValid = false;
            }
        });

        return bIsValid;
    }
});
