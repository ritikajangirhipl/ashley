<div class="card card-custom">
    <div class="card-header py-3">
        <div class="card-title">
            <h3 class="card-label font-weight-bolder text-dark">Order Forms</h3>
        </div>
    </div>
    <div class="card-body">	
        {!! Form::open(array('url' => route('cart.add'), 'method'=>'POST', 'files'=>true, 'id' => "orderForm", 'class' => "", 'enctype' => "multipart/form-data")) !!}	
            {{ Form::hidden("service_id", encrypt($service->id),['id' => "service_id", 'required' => true]) }}
            <div class="row">
                @php
                    $cartItem = null; 
                    if($update == 0){
                        
                        $cartItem = collect(Cart::instance('shopping')->content())->firstWhere('id', $service->id);
                        
                    } 
                @endphp
                @if($fields)
                    @foreach($fields as $key => $field)
                        @if($service->{$key})
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">{{ $field['label'] }}</label><span class="text-danger">*</span>
                                    @php
                                        $value = $cartItem->options->{$field['field_name']} ?? null;
                                    @endphp
                                    @if($field['inp_type'] == "text")
                                        {{ Form::text($field['field_name'], $value,['class' => "form-control", 'id' => $field['field_name'], 'required' => true, 'placeholder' => $field['label']]) }}
                                        
                                    @elseif($field['inp_type'] == "file")
                                        
                                        {!! Form::file($field['field_name'], ['accept' => 'application/pdf','id' => $field['field_name']]) !!}

                                    @elseif($field['inp_type'] == "select")
                                        @php
                                            $options = $field['options'];
                                            if($key == "location"){
                                                $options = getActiveCountries();
                                            }

                                            $selected = $cartItem->options->{$field['field_name']} ?? null;
                                        @endphp
                                        <select id="{{ $field['field_name'] }}" name="{{ $field['field_name'] }}" class="form-control" required>
                                            <option value="">Select One</option>
                                            @foreach($options as $oKey => $option)
                                                <option value="{{ $oKey }}" {{ $value == $oKey ? 'selected' : '' }}>{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    @elseif($field['inp_type'] == "textarea")
                                        {{ Form::textarea($field['field_name'], $value,['class' => "form-control", 'id' => $field['field_name'], 'required' => true, 'placeholder' => $field['label'],'rows' => 2]) }}
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

                @if($service->additionalFields)
                    @foreach($service->additionalFields as $key => $aField)
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                {{ Form::label("", $aField->field_name) }}
                                @php
                                    $value = $cartItem->options->{str_replace(' ', '_', $aField->field_name)} ?? null;
                                @endphp
                                
                                @if($aField->field_required)
                                <span class="text-danger">*</span>
                                @endif
                                @if($aField->field_type == 1)
                                    {{ Form::text($aField->field_name, $value,['class' => "form-control", 'id' => "", 'required' => $aField->field_required, 'placeholder' => $aField->field_name]) }}
                                    
                                @elseif($aField->field_type == 4)
                                    {{ Form::date($aField->field_name, $value,['class' => "form-control", 'id' => "", 'required' => $aField->field_required, 'placeholder' => $aField->field_name]) }}
                                @elseif($aField->field_type == 2) 
                                    @php
                                        $options = json_decode($aField->combo_values) ?? [];
                                    @endphp
                                    <select id="" name="{{ $aField->field_name }}" class="form-control" {{ $aField->field_required == 1 ? "required" : "" }}>
                                        <option value="">Select One</option>
                                        @foreach($options as $oKey => $option)
                                            <option value="{{ $oKey }}" {{ $value == $oKey ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @elseif($aField->field_type == 3)
                                    {{ Form::textarea($aField->field_name, $value,['class' => "form-control", 'id' => $field['field_name'], 'required' => $aField->field_required, 'placeholder' => $aField->field_name,'rows' => 2]) }}
                                @endif 
                            </div>
                        </div>                    
                    @endforeach
                @endif
                <div class="col-md-12 col-lg-12 text-left">
                    <button id="add_to_cart" class="btn btn-primary min-w-130px">Add to cart</button>
                </div>
            </div>
        {{ Form::close() }}
    </div>
</div>


@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    function addToCart(form) {
        var formData = new FormData(form);

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#add_to_cart').prop('disabled', true);
            },
            success: function (response) {
                if (response.status == "success") {
                    window.location.href = response.redirect_url;
                } else if(response.status == "error"){
                    window.location.href = response.redirect_url;
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'Something went wrong!',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                }
            },
            error: function (xhr) {
                $('#add_to_cart').prop('disabled', false);

                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        let input = $('[name="' + key + '"]');
                        input.addClass('is-invalid');
                        input.closest('.form-group').find('.invalid-feedback').remove();
                        input.after('<span class="invalid-feedback">' + value[0] + '</span>');
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: xhr.responseJSON.message || 'An unexpected error occurred!',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                }
            },
            complete: function () {
                $('#add_to_cart').prop('disabled', false);
            }
        });
    }
    
    $(document).ready(function () {
        $("#orderForm").validate({
            errorElement: 'span',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                if (element.hasClass("select2")) {
                    error.appendTo(element.parent());
                } else if (element.is("textarea")) {
                    error.appendTo(element.closest('.form-group'));
                } else {
                    error.appendTo(element.closest('.form-group'));
                }
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                addToCart(form);
            }
        });
    });
</script>
@endsection