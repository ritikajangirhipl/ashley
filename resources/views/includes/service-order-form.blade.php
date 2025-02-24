<div class="card card-custom">
    <div class="card-header py-3">
        <div class="card-title">
            <h3 class="card-label font-weight-bolder text-dark">Order Forms</h3>
        </div>
    </div>
    <div class="card-body">	
        {!! Form::open(array('url' => route('cart.add'), 'method'=>'POST', 'files'=>true, 'id' => "orderForm", 'class' => "", 'enctype' => "multipart/form-data")) !!}	
            <div class="row">
                @if($fields)
                    @foreach($fields as $key => $field)
                        @if($service->{$key})
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">{{ $field['label'] }}</label><span class="text-danger">*</span>
                                    @if($field['inp_type'] == "text")
                                        {{ Form::text($field['field_name'], null,['class' => "form-control", 'id' => $field['field_name'], 'required' => true, 'placeholder' => $field['label']]) }}
                                        
                                    @elseif($field['inp_type'] == "file")
                                        
                                        {!! Form::file($field['field_name'], ['accept' => 'application/pdf','id' => $field['field_name']]) !!}

                                    @elseif($field['inp_type'] == "select")
                                        @php
                                            $options = $field['options'];
                                            if($key == "location"){
                                                $options = getActiveCountries();
                                            }
                                        @endphp
                                        <select id="{{ $field['field_name'] }}" name="{{ $field['field_name'] }}" class="form-control" required>
                                            <option value="">Select One</option>
                                            @foreach($options as $oKey => $option)
                                                <option value="{{ $oKey }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    @elseif($field['inp_type'] == "textarea")
                                        {{ Form::textarea($field['field_name'], null,['class' => "form-control", 'id' => $field['field_name'], 'required' => true, 'placeholder' => $field['label'],'rows' => 2]) }}
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
                                @if($aField->field_required)
                                <span class="text-danger">*</span>
                                @endif
                                @if($aField->field_type == 1)
                                    {{ Form::text($aField->field_name, null,['class' => "form-control", 'id' => "", 'required' => $aField->field_required, 'placeholder' => $aField->field_name]) }}
                                    
                                @elseif($aField->field_type == 4)
                                    {{ Form::date($aField->field_name, null,['class' => "form-control", 'id' => "", 'required' => $aField->field_required, 'placeholder' => $aField->field_name]) }}
                                @elseif($aField->field_type == 2) 
                                    @php
                                        $options = json_decode($aField->combo_values) ?? [];
                                    @endphp
                                    <select id="" name="{{ $aField->field_name }}" class="form-control" {{ $aField->field_required == 1 ? "required" : "" }}>
                                        <option value="">Select One</option>
                                        @foreach($options as $oKey => $option)
                                            <option value="{{ $oKey }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @elseif($aField->field_type == 3)
                                    {{ Form::textarea($aField->field_name, null,['class' => "form-control", 'id' => $field['field_name'], 'required' => $aField->field_required, 'placeholder' => $aField->field_name,'rows' => 2]) }}
                                @endif 
                            </div>
                        </div>                    
                    @endforeach
                @endif
                <div class="col-md-12 col-lg-12 text-left">
                    <button class="btn btn-primary min-w-130px">Add to cart</button>
                </div>
            </div>
        {{ Form::close() }}
    </div>
</div>


@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

@include('includes.common-js')	
<script type="text/javascript">

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
                submitForm(form);
            }
        });
    });
</script>
@endsection