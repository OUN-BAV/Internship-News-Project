@if ($crud->hasAccess('create'))
	<a class="btn btn-dark text-light" data-style="zoom-in" id='upload'><span class="ladda-label"><i class="la la-cloud-download-alt"></i>Import</span></a>
@endif

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
            $('#upload').confirm({
                title: 'Import CSV',
                content: '' +
                '<form action="{{URL("/admin/customer/importToDatabase")}}" class="formName" enctype="multipart/form-data">' +
                '<div class="form-group">' +
                '<label>select you CSV file</label>' +
                '<input type="file"  accept=".csv, .xls, .xlsx" class="name" name="file" id="csvFile" required />' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            
                            var name = this.$content.find('.name').val();
                            if(!name){
                                $.alert('provide a valid file');
                                return false;
                            }
                            else{
                                // $.alert('file selected');
                                var jform = new FormData();
                                jform.append('file',$('#csvFile')[0].files[0])
                                $.ajax({
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url:'/admin/user/importToDatabase',
                                    method: 'post',
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    data: jform,
                                    enctype: 'multipart/form-data',
                                    success: function (response) {
                                        console.log(response);
                                        if(response.success) {
                                            new Noty({
                                                type: 'success',
                                                text: response.message
                                            }).show();
                                            setTimeout(function() {
                                                crud.table.ajax.reload();
                                            }, 200);
                                        } else {
                                            new Noty({
                                                type: 'error',
                                                text: response.message
                                            }).show();  
                                        }
                                    },
                                    error: function(error) {
                                        new Noty({
                                                type: 'error',
                                                text: "Import customer failed"
                                        }).show();
                                    }
                                })
                            }
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
    });
</script>