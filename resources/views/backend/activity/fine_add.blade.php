@extends('layout.backend.containerform')

@section('footer_js')
    <script src="http://ibook.dev/js/jquery-1.10.2.js"></script>
    <script src="{{ asset('backend/plugins/formValidation/formValidation.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/formValidation/bootstrap.min.js') }}"></script>
    <!-- Include CKEditor and jQuery adapter -->
    <script src="//cdn.ckeditor.com/4.4.3/basic/ckeditor.js"></script>
    <script src="//cdn.ckeditor.com/4.4.3/basic/adapters/jquery.js"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.

            CKEDITOR.replace('description', {
                filebrowserBrowseUrl: "{{ asset('backend/plugins/ckfinder/ckfinder.html') }}",
                filebrowserImageBrowseUrl: "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('backend/plugins/ckfinder/ckfinder.html?type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
                filebrowserWindowWidth: '1000',
                filebrowserWindowHeight: '700'
            });

            //bootstrap WYSIHTML5 - text editor
//        $(".textarea").wysihtml5();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#postForm')
                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'The full name is required and cannot be empty'
                                    }
                                }
                            },
                            summary: {
                                validators: {
                                    notEmpty: {
                                        message: 'The summary is required and cannot be empty'
                                    },
                                    callback: {
                                        message: 'The summary must be less than 200 characters long',
                                        callback: function (value, validator, $field) {
                                            if (value === '') {
                                                return true;
                                            }
                                            // Get the plain text without HTML
                                            var div = $('<div/>').html(value).get(0),
                                                    text = div.textContent || div.innerText;

                                            return text.length <= 200;
                                        }
                                    }
                                }
                            },
                            content: {
                                // Use the same transformer for all validators
                                transformer: function ($field, validatorName, validator) {
                                    var value = $field.val();
                                    if (value === '') {
                                        return value;
                                    }

                                    // Get the plain text without HTML
                                    var div = $('<div/>').html(value).get(0),
                                            text = div.textContent || div.innerText;

                                    return text;
                                },
                                validators: {
                                    notEmpty: {
                                        message: 'The content is required and cannot be empty'
                                    },
                                    stringLength: {
                                        message: 'The content must be less than 1000 characters long',
                                        max: 1000
                                    }
                                }
                            }
                        }
                    })
                    .find('[name="summary"], [name="description"]')
                    .each(function () {
                        $(this)
                                .ckeditor()
                                .editor
                                .on('change', function (e) {
                                    $('#postForm').formValidation('revalidateField', e.sender.name);
                                });
                    });
        });
    </script>
@endsection

@section('dynamicdata')




    <form id="postForm" method="post" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-3 control-label">Title</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="title"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Summary</label>
            <div class="col-xs-9">
                <textarea class="form-control" name="summary" style="height: 400px;"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Content</label>
            <div class="col-xs-9">
                <textarea class="form-control" name="description" style="height: 400px;"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-5 col-xs-offset-3">
                <button type="submit" class="btn btn-default">Validate</button>
            </div>
        </div>
    </form>


@endsection