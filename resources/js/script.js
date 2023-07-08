$(() => {
    // Setting of common variables
    var sMethod = 'POST';
    var iCurrentId = 0;
    var sConfirmationMessage = 'Are you sure you want to register this new data?';
    var sUrl = '/api/add';
    var sAlertMessage = 'Registration successful';
    var sErrorMessages = 'There is an error while saving new data.';

    init();

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

    function init() {
        let sPathName = window.location.pathname;
        let aExplodedPathName = sPathName.split('/');

        // List Page
        if (sPathName === '/' || aExplodedPathName[2] === 'list') {
            getKangarooData();
        } else if (aExplodedPathName[2] === 'add') {

        } else {
            sMethod = 'PUT';
            sConfirmationMessage = 'Are you sure you want to update the data?';
            iCurrentId = aExplodedPathName[3];
            sUrl = '/api/edit/' + iCurrentId;
            sAlertMessage = 'Modification successful';
            sErrorMessages = 'There is an error while updating data.';
            populateForm(iCurrentId);
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
     * Insert or update new kangaroo data upon clicking of the submit button
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.07
     */
    $('#submit').click(function() {
        if (confirm(sConfirmationMessage) === true) {
            const oFormData = validateFields();
            if (oFormData.bIsValid === true) {
                if (sMethod === 'PUT') {
                    oFormData.form_data['id'] = iCurrentId;
                }

                $.ajax({
                    url: sUrl,
                    type: sMethod,
                    data: oFormData.form_data,
                    success: function() {
                        alert(sAlertMessage);
                        // window.location.href = '/kangaroo/list';
                    },
                    error: function(oErrorResponse) {
                        alert(sErrorMessages);
                        if (oErrorResponse.status === 422) {
                            displayBackendErrorMessages(oErrorResponse.responseJSON.errors);
                        }
                    }
                });
            }
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

        // Hide and empty inline error messages
        $('.invalid-feedback').text('');
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
        const oErrorMessages = {
            name     : 'Please fill out this field.',
            weight   : 'Please fill out this field.',
            height   : 'Please fill out this field.',
            gender   : 'Please select an option from the dropdown menu.',
            birthday : 'Please choose a date from the calendar.'
        }

        let bIsValid = true;
        $.each(oFormData, function(sKey, sValue) {
            if ($.inArray(sKey, ['name', 'weight', 'height', 'gender', 'birthday']) !== -1) {
                if (sValue === '') {
                    $('#' + sKey + '-error').text(oErrorMessages[sKey]);
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
        const oErrorMessages = {
            name     : 'Name should only contain letters, spaces, and hyphens. It must be between 1 and 50 characters long.',
            nickname : 'Nickname should only contain letters, numbers, spaces, hyphens, and underscores. It must be between 1 and 20 characters long.',
            color    : 'Color should only contain letters and spaces. It must be between 1 and 20 characters long.'
        }

        const oNameProperties = new RegExp('^[a-zA-Z\\s\-]{1,50}$');
        const oNicknameProperties = new RegExp('^[a-zA-Z0-9\\s\-_]{0,20}$');
        const oColorProperties = new RegExp('^[a-zA-Z\\s]{0,20}$');

        $.each(oFormData, function(sKey, sValue) {
            if ($.inArray(sKey, ['name', 'nickname', 'color']) !== -1) {
                if (sKey === 'name' && oNameProperties.test(sValue) !== true) {
                    $('#' + sKey + '-error').text(oErrorMessages[sKey]);
                    $('#' + sKey + '-error').show();
                    bIsValid = false;
                }

                if (sKey === 'nickname' && oNicknameProperties.test(sValue) !== true) {
                    $('#' + sKey + '-error').text(oErrorMessages[sKey]);
                    $('#' + sKey + '-error').show();
                    bIsValid = false;
                }

                if (sKey === 'color' && oColorProperties.test(sValue) !== true) {
                    $('#' + sKey + '-error').text(oErrorMessages[sKey]);
                    $('#' + sKey + '-error').show();
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
                    $('#name-error').text('Name you entered already exists. Please choose a different name.');
                    $('#name-error').show();
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

    /**
     * populateForm
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.08
     */
    function populateForm(iId) {
        $.ajax({
            url: '/api/list/' + iId,
            type: 'GET',
            dataType: 'json',
            success: function(oSuccessResponse) {
                $.each(oSuccessResponse, function(sKey, mValue) {
                    $('#' + sKey).val(mValue);
                });
            },
            error: function(){
                alert('There is an error while retrieving the data from the database. Please try again.');
                window.location.href = '/kangaroo/list';
            }
        });
    }

    /**
     * displayBackendErrorMessages
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.08
     * @param {object} oErrors
     */
    function displayBackendErrorMessages(oErrors) {
        $.each(oErrors, function(sField, oMessages) {
            $('#' + sField + '-error').text(oMessages.join(', '));
            $('#' + sField + '-error').show();
        });
    }
});
