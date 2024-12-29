/*
 Copyright (c) 2007-2024, CKSource Holding sp. z o.o. All rights reserved.
 For licensing, see LICENSE.html or https://ckeditor.com/sales/license/ckfinder
 */

var config = {};

CKFinder.editorConfig = function( config ) {
    config.filebrowserBrowseUrl = BASE_URL + 'templates/userfiles';
    config.filebrowserImageBrowseUrl = BASE_URL + 'templates/userfiles/images';
    config.filebrowserFlashBrowseUrl = BASE_URL + 'templates/userfiles/flash';
    config.filebrowserUploadUrl = BASE_URL + 'templates/userfiles/upload';
    config.filebrowserImageUploadUrl = BASE_URL + 'templates/userfiles/upload/images';
    config.filebrowserFlashUploadUrl = BASE_URL + 'templates/userfiles/upload/flash';

    // Add any additional configuration settings here.
};

CKFinder.define( config );