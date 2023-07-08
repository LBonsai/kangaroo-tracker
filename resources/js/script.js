import { buildDataGridTable } from './dxdatagrid';

$(() => {
    var sMethod = 'POST';
    var iCurrentId = 0;
    var sConfirmationMessage = 'Are you sure you want to register this new data?';
    var sUrl = '/api/add';
    var sAlertMessage = 'Registration successful';
    var sErrorMessages = 'There is an error while saving new data.'
    var sFormName = 'Registration Form';

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

    initializeConfiguration();

    /**
     * initializeConfiguration
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.08
     */
    function initializeConfiguration() {
        let sPathName = window.location.pathname;
        let aRouteValue = sPathName.split('/');

        if (sPathName === '/' || aRouteValue[2] === 'list') {
            getKangarooData();
        } else {
            setRegisterAndUpdateFormAttributes(aRouteValue);
        }
    }

    /**
     * getKangarooData
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.06
     */
    function getKangarooData() {
        $.ajax({
            url: '/api/list',
            type: 'GET',
            dataType: 'json',
            success: function(aSuccessResponse) {
                buildDataGridTable(aSuccessResponse);
            },
            error: function(oErrorResponse){
                alert(oErrorResponse.responseJSON.message);
                buildDataGridTable([]);
            }
        });
    }

    /**
     * Insert or update kangaroo data upon clicking of the submit button
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
                        window.location.href = '/kangaroo/list';
                    },
                    error: function(oErrorResponse) {
                        if (oErrorResponse.status === 422) {
                            alert(sErrorMessages);
                            displayBackendErrorMessages(oErrorResponse.responseJSON.errors);
                        } else {
                            alert(oErrorResponse.responseJSON.message);
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
     * @since 2023.07.08
     * @return {object}
     */
    function validateFields() {
        let oFormData = {};

        // Trim input and select tag values
        $('input, select', $('#kangaroo-form')).each(function() {
            oFormData[$(this).attr('id')] = $.trim($(this).val());
        });

        // Hide and empty inline error messages
        $('.invalid-feedback').text('').hide();

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
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.07
     * @param {object} oFormData
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
                    $('#' + sKey + '-error').text(oErrorMessages[sKey]).show();
                    bIsValid = false;
                }
            }
        });

        return bIsValid;
    }

    /**
     * checkIfValidCharactersAndLength
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
            color    : 'Color should only contain letters and spaces. It must be between 1 and 20 characters long.',
            birthday : 'Birthday must be in the format "YYYY-MM-DD".',
            weight   : 'Weight should be a positive float number with up to 5 digits before the decimal and up to 2 digits after the decimal.',
            height   : 'Height should be a positive float number with up to 5 digits before the decimal and up to 2 digits after the decimal.'
        }

        const oValidationRules = {
            name     : new RegExp('^[a-zA-Z\\s\-]{1,50}$'),
            nickname : new RegExp('^[a-zA-Z0-9\\s\-_]{0,20}$'),
            color    : new RegExp('^[a-zA-Z\\s]{0,20}$'),
            birthday : new RegExp('^\\d{4}-\\d{2}-\\d{2}$'),
            weight   : new RegExp('^\\d{0,5}\\.\\d{1,2}$'),
            height   : new RegExp('^\\d{0,5}\\.\\d{1,2}$')
        };

        $.each(oFormData, function(sKey, sValue) {
            if (oValidationRules.hasOwnProperty(sKey) === true && oValidationRules[sKey].test(sValue) === false) {
                $('#' + sKey + '-error').text(oErrorMessages[sKey]).show();
                bIsValid = false;
            }
        });

        return bIsValid;
    }

    /**
     * checkIfNameExists
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.07
     * @param {string} sName
     * @return {boolean}
     */
    function checkIfNameExists(sName) {
        let bIsValid= true;
        let oParams = {name : sName};
        if (sMethod === 'PUT') {
            $.extend(oParams, {id: iCurrentId});
        }

        $.ajax({
            url: '/api/check-name?' + $.param(oParams),
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function(oSuccessResponse) {
                if (oSuccessResponse.bIsExist === true) {
                    $('#name-error').text('Name you entered already exists. Please choose a different name.').show();
                    bIsValid = false;
                }
            }
        });

        return bIsValid;
    }

    /**
     * populateForm
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.08
     * @param {int} iId
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
            $('#' + sField + '-error').text(oMessages.join(' ')).show();
        });
    }

    /**
     * setRegisterAndUpdateFormAttributes
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.08
     * @param {array} aRouteValue
     */
    function setRegisterAndUpdateFormAttributes(aRouteValue) {
        if (aRouteValue[2] === 'edit') {
            sMethod = 'PUT';
            sConfirmationMessage = 'Are you sure you want to update the data?';
            iCurrentId = aRouteValue[3];
            sUrl = '/api/edit/' + iCurrentId;
            sAlertMessage = 'Modification successful';
            sErrorMessages = 'There is an error while updating data.';
            sFormName = 'Update Form';
            populateForm(iCurrentId);
        }

        setFormAttributes(sFormName);
        setDatePickerAttributes();

    }

    /**
     * setFormAttributes
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.08
     * @param {string} sFormName
     */
    function setFormAttributes(sFormName) {
        $('#form-name').text(sFormName);
    }

    /**
     * setDatePickerAttributes
     * @author Lee Benedict F. Baniqued
     * @since 2023.07.08
     */
    function setDatePickerAttributes() {
        let oDate = new Date();
        let iYear = oDate.getFullYear();
        let iMonth = oDate.getMonth() + 1;
        let iDay = oDate.getDate();
        let sFormattedDate = `${iYear}-${iMonth.toString().padStart(2, '0')}-${iDay.toString().padStart(2, '0')}`;

        $('#birthday').attr('max', sFormattedDate).datepicker({
            dateFormat: 'yy-mm-dd',
            maxDate: sFormattedDate,
            onClose: function(sSelectedDate) {
                let oCurrentDate = new Date();
                let oSelectedDate = new Date(sSelectedDate);
                oCurrentDate.setHours(0, 0, 0, 0);
                oSelectedDate.setHours(0, 0, 0, 0);

                if (oSelectedDate.toString() === 'Invalid Date' && $(this).val() !== '') {
                    alert('The selected date is not a valid date.');
                    $(this).datepicker('setDate', '');
                }

                if (oSelectedDate > oCurrentDate) {
                    $(this).datepicker('setDate', oCurrentDate);
                }
            }
        });
    }
});
